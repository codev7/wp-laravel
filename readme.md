# Code

## PHP

### API

Most logic is located in the API controllers (_/app/Controllers/Http/API/_). They response with json data.

If route operates with any entity, e.g. _project_ you should name route parameter as plural form of entity name (_projects_).
 
There's a couple of handy middlewares to check the user permissions:

- _CheckAccessByParameters.php_ - forbids request based off route parameters and route method (DELETE/POST/GET);
Example usege - add the following to the PHPDoc of the controller method - `@Middleware("param-access")`
- _CheckAccessByReference.php_ - forbids request based off request payload, _reference_type_ and _reference_id_ . There're several models which use that approach, e.g. _File_, _ToDo_.
Example usege - add the following to the PHPDoc of the controller method - `@Middleware("ref-access")`

Under the hood these middlewares utilize _CMV\Misc\Acl_ class.
 
## Javascript

Javascript code are located in `/resources/assets/js`.

The directory contents:

- /codemyviews.js - main file. Everything we need on front-end are set up here;
- /init.js - is used in /codemyviews.js, a set of various init methods. E.g. pgax(), vue();
- /custom - global jQuery code. No addition code must be placed here. The existing one will eventially be moved to a custom Vue controllers or init.js.
- /extensions - the place to extend vendor libraries. E.g. Lodash, jQuery.
- /plugins - vendor javascript libraries. 
- /vue - Vue.js-related code. controllers.js, filters.js, directives.js are just helper files to require the code we need to be required;
- /vue/controllers - components which are being mount to the dom on load. `[data-controller]` attribute is used to set the controller (e.g. data-controller="project/new"). Due to Browserify restrictions every new controller must be required in `controllers.js`;
- /vue/directives - custom vue directives. Used to decrease the repetion in the controllers/components. Examples of usage may be found in each file;
- /vue/filters - custom vue filters. Are used to format the data;
- /vue/spark - Laravel Spark (https://github.com/laravel/spark). Basically it's NPM side of the Spark package. Moved to the repository due to conflicts in the js code and a possible need of altering the code for our needs in the future.

The code is managed by http://gulpjs.com/ and it's extension http://laravel.com/docs/5.1/elixir .

gulpfile.js is pretty straightforward:

- /js/vendor + /js/custom folders contents are being concatenated into vendor.js;
- /js/codemyviews.js is browserified into cmv-js.js;
- /css/cmv-app.less is translated to /public/css/cmv-app.css;
- /css/cmv-marketing.less is translated to /public/css/codemyviews.css.

To constantly watch the changes in js/css run the following in the codemyviews project: `gulp; gulp watch`.

# Other

## Webhooks

#### Bitbucket

Controller - /Http/Webhooks/Bitbucket.php .

To create a webhook visit https://bitbucket.org/<ACCOUNT>/<REPOSITORY>/admin/addon/admin/bitbucket-webhooks/bb-webhooks-repo-admin

To test webhooks locally use http://ultrahook.com

To setup Bitbucket API fill in the following variables in your .env file:
```
BITBUCKET_KEY=*****
BITBUCKET_SECRET=****
BITBUCKET_ACCNAME=****
```
Example of usage:
```
$bb = App::make('Bitbucket');
$issues = $bb->api('Repositories\Issues');

$response = $issues->create(\Config::get('services.bitbucket.accname'), $todo->project->bitbucket_slug, [
    'title' => $todo->title,
    'content' => $todo->content,
    'kind' => 'task',
    'priority' => 'major'
]);
$content = json_decode($response->getContent());
```
