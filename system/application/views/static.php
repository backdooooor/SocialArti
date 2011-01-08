<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	  <title>socialArti - Социальная сеть программисов</title>

      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf8" />
	
      <!-- Scripts -->
      <script type="text/javascript" src="<? echo base_url();?>design/scripts/jquery.min.js"></script>
	  <script type="text/javascript" src="<? echo base_url();?>design/scripts/jquery.easyAccordion.js"></script>
      <script type="text/javascript" src="<? echo base_url();?>design/scripts/utility.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/UI.js"></script>
      <style type="text/css">
		  html{font-size:62.5%; }
		  body{font-size:1.2em;color:#294f88}
		  .sample{margin:30px;border:1px solid #92cdec;background:#d7e7ff;padding:30px}
		  h1{margin:0 0 20px 0;padding:0;font-size:2em;}
		  h2{margin:40px 0 20px 0;padding:0;font-size:1.6em;}
		  .easy-accordion h2{margin:0px 0 20px 0;padding:0;font-size:1.6em;}
		  p{font-size:1.2em;line-height:170%;margin-bottom:20px}


		/* UNLESS YOU KNOW WHAT YOU'RE DOING, DO NOT CHANGE THE FOLLOWING RULES */

		.easy-accordion{display:block;position:relative;overflow:hidden;padding:0;margin:0}
		.easy-accordion dt,.easy-accordion dd{margin:0;padding:0}
		.easy-accordion dt,.easy-accordion dd{position:absolute}
		.easy-accordion dt{margin-bottom:0;margin-left:0;z-index:5;/* Safari */ -webkit-transform: rotate(-90deg); /* Firefox */ -moz-transform: rotate(-90deg);-moz-transform-origin: 20px 0px;  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);cursor:pointer;}
		.easy-accordion dd{z-index:1;opacity:0;overflow:hidden}
		.easy-accordion dd.active{opacity:1;}
		.easy-accordion dd.no-more-active{z-index:2;opacity:1}
		.easy-accordion dd.active{z-index:3}
		.easy-accordion dd.plus{z-index:4}
		.easy-accordion .slide-number{position:absolute;bottom:0;left:10px;font-weight:normal;font-size:1.1em;/* Safari */ -webkit-transform: rotate(90deg); /* Firefox */ -moz-transform: rotate(90deg);  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);}


		/* FEEL FREE TO CUSTOMIZE THE FOLLOWING RULES */

		dd p{line-height:120%}

		

		#accordion-2{width:700px;height:500px;padding:30px;background:#fff;border:1px solid #b5c9e8}
		#accordion-2 h2{font-size:2.5em;margin-top:10px}
		#accordion-2 dl{width:700px;height:500px}
		#accordion-2 dt{line-height:44px;text-align:right;padding:10px 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:1px;background:#fff url(images/slide-title-inactive-2.jpg) 0 0 no-repeat;color:#26526c}
		#accordion-2 dt.active{cursor:pointer;color:#fff;background:#fff url(design/images/slide-title-active-2.jpg) 0 0 no-repeat}
		#accordion-2 dt.hover{color:#68889b;}
		#accordion-2 dt.active.hover{color:#fff}
		#accordion-2 dd{padding:25px;background:url(design/images/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}
		#accordion-2 .slide-number{color:#68889b;left:10px;font-weight:bold}
		#accordion-2 .active .slide-number{color:#fff}
		#accordion-2 a{color:#68889b}
		#accordion-2 dd img{float:right;margin:0 0 0 30px;position:relative;top:-20px}

		

      </style>

</head>
<body>

    <div class="sample">
        <h1>socialArti  -  социальная сеть будущего...</h1>





        <div id="accordion-2">
            <dl>
                <dt id="first_title">Вступление</dt>
                <dd id="first"><h2>Вступление</h2><p>Здесь будет какой то текст о великой socialArti</p></dd>
                <dt  id="pos_title">О проекте</dt>
                <dd id="pos"><h2>О проекте</h2><p>Здесь будет какой то текст о великом Артемии</p></dd>
                <dt id="auth_title" >Авторизация</dt>
                <dd id="auth"><h2>Авторизация</h2><p> <div id="auth_error"></div>
                        <br/><form  method="POST" onSubmit="doAuth();return false;">email <br/>
                                           <input type="text" name="email" id="email" /><br/>
                     Пароль <br/><input type="password" name="pass" id="pass" /><br/>
                    <input type="submit" value="Войти"/></form></p></dd>
                <dt id="reg_title">Регистрация</dt>
                <dd id="reg"><h2>Регистрация</h2><p><div id="reg_error"></div><br/><form  method="POST" onSubmit="doRegister();return false;">email <br/>
                    <input type="text" name="email" id="reg_email" /><br/>
                    Фамилия<br/><input type="text" name="surname" id="reg_surname" /><br/>
                    Имя <br/><input type="text" name="name" id="reg_name" /><br/>
                    Отчество <br/><input type="text" name="otch" id="reg_otch" /><br/>
                    Откуда ты<br/><input type="text" name="location" id="reg_location" /><br/>
                    Пароль <br/><input type="password" name="pass1" id="reg_pass1" /><br/>
                    Повтор Пароля <br/><input type="password" name="pass2" id="reg_pass2" /><br/>
                    <input type="submit" value="Регистрация"></form>
                    </p></dd>
           </dl>
        </div>

   		<p><a href="http://readyou.ru">Артемий Татаринов &copy; 2011</a></p>
    </div>

</body>
</html>
