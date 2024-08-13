<?php
class ScssList {
	public static $files = [
		[
			'css' => 'style.css',
			'scss' => [
				'den.scss',
				'mixin.scss',
				'fonts.scss',
				'utilites.scss',
				'base.scss',
				'blocks.scss',
				'modals.scss',
				'style.scss',
			]
		],
	];
	
	public static function Instance() {
		return self::$files;
	}
}
return ScssList::Instance();