<?php

	define('TYPE_TEXT', 0);
	define('TEXT_BOLD', 1);
	define('TEXT_NORMAL', 0);
	define('ALIGN_LEFT', 0);
	define('ALIGN_CENTER', 1);
	define('ALIGN_RIGHT', 2);
	define('FORMAT_NORMAL', 0);
	define('FORMAT_DOUBLE_HEIGHT', 1);
	define('FORMAT_DOUBLE_HW', 2);
	define('FORMAT_DOUBLE_WIDTH', 3); 

	$url = ($_GET && $_GET['url'])?$_GET['url']:"";
	$data = array();
	if($url !== "") {
	$data = file_get_contents($url);
	}
	 

 
 
	$PRINTER_NAME = "ZJ-58"; 
	$printerHandler = printer_open($PRINTER_NAME);
	printer_set_option($printerHandler, PRINTER_MODE, "raw");
	printer_start_doc($printerHandler, "New Postpaid");
	printer_start_page($printerHandler);
	$_fontHeight = 30;
	$_fontWidth = 12;
	$_fontWeightNormal = 400; 
	$_fontWeightBold = 700; 
	
	$lineNumber = 0;  
 
	/*foreach($data_mobile as $data){		
		$fontHeight = $_fontHeight;
		$fontWidth = $_fontWidth;
		$fontWeight = $_fontWeightNormal;
		if($data->format == FORMAT_DOUBLE_HEIGHT || $data->format == FORMAT_DOUBLE_HW){
			$fontHeight = $_fontHeight * 2;
		} 

		if($data->format == FORMAT_DOUBLE_WIDTH || $data->format == FORMAT_DOUBLE_HW){
			$fontWidth = $_fontWidth * 2;
		} 

		if($data->bold){
			$fontWeight = $_fontWeightBold;
		}

		$font = printer_create_font("Consolas", $fontHeight, $fontWidth, $fontWeight, false, false, false, 0);
		printer_select_font($printerHandler, $font); 
		
		$text = explode("\n", $data->content);
		foreach ($text as $line) {
			# code...
			printer_draw_text($printerHandler, $line, 0, $lineNumber);
			$lineNumber += $fontHeight;  
		}
	
	}*/
	$fontHeight = $_fontHeight;
		$fontWidth = $_fontWidth;
		$fontWeight = $_fontWeightNormal;
	$font = printer_create_font("Comic San MS", $fontHeight, $fontWidth, $fontWeight, false, false, false, 0);
	printer_select_font($printerHandler, $font); 

	$header = str_pad("BERKAH FOTOCOPY",30," ",STR_PAD_BOTH)."\n";
	$text = "522541482566
	SN:	6578-4748-1135-7753-2404
	CHILMAN-ADJI/R1/2200/12.80.";
	$footer = str_pad("Terima kasih",30," ",STR_PAD_BOTH);
	$text_to_print = $header. $text. $footer;

	$fontHeight = $_fontHeight;
	$fontWidth = $_fontWidth;
	$fontWeight = $_fontWeightNormal;
	
	$font = printer_create_font("Arial", $fontHeight, $fontWidth, $fontWeight, false, false, false, 0);
	printer_select_font($printerHandler, $font); 


	$contentSplit = splitLine($text_to_print, 30);

	foreach ($contentSplit as $content){		# code...
	

		$text = explode("\n", $content);
		foreach ($text as $line) {
			# code... 
			printer_draw_text($printerHandler, $line, 0, $lineNumber);
			$lineNumber += $fontHeight;  
		}

	}
	 

	printer_end_page($printerHandler);
	printer_end_doc($printerHandler); 
	printer_close($printerHandler);


function splitLine($content, $length){
	$longString = 'I like apple. You like oranges. We like fruit. I like meat, also.';


	//$content = $longString;
	$words = explode(" ", $content);
 

	$maxLineLength = $length;

	$currentLength = 0;
	$index = 0;
	$output = array();

	foreach ($words as $word) {
	    // +1 because the word will receive back the space in the end that it loses in explode()
	    $wordLength = strlen($word) + 1;

	    if (($currentLength + $wordLength) <= $maxLineLength) {
	        $output[$index] .= $word . ' ';
	        $currentLength += $wordLength;
	    } else {
	        $index += 1;
	        $currentLength = $wordLength;
	        $output[$index] = $word.' ';
	    }
	}

	print_r($content);
	print_r($output);
	return $output;
}
 
?>