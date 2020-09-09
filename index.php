<?php
//header("Content-type: text/xml");
//echo $_SERVER['PHP_SELF'];
//echo ":";
//echo $_SERVER["QUERY_STRING"];

require_once ('../class/library/Requests.php');
date_default_timezone_set('America/Los_Angeles');
Requests::register_autoloader();
$id = @$_REQUEST['id'];
if(!isset($id)){
$id = 216;	
}
$ids = array(
	'1'=>'208',
	'2'=>'188',
	'3'=>'213',//217
	'4'=>'212',
	'5'=>'236',
	'6'=>'237',
	'7'=>'199',
	'8'=>'190',
	'9'=>'214',
	'10'=>'216'
	
);
$idn = array(
	'1'=>'IBIZA無碼頻道',
	'2'=>'IBIZA制服誘惑頻道',
	'3'=>'D槽素人女孩頻道',
	'4'=>'IBIZA巨乳控頻道',
	'5'=>'松視+深夜劇情頻道',
	'6'=>'松視+超強企劃頻道',
	'7'=>'HOT+西洋黑映画',
	'8'=>'一本道国际放送',
	'9'=>'加勒比全球同步',
	'10'=>'HEYZO零时差'
	
);
$mac_address = getRandChar(2).":".getRandChar(2).":".getRandChar(2).":".getRandChar(2).":".getRandChar(2).":".getRandChar(2);
function getRandChar($length=2)
    {
    	$str = "";
    	$strPol = "0123456789ABCDEF";
    	$max = strlen($strPol)-1;
     
    	for($i=0;$i<$length;$i++){
    	$str.=$strPol[rand(0,$max)];
    	}
    	return $str;
    }
$headers = [
    'Content-Type' => 'application/x-www-form-urlencoded',
    'Content-Length' => '173',
    'User-Agent' => 'Dalvik/2.1.0 (Linux; U; Android 6.0.1; BLA-AL00 Build/V417IR)',
    'Host' => 'ctb.1919hdtv.com',
    'Connection' => 'Keep-Alive',
    'Accept-Encoding' => 'gzip'
];
$data = [
    'sl_id' => '1',
    'order' => 'play_check',
    'mac_address' => $mac_address,
    'adult_id' => $ids[$id],
    'serial_num' => 'ZX1G42CPJD',
    'box_type' => '3',
    'type' => '3',
    'auth_id' => 'b422a8f4987eb253d31d7e9244496d49',
    'APK_Type' => '3',
    'card_num' => ''
];
$options = [
	'timeout'=> 25
];
/*
if(file_exists($filePath) && filesize($filePath)>300){
	$content = file_get_contents($filePath);
}else{
	$response = Requests::post('https://ctb.1919hdtv.com/xmlapi/xml_api.php', $headers, $data,$options);
	//print_r($response->body);
	$content = $response->body;
	file_put_contents($filePath,$content);
	
	
}
*/
$response = Requests::post('https://ctb.1919hdtv.com/xmlapi/xml_api.php', $headers, $data,$options);
	//print_r($response->body);
$content = str_replace('&','&amp;',$response->body);

$content = str_replace('&','&amp;',$response->body);

//echo $content;
$xml=simplexml_load_string($content);
$m3u8 = $xml->list->url;
//$m3u8 = str_replace('live03.1919hdtv.com','61.58.156.10',$m3u8);
if($m3u8){
	header("Location:".$m3u8);
}

echo '#EXTM3U
#EXT-X-VERSION:3
#EXT-X-STREAM-INF:BANDWIDTH=7095315,CODECS="avc1.64001f,mp4a.40.2",RESOLUTION=1280x720
';

echo $m3u8 = $xml->list->url;

?>