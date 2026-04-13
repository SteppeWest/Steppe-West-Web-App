#!/usr/bin/env php
<?php
// sw_manager/commands/help.php

require_once __DIR__ . '/../lib/Console.php';

echo <<<HELP
Steppe West CLI (“sw”) — available commands:

  help             Show this help text
  clean [-r]       Clear runtime files & published assets (local or remote)
  compose [-r]     Run composer update in p2-yii2 (local or remote)
  init [-r]        Initialize environment (local or remote)
  backup [-r]      Database & codebase backup (local or remote)
  update [-r]      GitHub sync (remote only)
  dbsync           Update remote DB with data from local DB
  compress         Minify assets & views (local only)
  expand           Un-minify assets & views (local only)
  minify           Sync formatted copies and minify deployment PHP/CSS/JS files (local only)

  deploy           Deploy code to public_html via rsync/ssh


  …

Usage:
  sw <command> [args…]

HELP;

