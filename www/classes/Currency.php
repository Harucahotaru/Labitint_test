<?php

namespace app\classes;

use app\exceptions\ApiException;
use SimpleXMLElement;

class Currency
{
    protected const CURRENCY = [
        'USD',
        'EUR',
        'SEK',
        'JPY',
        'CAD',
    ];

    protected const CURRENCY_URL = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @return SimpleXMLElement
     */
    public function getAllCurrency(): SimpleXMLElement
    {
        $url = self::CURRENCY_URL . '?date_req=' . date("d/m/Y");
        try {
            $data = Helpers::getCurlXml($url);
        } catch (ApiException $e) {
            var_dump($e->getMessage());
        }

        return $data;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function getNeededCurrency(): array
    {
        $neededCurrency = [];
        $allCurrency = (new Currency)->getAllCurrency();
        foreach ($allCurrency->Valute as $currency) {
            if (in_array($currency->CharCode, self::CURRENCY)) {
                $neededCurrency[(string)$currency->CharCode] = $currency;
            }
        }

        return $neededCurrency;
    }
}