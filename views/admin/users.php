<?php 

require('views/admin/header.html');?>
<div class="container">
	<h3>Пользователи</h3>
	<?php
	require('views/admin/search.php');
	?>
	<?php 
foreach($users as $user) {
	$subscribe='Нет';
	if($user->subscribe==1){$subscribe='Да';}
	echo "
	<div class='panel panel-primary'>
		<div class='panel-heading' style='height:55px'>
			<h4 style='float:left'>Пользователь №".$user->id."<h4>
			<a type='button' class='btn btn-info' href='?controller=admin&action=singleUser&id=".$user->id."' style='float:right'>Просмотреть профиль</a>
		</div>
		<div class='panel-body'>
			<table class='table'>
				<tr class='panel panel-primary'>
					<td class='field_title'><p>Id:</p></td>
		            <td><p>".$user->id."</p></td>
		      	</tr>
			      <tr class='panel panel-primary'>
				    <td class='field_title'><p>Имя Фамилия:</p></td>
			        <td><p>".$user->name.' '.$user->surname."</p></td>
			      </tr>
			      <tr class='panel panel-primary'>
			        <td class='field_title'><p>Email:</p></td>
			        <td><p>".$user->email."</p></td>
			      </tr>
			      <tr class='panel panel-primary'>
					<td class='field_title'><p>Телефон: </p></td>
			        <td><p>".$user->phone."</p></td>
			      </tr>
			      <tr class='panel panel-primary'>
			      	<td class='field_title'><p>Город: </p></td>
			        <td><p>".$user->city."</p></td>
			      </tr>
			      <tr class='panel panel-primary'>
			      	<td class='field_title'><p>Хобби: </p></td>
			        <td><p>".$user->hobby."</p></td>
			      </tr>
			      <tr class='panel panel-primary'>
			      	<td class='field_title'><p>Дата регистрации: </p></td>
			        <td><p>".$user->regtime."</p></td>
			      </tr>
			      
			      <tr class='panel panel-primary'>
			        <td class='field_title'><p>Реферрал: </p></td>
		            <td><p>".$user->referral."</p></td>
			      </tr>
			      <tr class='panel panel-primary'>
			      	<td class='field_title'><p>Подписан на рассылку: </p></td>
			        <td><p>$subscribe</p></td>
			      </tr>
			      <tr class='panel panel-primary'>
			      	<td class='field_title'><p>Сума расходов: </p></td>
			        <td><p>".$user->spendings_sum." грн</p></td>
			      </tr>
			    </table>
			</div>
		</div>";
}?>
</div>
