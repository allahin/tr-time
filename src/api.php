<?php

$url = 'https://saatkac.info.tr/Türkiye';

$userAgent = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/124.0.0.0 Safari/537.36';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);

if($response === false) {
    echo 'fatal error ' . curl_error($curl);
    exit;
}

$dom = new DOMDocument();
@$dom->loadHTML($response);

$xpath = new DOMXPath($dom);
$clockTime = $xpath->query('//*[@id="clock"]')->item(0);

if ($clockTime !== null) {
    echo $clockTime->nodeValue;
} else {
    echo 'fatal error';
}
