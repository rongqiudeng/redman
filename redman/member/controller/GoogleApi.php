<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-30
 * Time: 下午2:51
 */

namespace app\member\controller;

class GoogleApi
{

    // Constructor
    public function __construct($key, $apiURL = 'https://www.googleapis.com/urlshortener/v1/url')
    {
        $this->apiURL = $apiURL . '?key=' . $key;
    }

    // Shorten a URL
    public function shorten($url)
    {
        // Send information along
        $response = $this->send($url);
        // Return the result
        return isset($response['id']) ? $response['id'] : false;
    }

    // Expand a URL
    public function expand($url)
    {
        // Send information along
        $response = $this->send($url, false);
        // Return the result
        return isset($response['longUrl']) ? $response['longUrl'] : false;
    }


    // Send information to Google
    public function send($url, $shorten = true)
    {
        // Create cURL
        $ch = curl_init();
        // If we're shortening a URL...
        if ($shorten) {
            curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:7070");
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5_HOSTNAME);
            curl_setopt($ch, CURLOPT_URL, $this->apiURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("longUrl" => $url)));
        } else {
            curl_setopt($ch, CURLOPT_URL, $this->apiURL . '&shortUrl=' . $url);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Execute the post
        $result = curl_exec($ch);
//        dump(curl_error($ch));
//        dump(curl_getinfo($ch));
        // Close the connection
        curl_close($ch);
        // Return the result
        return json_decode($result, true);
    }
}