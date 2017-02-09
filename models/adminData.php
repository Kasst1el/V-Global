<?php
  class AdminData {
    public static function getAdminData() {
      try{
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM settings limit 1');

        // we create a list of user objects from the database results
        $adminData=$req->fetch();
        return $adminData;
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=adminData');
      }
    }

    public static function editAdminData($admin_login,$admin_password){
      try{
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE settings SET admin_login=:admin_login, admin_password=:admin_password');
        $req->execute(array('admin_login'=>$admin_login,'admin_password'=>$admin_password,));
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=adminData');
      }
    }

    public static function admin_login($login,$password){
      try{  
        $db = Db::getInstance();
        $req = $db->prepare('SELECT admin_login,admin_password FROM settings LIMIT 1');
        $req->execute();
        $result=$req->fetch();
        if($result['admin_login']==$login && $result['admin_password']==$password){
          return true;
        }else{
          return false;
        }
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }
  }
?>