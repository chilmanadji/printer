<?php
/* contoh text */  
date_default_timezone_set('Asia/Jakarta');

$server['local'] = "http://localhost/CI/";
$server['online'] = "http://hayya.co.id/";
$url = $server['online']."admin/order/print?id=".$_GET['id']."&key=".$_GET['key'];
$url = str_replace("https", "http", $_GET['url']);


$cash = intval($_GET['cash']);

$result = file_get_contents($url);
$result = json_decode($result);
// print_r($result);

$line    = "------------------------------\n";
$line2   = "==============================\n";

if($result->valid){
$order = $result->order;
$detail = $result->order_detail;
$text = "\n";
$total = 0;
$total_with_discount = 0;
foreach($detail as $o){
$discount_price = $o->price *(100 - $o->discount_percent)/100;
if($order->id_group == 3 && $o->price_2 && $o->price_2 < $discount_price) :
$subtotal = $o->quantity * $o->price_2;
$total += $subtotal;
$margin = $o->price - $o->price_2;
$text .= $o->product_name."\n";
$pricelist = $o->quantity." x ".number_format($o->price)." (-".number_format($margin).")";
elseif($order->id_group == 4 && $o->price_3 && $o->price_3 < $discount_price):
$subtotal = $o->quantity * $o->price_3;
$total += $subtotal;
$margin = $o->price - $o->price_3;
$text .= $o->product_name."\n";
$pricelist = $o->quantity." x ".number_format($o->price)." (-".number_format($margin).")";
else :
$subtotal = $o->quantity * $o->price * (100 - $o->discount_percent)/100;

if($o->discount_percent):
$total_with_discount += $subtotal;
$text .= $o->product_name."\n";
$pricelist = $o->quantity." x ".number_format($discount_price). " (-".$o->discount_percent."%)";
else :
$total += $subtotal;
$text .= $o->product_name."\n";
$pricelist = $o->quantity." x ".number_format($o->price);
endif;
endif;
$text .= $pricelist;
$text .= str_pad(number_format($subtotal),(30-strlen($pricelist))," ",STR_PAD_LEFT)."\n\n";
}
$member_discount = 0;
if($order->discount_member_percent):
$member_discount = $order->discount_member_percent / 100 * $total;
elseif($order->discount_member_fixed):
$member_discount = $order->discount_member_fixed;
endif;

$grand_total = $total_with_discount + $total - $member_discount - $order->discount_fixed - $order->unix_code + $order->total_shipping;
$return = $cash - $grand_total;

// $text .= $line;
$total_order = $total_with_discount + $total;
$text .= "SUB TOTAL".str_pad(number_format($total_order),(30-strlen("SUB TOTAL"))," ",STR_PAD_LEFT);
if($order->unix_code) :
$text .= "\nKODE UNIK".str_pad('-'.number_format($order->unix_code),(30-strlen("KODE UNIK"))," ",STR_PAD_LEFT);
endif;
$text .= "\nDISKON".str_pad('-'.number_format($order->discount_fixed),(30-strlen("DISKON"))," ",STR_PAD_LEFT);
if($member_discount){
$text .= "\nDISKON MEMBER".str_pad('-'.number_format($member_discount),(30-strlen("DISKON MEMBER"))," ",STR_PAD_LEFT);
}

if($order->total_shipping){
$text .= "\nONGKIR".str_pad(number_format($order->total_shipping),(30-strlen("ONGKIR"))," ",STR_PAD_LEFT);
}



$text .= "\nTOTAL".str_pad(number_format($grand_total),(30-strlen("TOTAL"))," ",STR_PAD_LEFT)."\n";
if($cash) {
$text .= "\nCASH".str_pad(number_format($cash),(30-strlen("CASH"))," ",STR_PAD_LEFT);
$text .= "\nKEMBALI".str_pad(number_format($return),(30-strlen("KEMBALI"))," ",STR_PAD_LEFT)."\n";
}


if($order->total_shipping){
$text .= "\nPengiriman : ".$order->carrier_name;
$text .= "\nBerat      : ".$order->total_weight." gram\n";
}

// $text .= $line;

//$header  = date('Y-m-d').str_pad(date('H:i:s'),20," ",STR_PAD_LEFT)."\n\n";
$header  = str_pad("HayyakidZ",30," ",STR_PAD_BOTH)."\n";

/* Jalak */
/*
$header .= str_pad("Jl. Jalak Timur No. 3",30," ",STR_PAD_BOTH)."\n";
$header .= str_pad("KOTA TEGAL - JAWA TENGAH",30," ",STR_PAD_BOTH)."\n";
*/

/* Mejasem */

$header .= str_pad("Jl. Siklepuh No. 1B, Mejasem",30," ",STR_PAD_BOTH)."\n";
$header .= str_pad("KAB. TEGAL - JAWA TENGAH",30," ",STR_PAD_BOTH)."\n";

$header .= $line;

$header .= "No.   : MJ".date('Ymd').str_pad($order->id_order,4, "0", STR_PAD_LEFT)."\n";
$header .= "Order : ".str_pad($order->id_order,4, "0", STR_PAD_LEFT)."\n";
if($order->staff_name != ""):
$header .= "CS    : ".$order->staff_name."\n";
endif;
$header .= "Cust  : ".substr($order->cust_name,0,20)."\n";
$header .= "Date  : ".date('Y-m-d H:i:s')."\n";


$text    = $header.$line.$text;

$footer  = "\n";
$footer .= str_pad("Terima Kasih",30," ",STR_PAD_BOTH)."\n";
$footer .= "\n";

$text   = $text. $footer;

print_r($text);

// print nota

$printer = printer_open("EPSON TM-U220 Receipt");
printer_set_option($printer, PRINTER_TEXT_ALIGN, PRINTER_TA_RIGHT);
printer_write($printer, $text);  
printer_close($printer);

 
}else{
//echo "order invalid";
}
//$text_to_print = 'Eh, ini adalah testing aplikasi cetak teks langsung ke printer dengan PHP lhoo....';    
 ?>