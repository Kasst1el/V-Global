<?php
  class AdminController {
    public function index() {
      if($_SESSION['valid']==true && $_SESSION['type']=='admin'){
    	      $users = User::all();
      require_once('views/admin/index.php');
      }else{
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=login');
        }
    }

    public function login() {
      require_once('views/admin/login.php');
    }    
    public function logout() {
      require_once('views/admin/logout.php');
    } 

    public function users(){
      if($_SESSION['valid']==true && $_SESSION['type']=='admin'){
        // if (isset($_GET['sought_id']) || isset($_GET['sought_name']) || isset($_GET['sought_surname']) || isset($_GET['sought_email']) || isset($_GET['sought_phone']) || isset($_GET['sought_city']) || isset($_GET['sought_hobby'])) {

        //   $sought_id=htmlspecialchars($_GET['sought_id']); 
        //   $sought_name=htmlspecialchars($_GET['sought_name']); 
        //   $sought_surname=htmlspecialchars($_GET['sought_surname']); 
        //   $sought_email=htmlspecialchars($_GET['sought_email']); 
        //   $sought_phone=htmlspecialchars(str_replace("plus","+",$_GET['sought_phone']));
        //   $sought_city=htmlspecialchars($_GET['sought_city']);
        //   $sought_hobby=htmlspecialchars($_GET['sought_hobby']);

        //   $users = User::search($sought_id,$sought_name, $sought_surname,$sought_email,$sought_phone, $sought_city, $sought_hobby);
        //   require_once('views/admin/users.php');
        //  }else{
         $users = User::all();
         require_once('views/admin/users.php');
          //}
      }else{
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=login');
        }
  }

    public function singleUser(){
      if($_SESSION['valid']==true && $_SESSION['type']=='admin'){
        $id=htmlspecialchars($_GET['id']);
        $result=User::singleUser($id);
        require_once('views/admin/singleUser.php');
      }else{
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=login');
        }
    }

    public function settings(){
      if($_SESSION['valid']==true && $_SESSION['type']=='admin'){
        $adminData=adminData::getAdminData();
        require_once('views/admin/settings.php');
      }else{
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=login');
        }
    }


    public function messages(){
      if($_SESSION['valid']==true && $_SESSION['type']=='admin'){
        	$messages=Message::all();
      		require('views/admin/messages.php');
        }else{
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=login');
        }  
      }

    public function deleteMessage(){
      if($_SESSION['valid']==true && $_SESSION['type']=='admin'){
          $message_id=htmlspecialchars($_GET['message_id']);
          Message::delete($message_id);
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=messages');
      }else{
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=login');
        }
    }

    public function readMessage(){
      try{
      if($_SESSION['valid']==true && $_SESSION['type']=='admin'){
        $message_id=htmlspecialchars($_GET['message_id']);
        Message::readMessage($message_id);
        header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=messages');
      }else{
          header('Refresh: 0; URL =/LovaLive/index.php?controller=admin&action=login');
        }
    }catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/LovaLive/index.php?controller=admin&action=messages');
  }
}

}
