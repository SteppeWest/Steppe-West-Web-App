<?php
// sw_manager/commands/clean.php

/**
 * Recursively delete a directory’s contents (but not the dir itself).
 */
function rrmdir_contents(string $dir): void {
    foreach (glob(rtrim($dir, '/').'/*') as $path) {
        if (is_dir($path)) {
            rrmdir_contents($path);
            rmdir($path);
        } else {
            unlink($path);
        }
    }
}

// Find each runtime folder under p2-yii2/*/runtime/*
$pattern = __DIR__ . '/../../p2-yii2/*/runtime/*';
foreach (glob($pattern, GLOB_ONLYDIR) as $runtimeDir) {
    echo "Cleaning: {$runtimeDir}\n";
    rrmdir_contents($runtimeDir);
}

echo "✅ All runtime directories cleaned.\n";
