<?php

namespace App\Controllers;

use App\Models\ForumCategoryModel;
use App\Models\ForumThreadModel;
use App\Models\ForumPostModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Forum extends BaseController
{
    protected ForumCategoryModel $catModel;
    protected ForumThreadModel   $threadModel;
    protected ForumPostModel     $postModel;

    public function __construct()
    {
        $this->catModel    = new ForumCategoryModel();
        $this->threadModel = new ForumThreadModel();
        $this->postModel   = new ForumPostModel();
    }

    // ── Forum index ─────────────────────────────────────────────────────────

    public function index(): string
    {
        return view('forum/index', [
            'title'      => 'Forum — CS Knowledge Base',
            'categories' => $this->catModel->getCategoriesWithStats(),
        ]);
    }

    // ── Category: thread list ────────────────────────────────────────────────

    public function category(string $slug): string
    {
        $category = $this->catModel->where('slug', $slug)->first();
        if (!$category) throw PageNotFoundException::forPageNotFound();

        return view('forum/category', [
            'title'    => $category['name'] . ' — Forum',
            'category' => $category,
            'threads'  => $this->threadModel->getThreadsForCategory($category['id']),
        ]);
    }

    // ── Thread view ──────────────────────────────────────────────────────────

    public function thread(int $id): string
    {
        $thread = $this->threadModel->getThreadWithMeta($id);
        if (!$thread) throw PageNotFoundException::forPageNotFound();

        // Increment views (only once per session)
        $viewKey = 'viewed_thread_' . $id;
        if (!session()->get($viewKey)) {
            $this->threadModel->set('views', 'views + 1', false)->where('id', $id)->update();
            session()->set($viewKey, true);
        }

        return view('forum/thread', [
            'title'  => $thread['title'] . ' — Forum',
            'thread' => $thread,
            'posts'  => $this->postModel->getPostsForThread($id),
        ]);
    }

    // ── New thread form ──────────────────────────────────────────────────────

    public function newThread(string $catSlug): string
    {
        $category = $this->catModel->where('slug', $catSlug)->first();
        if (!$category) throw PageNotFoundException::forPageNotFound();

        return view('forum/new_thread', [
            'title'    => 'New Thread — ' . $category['name'],
            'category' => $category,
        ]);
    }

    // ── Store new thread (POST) ──────────────────────────────────────────────

    public function storeThread(string $catSlug)
    {
        $category = $this->catModel->where('slug', $catSlug)->first();
        if (!$category) throw PageNotFoundException::forPageNotFound();

        $title = trim((string) $this->request->getPost('title'));
        $body  = trim((string) $this->request->getPost('body'));

        if ($title === '' || $body === '') {
            session()->setFlashdata('forum_error', 'Both a title and a message are required.');
            return redirect()->back()->withInput();
        }

        if (strlen($title) > 255) {
            session()->setFlashdata('forum_error', 'Title must be 255 characters or less.');
            return redirect()->back()->withInput();
        }

        $threadId = $this->threadModel->insert([
            'forum_category_id' => $category['id'],
            'user_id'           => session()->get('user_id'),
            'title'             => $title,
            'slug'              => $this->threadModel->makeUniqueSlug($title),
        ]);

        $this->postModel->insert([
            'thread_id' => $threadId,
            'user_id'   => session()->get('user_id'),
            'body'      => $body,
        ]);

        return redirect()->to(base_url('forum/t/' . $threadId));
    }

    // ── Add reply (POST) ─────────────────────────────────────────────────────

    public function reply(int $threadId)
    {
        $thread = $this->threadModel->find($threadId);
        if (!$thread) throw PageNotFoundException::forPageNotFound();

        if ($thread['is_locked']) {
            session()->setFlashdata('forum_error', 'This thread is locked and no longer accepts replies.');
            return redirect()->to(base_url('forum/t/' . $threadId));
        }

        $body = trim((string) $this->request->getPost('body'));
        if ($body === '') {
            session()->setFlashdata('forum_error', 'Reply cannot be empty.');
            return redirect()->to(base_url('forum/t/' . $threadId));
        }

        $this->postModel->insert([
            'thread_id' => $threadId,
            'user_id'   => session()->get('user_id'),
            'body'      => $body,
        ]);

        // Bump thread's updated_at so it surfaces in recent activity
        $this->threadModel->update($threadId, ['updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->to(base_url('forum/t/' . $threadId) . '#latest');
    }

    // ── Delete post (POST) ───────────────────────────────────────────────────

    public function deletePost(int $postId)
    {
        $post = $this->postModel->find($postId);
        if (!$post) throw PageNotFoundException::forPageNotFound();

        if ((int) $post['user_id'] !== (int) session()->get('user_id')) {
            session()->setFlashdata('forum_error', 'You can only delete your own posts.');
            return redirect()->to(base_url('forum/t/' . $post['thread_id']));
        }

        $threadId = $post['thread_id'];
        $remaining = $this->postModel->where('thread_id', $threadId)->countAllResults();

        $this->postModel->delete($postId);

        if ($remaining <= 1) {
            // Last post deleted — remove thread too
            $thread = $this->threadModel->find($threadId);
            $this->threadModel->delete($threadId);
            session()->setFlashdata('forum_success', 'Thread deleted.');
            return redirect()->to(base_url('forum'));
        }

        session()->setFlashdata('forum_success', 'Post deleted.');
        return redirect()->to(base_url('forum/t/' . $threadId));
    }
}
