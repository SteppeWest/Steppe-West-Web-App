#!/usr/bin/env php
<?php
// sw_manager/commands/minify.php

require_once __DIR__ . '/../lib/MinifyManager.php';

try {
	exit(MinifyManager::run());
} catch (Throwable $e) {
	fwrite(STDERR, Console::fail($e->getMessage()) . PHP_EOL);
	exit(1);
}
