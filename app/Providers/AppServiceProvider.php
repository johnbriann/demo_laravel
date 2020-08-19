<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use BeyondCode\Mailbox\InboundEmail;
//use BeyondCode\Mailbox\Facades\Mailbox;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Mailbox::catchAll(LeadsController::class);
        //Mailbox::catchAll(function (InboundEmail $email) {
            //serialize($email->to()).":::::".serialize($email->attachments())
        //});
    }
}
