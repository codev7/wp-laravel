@setup
    $domain = "{$subdomain}.approvemyviews.com";
@endsetup

@servers(['forge' => 'forge@cmvplatform.approvemyviews.com'])

@task('init', ['on' => 'forge'])
    echo 'going to initialize {{$domain}} from {{$repo}}'
    echo 'rm -rf ./{{$domain}}'
    rm -rf ./{{$domain}}
    echo 'git clone {{$repo}} {{$domain}}';
    git clone {{$repo}} {{$domain}}
@endtask

@task('deploy', ['on' => 'forge'])
    echo 'going to deploy {{$domain}} from {{$repo}}'
    echo 'cd ./{{$domain}}';
    cd ./{{$domain}}
    echo 'git pull';
    git pull
@endtask