<?php

	$path = realpath( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	$path_libs = $path . 'libs' . DIRECTORY_SEPARATOR;
	require_once( $path_libs . 'changewords.php' );
	require_once( $path . 'class' . DIRECTORY_SEPARATOR . 'Color.class.php' );
	require_once( $path . 'class' . DIRECTORY_SEPARATOR . 'Os.class.php' );

	$name = Os :: generateName( $path_libs . 'adjective.txt', $path_libs . 'noun.txt' );
	$info = Os :: computerInfo( );
	$out_info = "PROCESSOR_IDENTIFIER\t" . $info[ 'PROCESSOR_IDENTIFIER' ] . "\n";
	$out_info .= "PROCESSOR_LEVEL\t" . $info[ 'PROCESSOR_LEVEL' ] . "\n";
	$out_info .= "NUMBER_OF_PROCESSORS\t" . $info[ 'NUMBER_OF_PROCESSORS' ] . "\n";

	$uid = ChangeWords( $name[ 'noun' ], $name[ 'adjective' ] ) . "\n";
	$out = Color :: green( $uid );
	$out_uid = sprintf( '%u', crc32( $out ) );

	
	file_put_contents( '_info', $out_info );
	file_put_contents( '_name', $out );
	file_put_contents( '_uid', $out_uid );
