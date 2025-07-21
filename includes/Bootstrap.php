<?php


namespace MediaWiki\Extension\EmbedVideo;

class Bootstrap {
    public static function onRegistration() {
        $classAliasMap = [
            '1.44' => [
                [ 'MediaWiki\\FileRepo\\RepoGroup', 'RepoGroup' ],
            ]
        ];

        foreach ( $classAliasMap as $version => $classMap ) {
            if ( version_compare( MW_VERSION, $version, '<' ) ) {
                foreach ( $classMap as $classAlias ) {
                    if ( !class_exists( $classAlias[0] ) && class_exists( $classAlias[1] ) ) {
                        class_alias( $classAlias[0], $classAlias[1] );
                    }
                }
            }
        }
    }
}
