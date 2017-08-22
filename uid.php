<?php

	$path = realpath( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	$path_libs = $path . 'libs' . DIRECTORY_SEPARATOR;
	require_once( $path_libs . 'changewords.php' );
	require_once( $path . 'class' . DIRECTORY_SEPARATOR . 'Color.class.php' );
	require_once( $path . 'class' . DIRECTORY_SEPARATOR . 'Os.class.php' );

	$name = Os :: generateName( $path_libs . 'adjective.txt', $path_libs . 'noun.txt' );
	$uid = ChangeWords( $name[ 'noun' ], $name[ 'adjective' ] ) . "\n";
	$out = Color :: green( $uid );
	$uid = sprintf( '%u', crc32( $out ) );

	file_put_contents( '_name', $out );
	file_put_contents( '_uid', $uid );
