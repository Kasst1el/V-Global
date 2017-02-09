<?php
error_reporting(E_ALL & ~E_NOTICE);
session_name("fancyform");
session_start();


$_SESSION['n1'] = rand(1,20);
$_SESSION['n2'] = rand(1,20);
$_SESSION['expect'] = $_SESSION['n1']+$_SESSION['n2'];


$str='';
if($_SESSION['errStr'])
{
	$str='<div class="error">'.$_SESSION['errStr'].'</div>';
	unset($_SESSION['errStr']);
}

$success='';
if($_SESSION['sent'])
{
	$success='<h2>Thank you!</h2>';
	
	$css='<style type="text/css">#contact-form{display:none;}</style>';
	
	unset($_SESSION['sent']);
}
?>





<div id="main-container" style="background-color:white; border-radius:8px; border:2px solid lightgray; padding:10px">

<link rel="stylesheet" type="text/css" href="jqtransformplugin/jqtransform.css" />
<link rel="stylesheet" type="text/css" href="formValidator/validationEngine.jquery.css" />
<link rel="stylesheet" type="text/css" href="demo.css" />

<?=$css?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="jqtransformplugin/jquery.jqtransform.js"></script>
<script type="text/javascript" src="formValidator/jquery.validationEngine.js"></script>

<script type="text/javascript" src="script.js"></script>


	<div id="form-container">
    <h2>Форма обратной связи</h2>
    <h4>Здесь вы можете отправить нам сообщение.</h4>
    
    <form id="contact-form" name="contact-form" method="post" action="./views/home/form/submit.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="15%"><label for="name">Ваше имя:</label></td>
          <td width="70%"><input type="text" class="validate[required,custom[onlyLetter]]" name="name" id="name" value="<?=$_SESSION['post']['name']?>" /></td>
          <td width="15%" id="errOffset">&nbsp;</td>
        </tr>
        <tr>
          <td><label for="email">Ваш e-mail:</label></td>
          <td><input type="text" class="validate[required,custom[email]]" name="email" id="email" value="<?=$_SESSION['post']['email']?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
        	 <td colspan="3"><h4>Выберите тему для письма и напишите сообщение</h4></td>
        </tr>
        <tr>
          <td><label for="subject">Тема письма:</label></td>
          <td><select name="subject" id="subject">
            <option value="" selected="selected"> - выбрать тему -</option>
            <option value="Нашел ошибку!">Нашел ошибку!</option>
            <option value="Предлагаю...">Предлагаю...</option>
            <option value="Желаю...">Желаю...</option>
            <option value="Помогите...">Помогите... :)</option>
            <option value="Hello">Hello!</option>
				<option value="RRR">А ты кто?</option>
          </select>          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><label for="message">Сообщение:</label></td>
          <td><textarea name="message" id="message" class="validate[required]" cols="35" rows="5"><?=$_SESSION['post']['message']?></textarea></td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
        	 <td colspan="3"><h4>Введите капчу и нажмите "Отправить".</h4></td>
        </tr>
        <tr>
          <td><label for="captcha"><?=$_SESSION['n1']?> + <?=$_SESSION['n2']?> =</label></td>
          <td><input type="text" class="validate[required,custom[onlyNumber]]" name="captcha" id="captcha" /></td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td colspan="2"><input type="submit" name="button" id="button" value="Отправить" />
          <input type="reset" name="button2" id="button2" value="Очистить" />
          
          <?=$str?>          <img id="loading" src="img/ajax-load.gif" width="16" height="16" alt="loading" /></td>
        </tr>
      </table>
      </form>
      <?=$success?>
    </div>
<!-- 	<div class="tutorial-info">	
	Русская версия <a href="http://master-css.com/page/forma-obratnoj-svjazi-dlja-sajta">красивой формы контактов.</a><br />
   Автор: <a href="http://tutorialzine.com/2009/09/fancy-contact-form/">www.tutorialzine.com</a>.</div> -->

</div>
