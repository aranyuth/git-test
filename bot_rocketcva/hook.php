<?php
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$time = date("H:i:s");
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$queryText = $request["queryResult"]["queryText"];
$action = $request["queryResult"]["action"];

$userId = $request['originalDetectIntentRequest']['payload']['data']['source']['userId'];

$myfile = fopen("log$date.txt", "a") or die("Unable to open file!");
$log = $date."-".$time."\t".$userId."\t".$queryText."\n";
fwrite($myfile,$log);
fclose($myfile);

//if(!empty($action) or $action==Null or $action!==' ')

if(isset($action))
{
 $curl = curl_init();

curl_setopt_array($curl, array(
 CURLOPT_URL => "https://api.line.me/v2/bot/message/push",
 CURLOPT_SSL_VERIFYPEER => false,
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "POST",
 //CURLOPT_POSTFIELDS => "{\r\n\r\n \"to\": \"Ub8c6ef4a7880161aa490bd7bd11d0133\",\r\n\r\n \"messages\": [{\r\n\r\n \"type\": \"text\",\r\n\r\n \"text\": \"$queryText https://modcumram.com/hook/push.php?uid=$userId\"\r\n\r\n }]\r\n\r\n}",
 CURLOPT_POSTFIELDS => "{\r\n\r\n \"to\": \"user_id line ของเรา\",\r\n\r\n \"messages\": [\r\n \t{\r\n \"type\": \"flex\",\r\n \"altText\": \"Flex Message\",\r\n \"contents\": {\r\n \"type\": \"bubble\",\r\n \"direction\": \"rtl\",\r\n \"body\": {\r\n \"type\": \"box\",\r\n \"layout\": \"vertical\",\r\n \"spacing\": \"sm\",\r\n \"contents\": [\r\n {\r\n \"type\": \"image\",\r\n \"url\": \"https://cdn4.iconfinder.com/data/icons/web-design-and-development-7-2/128/301-512.png\",\r\n \"aspectMode\": \"fit\",\r\n \"action\": {\r\n \"type\": \"uri\",\r\n \"uri\": \"https://url_code_push/hook/push.php?uid=$userId\"\r\n }\r\n },\r\n {\r\n \"type\": \"text\",\r\n \"text\": \"$queryText\",\r\n \"align\": \"center\"\r\n }\r\n ]\r\n },\r\n \"styles\": {\r\n \"body\": {\r\n \"separator\": true\r\n }\r\n }\r\n }\r\n}\r\n ]\r\n}\r\n",
 CURLOPT_HTTPHEADER => array(
 "authorization: Bearer line_token",
 "cache-control: no-cache",
 "content-type: application/json",
 "postman-token: 7f766920-b207–53c4–6059–6d20ceec77ea"
 ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
 echo "cURL Error #:" . $err;
} else {
 echo $response;
}

}

?>