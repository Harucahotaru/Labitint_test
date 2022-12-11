<?php

namespace app\classes;

use app\exceptions\ApiException;
use SimpleXMLElement;

class Helpers
{
    /**
     * @param $url
     * @return SimpleXMLElement
     * @throws ApiException
     */
    public static function getCurlXml($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        if (empty($output)) {
            throw new ApiException('Can not connect to api, please try again later');
        }

        return new SimpleXMLElement($output);
    }
}