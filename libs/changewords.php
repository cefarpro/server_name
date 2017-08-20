<?php

require_once( realpath( dirname( __FILE__ ) . '/phpmorphy/src/common.php' ) );



function ChangeWords( $word, $adjective )
{

	$dict_bundle = new phpMorphy_FilesBundle( realpath( dirname( __FILE__ ) . '/phpmorphy/dicts' ) . DIRECTORY_SEPARATOR . 'utf-8' . DIRECTORY_SEPARATOR, 'rus');
	// var_dump( $dict_bundle );
	
	// Create phpMorphy instance
	try {
		$morphy = new phpMorphy( $dict_bundle, array( 'storage' => PHPMORPHY_STORAGE_FILE ) );
	} catch(phpMorphy_Exception $e) {
		die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
	}

	switch ( $word ) {
					/*
						case 'ПРИМЕР СЛОВА, КОТОРОЕ ВЕРНЕТСЯ КАК ЕСТЬ': return $word;
					*/
    }

	$adjective = mb_strtoupper( $adjective );
	$sentences = explode( ', ', $word );
	$sent = '';
	$gender = 'МР';
	foreach ( $sentences as $s )
	{
		$Words = explode(" ", $s);	
		$f_flag = false;
		$count = count( $Words );
		foreach ( $Words as $k => $w )
		{
			$w = mb_strtolower( $w, 'utf-8' );
			if ( preg_match( '/^[а-яА-ЯёЁ]/', $w ) and mb_strlen( $w, 'UTF-8' ) > 1 )
			{
				$w = mb_strtoupper( $w, 'utf-8' );

				$pos = GetPoS( $w, $morphy );
				//var_dump( $pos );
				//Исключения
				if ( $pos == 'П' ) {
					$gender = GetGender( $w, $morphy );
					$f_flag = true;
				}
				if ( $pos == 'С' && !$f_flag ) {
					$gender = GetGender( $w, $morphy );
					
				}

				$new_word = $w;
				$sent .= $new_word . ' ';
			}
			else $sent .= $w . ' ';
		}
		$sent = substr( $sent, 0, -1 );
		$sent .= ', ';
	}
	$sent = substr( $sent, 0, -2 );
	$new_sent = $morphy -> castFormByGramInfo( $sent, 'С', array( 'ЕД', 'ИМ', $gender ), true );
	$sent = ( count( $new_sent ) ) ? current( $new_sent ) : $sent;
	$w = $morphy -> castFormByGramInfo( $adjective, 'П', array( 'ЕД', 'ИМ', $gender ), true );
	$adjective = ( !$w ) ? $adjective : current( $w );
	return $adjective . ' ' . $sent;
}

function GetPoS( $word, $morphy )
{

	$PoS = $morphy -> getPartOfSpeech( $word );
	$pos = null;
	if ( $PoS ) {
		foreach ( $PoS as $PoSes ) {

			if ( $PoSes == 'С' ) {
				$pos = $PoSes;					
			}

			if ( $PoSes == 'П') {
				$pos = $PoSes;					
			}
		}
	}
	return $pos;
}

function GetGender( $word, $morphy )
{
	$GramInfo = $morphy -> getGramInfo($word);
	$Gender = null;
	foreach ( $GramInfo[ 0 ][ 0 ][ 'grammems' ] as $gi ) {
		if ( $gi == 'ЖР' or $gi == 'МР' or $gi == 'СР' ) {
			if ( $gi == 'СР' ) $gi = 'МР';
			$Gender = $gi;
			//Исключения
			switch ( $word ) {
				/*
				case 'ПРИМЕР': $Gender = 'МР'; break;
				*/
			}
		}
	}
	return $Gender;
}

function GetLar($word, $morphy)
{
	$GramInfo = $morphy-> getGramInfo($word);
	$Lar = null;
	foreach ($GramInfo[0][0]['grammems'] as $gi) 
	{
		if ($gi == 'ЕД' or $gi == 'МН')
			$Lar = $gi;
		//Исключения
		switch ($word) {
		/*
			case 'ПРИМЕРЫ': $Lar = 'МН'; break;
		*/
    	}

	}
	return $Lar;
}


function CheckWord($word, $form = 1)
{	
	;
}
?>