<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
	  <title>socialArti - Социальная сеть</title>

      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />

      <!-- Scripts -->
      <script type="text/javascript" src="<? echo base_url();?>design/scripts/jquery-1.4.3.js"></script>


<script type="text/javascript" src="<? echo base_url();?>design/scripts/UI.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/interface.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/ajaxupload.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/fast.js"></script>
<link rel="stylesheet" href="<? echo base_url();?>design/style.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<? echo base_url();?>design/css/styles.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<? echo base_url();?>design/css/fast.css" type="text/css" media="screen, projection" />
 



</head>
<body>

    <div class="sample">
            <h1>Быстрые сообщения</h1>




    <table><tr><td width="40%" >
                <div id="user_online"></div>
            </td>
            <td >
                <div id="message"></div>
            </td>
        </tr></table><br/>
        <div id="send_message">
            <form onSubmit="doSendMessage();return false;" onkeypress="ctrlEnter(event);">
            Текст сообщения<br/>
            <textarea rows="3" cols="60" id="text_mes"></textarea>
            
            <br/><input type="submit" value="Ctrl+&crarr;"/>
            </form>
        </div>

        <center><a href="http://readyou.ru">Артемий Татаринов &copy;</a></center>
    </div>

</body>
</html>
