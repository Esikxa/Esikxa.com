<?php

namespace App\Helpers;

use App\Models\ApiLog;
use App\Repositories\ApiLogRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LogHelper
{
    protected $apiLog;

    public function __construct(ApiLogRepository $apiLog)
    {
        $this->apiLog = $apiLog;
    }

    protected static function route($request)
    {
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        return list($controller, $action) = explode('@', $controllerAction);
    }

    public static function info($message, $request, $data = [])
    {
        $action = LogHelper::route($request);
        $data = !empty($data) ? $data : $request->all();

        Log::info($message, ['controller' => $action[0], 'action' => $action[1], $data]);
    }

    public static function error($message, $request, $error)
    {
        $action = LogHelper::route($request);
        Log::error($message, ['controller' => $action[0], 'action' => $action[1], $error]);
    }

    protected function prepareData($request)
    {
        $statusCode = isset($context['exception']) ? $context['exception']->getStatusCode() : $context['status_code'] ?? '-';
        $action = LogHelper::route($request);
        $data =  [
            'uuid' => Str::uuid(),
            'remote_addr' => $request->getClientIp(),
            'user_agent' => $request->header('User-Agent'),
            'url' => $request->fullUrl(),
            'http_method' => $request->method(),
            'status_code' => $statusCode,
            'controller' => $action[0],
            'action' => $action[1]

        ];
        return $data;
    }

    public static function store($title, $message = null, $request, $response_data = null, $post_data = [])
    {
        $statusCode = isset($context['exception']) ? $context['exception']->getStatusCode() : $context['status_code'] ?? null;
        $action = LogHelper::route($request);
        $data =  [
            'channel' => env('APP_ENV'),
            'uuid' => Str::uuid(),
            'title' => $title,
            'message' => $message,
            'remote_addr' => $request->getClientIp(),
            'user_agent' => $request->header('User-Agent'),
            'url' => $request->fullUrl(),
            'http_method' => $request->method(),
            'status_code' => $statusCode,
            'controller' => isset($action) ? @$action[0] : null,
            'action' => isset($action) ? @$action[1] : null,
            'request_data' => json_encode(array_merge($request->all(), $post_data)),
            'response_data' => isset($response_data) ? json_encode($response_data) : null,
            'context' => isset($context) ? json_encode($context) : null,
            'client_id' => auth('customer')->user()->client_id ?? 1

        ];
        ApiLog::create($data);
    }
}
