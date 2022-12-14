<?php

require_once 'config.php';
require_once 'amo_access.php';

$apiKey = $webinarApiKey;

$access_token = '';

$users = [];
$chat_leads = [];
$leads = [];


$lastWebinarAlias = getLastWebinar($apiKey);

$webinarUsers = getUsersFromWebinar($lastWebinarAlias, $apiKey); // список учасников вебинара

foreach ($webinarUsers as $u) {
    $users[$u['email']] = $u;
    $matches = [];
    $t = preg_match('/\_(.*)\_/', $u['name'], $matches);
    
    $users[$u['email']]['lead_id'] = (count($matches) > 1) ? (int)$matches[1] : '';
}

$leadsChatsData = getLastWebinarInfoChats($lastWebinarAlias, $apiKey); //информация о чате последнего прошедшего вебинара

foreach ($leadsChatsData as $c) {
    $chat_leads[$c[4]][] = $c;
}

$leadsVisitsData = getLastWebinarInfoVisits($lastWebinarAlias, $apiKey); //информация о посещениях последнего прошедшего вебинара

foreach ($leadsVisitsData as $l) {
    if (!isset($chat_leads[$l[1]])) {
        $leads[$l[1]][] = $l;
    }
}

foreach ($chat_leads as $key => $cl) {
    if (isset($users[$key])) {
        $users[$key]['chat'] = $cl;
    }
}
foreach ($leads as $key => $vl) {
    if (isset($users[$key])) {
        $users[$key]['visitor'] = $vl;
    }
}

pp($users);

foreach ($users as $leadUser) {
    if (isset($leadUser['chat']) && count($leadUser['chat']) && !isset($leadUser['visitor']) && !count($leadUser['visitor'])) {
        amoUpdateLead($pipeline, $token_file, $subdomain, $client_id, $client_secret, $code, $redirect_uri, $amo_status_webinar_chat_id, $leadUser, 'chat');
    }
    
    if (isset($leadUser['visitor']) && count($leadUser['visitor']) && !isset($leadUser['chat']) && !count($leadUser['chat'])) {
        amoUpdateLead($pipeline, $token_file, $subdomain, $client_id, $client_secret, $code, $redirect_uri, $amo_status_webinar_id, $leadUser, 'visitor');
    }
}

function getLastWebinar($apiKey = null) {
    if ($apiKey) {
        $data['request'] = json_encode([
            'key' => $apiKey,
            'action' => 'webinarsList',
            "params" => [
                "status" => "FINISHED",
                // "date" => '2022-12-20',
                "date" => date('Y-m-d'),
            ]
        ]);
    
        $res = makeCurl($data);
        // вывод результатов
    
        pp($res);
        
        $now = time();
        
        // название вебинаров которые нам не нужны
        $excluded = [
            'Постоянная вебинарная комната №1',
            'тест автовеб',
        ];
        
        if ($res && isset($res['response']) && count($res)) {
            foreach ($res['response'] as $webinar) {
                if (!in_array($webinar['name'], $excluded) && !(strpos($webinar['name'], 'клон') !== false)) {
                    $webinar['start'] = strtotime($webinar['start']);
                    
                    if ($webinar['start'] < $now) {
                        $webinars[] = $webinar;    
                    }
                }
            }
        }
        
        $counts = array_column($webinars, 'start');
        
        // find index of min value
        $index = array_search(max($counts), $counts, true);
        
        if (isset($res['response']) && isset($res['response'][$index])) {
            return $res['response'][$index]['alias'];
        } else {
            return null;
        }
    
        // $lastActiveWebinar = end($res['response']);

        // $lastActiveWebinar = $res['response'][0];
        
        // pp($lastActiveWebinar);
    
        // if ($lastActiveWebinar && isset($lastActiveWebinar['alias'])) {
        //     return $lastActiveWebinar['alias'];
        // }
    }

    return null;
}

function getUsersFromWebinar($alias, $apiKey = null) {
    if ($alias && $apiKey) {
        $data['request'] = json_encode([
            "key" => $apiKey,
            "action" =>"attendeesList",
            "params" => [
                "fields"=>[
                    "name",
                    "email",
                    "phone",
                    "company"
                ],
                "alias" => $alias,
            ]
        ]);
    
        $res = makeCurl($data);
        // вывод результатов
    
        // pp($res);

        if (isset($res['response']['list'])) {
            return $res['response']['list'];
        } else {
            return [];
        }
    }

    return [];
}

function getLastWebinarInfoChats($alias, $apiKey = null) {
    if ($alias && $apiKey) {
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
    
        // pp($res);

        if (isset($res['response'])) {
            return $res['response'];
        } else {
            return [];
        }
    }

    return [];
}
function getLastWebinarInfoVisits($alias, $apiKey = null) {
    if ($alias && $apiKey) {
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
    
        // pp($res);
    
        if (isset($res['response'])) {
            return $res['response'];
        } else {
            return [];
        }
    }

    return [];
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

function amoUpdateLead($pipeline, $token_file, $subdomain, $client_id, $client_secret, $code, $redirect_uri, $status_id, $user, $type) {
    $name = $user['name'];
    $phone = $user['phone'];
    $email = $user['email'];
    $target = 'Цель';
    $company = $user['company'];
    
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
    
    $utm_source   = '';
    $utm_content  = '';
    $utm_medium   = '';
    $utm_campaign = '';
    $utm_term     = '';
    $utm_referrer = '';
    
    $data = [
        [
            "id" => (int) $user['lead_id'],
            "pipeline_id" => (int) $pipeline,
            "status_id" => (int) $status_id,
        ]
    ];
    
    $method = "/api/v4/leads";
    
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ];
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
    curl_setopt($curl, CURLOPT_URL, "https://$subdomain.amocrm.ru".$method);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
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
    pp($Response);
    
    $text = 'Примечание:
        ';
    
    foreach ($user[$type] as $infos) {
        $text .= '
        ';
        foreach ($infos as $info) {
            $text .= $info . '
            ';
        }
    }
    

    // Добавляем примечание к лиду
    $data = [
        [
            "entity_id" => (int) $user['lead_id'],
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
}