<?php
return [
	'rules' => [
		'<language:[A-Za-z]{2,3}>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<language:[A-Za-z]{2,3}>/<controller:\w+>' => '<controller>/index',
		'<language:[A-Za-z]{2,3}>' => 'site/index',
	],
];
