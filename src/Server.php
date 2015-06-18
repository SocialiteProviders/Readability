<?php

namespace SocialiteProviders\Readability;

use Laravel\Socialite\One\User;
use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server as BaseServer;

class Server extends BaseServer
{
    /**
     * {@inheritDoc}
     */
    public function urlTemporaryCredentials()
    {
        return 'https://www.readability.com/api/rest/v1/oauth/request_token/';
    }

    /**
     * {@inheritDoc}
     */
    public function urlAuthorization()
    {
        return 'https://www.readability.com/api/rest/v1/oauth/authorize/';
    }

    /**
     * {@inheritDoc}
     */
    public function urlTokenCredentials()
    {
        return 'https://www.readability.com/api/rest/v1/oauth/access_token/';
    }

    /**
     * {@inheritDoc}
     */
    public function urlUserDetails()
    {
        return 'https://www.readability.com/api/rest/v1/users/_current';
    }

    /**
     * {@inheritDoc}
     */
    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
        $user = new User();
        $user->nickname = $data['username'];
        $user->name = $data['first_name'].' '.$data['last_name'];
        $user->email = $data['email_into_address'];
        $user->avatar = $data['avatar_url'];
        $user->extra = array_diff_key($data, array_flip([
            'username', 'first_name', 'last_name',
            'email_into_address', 'avatar_url',
        ]));

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function userUid($data, TokenCredentials $tokenCredentials)
    {
        return;
    }

    /**
     * {@inheritDoc}
     */
    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
        return $data['email_into_address'];
    }

    /**
     * {@inheritDoc}
     */
    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
        return $data['username'];
    }
}
