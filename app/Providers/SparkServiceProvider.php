<?php

namespace CMV\Providers;

use CMV\Team;
use Validator;
use Laravel\Spark\Spark;
use Illuminate\Http\Request;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    protected $twoFactorAuth = false;
    /**
     * Meta-data included in invoices generated by Spark.
     *
     * @var array
     */
    protected $invoiceWith = [
        'vendor' => 'Code My Views Inc.',
        'product' => 'Development Services',
        'street' => '2028 E Ben White Blvd Ste 240-9450',
        'location' => 'Austin, TX 78741',
        'phone' => '512-831-6717',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

    /**
     * Customize general Spark options.
     *
     * @return void
     */
    protected function customizeSpark()
    {
        Spark::configure([
            'models' => [
                'teams' => CMV\Team::class,
            ]
        ]);


        /*Spark::validateNewTeamsWith(function() {
        });*/
    }

    /**
     * Customize Spark's new user registration logic.
     *
     * @return void
     */
    protected function customizeRegistration()
    {
        // Spark::validateRegistrationsWith(function (Request $request) {
        //     return [
        //         'name' => 'required|max:255',
        //         'email' => 'required|email|unique:users',
        //         'password' => 'required|confirmed|min:6',
        //         'terms' => 'required|accepted',
        //     ];
        // });

        // Spark::createUsersWith(function (Request $request) {
        //     // Return New User Instance...
        // });
    }

    /**
     * Customize the roles that may be assigned to team members.
     *
     * @return void
     */
    protected function customizeRoles()
    {
        Spark::defaultRole('member');

        Spark::roles([
            'admin' => 'Administrator',
            'member' => 'Member',
        ]);
    }

    /**
     * Customize the tabs on the settings screen.
     *
     * @return void
     */
    protected function customizeSettingsTabs()
    {
        Spark::settingsTabs()->configure(function ($tabs) {
            return [
                $tabs->profile(),
                $tabs->teams(),
                $tabs->security(),
                $tabs->subscription(),
                // $tabs->make('Name', 'view', 'fa-icon'),
            ];
        });

        Spark::teamSettingsTabs()->configure(function ($tabs) {
            return [
                $tabs->owner(),
                $tabs->membership()
            ];
        });
    }

    /**
     * Customize Spark's profile update logic.
     *
     * @return void
     */
    protected function customizeProfileUpdates()
    {
        // Spark::validateProfileUpdatesWith(function (Request $request) {
        //     return [
        //         'name' => 'required|max:255',
        //         'email' => 'required|email|unique:users,email,'.$request->user()->id,
        //     ];
        // });

        // Spark::updateProfilesWith(function (Request $request) {
        //     // Update $request->user()...
        // });
    }

    /**
     * Customize the subscription plans for the application.
     *
     * @return void
     */
    protected function customizeSubscriptionPlans()
    {

        Spark::plan('Freelancer', 'WP-CONCIERGE-SINGLE')->price(599)
         ->features([
             '1 site',
             '1 request at a time',
             '2 Business Days to Complete Non Urgent Tasks',
         ]);

         Spark::plan('Agency', 'WP-CONCIERGE-FREELANCER')->price(1599)
         ->features([
             '3 sites',
             '2 request at a time',
             '2 Business Days to Complete Non Urgent Tasks'
         ]);

         Spark::plan('Agency XL', 'WP-CONCIERGE-AGENCY')->price(2400)
         ->features([
             '5 sites',
             '3 request at a time',
             '1 Business Days to Complete Non Urgent Tasks'
         ]);
    }
}
