@setup
    $domain = "{$subdomain}.approvemyviews.com";
    $path = "/home/forge/{$domain}";
@endsetup

@servers(['forge' => 'forge@cmvplatform.approvemyviews.com'])

@task('init', ['on' => 'forge'])
    echo 'going to initialize {{$domain}} from {{$repo}}'
    echo 'rm -rf {{$path}}'
    rm -rf {{$path}}
    echo 'git clone {{$repo}} {{$path}}';
    git clone {{$repo}} {{$path}}
@endtask

@task('deploy', ['on' => 'forge'])
    echo 'going to deploy {{$domain}} from {{$repo}}'
    echo 'cd {{$path}}';
    cd {{$path}}
    echo 'git pull';
    git pull
@endtask