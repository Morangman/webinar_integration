<!DOCTYPE html>
<?php
if (isset($_GET["utm_source"]) && !isset($_COOKIE["utm_source"])) {
  setcookie("utm_source", $_GET["utm_source"], time() + 3600*24);
}
if (isset($_GET["utm_medium"]) && !isset($_COOKIE["utm_medium"])) {
  setcookie("utm_medium", $_GET["utm_medium"], time() + 3600*24);
}
if (isset($_GET["utm_campaign"]) && !isset($_COOKIE["utm_campaign"])) {
  setcookie("utm_campaign", $_GET["utm_campaign"], time() + 3600*24);
}
if (isset($_GET["utm_content"]) && !isset($_COOKIE["utm_content"])) {
  setcookie("utm_content", $_GET["utm_content"], time() + 3600*24);
}
if (isset($_GET["utm_term"]) && !isset($_COOKIE["utm_term"])) {
  setcookie("utm_term", $_GET["utm_term"], time() + 3600*24);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="/css/intlTelInput.css">
    <link rel="stylesheet" href="/css/lib.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Бесплатный онлайн мастер-класс "Как найти прибыльный товар для продажи на Amazon"</title>
    <style>
        header .container .text p {
            display: inline-block;
            background: #023eea;
            padding: 5px 10px;
            color: #fff;
        }
        header .container .top .date {
                padding: 5px 10px;
                padding-left: 40px;
                background: #5f22cf;
                color: #fff;
                border-radius: 5px;
                position: relative;
        }
        header .container .top .date:before {
            content: '';
            width: 20px;
            height: 20px;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: url(https://tovar.levelamz.com/img/svg/clock.svg) center center/100% 100% no-repeat;
            position: absolute;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="top">
                <div class="logo">
                </div>
                <div class="date">
                    <p>11 января</p>
                    <p>19:00 Киев/20:00 МСК</p>
                </div>
            </div>
            <div class="text">
                <p>Бесплатный онлайн мастер-класс</p>
                <h2>Как найти прибыльный товар для продажи на Amazon</h2>
                <b>Пошаговый алгоритм поиска и анализа</b>
                <a href="#form" class="btn">Зарегистрироваться</a>
            </div>
            <div class="bonus-after-registration">
                <div class="image">
                    <img src="https://tovar.levelamz.com/img/excel.png" alt="excel">
                </div>
                <div class="info">
                    <p>Получите бонусы после регистрации:</p>
                    <b>Таблица-шаблон анализа товаров и Список запрещённых товаров на Amazon</b>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="features container">
            <h2>Для кого мастер-класс?</h2>
            <div class="content">
                <div class="block">
                    <div class="image">
                        <img src="https://tovar.levelamz.com/img/svg/binoculars.svg" alt="binoculars">
                    </div>
                    <p>Тех, кто не знает как найти и проанализировать прибыльный товар на Amazon</p>
                </div>
                <div class="block">
                    <div class="image">
                        <img src="https://tovar.levelamz.com/img/svg/sleep.svg" alt="sleep">
                    </div>
                    <p>Тех, кто уже закупал партию товара, не проанализировав рынок, и долго не может его продать</p>
                </div>
                <div class="block">
                    <div class="image">
                        <img src="https://tovar.levelamz.com/img/svg/mask.svg" alt="mask">
                    </div>
                    <p>Тех, кто сомневается в прибыльности бизнеса на торговой площадке США</p>
                </div>
                <div class="block">
                    <div class="image">
                        <img src="https://tovar.levelamz.com/img/svg/line.svg" alt="line">
                    </div>
                    <p>Тех, кто определился с товаром, но не знает насколько маржинальным он будет на Amazon</p>
                </div>
            </div>
        </div>
        <div class="master-class-info">
            <div class="container">
                <h2>Что будет на мастер-классе?</h2>
                <div class="grid">
                    <div class="block">
                        <div class="image">
                            <img src="https://tovar.levelamz.com/img/master-class/image1.png" alt="f">
                        </div>
                        <p>Как найти правильную нишу на Amazon?</p>
                    </div>
                    <div class="block">
                        <div class="image">
                            <img src="https://tovar.levelamz.com/img/master-class/image2.png" alt="s">
                        </div>
                        <p>Какие товары лучше всего продаются на Amazon и почему</p>
                    </div>
                    <div class="block">
                        <div class="image">
                            <img src="https://tovar.levelamz.com/img/master-class/image3.png" alt="t">
                        </div>
                        <p>С помощью каких программ нужно анализировать товары</p>
                    </div>
                    <div class="block">
                        <div class="image">
                            <img src="https://tovar.levelamz.com/img/master-class/image4.png" alt="f">
                        </div>
                        <p>В каких категориях не стоит продавать товары</p>
                    </div>
                    <div class="block">
                        <div class="image">
                            <img src="https://tovar.levelamz.com/img/master-class/image5.png" alt="f">
                        </div>
                        <p>На какие показатели обращать внимание<br> при поиске и анализе</p>
                    </div>
                    <div class="block">
                        <div class="image">
                            <img src="https://tovar.levelamz.com/img/master-class/image6.png" alt="s">
                        </div>
                        <p>Какие товары запрещены для продаж на Amazon</p>
                    </div>
                </div>
                <div class="instant-bonus">
                    <div class="image">
                        <img src="https://tovar.levelamz.com/img/notebook.png" alt="notebook">
                    </div>
                    <div class="text">
                        <h2>Получите мгновенные бонусы после регистрации</h2>
                        <p>Таблица-шаблон анализа товаров и Список запрещённых товаров на Amazon</p>
                        <a href="#form" class="btn">Зарегистрироваться</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="master container">
            <div class="text">
                <h2>Вебинар проводит Максим Авдеев</h2>
                <ul>
                    <li>Более 7-ми лет опыта в предпринимательстве</li>
                    <li>Предприниматель и эксперт по заработку в интернете</li>
                    <li>Эксперт по организации удаленных команд</li>
                    <li>Специалист по E-Commerce на рынке США</li>
                </ul>
            </div>
            <div class="image">
                <img src="https://tovar.levelamz.com/img/master.png" alt="master">
            </div>
        </div>
        <div class="timer container">
            <h2>Регистрируйтесь в течении 4 минут и получите бонус</h2>
            <div class="content">
                <div class="clock">
                    <p>Осталось</p>
                    <div class="main_timer">
                        <div class="minute">
                            <p>04</p>
                            <span>Мин</span>
                        </div>
                        <div class="second">
                            <p>00</p>
                            <span>Сек</span>
                        </div>
                        <div class="millisecond">
                            <p>00</p>
                            <span>Мсек</span>
                        </div>
                    </div>
                </div>
                <form class="form" id="form" action="">
                    <label>
                        <span>Имя</span>
                        <input type="text" placeholder="Имя Фамилия" name="name" required>
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" placeholder="name@gmail.com" name="email" required>
                    </label>
                    <label>
                        <span>№ телефона</span>
                        <input id="phone" type="tel" placeholder="+38(098)123-45-67" name="phone" required>
                    </label>
                    <button type="submit" class="btn">Принять участие</button>
                    <label class="term">
                        <input type="checkbox" name="term_of_use" checked>
                        <span></span>
                        Я ознакомлен(а) и принимаю политику конфиденциальности
                    </label>
                </form>
            </div>
        </div>
        <footer class="container">
            <h2>Внимание!</h2>
            <b>Успейте зарегистрироваться, количество мест ограничено до 100 человек и возможность регистрации может быть закрыта в любой момент.</b>
        </footer>
    </main>
    <script src="/js/lib.js"></script>
    <script src="/js/script.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="https://static.bizon365.ru/form/anyform.min.js"></script>
        <script type="text/javascript">
            (function() {
                $bizon_init_form({
                    selectors: {
                        form: '#form',
                        message: '.error',
                        closestDate: '.webinar_datee',
                        closestTime: '.webinar_time',
                    },
                    form_fields: {
                        email: 'input[type=email]',
                        name: 'input[name=name]',
                        submitButton: '#form button',
                    },
                    pageId: '5150:tovar_amz',
                    closestDateOnly: true,
                    successMessage: 'Регистрация успешна',
                    allowFormAction: false
                });
            })();
        </script> -->

        <script type="text/javascript">
            $('#form button').on('click', (e) => {
                e.preventDefault();
                let name = $('input[name=name]').val();
                let email = $('input[name=email]').val();
                let phone = $('input[name=phone]').val();
                if (!name || !email || !phone) return;
                $.ajax({
                    method: "POST",
                    url: "/send_to_webinar.php",
                    dataType: 'json',
                    data: {
                        name: name,
                        email: email,
                        phone: phone
                    },
                    success: () => {
                        window.location.href = '/thanks.php';
                    },
                    error: () => {
                        window.location.href = '/thanks.php';
                    }
                });
            });
        </script>

        <script src="/js/intlTelInput.js"></script>
        <script>
            $('input[name="phone"]').intlTelInput(
            {
                defaultCountry    : 'ua',
                separateDialCode  : false,
                nationalMode      : false,
                initialCountry    : 'auto',
                // geoIpLookup       : function (callback) {
                //     $.get("https://ipinfo.io", function () {
                //     }, "jsonp").always(function (resp) {
                //         var countryCode = (resp && resp.country) ? resp.country : "";
                //         callback(countryCode);
                //     });
                // },
                preferredCountries: ['ua', 'ru', 'by', 'kz']
            });
        </script>
</body>
</html>