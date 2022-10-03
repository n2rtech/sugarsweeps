<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';
require 'recipe/deploy/vendors.php';
// Config

set('repository', 'git@git.n2rtechnologies.com:rc21292/sugarsweeps.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('production')
    ->set('remote_user', 'ubuntu')
    ->set('hostname', '15.236.57.233')
    ->set('identityFile', '~/.ssh/id_rsa')
    ->set ('ssh_multiplexing', false)
    ->set('deploy_path', '/var/www/html');
host('staging')
    ->set('remote_user', 'root')
    ->set('hostname', '216.158.229.197')
    ->set('identityFile', '~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/sugarsweeps');

// Hooks

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:optimize',
    'artisan:migrate',
    'npm:install',
    'npm:run:prod',
    'deploy:publish',
]);

task('npm:run:prod', function () {
    cd('{{release_or_current_path}}');
    run('npm run prod');
});

after('deploy:failed', 'deploy:unlock');
