<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class CurlHelper
{
    public static function request($url, $type = 'get', $postData = '', $sendToken = false)
    {
        try {
            Log::info('CURL request initiated.', [$postData]);
            $headers = array(
                "Accept: application/json",
                "X-Client-ID: health-yaadaayo-live"
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            if ($type == 'post') {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            }
            $result = curl_exec($ch);
            /* Check for 404 (file not found). */
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            Log::info('Curl response.', [$result]);
            $result = json_decode($result, true);
            if ($httpCode != 200) {
                CurlHelper::verifyHttpCode($httpCode, $url, $result);
            }
            curl_close($ch);
            Log::info('CURL response.', [$result]);
            return $result;
        } catch (Exception $e) {
            Log::info('CURL error.', [$e->getMessage(), $e->GETlINE()]);
        }
    }

    public static function verifyHttpCode($code, $url, $result)
    {
        $message = 'Oops! something went wrong with API call. Please, try again.';
        if (isset($result['message']) && is_array($result['message'])) {
            $message = 'Validation error.';
            $message .= '<ul>';
            foreach ($result['message'] as $key => $value) {
                foreach ($value as $msg) {
                    $message .= '<li>' . $msg . '</li>';
                }
            }
            $message .= '</ul>';
        } elseif (isset($result['message'])) {
            $message = $result['message'];
        }
        // if (isset($result['status']) && $result['status'] == false) {
        //     abort(response()->json(['code' => 1, 'message' => $message], 503));
        // }

        if ($url == '') {
            abort(response()->json(['code' => 1, 'message' => 'Invalid url.'], 503));
        }
        if ($code == 0) {
            if (str_contains($url, env('LOCATION_SERVICE_API_BASE_PATH')) !== false) {
                abort(response()->json(['code' => 1, 'message' => 'Location service unavailable.'], 503));
            } else {
                abort(response()->json(['code' => 1, 'message' => $message], 503));
            }
        } else {
            abort(response()->json(['code' => 1, 'message' => $message], $code));
        }
    }
}
