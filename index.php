<?php
date_default_timezone_set('America/Los_Angeles');
$id = @$_REQUEST['id'];
if(!isset($id)){
$id = 2;	
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


$response = curl_post('https://ctb.1919hdtv.com/xmlapi/xml_api.php', $headers, $data,$options);
//$response = Requests::post('https://ctb.1919hdtv.com/xmlapi/xml_api.php', $headers, $data,$options);
	print_r($response->body);
$content = str_replace('&','&amp;',$response->body);

$content = str_replace('&','&amp;',$response->body);

//echo $content;
$xml=simplexml_load_string($content);
//echo $m3u8 = $xml->list->url;
//if($m3u8){
//	header("Location:".$m3u8);
//}
echo '#EXTM3U
#EXT-X-VERSION:3
#EXT-X-STREAM-INF:BANDWIDTH=7095315,CODECS="avc1.64001f,mp4a.40.2",RESOLUTION=1280x720
';

echo $m3u8 = $xml->list->url;

function curl_post($url ,$headers=array(),$data,$options){
		$cookie_jar_index = 'cookie.txt';
		$cookie = "PHPSESSID=0c241uo8cchkdou5mm4feiim84; path=/; __cfduid=dccb4d0ffb0f76b193e0811475a804d061599211613; expires=Sun, 04-Oct-20 09:26:53 GMT; path=/; domain=.1919hdtv.com; HttpOnly; SameSite=Lax";
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }




?>
