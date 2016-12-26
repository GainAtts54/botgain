<?php
$post = file_get_contents(‘php://input’);
$urlReply = ‘https://api.line.me/v2/bot/message/reply';
$token = ‘QGzqhC65D4pUbgrqnlgp1KF9GaP+HONhY59RJ+5OnhsyW6rlmxW6ecmYkcrbeTWGTYMdDYq3YOW3QfYKVkskbDERMx/xVuefP1+FbJWFbiOzGohD9CWQXqX37ttvYgdnSd6gWXcKMDKS8PBQhyRuyQdB04t89/1O/w1cDnyilFU=’;
เสร็จแล้วก็มาเขียน Function ไว้สำหรับ post data ไปยัง Line Message API กัน
function postMessage($token,$packet,$urlReply){
 $dataEncode = json_encode($packet);
 $headersOption = array(‘Content-Type: application/json’,’Authorization: Bearer ‘.$token);
 $ch = curl_init($urlReply);
 curl_setopt($ch,CURLOPT_CUSTOMREQUEST,’POST’);
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
 curl_setopt($ch,CURLOPT_POSTFIELDS,$dataEncode);
 curl_setopt($ch,CURLOPT_HTTPHEADER,$headersOption);
 curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
 $result = curl_exec($ch);
 curl_close($ch);
}
หลังจากนั้นก็มาเขียนส่วนที่รอรับข้อความจาก ผู้ใช้งานในระหว่างที่พิมพ์คุยกับ BOT กันครับ โครงสร้างของ JSON ที่ผู้ใช้งานพิมพ์ส่งไปยัง Line จะเป็นประมาณนี้
{“events”:[{“type”:”message”,”replyToken”:”ไม่บอก”,”source”:{“userId”:”ไม่บอก”,”type”:”user”},”timestamp”:1477132643802,”message”:{“type”:”text”,”id”:”5094630491076",”text”:”ว่าไงท่าน”}}]}
ดังนั้นเราก็ต้องแปลง JSON แล้วทำการตรวจว่ามันเป็น event ประเภทอะไร มี type เป็นอะไร location, text, sticker, video, audio หรือ image เราจะได้แยกการทำงานให้ BOT เราถูกว่าจะให้ Response อะไรกลับไปบ้าง
$res = json_decode($post, true);
if(isset($res[‘events’]) && !is_null($res[‘events’])){
 foreach($res[‘events’] as $item){
 if($item[‘type’] == ‘message’){
 switch($item[‘message’][‘type’]){
 case ‘text’:
break;
case ‘image’:
break;
 case ‘video’:
 
 break;
 case ‘audio’:
 
 break;
 case ‘location’:
break;
 case ‘sticker’:

 break;
}
เรามาลองส่ง sticker กลับไปหาผู้ใช้งานกัน
ดู sticker list ได้ที่นี่ https://devdocs.line.me/en/files/sticker_list.pdf
ลองเขียน function สร้าง json จาก array เพื่อส่ง sticker กลับดูแบบง่ายๆ
function getSticker($replyToken){
 $sticker = array(
 ‘type’ => ‘sticker’,
 ‘packageId’ => ‘4’,
 ‘stickerId’ => ‘300’
 );
 $packet = array(
 ‘replyToken’ => $replyToken,
 ‘messages’ => array($sticker),
 );
 return $packet;
}
