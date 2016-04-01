<?php

error_reporting(E_ALL);

      $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'http://xkcd.com');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_PROXY, '222.246.232.55:80');
                $output = curl_exec($ch);
                curl_close($ch);
                print $output;




?>
