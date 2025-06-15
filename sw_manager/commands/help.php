#!/usr/bin/env php
<?php
// sw_manager/commands/help.php

require_once __DIR__ . '/../lib/Console.php';

echo <<<HELP
Steppe West CLI (“sw”) — available commands:

  help          Show this help text
  clean         Remove all runtime/* files under p2-yii2
  compose       Run composer update in p2-yii2
  backup        Create DB and asset backups
  deploy        Deploy code to public_html via rsync/ssh
  …

Usage:
  sw <command> [args…]

HELP;
