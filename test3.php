<?php

$text = "                APOTEK SIDAPURNA                
      Jl. Sumber Bawang RT. 26/3 Sidapurna  ";


// print nota
$printer_name = "MINIPOS-80C";
$printer = printer_open($printer_name);
printer_set_option($printer, PRINTER_PAPER_WIDTH, 80);
printer_set_option($printer, PRINTER_PAPER_LENGTH, 3276);
$_fontHeight = 30;
	$_fontWidth = 12;
	$_fontWeightNormal = 400; 
	$_fontWeightBold = 700;  

	$lineNumber = 0;  
 	$fontHeight = $_fontHeight;
		$fontWidth = $_fontWidth;
		$fontWeight = $_fontWeightNormal;

	 
$font = printer_create_font("Consolas", $fontHeight, $fontWidth, $fontWeight, false, false, false, 0);
printer_select_font($printer, $font);

printer_write($printer, $text);  
printer_close($printer);

?>