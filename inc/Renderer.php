<?php

class Renderer {
	private $app;

	public function __construct(App $app) {
		$this->app = $app;
	}

	private function renderFilePath($filename) {
		return $this->app->basePath() . 'inc/renders/' . $filename;
	}

	public function renderHead() {
		include $this->renderFilePath('head.min.php');
	}

	public function renderHeader() {
		include $this->renderFilePath('header.min.php');
	}

	public function renderContent() {
		include $this->renderFilePath('content.min.php');
	}

	public function renderContentFoot() {
		include $this->renderFilePath('content.foot.min.php');
	}

	public function renderFooter() {
		include $this->renderFilePath('footer.min.php');
	}

	public function renderResources($type) {
		$resources = $this->app->fetchData('resources');
		$html = '';
		foreach ($resources[$type] as $resource) {
			if ($type === 'css') {
				$html .= '<link rel="stylesheet" href="' . $resource['url'] . '"';
			} elseif ($type === 'js') {
				$html .= '<script src="' . $resource['url'] . '"';
			}
			if (!empty($resource['integrity'])) {
				$html .= ' integrity="' . $resource['integrity'] . '"';
			}
			$html .= ' crossorigin="anonymous">';
			if ($type === 'js') {
				$html .= '</script>';
			}
		}
		return $html;
	}
}
