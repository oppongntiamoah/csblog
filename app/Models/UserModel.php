<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['google_id', 'name', 'email', 'avatar'];

    protected $useTimestamps = true;

    public function findOrCreateFromGoogle(array $googleUser): array
    {
        $user = $this->where('google_id', $googleUser['sub'])->first();

        if ($user) {
            $this->update($user['id'], [
                'name'   => $googleUser['name'],
                'avatar' => $googleUser['picture'] ?? $user['avatar'],
            ]);
            return $this->find($user['id']);
        }

        $id = $this->insert([
            'google_id' => $googleUser['sub'],
            'name'      => $googleUser['name'],
            'email'     => $googleUser['email'],
            'avatar'    => $googleUser['picture'] ?? null,
        ]);

        return $this->find($id);
    }
}
