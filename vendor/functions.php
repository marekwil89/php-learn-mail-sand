<?php

	function redirect($location)
	{
		return header("Location: $location");
	}


	/* 
	* funcja tłumaczenia 
	* 
	* użycie echo __('witaj', 'welcome')
	* Wyświetlanie tekstu jest zależne od zmiennej $_GET['en']  
	*/
	function __($orginal = '', $translation = '')
	{
		if( is_array($orginal) )
		{
			if( isset($_GET['lang']) ){
				return $orginal[ $_GET['lang'] ];
			}
			else{
				return array_shift($orginal);
			}
		}
		else
		{
			if( isset($_GET['en']) ){
				return $translation;
			}else{
				return $orginal;
			}
		}
	}

	
	/*
	* Generowanie UUID
	*/
	function generate_uuid($space = '-') {
		return sprintf( '%04x%04x'.$space.'%04x'.$space.'%04x'.$space.'%04x'.$space.'%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}



	/*
	* sortowanie tablicy wielowymiarowej po kluczu
	*/
	function array_sort_by_column(&$arr, $col, $asc = true) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}

		if( $asc == true ){
			$sort_order = SORT_ASC;
		}
		else{
			$sort_order = SORT_DESC;
		}

		array_multisort($sort_col, $sort_order, $arr);
	}



	/***************************
	******* DATA helpers *******
	****************************/

	/*
	* data w dowolnym formacie do timestamp
	*/
	function time_data_to_timestamp( $data, $format = 'd.m.Y' )
	{
		$output_date = DateTime::createFromFormat($format, $data)->getTimestamp();
		$output_date = date($output_date);
		return $output_date;
	}

	/* 
	* zmiana formatu daty z dowolnego na dowolny
	*/
	function time_format($data, $input_format, $output_format)
	{
		$output_data = DateTime::createFromFormat($input_format, $data)->getTimestamp();
		$output_data = date($output_format, $output_data);
		return $output_data;
	}

	/* 
	* dodawanie czasu do daty - np. dodanie 1 roku do konkretnej daty
	*/
	function time_add($data, $time, $input_format = 'd.m.Y', $output_format = 'd.m.Y')
	{
		$new_date = strtotime( time_format($data,$input_format,'d.m.Y')  . $time );
		$format = date( $output_format, $new_date );
		return $format;
	}

	/* 
	*	czas który upłynął między datami (np wiek)
	*	zwraca string liczbowy np 18
	*/
	function time_difference($data1, $data2, $output_format = '%d', $format1 = 'd.m.Y', $format2 = 'd.m.Y')
	{
		$day1 = DateTime::createFromFormat($format1, $data1);
		$day2 = DateTime::createFromFormat($format2, $data2);
		$diff = $day1->diff($day2);
		return $diff->format($output_format);
	}