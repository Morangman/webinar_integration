<?php

require_once 'config.php';
require_once 'amo_access.php';

$apiKey = $webinarApiKey;

$userData = [
    'name' => $_REQUEST['name'],
    'phone' => $_REQUEST['phone'],
    'email' => $_REQUEST['email'],
    'sitename' => 'newlevelcg',
    'utm_source' => (isset($_COOKIE['utm_source'])?$_COOKIE['utm_source']:''),
    'utm_medium' => (isset($_COOKIE['utm_medium'])?$_COOKIE['utm_medium']:''),
    'utm_campaign' => (isset($_COOKIE['utm_campaign'])?$_COOKIE['utm_campaign']:''),
    'utm_term' => (isset($_COOKIE['utm_term'])?$_COOKIE['utm_term']:''),
    'utm_content' => (isset($_COOKIE['utm_content'])?$_COOKIE['utm_content']:''),
];

$newAmoLead = amoSetRegisteredLead($pipeline, $token_file, $subdomain, $client_id, $client_secret, $code, $redirect_uri, $amo_status_registered_id, $userData);
// array (
//     0 => 
//     array (
//       'id' => 367875,
//       'contact_id' => 521005,
//       'company_id' => NULL,
//       'request_id' => 
//       array (
//         0 => '0',
//       ),
//       'merged' => false,
//     ),
//   )

$userData['name'] = $userData['name'] . ' _' . $newAmoLead['id'] . '_';

addNewAttendee($userData, $apiKey); //добавление пользователя к вебинару

$lastWebinarAlias = getLastWebinar($apiKey);

try {
    addNewAttendeeToLastWebinar($userData, $lastWebinarAlias, $apiKey); // добавление пользователя к последнему автовебинару
} catch (\Exception $e) {
    clog('error - активного автовебинара не обнаруженно!');
}


////////////////

function addNewAttendee(array $clientData = [], $apiKey = null) {
    if ($apiKey) {
        $data['request'] = json_encode([
            'key' => $apiKey,
            'action' => 'attendeesCreate',
            'params' => [
                "name" => $clientData['name'],
                "email" => $clientData['email'],
                "phone" => $clientData['phone'],
                "company" => $clientData['sitename']
            ]
        ]);
    
        $res = makeCurl($data);

        pp($res);

        if (isset($res['response']) && isset($res['response']['success'])) {
            clog($clientData['email'] . ' ' . $res['response']['success']);
        } else {
            clog($clientData['email'] . ' ' . 'error for new Attendee!');
        }
    
        // pp($res);
    }
}

function getLastWebinar($apiKey = null) {
    if ($apiKey) {
        $data['request'] = json_encode([
            'key' => $apiKey,
            'action' => 'webinarsList',
            "params" => [
                "status" => "ACTIVE"
            ]
        ]);
    
        $res = makeCurl($data);
        // вывод результатов
    
        // pp($res);
        
        $webinars = [];
        
        // название вебинаров которые нам не нужны
        $excluded = [
            'Постоянная вебинарная комната №1',
            'тест автовеб',
        ];
        
        $now = time();
        
        if ($res && isset($res['response']) && count($res)) {
            foreach ($res['response'] as $webinar) {
                if (!in_array($webinar['name'], $excluded) && !str_contains($webinar['name'], 'клон')) {
                    $webinar['start'] = strtotime($webinar['start']);
                    
                    if ($webinar['start'] > $now) {
                        $webinars[] = $webinar;    
                    }
                }
            }
        }
        
        $counts = array_column($webinars, 'start');
        
        // find index of min value
        $index = array_search(min($counts), $counts, true);

        // $closest = min(array_column($webinars, 'start'));
        
        if (isset($webinars[$index]) && isset($webinars[$index]['alias'])) {
            $lastActiveWebinar = $webinars[$index]['alias'];
        } else {
            $lastActiveWebinar = null;
        }
        
        pp($lastActiveWebinar);
        
        return $lastActiveWebinar;
        
        // pp($lastActiveWebinar);
    
        // $lastActiveWebinar = end($res['response']);

        // // $lastActiveWebinar = $res['response'][0];
    
        // if ($lastActiveWebinar && isset($lastActiveWebinar['alias'])) {
        //     return $lastActiveWebinar['alias'];
        // }
    }

    return null;
}

function addNewAttendeeToLastWebinar(array $clientData = [], string $alias = '', $apiKey = null) {
    if ($apiKey) {
        $data['request'] = json_encode([
            "key" => $apiKey,
            "action" =>"attendeesAddToWebinar",
            "params" => [
            "alias" => $alias,
                "attendees" => [$clientData['email']]
            ]
        ]);
    
        $res = makeCurl($data);

        if (isset($res['response']) && isset($res['response']['success'])) {
            clog($clientData['email'] . ' ' . $res['response']['success']);
        } else {
            clog($clientData['email'] . ' ' . 'error added for alias: ' . $alias);
        }
    
        pp($res);
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

function amoSetRegisteredLead($pipeline, $token_file, $subdomain, $client_id, $client_secret, $code, $redirect_uri, $status_id, $user) {
    $name = $user['name'];
    $phone = $user['phone'];
    $email = $user['email'];
    $target = 'Цель';
    $company = $user['sitename'];
    
    $dataToken = file_get_contents($token_file);
    $dataToken = json_decode($dataToken, true);
    
    $access_token = $dataToken["access_token"];
    
    $custom_field_id = 53581198;
    $custom_field_value = 'тест';
    
    $ip = '1.2.3.4';
    $domain = 'site.ua';
    $price = 0;
    $pipeline_id = $pipeline;
    $user_amo = 0;
    
    $utm_source   = $user['utm_source'];
    $utm_content  = $user['utm_content'];
    $utm_medium   = $user['utm_medium'];
    $utm_campaign = $user['utm_campaign'];
    $utm_term     = $user['utm_term'];
    
    $data = [
        [
            "name" => 'Регистрация / ' . date("d.m.Y H:i"),
            "pipeline_id" => (int) $pipeline_id,
            "status_id" => (int) $status_id,
            "_embedded" => [
                "metadata" => [
                    "category" => "forms",
                    "form_id" => 1,
                    "form_name" => "Форма на сайте",
                    "form_page" => $target,
                    "form_sent_at" => strtotime(date("d.m.Y H:i")),
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
                            ]
                        ]
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
    // pp($Response);
    
    if ($Response && count($Response)) {

        $text = 'Примечание:
                ';
        
        foreach ($user as $key => $info) {
            $text .= $key . ': ' . $info . '
            ';
        }
        
    
        // Добавляем примечание к лиду
        $data = [
            [
                "entity_id" => (int) $Response[0]['id'],
                "note_type" => "common",
                "params" => [
                    "text" => $text,
                ]
            ]
        ];
    
        $method = "/api/v4/leads/notes";
        
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

        foreach ($Response as $res) {
            $id = $res['id'];
            
            $data = [
                "user_id" => 0,
                "status_id" => (int) $status_id,
            ];
            
            $method = "/api/v4/leads/unsorted/$id/accept";
            
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
        }

        return $Response[0];
    }

    return null;
}