#!/usr/bin/env php
<?php
// sw_manager/commands/update.php

require_once __DIR__ . '/../lib/Remote.php';
$args   = $GLOBALS['sw_args'] ?? [];
$remote = Remote::parseFlag($args);
