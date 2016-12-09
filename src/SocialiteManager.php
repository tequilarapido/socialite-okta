<?php

namespace Tequilarapido\Okta;

class SocialiteManager extends \Laravel\Socialite\SocialiteManager
{
    /**
     * Creates Okta provider and bind it to Laravel Socialite
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    public function createOktaDriver()
    {
        $config = $this->app['config']['services.okta'];

        $provider =  $this->buildProvider(OktaProvider::class, $config);

        $provider->setOktaUrl($config['url']);

        return $provider;
    }
}
