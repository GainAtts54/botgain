<?php
$access_token = 'IlIUpzMSYkvp6ijy0NvHDboc0awS6FZ8bLuZ2MneybypEbWnYoYG+qOFleCIwcoGzoynFDURssJciBRNEjMGLaTselkvza940mVgvGYWiOyxsR5fr/CCVn4Tu2/JiyLtoUTNOQg1m8B9pvTD1sm9cwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
