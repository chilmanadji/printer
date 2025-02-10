<?php
/* contoh text */  
date_default_timezone_set('Asia/Jakarta');

//$url = str_replace("https", "http", $_GET['url']);

//$text = file_get_contents($url);
$text = "Eh, ini adalah testing aplikasi cetak teks langsung ke printer dengan PHP lhoo....";


// print nota
$printer_name = "POS-58";
$printer = printer_open($printer_name);
printer_set_option($printer, PRINTER_TEXT_ALIGN, PRINTER_TA_RIGHT);
printer_write($printer, $text);  
printer_close($printer);
/*

echo "<script type='text/javascript'>
window.setTimeout(function(){window.close()} , 5 * 1000 );
</script>";

*/

//$text_to_print = 'Eh, ini adalah testing aplikasi cetak teks langsung ke printer dengan PHP lhoo....';    
 

 ?>