<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clock</title>
</head>
<body>
    <div id="clock"><?php echo getCurrentTime(); ?></div>
    <script>
        function updateClock() {
            var now = new Date();
            now.setSeconds(now.getSeconds() + 1); // It adds +1 to the time data it receives from PHP and continues updating. You can use this version if you think there is a delay in the clock data.
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();

            var timeString = ('0' + hour).slice(-2) + ':' + ('0' + minute).slice(-2) + ':' + ('0' + second).slice(-2);

            document.getElementById('clock').textContent = timeString;
        }

        setInterval(updateClock, 1000);

        updateClock();
    </script>
    <?php
    function getCurrentTime() {
        $url = 'https://saatkac.info.tr/Türkiye';
        $userAgent = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/124.0.0.0 Safari/537.36';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);

        if ($response === false) {
            return 'fatal error ' . curl_error($curl);
        }

        $dom = new DOMDocument();
        @$dom->loadHTML($response);

        $xpath = new DOMXPath($dom);
        $clockTime = $xpath->query('//*[@id="clock"]')->item(0);

        if ($clockTime !== null) {
            return $clockTime->nodeValue;
        } else {
            return 'fatal error';
        }
    }
    ?>
</body>
</html>