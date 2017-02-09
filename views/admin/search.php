<?php
if (isset($_POST['sought_id']) || isset($_POST['sought_name']) || isset($_POST['sought_surname']) || isset($_POST['sought_email']) || isset($_POST['sought_phone']) || isset($_POST['sought_city']) || isset($_POST['sought_hobby'])) {

 	$filterArray=['sought_id'=>htmlspecialchars($_POST['sought_id']), 'sought_name'=>htmlspecialchars($_POST['sought_name']),'sought_surname'=>htmlspecialchars($_POST['sought_surname']),'sought_email'=>htmlspecialchars($_POST['sought_email']),'sought_phone'=>htmlspecialchars(str_replace("+","plus",$_POST['sought_phone'])),'sought_city'=>htmlspecialchars($_POST['sought_city']),'sought_hobby'=>htmlspecialchars($_POST['sought_hobby'])];

 	$header='Refresh: 0; URL =/BalkonPub/index.php?controller=admin&action=users&';
 	foreach($filterArray as $key=>$value){
          if($value!=null){
            if($i>0){
              $header.='&';
            }
            $header.=$key.'='.$value;
            $i++;
          }
        }
        header($header);

}else{
?>
<div class="container">
	<div class="panel panel-success">
		<div class="panel-heading">
			<p class="text-center"><b>Найти пользователя:</b></p>
		</div>
		<div class="panel-body">
			  <form method='POST' action="/BalkonPub/views/admin/search.php">
			  	<table class="table">
			  		<tr>
			  			<td class="field_title"><p>Id пользователя</p></td>
					    <td><input type='text' name='sought_id' placeholder='Введите Id'></td>
					</tr>
			  		<tr>
			  			<td class="field_title"><p>Имя пользователя</p></td>
					    <td><input type='text' name='sought_name' placeholder='Введите имя'></td>
					</tr>
					<tr>
					    <td class="field_title"><p>Фамилия</p></td>
					    <td><input type='text' name='sought_surname' placeholder='Введите фамилия'></td>
					</tr>
					<tr>
						<td class="field_title"><p>Email</p></td>
					    <td><input type='text' name='sought_email' placeholder='Введите Email'></td>
					</tr>
					<tr>
						<td class="field_title"><p>Телефон</p></td>
						<td><input type='text' name='sought_phone' placeholder='Введите телефон'></td>
					</tr>
					<tr>
						<td class="field_title"><p>Город</p></td>
						<td><input type='text' name='sought_city' placeholder='Введите город'></td>
					</tr>
					<tr>
						<td class="field_title"><p>Хобби</p></td>
						<td><input type='text' name='sought_hobby' placeholder='Введите хобби'></td>
					</tr>
					<tr>
						<td></td><td><input class="btn btn-success" type="submit" name="submit" value="Найти пользователя"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php } 