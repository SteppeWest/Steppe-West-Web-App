<?php

class MinifyManager
{
	private const PHP_VIEW_DIRS = [
		'p2-yii2/backend/views',
		'p2-yii2/frontend/views',
	];

	private const STATIC_ROOT = 'p2-yii2/static';

	public static function run(): int
	{
		$pairCount = 0;
		$actionCount = 0;

		foreach (self::collectPhpPairs() as $pair) {
			$pairCount++;
			$actionCount += self::processPair($pair);
		}

		foreach (self::collectAssetPairs('css') as $pair) {
			$pairCount++;
			$actionCount += self::processPair($pair);
		}

		foreach (self::collectAssetPairs('js') as $pair) {
			$pairCount++;
			$actionCount += self::processPair($pair);
		}

		if ($actionCount === 0) {
			echo Console::info('No files required action.') . PHP_EOL;
		}

		return 0;
	}

	/** @return array<int, array{type:string, formatted:string, working:string}> */
	private static function collectPhpPairs(): array
	{
		$pairs = [];
		$seen = [];

		foreach (self::PHP_VIEW_DIRS as $dir) {
			if (!is_dir($dir)) {
				continue;
			}

			$it = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS)
			);

			foreach ($it as $file) {
				if (!$file->isFile()) {
					continue;
				}

				$path = $file->getPathname();
				if (substr($path, -4) !== '.php') {
					continue;
				}

				if (str_contains($path, DIRECTORY_SEPARATOR . '.') || str_contains($path, '/.')) {
					continue;
				}

				$formatted = str_ends_with($path, '.max.php')
					? $path
					: substr($path, 0, -4) . '.max.php';
				$working = str_ends_with($path, '.max.php')
					? substr($path, 0, -8) . '.php'
					: $path;

				$key = $formatted . '|' . $working;
				if (isset($seen[$key])) {
					continue;
				}

				$seen[$key] = true;
				$pairs[] = [
					'type' => 'php',
					'formatted' => $formatted,
					'working' => $working,
				];
			}
		}

		usort($pairs, fn(array $a, array $b) => strcmp($a['working'], $b['working']));
		return $pairs;
	}

	/** @return array<int, array{type:string, formatted:string, working:string}> */
	private static function collectAssetPairs(string $type): array
	{
		$ext = $type;
		$dirName = $type;
		$pairs = [];
		$seen = [];
		$root = self::STATIC_ROOT;

		if (!is_dir($root)) {
			return [];
		}

		$it = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
		);

		foreach ($it as $file) {
			if (!$file->isFile()) {
				continue;
			}

			$path = $file->getPathname();
			if (substr($path, -strlen('.' . $ext)) !== '.' . $ext) {
				continue;
			}

			if (!preg_match('#/(?:' . preg_quote($dirName, '#') . ')/#', str_replace('\\', '/', $path))) {
				continue;
			}

			$formatted = str_ends_with($path, '.min.' . $ext)
				? substr($path, 0, -strlen('.min.' . $ext)) . '.' . $ext
				: $path;
			$working = str_ends_with($path, '.min.' . $ext)
				? $path
				: substr($path, 0, -strlen('.' . $ext)) . '.min.' . $ext;

			$key = $formatted . '|' . $working;
			if (isset($seen[$key])) {
				continue;
			}

			$seen[$key] = true;
			$pairs[] = [
				'type' => $type,
				'formatted' => $formatted,
				'working' => $working,
			];
		}

		usort($pairs, fn(array $a, array $b) => strcmp($a['working'], $b['working']));
		return $pairs;
	}

	private static function processPair(array $pair): int
	{
		$formattedExists = is_file($pair['formatted']);
		$workingExists = is_file($pair['working']);

		if (!$formattedExists && !$workingExists) {
			return 0;
		}

		if (!$formattedExists) {
			self::ensureParentDir($pair['formatted']);
			self::writeFile($pair['formatted'], file_get_contents($pair['working']));
			self::touchNewer($pair['formatted'], $pair['working']);
			echo Console::ok('Created formatted file: ') . $pair['formatted'] . PHP_EOL;
			return 1;
		}

		if (!$workingExists) {
			self::ensureParentDir($pair['working']);
			$content = file_get_contents($pair['formatted']);
			self::writeFile($pair['working'], self::minify($pair['type'], $content, $pair['formatted']));
			self::touchNewer($pair['formatted'], $pair['working']);
			echo Console::ok('Created working file: ') . $pair['working'] . PHP_EOL;
			return 1;
		}

		if (filemtime($pair['working']) <= filemtime($pair['formatted'])) {
			return 0;
		}

		$original = file_get_contents($pair['working']);
		$minified = self::minify($pair['type'], $original, $pair['working']);

		self::writeFile($pair['working'], $minified);
		self::writeFile($pair['formatted'], $original);
		self::touchNewer($pair['formatted'], $pair['working']);

		echo Console::ok('Minified working file: ') . $pair['working'] . PHP_EOL;
		echo Console::ok('Updated formatted file: ') . $pair['formatted'] . PHP_EOL;
		return 2;
	}

	private static function ensureParentDir(string $path): void
	{
		$dir = dirname($path);
		if (!is_dir($dir)) {
			mkdir($dir, 0755, true);
		}
	}

	private static function writeFile(string $path, string $contents): void
	{
		if (file_put_contents($path, $contents) === false) {
			throw new RuntimeException("Failed writing file: {$path}");
		}
	}

	private static function touchNewer(string $target, string $reference): void
	{
		$ts = max(time(), filemtime($reference) + 1);
		if (!touch($target, $ts)) {
			throw new RuntimeException("Failed touching file: {$target}");
		}
	}

	private static function minify(string $type, string $contents, string $path): string
	{
		return match ($type) {
			'php' => self::minifyPhpView($contents),
			'css' => self::minifyWithExternal($type, $contents, $path),
			'js'  => self::minifyWithExternal($type, $contents, $path),
			default => throw new RuntimeException("Unsupported minify type: {$type}"),
		};
	}

	private static function minifyWithExternal(string $type, string $contents, string $path): string
	{
		$tmpIn = tempnam(sys_get_temp_dir(), 'swm_in_');
		$tmpOut = tempnam(sys_get_temp_dir(), 'swm_out_');
		if ($tmpIn === false || $tmpOut === false) {
			throw new RuntimeException('Failed creating temporary files.');
		}

		file_put_contents($tmpIn, $contents);

		$commands = [];
		if (self::commandExists('minify')) {
			$commands[] = 'minify ' . escapeshellarg($tmpIn) . ' > ' . escapeshellarg($tmpOut);
		}
		if ($type === 'css' && self::commandExists('cleancss')) {
			$commands[] = 'cleancss -o ' . escapeshellarg($tmpOut) . ' ' . escapeshellarg($tmpIn);
		}
		if ($type === 'js' && self::commandExists('terser')) {
			$commands[] = 'terser ' . escapeshellarg($tmpIn) . ' -o ' . escapeshellarg($tmpOut) . ' -c -m';
		}

		foreach ($commands as $command) {
			exec($command, $output, $status);
			if ($status === 0) {
				$result = file_get_contents($tmpOut);
				@unlink($tmpIn);
				@unlink($tmpOut);
				if ($result === false) {
					throw new RuntimeException("Failed reading minified output for {$path}");
				}
				return $result;
			}
		}

		@unlink($tmpIn);
		@unlink($tmpOut);
		throw new RuntimeException(
			"No supported minifier available for {$type} file {$path}. Install 'minify' or the type-specific CLI tools."
		);
	}

	private static function commandExists(string $command): bool
	{
		$check = sprintf('command -v %s >/dev/null 2>&1', escapeshellarg($command));
		exec($check, $output, $status);
		return $status === 0;
	}

	private static function minifyPhpView(string $source): string
	{
		$parts = preg_split('/(<\?(?:php|=)?[\s\S]*?\?>)/', $source, -1, PREG_SPLIT_DELIM_CAPTURE);
		if ($parts === false) {
			throw new RuntimeException('Failed splitting PHP view source.');
		}

		$out = '';
		foreach ($parts as $part) {
			if ($part === '') {
				continue;
			}

			if (preg_match('/^<\?(?:php|=)?[\s\S]*\?>$/', $part) === 1) {
				$out .= self::minifyPhpBlock($part);
				continue;
			}

			$out .= self::minifyHtmlBlock($part);
		}

		return trim($out);
	}

	private static function minifyPhpBlock(string $source): string
	{
		$tokens = token_get_all($source);
		$out = '';
		$needsSpace = false;

		foreach ($tokens as $token) {
			if (is_string($token)) {
				$out .= $token;
				$needsSpace = false;
				continue;
			}

			[$id, $text] = $token;

			if (in_array($id, [T_COMMENT, T_DOC_COMMENT], true)) {
				continue;
			}

			if ($id === T_WHITESPACE) {
				$needsSpace = true;
				continue;
			}

			if ($needsSpace && $out !== '' && !preg_match('/[\s(<>=!,:;\[{]$/', $out) && !preg_match('/^[)\]}>.,:;]$/', $text)) {
				$out .= ' ';
			}

			$out .= $text;
			$needsSpace = false;
		}

		return $out;
	}

	private static function minifyHtmlBlock(string $source): string
	{
		$source = preg_replace('/<!--(?!\[if).*?-->/s', '', $source) ?? $source;
		$source = preg_replace('/>\s+</', '><', $source) ?? $source;
		$source = preg_replace('/\s{2,}/', ' ', $source) ?? $source;
		return trim($source);
	}

	private function findExecutable(array $names): ?string
	{
		$paths = explode(':', getenv('PATH') ?: '');
		$paths = array_merge([
			'/opt/homebrew/bin',
			'/usr/local/bin',
			'/opt/homebrew/sbin',
			'/usr/local/sbin',
		], $paths);

		$paths = array_unique(array_filter($paths));

		foreach ($names as $name) {
			foreach ($paths as $dir) {
				$file = rtrim($dir, '/') . '/' . $name;
				if (is_file($file) && is_executable($file)) {
					return $file;
				}
			}
		}

		return null;
	}


	/*
	findExecutable()
	$minify = $this->findExecutable(['minify']);
	$cleanCss = $this->findExecutable(['cleancss']);
	$terser = $this->findExecutable(['terser']);
	*/


	private function minifyCss(string $inputPath): string
	{
		$minify = $this->findExecutable(['minify']);
		if ($minify !== null) {
			$command = escapeshellarg($minify)
				. ' --type css '
				. escapeshellarg($inputPath)
				. ' 2>/dev/null';

			$output = shell_exec($command);
			if (is_string($output) && trim($output) !== '') {
				return $output;
			}
		}

		$cleanCss = $this->findExecutable(['cleancss']);
		if ($cleanCss !== null) {
			$command = escapeshellarg($cleanCss)
				. ' '
				. escapeshellarg($inputPath)
				. ' 2>/dev/null';

			$output = shell_exec($command);
			if (is_string($output) && trim($output) !== '') {
				return $output;
			}
		}

		throw new \RuntimeException(
			"No supported minifier available for css file {$inputPath}. Install 'minify' or the type-specific CLI tools."
		);
	}








}
