<?php
$header  = str_pad("HayyakidZ",30," ",STR_PAD_BOTH)."\n";
$header .= str_pad("Jl. Siklepuh No. 1B, Mejasem",30," ",STR_PAD_BOTH)."\n";
$header .= str_pad("KAB. TEGAL - JAWA TENGAH",30," ",STR_PAD_BOTH)."\n";
$text = $header;

$PRINTER_NAME = "POS-58"; 
$PRINTER_NAME = "ZJ-58"; 
$printer = printer_open($PRINTER_NAME);
printer_set_option($printer, PRINTER_TEXT_ALIGN, PRINTER_TA_RIGHT);
printer_write($printer, $text);  
printer_close($printer);
 