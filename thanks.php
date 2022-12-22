<?php
// $inarr=$data;
//     $inarr['client']='newlevelcg';
//     $inarr['nohlr']='1';
//     $utm_source=(isset($_COOKIE['utm_source'])?$_COOKIE['utm_source']:'');
//     $utm_medium=(isset($_COOKIE['utm_medium'])?$_COOKIE['utm_medium']:'');
//     $utm_campaign=(isset($_COOKIE['utm_campaign'])?$_COOKIE['utm_campaign']:'');
//     $utm_term=(isset($_COOKIE['utm_term'])?$_COOKIE['utm_term']:'');
//     $utm_content=(isset($_COOKIE['utm_content'])?$_COOKIE['utm_content']:'');
//     $inarr['phone']= $_REQUEST['phone'];
//     $inarr['raw']= $DATA;
//     $inarr['name']=$_REQUEST['client_name'];
//     $inarr['source']='Заказ звонка';   
//     $inarr['tags']=$_REQUEST['lead-tag'];   
//     $inarr['referer']=$_REQUEST['referrer'];

//     $inarr['utm_source']=$utm_source;
//     $inarr['utm_medium']=$utm_medium;
//     $inarr['utm_campaign']=$utm_campaign;
//     $inarr['utm_term']=$utm_term;
//     $inarr['utm_content']=$utm_content;
//     Get2InServ($inarr);

// function Get2InServ($inarr)
//   {
//   $link='https://wdg.biz-crm.ru/inserv/in.php';
//   $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
//   #Устанавливаем необходимые опции для сеанса cURL
//   curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//   curl_setopt($curl,CURLOPT_URL,$link);
//   curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
//   curl_setopt($curl, CURLOPT_POST, true);
//   curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($inarr));
//   curl_setopt($curl,CURLOPT_HEADER,false);
//   curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
//   curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
//   $out=curl_exec($curl);
//   return $out;
//   }
  
// $name = trim($_REQUEST['name']);
// $phone = trim($_REQUEST['phone']);
// $theme = "Регистарция";
// $email = trim($_REQUEST['email']);
//     if ($name != "") :
//         $headers =  'MIME-Version: 1.0' . "\r\n"; 
//         $headers .= 'From: Your name <info@address.com>' . "\r\n";
//         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//         $utm = "<p style='color: #777'><strong>UTM метки:</strong><br>";
//         if(isset($_COOKIE["utm_source"])) {$utm .= "Источник: ".$_COOKIE["utm_source"]."<br>";};
//         if(isset($_COOKIE["utm_medium"])) {$utm .= "Тип рекламной компании: ".$_COOKIE["utm_medium"]."<br>";};
//         if(isset($_COOKIE["utm_campaign"])) {$utm .= "Название рекламной кампании: ".$_COOKIE["utm_campaign"]."<br>";};
//         if(isset($_COOKIE["utm_content"])) {$utm .= "Идентификатор объявления: ".$_COOKIE["utm_content"]."<br>";};
//         if(isset($_COOKIE["utm_term"])) {$utm .= "Ключевое слово в кампании: ".$_COOKIE["utm_term"]."<br>";};
//         $utm .= "</p>";

//     $user=array(
//       'USER_LOGIN'=>'aplusdigital.top@gmail.com', #Ваш логин (электронная почта)
//       'USER_HASH'=>'18543c3bfefae9dd5b4a6acdb8b3b505c02f8389' #Хэш для доступа к API (смотрите в профиле пользователя)
//     );

//     #Формируем ссылку для запроса
//     $link='https://newlevelcg.amocrm.ru/private/api/auth.php?type=json';


//     $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
//     #Устанавливаем необходимые опции для сеанса cURL
//     curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//     curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
//     curl_setopt($curl,CURLOPT_URL,$link);
//     curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
//     curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($user));
//     curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
//     curl_setopt($curl,CURLOPT_HEADER,false);
//     curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
//     curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
//     curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
//     curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

//     $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
//     $code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
//     curl_close($curl); #Завершаем сеанс cURL

//     $code=(int)$code;
//     $errors=array(
//         301=>'Moved permanently',
//         400=>'Bad request',
//         401=>'Unauthorized',
//         403=>'Forbidden',
//         404=>'Not found',
//         500=>'Internal server error',
//         502=>'Bad gateway',
//         503=>'Service unavailable'
//     );
//     try
//     {
//         #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
//         if($code!=200 && $code!=204)
//             throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
//     }
//     catch(Exception $E)
//     {
//         die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
//     }
//     /**
//      * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
//      * нам придётся перевести ответ в формат, понятный PHP
//      */
    
//     $Response=json_decode($out,true);
//     $Response=$Response['response'];
//     $amoutm = 'Источник: '.$_COOKIE["utm_source"].' Тип трафика:'.$_COOKIE["medium"].' Название кампании: '.$_COOKIE["utm_campaign"].' Идентификатор:'.$_COOKIE["utm_content"].' Ключевое слово: '.$_COOKIE["utm_term"];

//     $Response=json_decode($out,true);
//     $Response=$Response['response'];

    
//     $deal = $name." ".$theme;
//   $leads['request']['leads']['add']=array(
//     array(
//       'name'=>$deal,
//       //'date_create'=>1298904164, //optional
//       'status_id'=>33990205,
//       'price'=>0,
//       'linked_users_id'=> array($v['id'].PHP_EOL),
//        #Теги
//       'custom_fields'=>array(
//         array(
//           'id'=>1902256, # id поля типа date
//           'values'=>array(
//             array(
//               'value'=>$amoutm # в качестве разделителя используется точка
//             )
//           )
//         ),
//         array(
//           'id'=>427496, # id поля типа multiselect
//           'values'=>array( # id значений передаются в массиве values через запятую
//               1240665,
//               1240664
//           )
//         ),
//         array(
//           'id'=>427497, # id поля типа radiobutton
//           'values'=>array(
//             array(
//               'value'=>1240667
//             )
//           )
//         ),
//         array(
//           'id'=>427231, # id поля типа date
//           'values'=>array(
//             array(
//               'value'=>'14.06.2014' # в качестве разделителя используется точка
//             )
//           )
//         ),
//         array(
//           #Смарт адрес
//           'id'=>458615, #Уникальный индентификатор заполняемого дополнительного поля
//           'values'=>array(
//             array(
//               'value' => 'Address line 1',
//               'subtype' => 'address_line_1',
//             ),
//             array(
//               'value' => 'Address line 2',
//               'subtype' => 'address_line_2',
//             ),
//             array(
//               'value' => 'Город',
//               'subtype' => 'city',
//             ),
//             array(
//               'value' => 'Регион',
//               'subtype' => 'state',
//             ),
//             array(
//               'value' => '203',
//               'subtype' => 'zip',
//             ),
//             array(
//               'value' => 'RU',
//               'subtype' => 'country',
//             )
//           )
//         )
//       )
//     )
//   );
  
//   $link='https://newlevelcg.amocrm.ru/private/api/v2/json/leads/set'; 

//   $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
//   #Устанавливаем необходимые опции для сеанса cURL
//   curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//   curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
//   curl_setopt($curl,CURLOPT_URL,$link);
//   curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
//   curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($leads));
//   curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
//   curl_setopt($curl,CURLOPT_HEADER,false);
//   curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
//   curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
//   curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
//   curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
   
//   $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
//   $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
  
//   $code=(int)$code;
//   $errors=array(
//       301=>'Moved permanently',
//       400=>'Bad request',
//       401=>'Unauthorized',
//       403=>'Forbidden',
//       404=>'Not found',
//       500=>'Internal server error',
//       502=>'Bad gateway',
//       503=>'Service unavailable'
//   );
//   try
//   {
//       #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
//       if($code!=200 && $code!=204)
//           throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
//   }
//   catch(Exception $E)
//   {
//       die('Error: '.$E->getMessage().PHP_EOL.'Error code: '.$E->getCode());
//   }

//   /**
//    * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
//    * нам придётся перевести ответ в формат, понятный PHP
//    */
//   $Response=json_decode($out,true);
//   $Response=$Response['response']['leads']['add'];

//   foreach($Response as $v)
//     if(is_array($v))
//         $output.=$v['id'].PHP_EOL;
//       $lead_id = $v['id'];

//     if ($theme != 'Получить полный доступ') {
//         $contacts['request']['contacts']['add']=array(
//         array(
//             'name'=>$name, #Имя контакта
//             'linked_leads_id'=>$lead_id,
//             'company_name'=>'', #Наименование компании
//             'tags' => '', #Теги
//             'custom_fields'=>array(
//                 array(
//                     #Телефоны
//                     'id'=>1608395, #Уникальный индентификатор заполняемого дополнительного поля
//                     'values'=>array(
//                         array(
//                             'value'=>strval($phone),
//                             'enum'=>'MOB' #Мобильный
//                         )
//                     )
//                 ),
//                 array(
//                     #E-mails
//                     'id'=>1608397,
//                     'values'=>array(
//                         array(
//                             'value'=>$email,
//                             'enum'=>'WORK', #Рабочий
//                         )
//                     )
//                 )
//             )
//         )
//     );

//     $link='https://newlevelcg.amocrm.ru/private/api/v2/json/contacts/set';
//     $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
//     #Устанавливаем необходимые опции для сеанса cURL
//     curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//     curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
//     curl_setopt($curl,CURLOPT_URL,$link);
//     curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
//     curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($contacts));
//     curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
//     curl_setopt($curl,CURLOPT_HEADER,false);
//     curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
//     curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
//     curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
//     curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

//     $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
//     $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);

//     $code=(int)$code;
//     $errors=array(
//         301=>'Moved permanently',
//         400=>'Bad request',
//         401=>'Unauthorized',
//         403=>'Forbidden',
//         404=>'Not found',
//         500=>'Internal server error',
//         502=>'Bad gateway',
//         503=>'Service unavailable'
//     );
//     try
//     {
//         #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
//         if($code!=200 && $code!=204)
//             throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
//     }
//     catch(Exception $E)
//     {
//         die('Error: '.$E->getMessage().PHP_EOL.'Error code: '.$E->getCode());
//     }

//     /**
//      * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
//      * нам придётся перевести ответ в формат, понятный PHP
//      */
//     $Response=json_decode($out,true);
//     $Response=$Response['response']['contacts']['add'];
//     }


//     $data = array (
//   'add' =>
//   array (
//     0 =>
//     array (
//       'element_id' => $lead_id,
//       'element_type' => '2',
//       'text' => $note,
//       'note_type' => '4',
//       'created_at' => '1509570000',
//       'responsible_user_id' => '504141',
//       'created_by' => '504141',
//     ),
//   ),
// );
// $subdomain='newlevelcg'; #Наш аккаунт - поддомен
// #Формируем ссылку для запроса
// $link='https://'.$subdomain.'.amocrm.ru/api/v2/notes';
// /* Нам необходимо инициировать запрос к серверу. Воспользуемся библиотекой cURL (поставляется в составе PHP). Подробнее о
// работе с этой
// библиотекой Вы можете прочитать в мануале. */
// $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
// #Устанавливаем необходимые опции для сеанса cURL
// curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
// curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
// curl_setopt($curl,CURLOPT_URL,$link);
// curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
// curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
// curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
// curl_setopt($curl,CURLOPT_HEADER,false);
// curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
// curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
// curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
// curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
// $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
// $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
// /* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
// $code=(int)$code;
// $errors=array(
//   301=>'Moved permanently',
//   400=>'Bad request',
//   401=>'Unauthorized',
//   403=>'Forbidden',
//   404=>'Not found',
//   500=>'Internal server error',
//   502=>'Bad gateway',
//   503=>'Service unavailable'
// );
// try
// {
//   #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
//  if($code!=200 && $code!=204)
//     throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
// }
// catch(Exception $E)
// {
//   die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
// }
// endif;

// $inarr['client']='newlevelcg';
//     $inarr['nohlr']='1';
//     $utm_source=(isset($_COOKIE['utm_source'])?$_COOKIE['utm_source']:'');
//     $utm_medium=(isset($_COOKIE['utm_medium'])?$_COOKIE['utm_medium']:'');
//     $utm_campaign=(isset($_COOKIE['utm_campaign'])?$_COOKIE['utm_campaign']:'');
//     $utm_term=(isset($_COOKIE['utm_term'])?$_COOKIE['utm_term']:'');
//     $utm_content=(isset($_COOKIE['utm_content'])?$_COOKIE['utm_content']:'');
//     $inarr['phone']= $_REQUEST['phone'];
//     $inarr['name']=$_REQUEST['name'];
//     $inarr['source']='Регистрация';   
//     $inarr['tags']=$_REQUEST['lead-tag'];   
//     $inarr['referer']=$_REQUEST['referrer'];
//     $inarr['email'] = $_REQUEST['email'];
//     $inarr['utm_source']=$utm_source;
//     $inarr['utm_medium']=$utm_medium;
//     $inarr['utm_campaign']=$utm_campaign;
//     $inarr['utm_term']=$utm_term;
//     $inarr['utm_content']=$utm_content;
//     $inarr['raw']= $_REQUEST;
    // Get2InServ($inarr);

// function Get2InServ($inarr)
//   {
//   $link='https://wdg.biz-crm.ru/inserv/in.php';
//   $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
//   #Устанавливаем необходимые опции для сеанса cURL
//   curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//   curl_setopt($curl,CURLOPT_URL,$link);
//   curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
//   curl_setopt($curl, CURLOPT_POST, true);
//   curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($inarr));
//   curl_setopt($curl,CURLOPT_HEADER,false);
//   curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
//   curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
//   $out=curl_exec($curl);
//   return $out;
//   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/lib.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Спасибо за регистарицию!</title>
    <style>
      @media all and (max-width: 575px) {
        .thank-you .container .buttons {
          bottom: 70px;
        }

      }
    </style>
</head>
<body class="center thank-you">
    <div class="container">
        <h2>Спасибо за регистрацию!</h2>
        <p>Чтобы забрать бонусы, выберите любой удобный для Вас мессенджер.</p>
        <div class="buttons">
            <!-- <a href="https://telegram.me/LevelConsultingGroup_bot?start=subscribe_5EC8F923-3DEA-4588-BFEA-046EE7CAB9D0" class="telegram">
                <img src="../img/svg/telegram.svg" alt="telegram">
                Забрать
            </a>
            <a href="https://is.gd/92E9Iq" class="viber">
                <img src="../img/svg/viber.svg" alt="viber">
                Забрать
            </a> -->
            <div class="wepster-hash-h20hav"></div>
        </div>
    </div>
</body>

<!-- leeloo init code -->
<script>
window.LEELOO = function(){
window.LEELOO_INIT = { id: '5f48e52df461e4001288f325' };
var js = document.createElement('script');
js.src = 'https://app.leeloo.ai/init.js';
js.async = true;
document.getElementsByTagName('head')[0].appendChild(js);
}; LEELOO();
</script>
<!-- end leeloo init code -->
<script>window.LEELOO_LEADGENTOOLS = (window.LEELOO_LEADGENTOOLS || []).concat('h20hav');</script>
</html>