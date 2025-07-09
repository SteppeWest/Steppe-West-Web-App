#!/usr/bin/env php
<?php
// sw_manager/commands/init.php

$args   = $GLOBALS['sw_args'] ?? [];
$remote = Remote::parseFlag($args);

// 1) Determine environment
$env = $remote ? 'Production' : 'Development';

// 2) Run Yii init (overwrite)
Console::info("Running Yii init ({$env})… ");
$initCmd = sprintf(
    'cd p2-yii2 && php init --env=%s --overwrite=1',
    escapeshellarg($env)
);
$code = Ssh::run($initCmd, $remote, SSH_REMOTE_DIR);
if ($code !== 0) {
    fwrite(STDERR, Console::fail("Init failed (exit code {$code}).\n"));
    exit($code);
}
echo Console::ok("done\n");

// 3) Ensure target directories exist
Console::info("Preparing target directories… ");
$prep = implode(' && ', [
    'mkdir -p public_html',
    'mkdir -p public_html/sub_backend',
]);
$code = Ssh::run($prep, $remote, SSH_REMOTE_DIR);
if ($code !== 0) {
    fwrite(STDERR, Console::fail("Directory setup failed.\n"));
    exit(1);
}
echo Console::ok("done\n");

// 4) Deploy frontend/web → public_html
Console::info("Deploying frontend… ");
$front = implode(' && ', [
    'rm -rf public_html/*',                    // wipe everything
    'mkdir -p public_html/sub_backend',        // recreate sub_backend
    'mv p2-yii2/frontend/web/* public_html/',
]);
$code = Ssh::run($front, $remote, SSH_REMOTE_DIR);
if ($code !== 0) {
    fwrite(STDERR, Console::fail("Frontend deploy failed.\n"));
    exit(1);
}
echo Console::ok("done\n");

// 5) Deploy backend/web → public_html/sub_backend
Console::info("Deploying backend… ");
$back = implode(' && ', [
    'rm -rf public_html/sub_backend/*',
    'mv p2-yii2/backend/web/* public_html/sub_backend/',
]);
$code = Ssh::run($back, $remote, SSH_REMOTE_DIR);
if ($code !== 0) {
    fwrite(STDERR, Console::fail("Backend deploy failed.\n"));
    exit(1);
}
echo Console::ok("done\n");

// 6) Copy htaccess into both
Console::info("Copying .htaccess files… ");
$ht = implode(' && ', [
    'cp p2-yii2/environments/yii.htaccess public_html/.htaccess',
    'cp p2-yii2/environments/yii.htaccess public_html/sub_backend/.htaccess',
]);
$code = Ssh::run($ht, $remote, SSH_REMOTE_DIR);
if ($code !== 0) {
    fwrite(STDERR, Console::fail(".htaccess copy failed.\n"));
    exit(1);
}
echo Console::ok("done\n");

// 7) Final success
echo Console::ok("✅ Init complete.\n");
exit(0);
