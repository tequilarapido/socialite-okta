<?php

namespace Tequilarapido\Okta;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use Illuminate\Support\Arr;

class OktaProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * Scopes defintions
     *
     * @see http://developer.okta.com/docs/api/resources/oidc.html#scopes
     */
    const SCOPE_OPENID = 'openid';
    const SCOPE_PROFILE = 'profile';
    const SCOPE_EMAIL = 'email';
    const SCOPE_ADDRESS = 'address';
    const SCOPE_PHONE = 'phone';
    const SCOPE_OFFLINE_ACCESS = 'offline_access';

    /**
     * Api base url
     * @todo get from config
     *
     * @var string
     */
    protected $oktaUrl = 'https://tequilarapido.oktapreview.com';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [
        'openid',
        'profile',
        'email',
    ];

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->oktaUrl . '/oauth2/v1/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return $this->oktaUrl . '/oauth2/v1/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code), 'grant_type', 'authorization_code'
        );
    }


    /**
     * {@inheritdoc}
     *
     * @see http://developer.okta.com/docs/api/resources/oidc.html#get-user-information
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->oktaUrl . '/oauth2/v1/userinfo', [
            'headers' => [
                //'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     *
     * @see http://developer.okta.com/docs/api/resources/oidc.html#response-example-success
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => Arr::get($user, 'sub'),
            'email' => Arr::get($user, 'email'),
            'email_verified' => Arr::get($user, 'email_verified', false),
            'nickname' => Arr::get($user, 'nickname'),
            'name' => Arr::get($user, 'name'),
            'first_name' => Arr::get($user, 'given_name'),
            'last_name' => Arr::get($user, 'family_name'),
            'profileUrl' => Arr::get($user, 'profile'),
            'address' => Arr::get($user, 'address'),
            'phone' => Arr::get($user, 'phone'),
        ]);
    }
}