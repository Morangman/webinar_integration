<!DOCTYPE html>
<?php
if (isset($_GET["utm_source"]) && !isset($_COOKIE["utm_source"])) {
  setcookie("utm_source", $_GET["utm_source"], time() + 3600*24, '/');
}
if (isset($_GET["utm_medium"]) && !isset($_COOKIE["utm_medium"])) {
  setcookie("utm_medium", $_GET["utm_medium"], time() + 3600*24, '/');
}
if (isset($_GET["utm_campaign"]) && !isset($_COOKIE["utm_campaign"])) {
  setcookie("utm_campaign", $_GET["utm_campaign"], time() + 3600*24, '/');
}
if (isset($_GET["utm_content"]) && !isset($_COOKIE["utm_content"])) {
  setcookie("utm_content", $_GET["utm_content"], time() + 3600*24, '/');
}
if (isset($_GET["utm_term"]) && !isset($_COOKIE["utm_term"])) {
  setcookie("utm_term", $_GET["utm_term"], time() + 3600*24, '/');
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>5 шагов к бизнесу на Amazon</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/abtest/cssn/intlTelInput.css" media="none" onload="if(media!='all')media='all'">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5FJHDR6');</script>
    <!-- End Google Tag Manager -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110849957-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){
		dataLayer.push(arguments);
	}
	gtag('js', new Date());
	gtag('config', 'UA-110849957-1', {'send_page_view': false});
</script>


  <!-- anti-flicker snippet (recommended)  -->
<style>.async-hide { opacity: 0 !important} </style>
<script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
(a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
})(window,document.documentElement,'async-hide','dataLayer',4000,
{'GTM-5FJHDR6':true});</script>
  <style type="text/css">
  	.allow-dropdown.intl-tel-input {
  		width: 100%;
  		margin-bottom: 20px;
  	}
  	.allow-dropdown.intl-tel-input input {
  		width: 100%;
  	}
  	form .button {
    width: 100%;
    color: #000;
    text-align: center;
    padding: 8px 0;
    background: #ffd843;
    border-radius: 16px;
    font-family: 'Open Sans',sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 16px;
    cursor: pointer;
    border: none;
}
.intl-tel-input .country-list, .intl-tel-input.iti-container {
	z-index: 11111;
}
@media only screen and (-webkit-min-device-pixel-ratio: 2), not all, not all, not all, only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
.iti-flag {
    background-size: 5652px 15px;
}
}
  	@media (max-width: 800px) and (min-width: 320px) {
		.modal .form {
			border-radius: 30px;
		}
		.close {
			top: 65px;
    		right: 33px;
		}
		.block .wrapper-div {
			margin-top: 140px;
		}
  	}
  </style>
	<!-- <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/> -->
  <style type="text/css">
  		form .button, .modal .button {
  			padding: 0;
  		}
        .button, .btn {
            height: 70px!important;
            line-height: 70px!important;
            font-size: 18px!important;
            text-transform: uppercase!important;
            font-weight: bold!important;
            border-radius: 35px!important;
            padding: 0 20px;
            width: 300px;
        }
        @media all and (max-width: 800px) {
        	.button, .btn {
            height: 50px!important;
            line-height: 50px!important;
            font-size: 16px!important;
            text-transform: uppercase!important;
            font-weight: bold!important;
            border-radius: 25px!important;
            width: 100%;
        }
        }
    </style>



</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FJHDR6"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FJHDR6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<!-- Модальное окно -->
	<div id="openModal" class="modal" style="display: none">
		  <div class="modal-dialog">
		    <form id="form1" method="POST" class="form">
						
				<div class="data">
							<img src="nimg/close.svg" alt="" class="close">
							<p class="section5-title"> Регистрируйся<br> и получи бонус</p>
							<p class="title-form">
								PDF-план и 2 видеоурока по бизнесу<br> на Amazon
							</p>

							<label>Имя</label>
							<input class="input" type="text" placeholder="Имя Фамилия" name="name" required>
							<label>Email</label>
							<input class="input"type="email" placeholder="name@gmail.com" name="email" required>
							<label>&#8470; телефона</label>
							<input class="input" type="text" placeholder="+38 (098) 123-45-67" name="phone" required>
							<button class="button">Принять участие</button>
							
						</div>
								
						
						
						
			</form>
		    
		  </div>
	</div>
	<!------ -->
	<div class="block">
		<header class="header">
		<div class="wrapper-header">
			<div class="wrapper-text">
				<img src="nimg/logo.svg" class="logo">
				<img src="nimg/logo-mob.svg" class="logo-mob">
				<ul class="text-list">
					<li class="text-item">Живой онлайн мастер-класс</li><br>
					<li class="text-item1 date">2 января</li><br>
					<li class="text-item webHours">19:00 Киев</li><br>
				</ul>
			</div>

			<p class="center-text">5 шагов к бизнесу на Amazon</p>
			<p class="subtext">Запишись на бесплатный онлайн мастер-класс по товарному бизнесу на Amazon и получи PDF-План и 2 бонусных видеоурока по запуску бизнеса на Amazon</p>
			<button class="btn">Принять участие</button>
				
		</div>

		
	</header>
	<div class="wrapper-div">
			<div class="wrapper-section">
			<div class="section-block1">
				<div id="sticky-menu2">
					<p class="section-title">Программа мастер-класса:</p>
				</div>
				<p class="section-title-mob">Программа<br> мастер-класса:</p>
				
			</div>
			<div class="section-block2">
				<ul class="section-list">
					<li class="section-item">
						<img src="nimg/icon1.svg" alt="">
						<p class="description">Знакомство с 3-мя базовыми стратегиями построения бизнеса на Amazon</p>
					</li>
					<li class="section-item">
						<img src="nimg/icon2.svg" alt="">
						<p class="description">Узнаете как сделать так, чтобы Amazon сам отвечал на все запросы клиентов и делал отправки за Вас по программе Amazon FBA</p>
					</li>
					<li class="section-item">
						<img src="nimg/icon3.svg" alt="">
						<p class="description">Получите пошаговый план к построению бизнеса за 3 месяца</p>
					</li>
					<li class="section-item">
						<img src="nimg/icon4.svg" alt="">
						<p class="description">Разбор стратегии по перепродаже товаров</p>
					</li>
					<li class="section-item">
						<img src="nimg/icon5.svg" alt="">
						<p class="description">Как начать этот бизнес с минимальных инвестиций</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
	</div>
	<section class="section1">
		<div class="wrapper-section1">
			<div class="wrapper-img">
				<img src="nimg/books.svg" class="b-desk">
				<img src="nimg/b-mob.svg" class="b-mob">
			</div>
			<div class="wrapper-block">
				<p class="section1-title">Получите мгновенный бонус после регистрации</p>
				<p class="section1-subtitle">PDF-Книгу-план и 2 бонусных видеоурока по запуску бизнеса на Amazon</p>
				<button class="btn">Принять участие</button>
			</div>
		</div>
	</section>
	<section class="section2">
			<div class="section2-wrapper">
				<div class="information">
					<p class="information-title">
					Кто проводит
					мастер-класс:
					</p>
					<p class="information-subtitle">Максим Авдеев</p>
					<ul class="information-list">
						<li><span>Основатель Level Consulting Group</span></li>
						<li><span> Более 7 лет опыта в предпринимательстве</span></li>
						<li><span>Эксперт по E-Commerce на рынке США</span></li>
						<li><span>Общий оборот компаний Максима более $ 1.500.000 </span></li>
						<li><span>Более 85 успешно запущенных товаров на Amazon</span></li>
						<li><span>1000+ клиентов, запустивших бизнес на Amazon по обучающей программе Максима</span></li>
					</ul>
				</div>
				<div class="photo">
					<img src="nimg/photo.svg" alt="logo" class="desk-photo">

				</div>
				<img src="nimg/mob-photo.svg" alt="logo" class="mob-photo">
			</div>
				
	</section>
	<section class="section3">
		<div class="wrapper-div">
			<div class="wrapper-section3">
			<div class="section-block1">
				<div id="sticky-menu1">
					<p class="section-title"> Отзывы тех,<br> кто уже был на мастер-классах Максима:</p>
				</div>
				<p class="section-title-mob"> Отзывы тех,<br> кто уже был на мастер-классах Максима:</p>
				
			</div>
			<div class="section-block2">
				<ul class="section-list">
					<li class="section-item">
						<img src="nimg/icon11.svg" alt="">
					</li>
					<li class="section-item">
						<img src="nimg/icon12.svg" alt="">
					</li>
					<li class="section-item">
						<img src="nimg/icon13.svg" alt="">
					</li>
					<li class="section-item">
						<img src="nimg/icon14.svg" alt="">
					</li>
					<li class="section-item">
						<img src="nimg/icon15.svg" alt="">
					</li>
					<li class="section-item">
						<img src="nimg/icon16.svg" alt="">
					</li>
				</ul>
			</div>
		</div>
	</div>

	</section>
	<section  class="section4">
		<div class="wrapper-section4">
			<p class="section4-title">О компании Максима пишут:</p>

			<ul class="section4-list">
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-1.svg">
					</li>
				</a>
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-2.svg">
					</li>
				</a>
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-3.svg">
					</li>
				</a>
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-4.svg">
					</li>
				</a>
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-5.svg">
					</li>
				</a>
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-6.svg">
					</li>
				</a>
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-7.svg">
					</li>
				</a>
				<a href="#" class="link-media">
					<li class="section4-item">
						<img src="nimg/sec13-8.svg">
					</li>
				</a>
				
			</ul>
		</div>
	</section>
	<section class="section5">
		<div class="wrapper-section5">
			
			<div class="wrapper-form">
					<form id="form2" action="" class="form">
						
						<div class="data">
							<p class="section5-title">Заработок<br> на Amazon в одном<br> шаге от вас</p>
							<p class="title-form">
								Если Вы готовы поменять свою жизнь — регистрируйтесь прямо сейчас
							</p>

							<label>Имя</label>
							<input class="input" type="text" placeholder="Имя Фамилия" name="name" required>
							<label>Email</label>
							<input class="input"type="email" placeholder="name@gmail.com" name="email" required>
							<label>&#8470; телефона</label>
							<input class="input" type="text" placeholder="+38 (098) 123-45-67" name="phone" required>
							<button class="button">Принять участие</button>
							
						</div>
						
					</form>
			</div>

			<div class="img-block">
				<img src="nimg/legs.svg" alt="" class="legs">
			</div>
		</div>
	</section>
	<section class="section6">
		<div class="wrapper-section6">
			<p class="big-l">P.S.</p>
			<p class="sec6-title">Возможно, это будут самые полезные 2 часа, которые ты потратишь в этом месяце,<br> а может даже и в этом году, чтобы перейти на качественно другой уровень жизни.</p>

			<p class="sec6-title1">Или как обычно, будешь откладывать все на потом…<br> Но сейчас на кону твоя жизнь, твой успех, твое благополучие.</p>
		</div>

	</section>
	<div class="wrapper-title12">
			<p class="title12">Отбрось свои страхи<br>
			и предрассудки!</p>
	</div>

	<section class="section7">
		<div class="section7-wrapper">
			<img src="nimg/triangle.svg">
			<div class="wrapper-text-sec7">
				<p class="important">Важно!</p>
				<p class="title-reg"> Регистрация на мастер-класс может быть закрыта в любой момент! Мой личный совет для тебя — заполни форму регистрации прямо сейчас, чтобы потом не было поздно. </p>
			</div>
		</div>
	</section>
	<footer class="footer">
		<div class="footer-wrapper">
			<div class="footer-wrapper-block1">
				<img src="nimg/logo1.svg" alt="">
				<p>Copyright 2022 Level Consulting Group</p>
				<a href="https://levelamz.com/policy" target="_blank" class="conf" id="confidence-link">Политика конфиденциальности</a>
			</div>
			<div class="footer-wrapper-block2">
				<ul class="wrap-link">
					<li class="wrap-item">
						<a href="https://www.facebook.com/levelcg/" target="_blank"><img src="nimg/fb.svg"></a>
					</li>
					<li class="wrap-item">
						<a href="https://www.youtube.com/channel/UCc849ObQOUK0cpkGYsLhLAQ" target="_blank"><img src="nimg/yt.svg"></a>
					</li>
					<li class="wrap-item">
						<a href="https://t.me/levelcg" target="_blank"><img src="nimg/tg.svg"></a>
					</li>
				</ul>
			</div>
		</div>
	</footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="njs/sticky-kit.min.js"></script>
<script type="text/javascript" src="https://static.bizon365.ru/form/anyform.min.js"></script>
<script src="/abtest/intlTelInput-jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.2/waypoints.min.js"></script>
<script>
	$('.btn').click(function(e) {
	e.preventDefault();
	$('#openModal').fadeIn();
});

$('.modal-dialog').click(function(e) {
	e.stopPropagation();
});

$('#openModal').click(function() {
	$(this).fadeOut();
});

$('.close').click(function() {
	$('#openModal').fadeOut();
});


// $('.close').click(function(e) {
// 	e.preventDefault();
// 	$('#openModal').fadeOut();

$('.button').click(function() {
			const name = $(this).parent().find('input[name=name]').val();
			const email = $(this).parent().find('input[name=email]').val();
			const phone = $(this).parent().find('input[name=phone]').val();
			if (name && phone && email) {
			$.ajax({
				method: "POST",
				url: "https://webinar.levelamz.com/register-no-duplicate.php",
				dataType: 'jsonp',
				data: {
					name: name,
					phone: phone,
					email: email,
					sitename: 'webinar_v33',
				},
			})
			}
		});

// let date = new Date(2021, 2, 5, 19);
// 	let now = new Date();
// 	while (now > date && date.getDay() !== 6) {
// 		date.setDate(date.getDate() + 2);
// 	}
let date = new Date();

	var hours = date.getHours();
	let day_of_week = date.getDay();
			// 0 - sunday
			// 6 - saturday
			let plus = 0;
			let webHours = '19:00 Киев';
			// if (hours >= 20) {
			// 	plus = 1;
			// }

			switch (day_of_week) {
				case 1: {
					plus = 1;
					break;
				}
				case 2: {
					if (hours >= 20) {
						plus = 2;
					}
					break;
				}
				case 3: {
					plus = 1;
					break;
				}
				case 4: {
					if (hours >= 20) {
						plus = 3;
						webHours = '19:00 Киев';
					}
					break;
				}
				case 5: {
					plus = 2;
					webHours = '19:00 Киев';
					break;
				}
				case 6: {
					plus = 1;
					webHours = '19:00 Киев';
				} break;
				case 0: {
					webHours = '19:00 Киев';
					if (hours >= 14) {
						plus = 2;
						webHours = '19:00 Киев';
					}
				} break;
			}

			date.setDate(date.getDate() + plus);
			let day = date.getDate();
			let month = date.getMonth();
			switch(month) {
				case 0:
				month = 'января';
				break;
				case 1:
				month = 'февраля';
				break;
				case 2:
				month = 'марта';
				break;
				case 3:
				month = 'апреля';
				break;
				case 4:
				month = 'мая';
				break;
				case 5:
				month = 'июня';
				break;
				case 6:
				month = 'июля';
				break;
				case 7:
				month = 'августа';
				break;
				case 8:
				month = 'сентября';
				break;
				case 9:
				month = 'октября';
				break;
				case 10:
				month = 'ноября';
				break;
				case 11:
				month = 'декабря';
				break;
			}

			if (month === 'мая') {
				if (day === 2) {
					day = 4;
					webHours = '19:00 Киев';
				}
				if (day === 9) {
					day = 11;
					webHours = '19:00 Киев';
				}
			}
			
			$('.date').html(day + ' ' + month);
			$('.webHours').html(webHours);

			$('input[name="phone"]').intlTelInput(
		{
			utilsScript       : 'utils.js',
			defaultCountry    : 'auto',
			separateDialCode  : false,
			nationalMode      : false,
			initialCountry    : 'auto',
			geoIpLookup       : function (callback) {
				$.get("https://ipinfo.io?token=c20ad1db862e6d", function () {
				}, "jsonp").always(function (resp) {
					var countryCode = (resp && resp.country) ? resp.country : "ua";
					callback(countryCode);
				});
			},
			preferredCountries: ['ua', 'ru', 'by', 'kz']
		});

			(function() {
			$bizon_init_form({
				selectors: {
					form: '#form1',
					message: '.error',
					closestDate: '.webinar_datee',
					closestTime: '.webinar_time',
				},
				form_fields: {
					email: '#form1 input[type=email]',
					name: '#form1 input[name=name]',
					submitButton: '#form1 button', 
				},
				pageId: '5150:5steps',
				closestDateOnly: true,
				redirectUrl: 'https://amzlevel.com/thanks',
				successMessage: 'Регистрация успешна',
				allowFormAction: false	
			});
		})();
		(function() {
			$bizon_init_form({
				selectors: {
					form: '#form2',
					message: '.error',
					closestDate: '.webinar_datee',
					closestTime: '.webinar_time',
				},
				form_fields: {
					email: '#form2 input[type=email]',
					name: '#form2 input[name=name]',
					submitButton: '#form2 button', 
				},
				pageId: '5150:5steps',
				closestDateOnly: true,
				redirectUrl: 'https://amzlevel.com/thanks',
				successMessage: 'Регистрация успешна',
				allowFormAction: false	
			});
		})();

</script>
<script>
	$('#sticky-menu1').stick_in_parent();
	$('#sticky-menu2').stick_in_parent();
</script>

<script>
	$.get("https://ipinfo.io?token=c20ad1db862e6d", function () { }, "jsonp").always(function (resp) {
		var countryCode = (resp && resp.country) ? resp.country : "UA";
		console.log(countryCode);
		if (countryCode === 'UA') {
			$('#confidence-link').attr('href', 'https://levelamz.com/policy_ua');
		}
	});
</script>
</html>