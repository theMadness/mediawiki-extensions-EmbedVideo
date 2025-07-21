<?php

namespace MediaWiki\Extension\EmbedVideo;

class Bootstrap {
	public static function onRegistration() {
		$classAliasMap = [
			'1.44' => [
				[ 'MediaWiki\\Exception\\MWException', 'MWException' ],
				[ 'MediaWiki\\Exception\\ProcOpenError', 'Mediawiki\\ProcOpenError' ],
				[ 'MediaWiki\\Exception\\ShellDisabledError', 'Mediawiki\\ShellDisabledError' ],
				[ 'MediaWiki\\FileRepo\\File\\File' , 'File' ],
				[ 'MediaWiki\\FileRepo\\File\\LocalFile', 'LocalFile' ],
				[ 'MediaWiki\\FileRepo\\File\\UnregisteredLocalFile', 'UnregisteredLocalFile' ],
				[ 'MediaWiki\\FileRepo\\RepoGroup', 'RepoGroup' ],
				[ 'MediaWiki\\Page\\WikiPage', 'WikiPage' ],
				[ 'MediaWiki\\Skin\\Skin', 'Skin' ],
			],
			'1.43' => [
				[ 'Wikimedia\\ObjectCache\\WANObjectCache', 'WANObjectCache' ],
			],
		];

		foreach ( $classAliasMap as $version => $classMap ) {
			if ( version_compare( MW_VERSION, $version, '<' ) ) {
				foreach ( $classMap as $classAlias ) {
					if ( !class_exists( $classAlias[0] ) && class_exists( $classAlias[1] ) ) {
						class_alias( $classAlias[1], $classAlias[0] );
					}
				}
			}
		}
	}
}
