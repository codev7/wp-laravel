<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
//ToDo
//- not needed

/* other tables with no factory defined here. */
//awward_category
//company_metas
//contact_metas
//user_teams

//Awwward
$factory->define(CMV\Models\AwwwardsScraper\Awwward::class, function (Faker\Generator $faker) {
    return [
        'username'=> $faker->userName,
        'name'=> $faker->name(null),
        'site_url'=> $faker->url,
        'twitter'=> $faker->domainWord,
        'gplus'=> 'http://plus.google.com/'.$faker->domainWord,
        'facebook'=> 'http://facebook.com/'.$faker->domainWord,
        'country'=> $faker->country,
        'city'=> $faker->city
    ];
});

//Awwwcategory
$factory->define(CMV\Models\AwwwardsScraper\AwwwCategory::class, function (Faker\Generator $faker) {
    return [
        'name'=> $faker->word
        
    ];
});

//ConciergeSite
$factory->define(CMV\Models\PM\ConciergeSite::class, function (Faker\Generator $faker) {
    return [
        //'files' => [],
        'type' => $faker->randomElement(CMV\Models\PM\ConciergeSite::$types),
        'bitbucket_id' => $faker->randomNumber(7), //id of the site in bitbucket for api sync purposes
        'name' => implode(' ', $faker->words(4)),
        'slug' => implode('-', $faker->words(4)),
        'url' => $faker->url,
        'subdomain' => implode('-', $faker->words(4))//subdomain for the staging site {subdomain}.concierge.approvemyviews.com
    ];
});


//Invoice
$factory->define(CMV\Models\PM\Invoice::class, function (Faker\Generator $faker) {
    return [
        'discount' => $faker->numberBetween(0,100),
        'status' => $faker->randomElement(CMV\Models\PM\Invoice::$statuses),
        'date_paid' => $faker->dateTime()
    ];
});

//Message
$factory->define(CMV\Models\PM\Message::class, function (Faker\Generator $faker) {
    return [
        'comment' => $faker->realText( $faker->randomLetter(200,500) )
    ];
});

//Project
$factory->define(CMV\Models\PM\Project::class, function (Faker\Generator $faker) {
    return [
        'git_url' => 'ssh@bitbucket.org/codemyviews/'.implode('-', $faker->words(4)), //the ssh url for the git repo on bitbucket
        'bitbucket_id' => $faker->url, //bitbucket ID of the project for API purposes
        'team_id' => $faker->url,
        'name' => implode(' ', $faker->words(4)), //unique name of project
        'slug' => implode('-', $faker->words(4)), //unique
        'requested_deadline' => $faker->randomElement(CMV\Models\PM\Project::$requestedDeadlineOptions),
        'guaranteed_deadline' => $faker->randomElement(null, $faker->dateTimeThisMonth()),
        'status' => $faker->randomElement(CMV\Models\PM\Project::$statuses),
        'subdomain' => implode('-', $faker->words(4))
    ];
});

//ProjectBrief
$factory->define(CMV\Models\PM\ProjectBrief::class, function (Faker\Generator $faker) {
    return [
        'text' => $faker->realText( $faker->randomLetter(200,800) ), //will most likely be some sort of json until I figure out actual data structure for the ProjectBriefs
        'approved_at' => $faker->randomElement(null, $faker->dateTimeThisMonth())
    ];
});

$factory->define(CMV\Models\PM\ProjectType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(CMV\Models\PM\ProjectType::$defaults)
    ];
});



//Activity
$factory->define(CMV\Models\Prospector\Activity::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->realText( $faker->randomLetter(200,800) ),
    ];
});

//Company
$factory->define(CMV\Models\Prospector\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => implode(' ', $faker->words(4)),
        'type' => $faker->randomElement(CMV\Models\Prospector\Company::$types),
        'status' => $faker->randomElement(CMV\Models\Prospector\Company::array_keys($statuses))
    ];
});

//CompanyMeta
$factory->define(CMV\Models\Prospector\CompanyMeta::class, function (Faker\Generator $faker) {
    return [
        'value' => $faker->realText( $faker->randomLetter(5,15) )
    ];
});

//Contact
$factory->define(CMV\Models\Prospector\Contact::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName(null),
        'last_name' => $faker->lastName,
        'email' => $faker->email
    ];
});

//ContactMeta
$factory->define(CMV\Models\Prospector\ContactMeta::class, function (Faker\Generator $faker) {
    return [
        'value' => $faker->realText( $faker->randomLetter(5,15) )
    ];
});

//Users
$factory->define(CMV\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});
$factory->defineAs(CMV\User::class, 'developer', function (Faker\Generator $faker) use ($factory) {

    $user = $factory->raw(CMV\User::class);
    return array_merge($user, ['is_developer' => true,'email' => 'developer-'.$faker->unique()->numberBetween(0,9).'@cmv.local']);
});

$factory->defineAs(CMV\User::class, 'project_manager', function (Faker\Generator $faker) use ($factory) {
    
    $user = $factory->raw(CMV\User::class);
    return array_merge($user, ['is_admin' => true,'email' => 'admin-'.$faker->unique()->numberBetween(20,30).'@cmv.local']);
});

$factory->defineAs(CMV\User::class, 'sales_rep', function (Faker\Generator $faker) use ($factory) {
    
    $user = $factory->raw(CMV\User::class);
    return array_merge($user, ['is_sales_rep' => true,'email' => 'sales-'.$faker->unique()->numberBetween(10,20).'@cmv.local']);

});


//Team
$factory->define(CMV\Team::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});




