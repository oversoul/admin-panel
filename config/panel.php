<?php
/**
 * Config panel admin.
 */

return [
	'renderer' => 'default',

	'renderers' => [
		'json'    => Aecodes\AdminPanel\Responses\JsonRenderer::class,
		'default' => Aecodes\AdminPanel\Responses\DefaultRenderer::class,
	],

	'classes' => [
		'link'   => '',
		'button' => '',
	],

	'menu' => function () {
		return [];
	},

	'old_value' => function ($name, $default) {
		return $default;
	},

	'errors' => function () {
		return [];
	}

];