<?php

	$path = realpath( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	$path_libs = $path . 'libs' . DIRECTORY_SEPARATOR;
	require_once( $path_libs . 'changewords.php' );
	require_once( $path . 'class' . DIRECTORY_SEPARATOR . 'Color.class.php' );
	require_once( $path . 'class' . DIRECTORY_SEPARATOR . 'Os.class.php' );

/*

		$adjective = file( './libs/adjective.txt' );
		$noun = file( './libs/noun.txt' );

			foreach ( $noun as $n ) {
				$n = trim( $n );
				if ( !mb_strlen( $n ) ) continue;
				foreach ( $adjective as $a ) {
					$a = trim( $a );
					if ( !mb_strlen( $a ) ) continue;
					echo ChangeWords( $n, $a ) . "\n";
				}
			}

*/

	//echo "---------\n";
	//echo "OS :: generateName:\n";
	$name = Os :: generateName( $path_libs . 'adjective.txt', $path_libs . 'noun.txt' );
	$uid = ChangeWords( $name[ 'noun' ], $name[ 'adjective' ] ) . "\n";
	echo Os :: out( $uid );
	//echo var_export( Os :: computerInfo( ), true );
	//echo "\n";




