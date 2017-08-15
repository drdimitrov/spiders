<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Newsletter\NewsletterContract;
use App\Services\Newsletter\MailChimpNewsletter;
use Mailchimp;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NewsletterContract::class, function($app){
            $client = new Mailchimp(env('MAILCHIMP_SECRET'));
            return new MailChimpNewsletter($client);
        });
    }
}
