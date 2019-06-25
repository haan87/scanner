<?php
///Created By Arudji
///tools for scan response header
///contact Email : lostarmy1211@gmail.com
function alert(){
echo system("clear");
}
$aman = alert();
echo "\nLogin Succes\n";
function proses(){
$anu = fopen("response.txt", "a");
fputs ($anu, "RESULT" . "\n");
$pembatas = "\n" . "--------------------" . "\n";
$pembatas1 = "--------------------" . "\n";
fputs ($anu, $pembatas1);
echo "---SCANNER---\n";
echo "IP : ";
$ip = trim(fgets(STDIN));
echo "RANGE IP :";
$ip0 = trim(fgets(STDIN));
echo "RANGE IP : ";
$range = trim(fgets(STDIN));
echo "PORT : ";
$port = trim(fgets(STDIN));
echo "TIMEOUT : ";
$timeout = trim(fgets(STDIN));
echo "-------------\n";
echo "SCAN DI MULAI\n";
echo "-------------\n";
$ip1 = explode("/", $ip0);
$range1 = explode("/", $range);
$port1 = explode("/", $port);
for ($ipr = $ip1[0]; $ipr <= $ip1[1]; $ipr++){
for ($hosts = $range1[0]; $hosts <= $range1[1]; $hosts++){
$host = "$ip.$ipr.$hosts";
foreach($port1 as $ports){
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "$host");
curl_setopt($ch, CURLOPT_PORT, "$ports");
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
$anu = fopen("response.txt", "a");
$hasil = explode("<", $response);
$hasil1 = explode("Server", $response);
echo "$host" . ":$ports" . "  -  " . substr($response, 0, 12) . "\n";
$hostname = gethostbyaddr("$host");
fputs ($anu, $pembatas);
fputs ($anu, "ip : $host\n");
fputs ($anu, "port : $ports\n");
fputs ($anu, "hostname : $hostname\n");
fputs ($anu, "$hasil[0]");
fputs ($anu, $pembatas1);
}
}
}
echo "Scan Ulang = 1\n" . "keluar dari aplikasi = 2\n";
echo "rescan/exit = ";
$reload = trim(fgets(STDIN));
system(clear);
}
$gas = proses();
if($reload = 1){
$gas = proses();}
else{
exit("terimakasih sudah menggunakan tools ini");
}
