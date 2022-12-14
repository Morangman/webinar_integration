<?php

// require_once('./vendor/autoload.php');

require_once 'config.php';

$apiKey = $webinarApiKey;

$userData = [
    'name' => 'Test User',
    'phone' => '0990000000',
    'email' => 'sinepolsky.dmitry@gmail.com',
    'sitename' => 'webinar_v33',
];

// addNewAttendee($userData, $apiKey); //добавление пользователя к вебинару

// addNewAttendeeToLastWebinar($userData, getLastWebinar($apiKey), $apiKey); // добавление пользователя к последнему автовебинару

// getUsersFromWebinar(getLastWebinar($apiKey), $apiKey);

// getLastWebinarInfoChats(getLastWebinar($apiKey), $apiKey); //информация о чате последнего вебинара
// getLastWebinarInfoVisits(getLastWebinar($apiKey), $apiKey); //информация о посещениях последнего вебинара

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

        if (isset($res['response']) && isset($res['response']['success'])) {
            clog($clientData['email'] . ' ' . $res['response']['success']);
        } else {
            clog($clientData['email'] . ' ' . 'error for new Attendee!');
        }
    
        // pp($res);
    }
}

function getUsersFromWebinar($alias, $apiKey = null) {
    if ($apiKey) {
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
    
        pp($res);
    }

    return null;
}

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
                "status" => "ACTIVE"
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
    
        // pp($res);
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