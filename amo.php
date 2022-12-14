<?php

require_once 'config.php';

$apiKey = $webinarApiKey;

$access_token = '';

// getLastWebinarInfoChats(getLastWebinar($apiKey), $apiKey); //информация о чате последнего прошедшего вебинара
// getLastWebinarInfoVisits(getLastWebinar($apiKey), $apiKey); //информация о посещениях последнего прошедшего вебинара

amoAuth($subdomain, $client_id, $client_secret, $code, $redirect_uri, $token_file);

amoRefreshToken($subdomain, $client_id, $client_secret, $code, $redirect_uri, $token_file);

amoSetLead($access_token, $pipeline);

function getLastWebinar($apiKey = null) {
    if ($apiKey) {
        $data['request'] = json_encode([
            'key' => $apiKey,
            'action' => 'webinarsList',
            "params" => [
                "fields" => [
                    "name",
                    "alias"
                ],
                "status" => "FINISHED"
            ]
        ]);
    
        $res = makeCurl($data);
        // вывод результатов
    
        // pp($res);
    
        // $lastActiveWebinar = end($res['response']);

        $lastActiveWebinar = $res['response'][0];
    
        if ($lastActiveWebinar && isset($lastActiveWebinar['alias'])) {
            return $lastActiveWebinar['alias'];
        }
    }

    return null;
}

function getLastWebinarInfoChats($alias, $apiKey = null) {
    if ($apiKey) {
        $data['request'] = json_encode([
            "key" => $apiKey,
            "action" =>"webinarsHistory",
            "params" => [
                "alias" => $alias,
                "type" => "chats",
            ]
        ]);
    
        $res = makeCurl($data);
        // вывод результатов
    
        pp($res);
    
        // $lastActiveWebinar = end($res['response']);
    }

    return null;
}
function getLastWebinarInfoVisits($alias, $apiKey = null) {
    if ($apiKey) {
        $data['request'] = json_encode([
            "key" => $apiKey,
            "action" =>"webinarsHistory",
            "params" => [
                "alias" => $alias,
                "type" => "visits",
            ]
        ]);
    
        $res = makeCurl($data);
        // вывод результатов
    
        pp($res);
    
        // $lastActiveWebinar = end($res['response']);
    }

    return null;
}

function makeCurl($data) {
    $ch = curl_init();

    curl_setopt_array( $ch, [
        CURLOPT_URL =>'https://api.mywebinar.com',
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $data
    ]);

    $res = json_decode( curl_exec( $ch ) , true );

    curl_close( $ch );

    return $res;
}

function pp($data) {
    echo '<pre>' . var_export($data, true) . '</pre>';
}

function clog($log_msg)
{
    $log_filename = __DIR__ . '/logs/';

    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }

    $log_file_data = $log_filename.'/log_' . date('d-m-Y') . '.log';
    
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, date('Y-m-d H:i:s') . ' ' . $log_msg . "\n", FILE_APPEND);
}

//AmoCrm

function amoAuth($subdomain, $client_id, $client_secret, $code, $redirect_uri, $token_file) {
    $dataToken = file_get_contents($token_file);
    $dataToken = json_decode($dataToken, true);

    if ($dataToken && !isset($dataToken["endTokenTime"])) {
        $link = "https://$subdomain.amocrm.ru/oauth2/access_token";

        $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri,
        ];
    
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $code = (int)$code;
        
        $errors = [
            301 => 'Moved permanently.',
            400 => 'Wrong structure of the array of transmitted data, or invalid identifiers of custom fields.',
            401 => 'Not Authorized. There is no account information on the server. You need to make a request to another server on the transmitted IP.',
            403 => 'The account is blocked, for repeatedly exceeding the number of requests per second.',
            404 => 'Not found.',
            500 => 'Internal server error.',
            502 => 'Bad gateway.',
            503 => 'Service unavailable.'
        ];
    
        if ($code < 200 || $code > 204) die( "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error') );
        
        
        $response = json_decode($out, true);
        
        $arrParamsAmo = [
            "access_token"  => $response['access_token'],
            "refresh_token" => $response['refresh_token'],
            "token_type"    => $response['token_type'],
            "expires_in"    => $response['expires_in'],
            "endTokenTime"  => $response['expires_in'] + time(),
        ];
        
        $arrParamsAmo = json_encode($arrParamsAmo);
        
        $f = fopen($token_file, 'w');
        fwrite($f, $arrParamsAmo);
        fclose($f);

        $access_token = $response["access_token"];

        clog('Amo Auth success! New token: ' . $access_token);
    }
}

function amoRefreshToken($subdomain, $client_id, $client_secret, $code, $redirect_uri, $token_file) {
    $dataToken = file_get_contents($token_file);
    $dataToken = json_decode($dataToken, true);
    
    if ($dataToken["endTokenTime"] - 60 < time()) {
    
        $link = "https://$subdomain.amocrm.ru/oauth2/access_token";
    
        $data = [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'grant_type'    => 'refresh_token',
            'refresh_token' => $dataToken["refresh_token"],
            'redirect_uri'  => $redirect_uri,
        ];
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    
        $code = (int)$code;
        $errors = [
            301 => 'Moved permanently.',
            400 => 'Wrong structure of the array of transmitted data, or invalid identifiers of custom fields.',
            401 => 'Not Authorized. There is no account information on the server. You need to make a request to another server on the transmitted IP.',
            403 => 'The account is blocked, for repeatedly exceeding the number of requests per second.',
            404 => 'Not found.',
            500 => 'Internal server error.',
            502 => 'Bad gateway.',
            503 => 'Service unavailable.'
        ];
    
        if ($code < 200 || $code > 204) die( "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error') );
    
        $response = json_decode($out, true);
    
        $arrParamsAmo = [
            "access_token"  => $response['access_token'],
            "refresh_token" => $response['refresh_token'],
            "token_type"    => $response['token_type'],
            "expires_in"    => $response['expires_in'],
            "endTokenTime"  => $response['expires_in'] + time(),
        ];
    
        $arrParamsAmo = json_encode($arrParamsAmo);
    
        $f = fopen($token_file, 'w');
        fwrite($f, $arrParamsAmo);
        fclose($f);
    
        $access_token = $response['access_token'];

        clog('Amo refresh token success! New token: ' . $access_token);
    
    } else {
        $access_token = $dataToken["access_token"];
    }
}

function amoSetLead($access_token, $pipeline) {
    $name = 'Имя клиента';
    $phone = '+380123456789';
    $email = 'email@gmail.com';
    $target = 'Цель';
    $company = 'Название компании';
    
    $custom_field_id = 0;
    $custom_field_value = 'тест';
    
    $ip = '1.2.3.4';
    $domain = 'site.ua';
    $price = 0;
    $pipeline_id = $pipeline;
    $user_amo = 0;
    
    $utm_source   = '';
    $utm_content  = '';
    $utm_medium   = '';
    $utm_campaign = '';
    $utm_term     = '';
    $utm_referrer = '';
    
    $data = [
        [
            "name" => $phone,
            "price" => $price,
            "responsible_user_id" => (int) $user_amo,
            "pipeline_id" => (int) $pipeline_id,
            "_embedded" => [
                "metadata" => [
                    "category" => "forms",
                    "form_id" => 1,
                    "form_name" => "Форма на сайте",
                    "form_page" => $target,
                    "form_sent_at" => strtotime(date("Y-m-d H:i:s")),
                    "ip" => $ip,
                    "referer" => $domain
                ],
                "contacts" => [
                    [
                        "first_name" => $name,
                        "custom_fields_values" => [
                            [
                                "field_code" => "EMAIL",
                                "values" => [
                                    [
                                        "enum_code" => "WORK",
                                        "value" => $email
                                    ]
                                ]
                            ],
                            [
                                "field_code" => "PHONE",
                                "values" => [
                                    [
                                        "enum_code" => "WORK",
                                        "value" => $phone
                                    ]
                                ]
                            ],
                            [
                                "field_id" => (int) $custom_field_id,
                                "values" => [
                                    [
                                        "value" => $custom_field_value
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "companies" => [
                    [
                        "name" => $company
                    ]
                ]
            ],
            "custom_fields_values" => [
                [
                    "field_code" => 'UTM_SOURCE',
                    "values" => [
                        [
                            "value" => $utm_source
                        ]
                    ]
                ],
                [
                    "field_code" => 'UTM_CONTENT',
                    "values" => [
                        [
                            "value" => $utm_content
                        ]
                    ]
                ],
                [
                    "field_code" => 'UTM_MEDIUM',
                    "values" => [
                        [
                            "value" => $utm_medium
                        ]
                    ]
                ],
                [
                    "field_code" => 'UTM_CAMPAIGN',
                    "values" => [
                        [
                            "value" => $utm_campaign
                        ]
                    ]
                ],
                [
                    "field_code" => 'UTM_TERM',
                    "values" => [
                        [
                            "value" => $utm_term
                        ]
                    ]
                ],
                [
                    "field_code" => 'UTM_REFERRER',
                    "values" => [
                        [
                            "value" => $utm_referrer
                        ]
                    ]
                ],
            ],
        ]
    ];
    
    $method = "/api/v4/leads/complex";
    
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ];
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
    curl_setopt($curl, CURLOPT_URL, "https://$subdomain.amocrm.ru".$method);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_COOKIEFILE, 'amo/cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEJAR, 'amo/cookie.txt');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $code = (int) $code;
    $errors = [
        301 => 'Moved permanently.',
        400 => 'Wrong structure of the array of transmitted data, or invalid identifiers of custom fields.',
        401 => 'Not Authorized. There is no account information on the server. You need to make a request to another server on the transmitted IP.',
        403 => 'The account is blocked, for repeatedly exceeding the number of requests per second.',
        404 => 'Not found.',
        500 => 'Internal server error.',
        502 => 'Bad gateway.',
        503 => 'Service unavailable.'
    ];
    
    if ($code < 200 || $code > 204) die( "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error') );
    
    
    $Response = json_decode($out, true);
    $Response = $Response['_embedded']['items'];
    $output = 'ID добавленных элементов списков:' . PHP_EOL;
    foreach ($Response as $v)
        if (is_array($v))
            $output .= $v['id'] . PHP_EOL;
    return $output;
}