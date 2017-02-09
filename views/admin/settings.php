
<?php 
require('views/admin/header.html');?>
<style>
#left_part ul
{
	list-style-type:none;
}
#right_part>div.container {
	display:none;
}
 .shown
 {
 	display:block !important;
 }

.active
{
	background-color:#2bacd4 !important;
}
</style>


<div class="container col-xs-12">
	<div id="left_part" class="col-xs-3" style="margin-left:0px;padding-left:0px">
		<ul>
			<li>
				<button id="admin_setting" class="btn btn-info col-xs-12" onclick="{changeElement(this.id,'active'); deactivateAllElse(this.id,'content_switcher','active'); deactivateAllElse(this.id.substr(0,this.id.length-7)+'window','setting_window','shown'); changeElement(this.id.substr(0,this.id.length-7)+'window','shown')}"  name="content_switcher">
					Настройки доступа <br>к странице администрирования
				</button>
			</li>		
			<li>
				<button id="autocoupons_setting" class="btn btn-info col-xs-12" onclick="{changeElement(this.id,'active'); deactivateAllElse(this.id,'content_switcher','active'); deactivateAllElse(this.id.substr(0,this.id.length-7)+'window','setting_window','shown'); changeElement(this.id.substr(0,this.id.length-7)+'window','shown')}"  name="content_switcher">
					Настройки автоматических <br> промокодов
				</button>
			</li>
			<li>
				<button id="section_setting" class="btn btn-info col-xs-12" onclick="{changeElement(this.id,'active'); deactivateAllElse(this.id,'content_switcher','active'); deactivateAllElse(this.id.substr(0,this.id.length-7)+'window','setting_window','shown'); changeElement(this.id.substr(0,this.id.length-7)+'window','shown')}" name="content_switcher"> 
					Настройки разделов
				</button>
			</li>
		</ul>
	</div>
	<div id="right_part" class="col-xs-8">
	<?php 
echo "<div class='container' style='width:1100px' id='admin_window' name='setting_window'>
		<div class='panel panel-info'>
			<div class='panel-heading'>Данные доступа к странице администрирования</div>
			<div class='panel-body'>
				<form method='POST' action='/BalkonPub/views/admin/editAdminData.php'>
					<table class='table'>
						<tr>
							<td>Логин</td>
							<td>Пароль</td>
						</tr>
						<tr>
							<td><input type='text' name='admin_login' value='".$adminData['admin_login']."' required'></td>
							<td><input type='password' name='admin_password' value='".$adminData['admin_password']."' required'></td>
						</tr>
						<tr>
							<td><input type='submit' name='submit' class='btn btn-success' value='Сохранить'></td>
							<td></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>";

echo "<div class='container' style='width:1100px' id='autocoupons_window' name='setting_window'>";
	foreach($sampleCoupons as $coupon){
	echo "<form method='POST' action='/BalkonPub/views/admin/editCoupon.php'>
			<div class='panel panel-info'>				
				<div class='panel-heading'>
					<p>Название автоматически-создаваемого промо-кода: <br><input type='text' style='width:300px' name='sample_name' value='".$coupon->coupon_name."'></p>
					<input name='sample_id' value='".$coupon->coupon_id."'  style='display:none' required>
				</div>
				<div class='panel-body'>
					<table>
					    <tr>
					        <td class='field_title'><p>Описание образцового промо-кода<p></td>
					        <td><input type='text' style='width:100%' name='sample_description' value='".$coupon->description."'></td>
					    </tr>
					    <tr>
					        <td class='field_title'><p>Скидка:</p></td>
					        <td><input type='text' name='sample_discount' value='".$coupon->discount."' required></td>
					    </tr>
					    <tr>
					    	<td><input type='submit' name='submit' value='Редактировать промо-код' class='btn btn-success'>
					    	</td>
					    	<td></td>
					    </tr>
			  		</table>
			  	</div>
			</div>
		</form>";
		}

echo "</div>
<div class='container' id='section_window' style='width:1100px' name='setting_window'>";
	foreach($sections as $section){
	echo "<div class='panel ";
		if($section->visible==1){echo "panel-primary'>";}else{echo "panel-info'>";}
		echo "<div class='panel-heading'>
					<p>Раздел № $section->section_id</p>
				</div>
				<div class='panel-body'>
					<table class='table'>
					    <tr>
					        <td class='field_title'><p>Название раздела<p></td>
					        <td><p>$section->section_name</p></td>
					    </tr>
					    <tr>
					        <td class='field_title'><p>Порядок:</p></td>
					        <td><p>$section->weight</p></td>
					    </tr>
					    <tr>
					        <td class='field_title'><p>Видим:</p></td>
					        <td><p>";
					        if($section->visible==1){echo 'Да';}else{echo 'Нет';}
					        echo "</p></td>
					    </tr>
					    <tr>
					    	<td><a class='btn btn-success' href='?controller=admin&action=singleSection&section_id=".$section->section_id."'>Редактировать раздел</a>";
					    	if($section->visible==1){
					    		echo "<a class='btn btn-warning' href='./views/admin/toggleVisibility.php?section_id=".$section->section_id."&section_visible=0'>Спрятать раздел";
					    	}else{
					    		echo "<a class='btn btn-warning' href='./views/admin/toggleVisibility.php?section_id=".$section->section_id."&section_visible=1'>Сделать раздел видимым";}
					    		echo "</a>
					    	</td>
					    	<td><a class='btn btn-danger' href='?controller=admin&action=delete&section_id=".$section->section_id."'>Удалить раздел</a></td>
					    </tr>
			  		</table>
	  			</div>
	  		</div>";
		}

	require('views/admin/createSection.php');
echo "</div>";
	?>
</div>
<script>

function getAllElementsWithAttribute(attribute)
{
  var matchingElements = [];
  var allElements = document.getElementsByTagName('*');
  for (var i = 0, n = allElements.length; i < n; i++)
  {
    if (allElements[i].getAttribute(attribute) !== null)
    {
      // Element exists with attribute. Add to array.
      matchingElements.push(allElements[i]);
    }
  }
  return matchingElements;
}

function deactivateAllElse(id, name, status){

//alert(id+' '+name+' '+' '+status);
    array=getAllElementsWithAttribute('name');
        for(i=0;i<array.length;i++){
        	//alert(array[i].getAttribute('name'));
            if(array[i].getAttribute('name')==name && (z=array[i].className.indexOf(' '+status))>=0 && array[i].id!=id){
                array[i].className=array[i].className.substr(0,z);
                //alert( array[i].className+' deactivated');
            }
        }
   }

//alert(document.getElementById('admin_window').getAttribute('name'));

function changeElement(id,status){
	if((document.getElementById(id).className.indexOf(' '+status))<0){
	    document.getElementById(id).className+=' '+status;
	}else{
		if((i=document.getElementById(id).className.indexOf(' '+status))>=0){
    	document.getElementById(id).className=document.getElementById(id).className.substr(0, i);
    	}
	}
}
</script>
</div>