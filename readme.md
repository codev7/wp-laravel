### Webhooks

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
