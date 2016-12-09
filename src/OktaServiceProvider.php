<?php

namespace Tequilarapido\Okta;

use Laravel\Socialite\Contracts\Factory as SocialiteFactory;

class OktaServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        //$this->setupConfig();
        $this->extendSocialite();
    }

    private function extendSocialite()
    {
        $socialite = $this->app->make(SocialiteFactory::class);

        $socialite->extend(
            'okta',
            function ($app) use ($socialite) {
                return $socialite->buildProvider(
                    OktaProvider::class,
                    $app['config']['services.okta']
                );
            }
        );
    }


}