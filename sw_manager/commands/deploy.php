<?php
// sw_manager/commands/deploy.php

// 1) Load credentials *only* when deploying
require __DIR__ . '/../credentials.php';

// 2) Switch into your project directories
define('SSH_USER',   SSH_USER);   // from credentials.php
define('SSH_HOST',   SSH_HOST);
define('REMOTE_PATH','/path/on/server');

echo "Deploying to {$SSH_USER}@{$SSH_HOST}:{$REMOTE_PATH}\n";

// 3) Rsync the public_html folder
$cmd = sprintf(
    'rsync -avz --delete public_html/ %s@%s:%s',
    escapeshellarg(SSH_USER),
    escapeshellarg(SSH_HOST),
    escapeshellarg(REMOTE_PATH)
);
passthru($cmd, $exitCode);
exit($exitCode);
