<?php
$access_token = 'QGzqhC65D4pUbgrqnlgp1KF9GaP+HONhY59RJ+5OnhsyW6rlmxW6ecmYkcrbeTWGTYMdDYq3YOW3QfYKVkskbDERMx/xVuefP1+FbJWFbiOzGohD9CWQXqX37ttvYgdnSd6gWXcKMDKS8PBQhyRuyQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
