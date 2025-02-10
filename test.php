<?php
$text = "halooo";
//print_r($text);

// print nota
$printer_name = "POS-58";
$printer = printer_open($printer_name);
printer_set_option($printer, PRINTER_TEXT_ALIGN, PRINTER_TA_RIGHT);
printer_write($printer, $text);  
printer_close($printer);