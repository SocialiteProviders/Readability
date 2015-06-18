<?php

namespace SocialiteProviders\Readability;

use Laravel\Socialite\One\AbstractProvider;
use Laravel\Socialite\One\User;

class Provider extends AbstractProvider
{
    /**
     * {@inheritDoc}
     */
    public function user()
    {
        if (!$this->hasNecessaryVerifier()) {
            throw new \InvalidArgumentException('Invalid request. Missing OAuth verifier.');
        }

        $user = $this->server->getUserDetails($token = $this->getToken());

        return (new User())->setRaw($user->extra)->map([
            'id' => null, 'nickname' => $user->nickname, 'name' => $user->name,
            'email' => $user->email, 'avatar' => $user->avatar,
        ])->setToken($token->getIdentifier(), $token->getSecret());
    }
}
