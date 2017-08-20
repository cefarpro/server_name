<?php

	require './class/Os.class.php';
	// heromantor/phpmorphy
	require_once( realpath( dirname(__FILE__) . '/src/common.php'  ) );
	// require './libs/phpmorphy/changewords.php';

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
	$name = Os :: generateName( './libs/adjective.txt', './libs/noun.txt' );
	$uid = ChangeWords( $name[ 'noun' ], $name[ 'adjective' ] ) . "\n";
	echo $uid . "\n";
	//echo var_export( Os :: computerInfo( ), true );
	//echo "\n";
