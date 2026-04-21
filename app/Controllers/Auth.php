<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Google OAuth 2.0 authentication controller.
 *
 * Required .env keys:
 *   GOOGLE_CLIENT_ID     = <your-client-id>
 *   GOOGLE_CLIENT_SECRET = <your-client-secret>
 *
 * In Google Cloud Console → APIs & Services → Credentials:
 *   Authorised redirect URI: https://yourdomain.com/auth/google/callback
 */
class Auth extends BaseController
{
    private const GOOGLE_AUTH_URL  = 'https://accounts.google.com/o/oauth2/v2/auth';
    private const GOOGLE_TOKEN_URL = 'https://oauth2.googleapis.com/token';
    private const GOOGLE_INFO_URL  = 'https://www.googleapis.com/oauth2/v3/userinfo';

    // ── Redirect to Google ──────────────────────────────────────────────────

    public function google()
    {
        $clientId = env('GOOGLE_CLIENT_ID');

        if (!$clientId) {
            return view('auth/setup_required');
        }

        $state = bin2hex(random_bytes(16));
        session()->set('oauth_state', $state);

        $params = http_build_query([
            'client_id'     => $clientId,
            'redirect_uri'  => base_url('auth/google/callback'),
            'response_type' => 'code',
            'scope'         => 'openid email profile',
            'state'         => $state,
            'access_type'   => 'online',
            'prompt'        => 'select_account',
        ]);

        return redirect()->to(self::GOOGLE_AUTH_URL . '?' . $params);
    }

    // ── Handle OAuth callback ───────────────────────────────────────────────

    public function googleCallback()
    {
        $state = $this->request->getGet('state');
        $code  = $this->request->getGet('code');
        $error = $this->request->getGet('error');

        if ($error || $state !== session()->get('oauth_state')) {
            session()->setFlashdata('forum_error', 'Sign-in was cancelled or failed. Please try again.');
            return redirect()->to(base_url('forum'));
        }

        session()->remove('oauth_state');

        $token = $this->exchangeCode($code);
        if (empty($token['access_token'])) {
            session()->setFlashdata('forum_error', 'Could not get access token from Google.');
            return redirect()->to(base_url('forum'));
        }

        $googleUser = $this->fetchUserInfo($token['access_token']);
        if (empty($googleUser['sub'])) {
            session()->setFlashdata('forum_error', 'Could not fetch your Google profile.');
            return redirect()->to(base_url('forum'));
        }

        $user = (new UserModel())->findOrCreateFromGoogle($googleUser);

        session()->set([
            'user_logged_in' => true,
            'user_id'        => $user['id'],
            'user_name'      => $user['name'],
            'user_email'     => $user['email'],
            'user_avatar'    => $user['avatar'],
        ]);

        $redirect = session()->getFlashdata('login_redirect') ?? base_url('forum');
        return redirect()->to($redirect);
    }

    // ── Logout ──────────────────────────────────────────────────────────────

    public function logout()
    {
        session()->remove(['user_logged_in', 'user_id', 'user_name', 'user_email', 'user_avatar']);
        return redirect()->to(base_url('forum'));
    }

    // ── Helpers ─────────────────────────────────────────────────────────────

    private function exchangeCode(string $code): array
    {
        $ch = curl_init(self::GOOGLE_TOKEN_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query([
                'code'          => $code,
                'client_id'     => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect_uri'  => base_url('auth/google/callback'),
                'grant_type'    => 'authorization_code',
            ]),
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT        => 10,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response ? (json_decode($response, true) ?? []) : [];
    }

    private function fetchUserInfo(string $accessToken): array
    {
        $ch = curl_init(self::GOOGLE_INFO_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $accessToken],
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT        => 10,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response ? (json_decode($response, true) ?? []) : [];
    }
}
