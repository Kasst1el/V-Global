<?php 
require('views/admin/header.html');?>
<div class="container">
    <div class="panel panel-primary">
    <div class="panel-heading">Редактирование пользователя</div>
    <div class="panel-body">
      <form method='POST' action="/BalkonPub/views/admin/edit.php">
        <table class="table">
        <tr>
          <td class="field_title"><p>Id:</p></td>
          <td><p><?php echo $result['user']->id; ?></p><input type='text' name='id' value='<?php echo $result['user']->id; ?>' style="display:none">
          </td>
        </tr>
        <tr>
        <tr>
          <td class="field_title"><p>Имя пользователя:</p></td>
          <td><input type='text' name='changed_name' value='<?php echo $result['user']->name; ?>'>
          </td>
        </tr>
        <tr>
          <td class="field_title"><p>Фамилия:</p></td>
          <td><input type='text' name='changed_surname' value='<?php echo $result['user']->surname; ?>'>
          </td>
        </tr>
        <tr>
          <td class="field_title"><p>Email:</p></td>
          <td><input type='text' name='changed_email' value='<?php echo $result['user']->email; ?>'>
          </td>
        </tr>
        <tr>
          <td class="field_title"><p>Телефон:</p></td>
          <td><input type='text' name='changed_phone' value='<?php echo $result['user']->phone; ?>'>
          </td>
        </tr>
        <tr>
          <td class="field_title"><p>Город:</p></td>
          <td><input type='text' name='city' value='<?php echo $result['user']->city; ?>'>
          </td>
        </tr>
        <tr>
          <td class="field_title"><p>Хобби:</p></td>
          <td><input type='text' name='hobby' value='<?php echo $result['user']->hobby; ?>'>
          </td>
        </tr>
        <tr>
          <td class="field_title"><p>Подписка</p></td>
          <td><input type="checkbox" name="changed_subscribe" <?php if($result['user']->subscribe){
            echo 'checked';
            } ?>>
          </td>
        </tr>
        <tr>
          <td class="field_title"><p>Сума расходов</p></td>
          <td><input type='number' name='spendings_sum' value="<?php echo $result['user']->spendings_sum;?>">
          </td>
        </tr> 
        <tr><td><input class="btn btn-success" type="submit" name="submit" value="Изменить пользователя"></td><td></td></tr>
        </table>
      </form>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">Купоны пользователя</div>
    <div class="panel-body">
    <?php
    foreach($result['coupons'] as $coupon) {
      require('singleCoupon.php'); 
    }?>
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">История счетов</div>
    <div class="panel-body">
    <?php
    $users[]=$result['user'];
    require('createSpending.php');
    foreach($result['spendings'] as $spending) {
      require('singleSpending.php'); 
    }?>
    </div>
  </div>
</div>

