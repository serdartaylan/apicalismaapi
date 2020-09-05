<?php

/**
 * Laravel API Response Builder - configuration file
 *
 * See docs/config.md for detailed documentation
 *
 * @author    Marcin Orlowski <mail (#) marcinOrlowski (.) com>
 * @copyright 2016-2019 Marcin Orlowski
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/MarcinOrlowski/laravel-api-response-builder
 */

return [
    /*
    |-----------------------------------------------------------------------------------------------------------
    | Code range settings
    |-----------------------------------------------------------------------------------------------------------
    */
    'min_code' => 100,
    'max_code' => 1024,

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Error code to message mapping
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'map' => [

    ],

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Response Builder classes
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'classes' => [
        \Illuminate\Database\Eloquent\Model::class => [
            'key' => 'item',
            'method' => 'toArray',
            'pri' => 0,
        ],
        \Illuminate\Support\Collection::class => [
            'key' => 'items',
            'method' => 'toArray',
            'pri' => -1,
        ],
        \Illuminate\Database\Eloquent\Collection::class => [
            'key' => 'items',
            'method' => 'toArray',
            'pri' => 0,
        ],
        \Illuminate\Http\Resources\Json\JsonResource::class => [
            'key' => 'item',
            'method' => 'toArray',
            'pri' => 0,
        ],
    ],

    /*
    |-----------------------------------------------------------------------------------------------------------
    | data-to-json encoding options
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'encoding_options' => JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE,

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Exception handler error codes
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'exception_handler' => [
        'exception' => [
//			'http_not_found' => [
//				'code'      => \App\ApiCodes::HTTP_NOT_FOUND(),
//				'http_code' => Symfony\Component\HttpFoundation\Response::HTTP_BAD_REQUEST,
//			],
//			'http_service_unavailable' => [
//				'code'      => \App\ApiCodes::HTTP_SERVICE_UNAVAILABLE(),
//				'http_code' => Symfony\Component\HttpFoundation\Response::HTTP_BAD_REQUEST,
//			],
//			'http_exception' => [
//				'code'      => \App\ApiCodes::HTTP_EXCEPTION(),
//				'http_code' => Symfony\Component\HttpFoundation\Response::HTTP_BAD_REQUEST,
//			],
//			'uncaught_exception' => [
//				'code'      => \App\ApiCodes::UNCAUGHT_EXCEPTION(),
//				'http_code' => Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR,
//			],
//			'authentication_exception' => [
//				'code'      => \App\ApiCodes::AUTHENTICATION_EXCEPTION(),
//				'http_code' => Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED,
//			],
//			'validation_exception' => [
//				'code'      => \App\ApiCodes::VALIDATION_EXCEPTION(),
//				'http_code' => Symfony\Component\HttpFoundation\Response::HTTP_UNPROCESSABLE_ENTITY,
//			],
        ],
    ],

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Debug config
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'debug' => [
        'debug_key' => 'debug',
        'exception_handler' => [
            'trace_key' => 'trace',
            'trace_enabled' => env('APP_DEBUG', false),
        ],
    ],

];
