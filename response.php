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
	
	print_r(json_decode($data));


	$data_mobile = json_decode($data);

 
 
	$PRINTER_NAME = (!empty($_GET['printer']) && $_GET['printer'] != "")?$_GET['printer']:"MINIPOS-80C";
	$printerHandler = printer_open($PRINTER_NAME);
	printer_set_option($printerHandler, PRINTER_PAPER_WIDTH, "80");
	printer_set_option($printerHandler, PRINTER_MODE, "raw");
	printer_start_doc($printerHandler, "New Postpaid");
	printer_start_page($printerHandler);
	$feed_length = 76;
	$_fontHeight = 30;
	$_fontWidth = 12;
	$_fontWeightNormal = 400; 
	$_fontWeightBold = 700; 
	
	$lineNumber = 0;  
 	$fontHeight = $_fontHeight;
		$fontWidth = $_fontWidth;
		$fontWeight = $_fontWeightNormal;

	 
	$font = printer_create_font("Consolas", $fontHeight, $fontWidth, $fontWeight, false, false, false, 0);
	printer_select_font($printerHandler, $font); 
	$data = file_get_contents($url);
	$data .= " .\n  .\n .\n .\n .\n .\n .\n";
	$text= explode("\n", $data);
	$result = array();
	$index = 0;
	foreach ($text as $line) {

		echo $line."\n";
		$txt = str_pad($index, 48, "-", STR_PAD_BOTH);
		$lineNumber += $fontHeight; 	
		printer_draw_text($printerHandler, $line, 0, $lineNumber);
		if($index > 0 && $index%$feed_length == 0){
			$lineNumber = 0;
			printer_end_page($printerHandler); 
			printer_start_page($printerHandler);
		}
		$index++;
	}

//	printer_draw_text($printerHandler, $line, 0, $lineNumber);
	 
	printer_end_page($printerHandler); 
	printer_end_doc($printerHandler);
	printer_close($printerHandler);

//print_r($result);

 echo "<script type='text/javascript'>window.setTimeoutt(function(){window.close()} , 3 * 1000 );</script>";
 
?>