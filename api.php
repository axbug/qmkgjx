<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(0);
$url = $_GET['url'];
preg_match('/=(.*?)$/si', $url, $url);
$url=$url[1];
$url = "http://cgi.kg.qq.com/fcgi-bin/kg_ugc_getdetail?callback=jsopgetsonginfo&inCharset=GB2312&outCharset=utf-8&v=4&shareid=".$url;
$json = file_get_contents($url);
preg_match('|"playurl": "(.*)",|U', $json, $mp3);
preg_match('|"playurl_video": "(.*)",|U', $json, $mp4);
preg_match('|"cover": "(.*)",|U', $json, $img);
$mp3 = str_ireplace("\\/", "/", $mp3);
$mp4 = str_ireplace("\\/", "/", $mp4);
$img = str_ireplace("\\/", "/", $img);

if (!empty($img)){
	$reinfo = array('code' => '1', 'msg' => 'success', 'mp3' => $mp3[1], 'video' => $mp4[1], "img" => $img[1]);
}else{
    $reinfo = array('code' => '-1', 'msg' => 'ㄟ( ▔, ▔ )ㄏ，没有找到相关信息');
}
echo json_encode($reinfo);
?>
