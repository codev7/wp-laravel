<?php
require __DIR__ . '/../../../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

if (!$request->user() || $request->user()->is_mastermind == false) {
    header( 'Location: /login' );
    die();
}

/**
 * @link https://github.com/ptrofimov/beanstalk_console
 * @link http://kr.github.com/beanstalkd/
 * @author Petr Trofimov, Sergey Lysenko
 */
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

require_once dirname(__FILE__) . '/../config.php';
$authenticated = false;

if (
        isset($config['auth']) &&
        isset($config['auth']['enabled']) &&
        $config['auth']['enabled'] &&
        isset($_SERVER['PHP_AUTH_USER']) &&
        isset($_SERVER['PHP_AUTH_PW']) &&
        $_SERVER['PHP_AUTH_USER'] == $config['auth']['username'] &&
        $_SERVER['PHP_AUTH_PW'] == $config['auth']['password']
) {
    $authenticated = true;
}

if (!isset($config['auth']) || (isset($config['auth']['enabled']) && $config['auth']['enabled'] == false)) {
    $authenticated = true;
}

if (!$authenticated) {
    header('WWW-Authenticate: Basic realm="Secure Access"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentication required.';
    exit;
}

require_once dirname(__FILE__) . '/../lib/include.php';

$console = new Console;
$errors = $console->getErrors();
$fields = $console->getTubeStatFields();
$groups = $console->getTubeStatGroups();
$visible = $console->getTubeStatVisible();
$tplVars = $console->getTplVars();
extract($tplVars);

require_once dirname(__FILE__) . "/../lib/tpl/{$_tplMain}.php";
