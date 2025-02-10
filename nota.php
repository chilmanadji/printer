<?php
$n = 19;
$line    = "-------------------\n";
$line2   = "===================\n";
$header  = str_pad("BERKAH PRINTING",$n," ",STR_PAD_BOTH)."\n";
$header  .= str_pad("Langgen, Talang ",$n," ",STR_PAD_BOTH)."\n";
$header  .= str_pad("089678508784 ",$n," ",STR_PAD_BOTH)."\n";

$x = 200;
$total_order = $x*5500;
$total_diskon = $x*800;
$total = $total_order - $total_diskon;
$body = str_pad("Yasin",$n," ",STR_PAD_RIGHT)."\n";
$body .= $x." x 5,500"."\n".str_pad(number_format($total_order),$n," ",STR_PAD_LEFT)."\n";
$body .= $line;
$body .= "SUBTOTAL".str_pad(number_format($total_order),($n-strlen("SUBTOTAL"))," ",STR_PAD_LEFT)."\n";
$body .= "DISKON".str_pad("-".number_format($total_diskon),($n-strlen("DISKON"))," ",STR_PAD_LEFT)."\n";
$body .= $line;
$body .= "TOTAL".str_pad(number_format($total),($n-strlen("TOTAL"))," ",STR_PAD_LEFT)."\n";

$footer = "\n".str_pad("Terima kasih ",$n," ",STR_PAD_BOTH)."\n";
$text = $header;
$text .= $line2;
$text .= $body;
$text .= $footer;

print_r($text);

// print nota
$printer_name = "POS-58"; 
$printer = printer_open($printer_name);
printer_set_option($printer, PRINTER_TEXT_ALIGN, PRINTER_TA_RIGHT);
printer_write($printer, $text);  
printer_close($printer);
