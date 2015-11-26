<?php

namespace Laravel\Spark\Http\Controllers\Auth;

use App\User;
use Validator;
use Exception;
use Carbon\Carbon;
use Laravel\Spark\Spark;
use Illuminate\Http\Request;
use Stripe\Coupon as StripeCoupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Spark\Subscriptions\Plan;
use Laravel\Spark\Events\User\Registered;
use Laravel\Spark\Events\User\Subscribed;
use Laravel\Spark\InteractsWithSparkHooks;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Laravel\Spark\Events\Team\Created as TeamCreated;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Laravel\Spark\Contracts\Repositories\UserRepository;
use Laravel\Spark\Contracts\Repositories\TeamRepository;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Spark\Contracts\Auth\Subscriber as SubscriberContract;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins, ValidatesRequests, InteractsWithSparkHooks;

    /**
     * The user repository instance.
     *
     * @var \Laravel\Spark\Contracts\Repositories\UserRepository
     */
    protected $users;

    /**
     * The team repository instance.
     *
     * @var \Laravel\Spark\Contracts\Repositories\TeamRepository
     */
    protected $teams;

    /**
     * The URI for the login route.
     *
     * @var string
     */
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Laravel\Spark\Contracts\Repositories\UserRepository  $users
     * @param  \Laravel\Spark\Contracts\Repositories\TeamRepository  $teams
     * @return void
     */
    public function __construct(UserRepository $users, TeamRepository $teams)
    {
        $this->users = $users;
        $this->teams = $teams;
        $this->plans = Spark::plans();

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('spark::auth.authenticate');
    }

    /**
     * Send the post-authentication response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, Authenticatable $user)
    {
        if (Spark::supportsTwoFactorAuth() && Spark::twoFactorProvider()->isEnabled($user)) {
            return $this->logoutAndRedirectToTokenScreen($request, $user);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Generate a redirect response to the two-factor token screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $users
     * @return \Illuminate\Http\Response
     */
    protected function logoutAndRedirectToTokenScreen(Request $request, Authenticatable $user)
    {
        Auth::logout();

        $request->session()->put('spark:auth:id', $user->id);

        return redirect('login/token');
    }

    /**
     * Show the two-factor authentication token verification form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToken()
    {
        return session('spark:auth:id') ? view('spark::auth.token') : redirect('login');
    }

    /**
     * Verify the two-factor authentication token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postToken(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        if (! session('spark:auth:id')) {
            return redirect('login');
        }

        $model = config('auth.model');

        $user = (new $model)->findOrFail(
            $request->session()->pull('spark:auth:id')
        );

        if (Spark::twoFactorProvider()->tokenIsValid($user, $request->token)) {
            Auth::login($user);

            return redirect()->intended($this->redirectPath());
        } else {
            return back();
        }
    }

    /**
     * Show the application registration form.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getRegister(Request $request)
    {
        if (Spark::forcingPromotion() && ! $request->query('coupon')) {
            if (count($request->query()) > 0) {
                return redirect($request->fullUrl().'&coupon='.Spark::forcedPromotion());
            } else {
                return redirect($request->fullUrl().'?coupon='.Spark::forcedPromotion());
            }
        }

        if (count($this->plans->paid()) > 0) {
            return view('spark::auth.registration.subscription');
        } else {
            return view('spark::auth.registration.simple');
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $withSubscription = count($this->plans->paid()) > 0 &&
                            $this->plans->find($request->plan) &&
                            $this->plans->find($request->plan)->price > 0;

        return $this->register($request, $withSubscription);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $withSubscription
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request, $withSubscription = false)
    {
        $this->validateRegistration($request, $withSubscription);

        $user = $this->users->createUserFromRegistrationRequest(
            $request, $withSubscription
        );

        if ($request->team_name) {
            $team = $this->teams->create($user, ['name' => $request->team_name]);

            event(new TeamCreated($team));
        }

        if ($request->invitation) {
            $this->teams->attachUserToTeamByInvitation($request->invitation, $user);
        }

        event(new Registered($user));

        if ($withSubscription) {
            event(new Subscribed($user));
        }

        Auth::login($user);

        return response()->json(['path' => $this->redirectPath()]);
    }

    /**
     * Validate the new registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $withSubscription
     * @return void
     */
    protected function validateRegistration(Request $request, $withSubscription = false)
    {
        if (Spark::$validateRegistrationsWith) {
            $this->callCustomRegistrationValidator($request, $withSubscription);
        } else {
            $this->validateDefaultRegistration($request, $withSubscription);
        }
    }

    /**
     * Validate the new custom registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $withSubscription
     * @return void
     */
    protected function callCustomRegistrationValidator(Request $request, $withSubscription)
    {
        $validator = $this->getCustomValidator(
            Spark::$validateRegistrationsWith, $request, [$withSubscription]
        );

        if ($withSubscription) {
            $this->addSubscriptionRulesToValidator($validator, $request);
        }

        $this->callCustomValidator($validator, $request);
    }

    /**
     * Validate a new registration using the default rules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $withSubscription
     * @return void
     */
    protected function validateDefaultRegistration(Request $request, $withSubscription)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'terms' => 'required|accepted',
        ]);

        if ($withSubscription) {
            $this->addSubscriptionRulesToValidator($validator, $request);
        }

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }

    /**
     * Add the subscription rules to the registration validator.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function addSubscriptionRulesToValidator($validator, Request $request)
    {
        $validator->mergeRules('stripe_token', 'required');

        if ($request->coupon) {
            $validator->after(function ($validator) use ($request) {
                $this->validateCoupon($validator, $request);
            });
        }
    }

    /**
     * Validate that the provided coupon actually exists on Stripe.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateCoupon($validator, Request $request)
    {
        try {
            $coupon = StripeCoupon::retrieve(
                $request->coupon, ['api_key' => config('services.stripe.secret')]
            );

            if ($coupon && $coupon->valid) {
                return;
            }
        } catch (Exception $e) {
            //
        }

        $validator->errors()->add('coupon', 'The provided coupon code is invalid.');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return Spark::$afterAuthRedirectTo;
    }
}
