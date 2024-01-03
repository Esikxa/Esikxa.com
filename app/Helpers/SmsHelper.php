<?php

namespace App\Helpers;


class SmsHelper
{
    public static $SMS_TOKEN = "RWRxYk9jTGtsYkZqZkx5Ymhnam4=";
    public static $SMS_FROM_NAME = "HYA";

    public static function SendSms($mobile, $message)
    {
        $args = http_build_query(array(
            'api_key' => self::$SMS_TOKEN,
            'to' => self::checkGetMobile($mobile),
            'from' => self::$SMS_FROM_NAME,
            'sms' => $message
        ));

        $url = "https://yaadayo.com/sms/api?action=send-sms";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $status_code;
    }
    public static function checkGetMobile($mobile)
    {

        if (substr($mobile, 0, 3) === "977") {
            return $mobile;
        } else {
            return '977' . $mobile;
        }
    }
}
