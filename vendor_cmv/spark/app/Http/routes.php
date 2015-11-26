<?php

// Terms Routes...
$router->get('terms', 'TermsController@show');

// Settings Dashboard Routes...
$router->get('settings', 'Settings\DashboardController@show');

// Profile Routes...
$router->put('settings/user', 'Settings\ProfileController@updateUserProfile');

// Team Routes...
if (Spark::usingTeams()) {
    $router->post('settings/teams', 'Settings\TeamController@store');
    $router->get('settings/teams/{id}', 'Settings\TeamController@edit');
    $router->put('settings/teams/{id}', 'Settings\TeamController@update');
    $router->delete('settings/teams/{id}', 'Settings\TeamController@destroy');
    $router->get('settings/teams/switch/{id}', 'Settings\TeamController@switchCurrentTeam');

    $router->post('settings/teams/{id}/invitations', 'Settings\InvitationController@sendTeamInvitation');
    $router->post('settings/teams/invitations/{invite}/accept', 'Settings\InvitationController@acceptTeamInvitation');
    $router->delete('settings/teams/invitations/{invite}', 'Settings\InvitationController@destroyTeamInvitationForUser');
    $router->delete('settings/teams/{team}/invitations/{invite}', 'Settings\InvitationController@destroyTeamInvitationForOwner');

    $router->put('settings/teams/{team}/members/{user}', 'Settings\TeamController@updateTeamMember');
    $router->delete('settings/teams/{team}/members/{user}', 'Settings\TeamController@removeTeamMember');
    $router->delete('settings/teams/{team}/membership', 'Settings\TeamController@leaveTeam');
}

// Security Routes...
$router->put('settings/user/password', 'Settings\SecurityController@updatePassword');
$router->post('settings/user/two-factor', 'Settings\SecurityController@enableTwoFactorAuth');
$router->delete('settings/user/two-factor', 'Settings\SecurityController@disableTwoFactorAuth');

// Subscription Routes...
if (count(Spark::plans()) > 0) {
    $router->post('settings/user/plan', 'Settings\SubscriptionController@subscribe');
    $router->put('settings/user/plan', 'Settings\SubscriptionController@changeSubscriptionPlan');
    $router->delete('settings/user/plan', 'Settings\SubscriptionController@cancelSubscription');
    $router->post('settings/user/plan/resume', 'Settings\SubscriptionController@resumeSubscription');
    $router->put('settings/user/card', 'Settings\SubscriptionController@updateCard');
    $router->put('settings/user/vat', 'Settings\SubscriptionController@updateExtraBillingInfo');
    $router->get('settings/user/plan/invoice/{id}', 'Settings\SubscriptionController@downloadInvoice');
}

// Authentication Routes...
$router->get('login', 'Auth\AuthController@getLogin');
$router->post('login', 'Auth\AuthController@postLogin');
$router->get('logout', 'Auth\AuthController@getLogout');

// Two-Factor Authentication Routes...
if (Spark::supportsTwoFactorAuth()) {
    $router->get('login/token', 'Auth\AuthController@getToken');
    $router->post('login/token', 'Auth\AuthController@postToken');
}

// Registration Routes...
$router->get('register', 'Auth\AuthController@getRegister');
$router->post('register', 'Auth\AuthController@postRegister');

// Password Routes...
$router->get('password/email', 'Auth\PasswordController@getEmail');
$router->post('password/email', 'Auth\PasswordController@postEmail');
$router->get('password/reset/{token}', 'Auth\PasswordController@getReset');
$router->post('password/reset', 'Auth\PasswordController@postReset');

// User API Routes...
$router->get('spark/api/users/me', 'API\UserController@getCurrentUser');

// Team API Routes...
if (Spark::usingTeams()) {
    $router->get('spark/api/teams/invitations', 'API\InvitationController@getPendingInvitationsForUser');
    $router->get('spark/api/teams/roles', 'API\TeamController@getTeamRoles');
    $router->get('spark/api/teams/{id}', 'API\TeamController@getTeam');
    $router->get('spark/api/teams', 'API\TeamController@getAllTeamsForUser');
    $router->get('spark/api/teams/invitation/{code}', 'API\InvitationController@getInvitation');
}

// Subscription API Routes...
if (count(Spark::plans()) > 0) {
    $router->get('spark/api/subscriptions/plans', 'API\SubscriptionController@getPlans');
    $router->get('spark/api/subscriptions/coupon/{code}', 'API\SubscriptionController@getCoupon');
    $router->get('spark/api/subscriptions/user/coupon', 'API\SubscriptionController@getCouponForUser');
}

// Stripe Routes...
if (count(Spark::plans()) > 0) {
    $router->post('stripe/webhook', 'Stripe\WebhookController@handleWebhook');
}
