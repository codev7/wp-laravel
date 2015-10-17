<?php

namespace CMV;

use Laravel\Cashier\Billable;
use Laravel\Spark\Teams\CanJoinTeams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Cashier\Contracts\Billable as BillableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Spark\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;
use Laravel\Spark\Contracts\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatableContract;

class User extends Model implements AuthorizableContract,
                                    BillableContract,
                                    CanResetPasswordContract,
                                    TwoFactorAuthenticatableContract
{
    use Authorizable, Billable, CanResetPassword, TwoFactorAuthenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'using_two_factor_auth'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_options',
        'stripe_id', 'stripe_subscription', 'last_four', 'extra_billing_info'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'trial_ends_at', 'subscription_ends_at','created_at', 'updated_at', 'deleted_at'
    ];

    public function isAdministrator()
    {

        return $this->administrator;

    }


    public function leads()
    {


        return $this->hasMany( 'CMV\Lead' );

    }

    public function saveNameFromFullName($fullName)
    {

        $parts = explode(" ", $fullName);
        
        $this->first_name = $parts[0];

        if(count($parts) > 1)
        {
            $this->last_name = array_pop($parts);

            $this->first_name = implode(" ", $parts);   
        }
        
        $this->save();
    }

    public function getFullName()
    {


        if(isset($this->last_name) && isset($this->first_name))
        {

            return $this->first_name . ' ' . $this->last_name;

        }


        if(isset($this->first_name))
        {
            return $this->first_name;
        }

        if(isset($this->last_name))
        {
            return $this->last_name;
        }

        return false;
    }
}
