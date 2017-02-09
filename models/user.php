<?php
  class User {
    // we define 3 attributes
    // they are public so that we can access them using $user->name directly
    public $id;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $city;
    public $hobby;
    public $regtime;
    public $referral;
    public $subscribe;
    public $spendings_sum;

    public function __construct($id, $name, $surname,$email, $phone, $city,$hobby, $regtime,$referral,$subscribe,$spendings_sum) {
      $this->id      = $id;
      $this->name  = $name;
      $this->surname = $surname;
      $this->email = $email;
      $this->phone=$phone;
      $this->city=$city;
      $this->hobby=$hobby;
      $this->regtime=$regtime;
      $this->referral=$referral;
      $this->subscribe=$subscribe;
      $this->spendings_sum=$spendings_sum;
    }

    public static function all() {
      try{
        $list = [];
        $db = Db::getInstance();

          $req = $db->query('SELECT * FROM users');
          foreach($req->fetchAll() as $user) {
            $list[] = new user($user['id'], $user['name'], $user['surname'],$user['email'], $user['phone'], $user['city'], $user['hobby'], $user['regdate'],$user['referral'],$user['subscribe'],$user['spendings_sum']);

          }
        return $list;
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function singleUser($id){
      try{
        if($id!=null)
        {
          $db = Db::getInstance();
          $userReq=$db->query('SELECT * from users where id='.$id);
          $userReq->execute();
          $userData=$userReq->fetch();
          $user=new user($userData['id'], $userData['name'], $userData['surname'],$userData['email'],$userData['phone'],  $userData['city'], $userData['hobby'], $userData['regdate'],$userData['referral'],$userData['subscribe'],$userData['spendings_sum']);

          $couponReq=$db->query('SELECT * FROM coupons WHERE benefitiary='.$id);
          $couponReq->execute();
          $couponData=$couponReq->fetchAll();
          $coupons=[];
          foreach($couponData as $coupon){
            $coupons[]=new coupon($coupon['coupon_id'], $coupon['coupon_name'], $coupon['description'],$coupon['discount'],$coupon['benefitiary']);
          }

          $spendingReq=$db->query('SELECT * FROM spendings WHERE user_id='.$id);
          $spendingReq->execute();
          $spendingData=$spendingReq->fetchAll();
          $spendings=[];
          foreach($spendingData as $spending){
            $spendings[]=new spending($spending['spending_id'], $spending['user_id'], $spending['who_filled'],$spending['date'],$spending['purchase_list'],$spending['sum']);
          }

          $result=['user'=>$user,'coupons'=>$coupons, 'spendings'=>$spendings];
          return $result;//require_once('/../views/admin/singleUser.php');
        }
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function create($name,$surname,$email,$phone,$referral,$subscribe,$password){
      try{
        $db = Db::getInstance();
        $req = $db->prepare('INSERT INTO users (name, surname, email, phone, regdate, referral,subscribe,password) VALUES (:name,:surname,:email,:phone,:date,:referral,:subscribe,:password)');
        $req->execute(array('name'=>$name,'surname'=>$surname,'email'=>$email,'phone'=>$phone, 'date'=>date('Y-m-d'), 'referral'=>$referral,'subscribe'=>$subscribe,'password'=>$password));
        
        //get new user's id
        $idReq=$db->prepare('SELECT id FROM users where name="'.$name.'" AND surname="'.$surname.'" AND email="'.$email.'" AND phone="'.$phone.'"');
        $idReq->execute();
        $id=$idReq->fetch()['id'];
        //create coupon for registration
        $sampleReq=$db->prepare('SELECT * FROM coupons where coupon_id=-2');
        $sampleReq->execute();
        $sample=$sampleReq->fetch();

        $req2 = $db->prepare('INSERT INTO coupons (coupon_name, description, discount,benefitiary) VALUES (:coupon_name,:description,:discount,:benefitiary)');
        $req2->execute(array('coupon_name'=>$sample['coupon_name'],'description'=>$sample['description'],'discount'=>$sample['discount'],'benefitiary'=>$id));
        
        if($referral!=null && $referral!=0){
          $sampleReq=$db->prepare('SELECT * FROM coupons where coupon_id=-1');
          $sampleReq->execute();
          $sample=$sampleReq->fetch();

          $req2 = $db->prepare('INSERT INTO coupons (coupon_name, description, discount,benefitiary) VALUES (:coupon_name,:description,:discount,:benefitiary)');
          $req2->execute(array('coupon_name'=>$sample['coupon_name'],'description'=>$sample['description'],'discount'=>$sample['discount'],'benefitiary'=>$referral));
        }
      } catch(PDOException $e){
          echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
          header('Refresh: 10; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function editUser($id, $name,$surname,$email,$phone, $city,$hobby,$subscribe,$sum){
      try{
        $db = Db::getInstance();

        if($db != false){

          if($req = $db->prepare('UPDATE users SET name=:name, surname=:surname, email=:email, phone=:phone, city=:city,hobby=:hobby,subscribe=:subscribe,spendings_sum=:spendings_sum WHERE id=:id')){ 
            
            if($req->execute(array('name'=>$name,'surname'=>$surname,'email'=>$email,'phone'=>$phone, 'city'=>$city,'hobby'=>$hobby, 'subscribe'=>$subscribe,'id'=>$id,'spendings_sum'=>$sum)) == false ){
                echo "ERROR: Could not execute query: $sql. " . $mysqli->error;
              }
            }else{
              echo "ERROR: Could not prepare query: $sql. " . $mysqli->error;
            }
          }else{
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          return true;
        } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        return false;
      }
    }

    
    public static function changeSubscribe(){
      try{  
        $subscribe=htmlspecialchars($_GET['subscribe']);
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE users SET subscribe='.$subscribe);
        $req->execute();
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function setReferral($id,$referral){
      try{
        $db = Db::getInstance();
         $req = $db->prepare('UPDATE users SET referral='.$referral.' WHERE id='.$id.' AND (referral=null OR referral=0)');
         
        //$req = $db->prepare('UPDATE users SET referral='.$referral.' WHERE id='.$id);

        $req->execute();

        $sampleReq=$db->prepare('SELECT * FROM coupons where coupon_id="-1" LIMIT 1');
        $sampleReq->execute();
        $sample=$sampleReq->fetch();

        $req2 = $db->prepare('INSERT INTO coupons (coupon_name, description, discount,benefitiary) VALUES (:coupon_name,:description,:discount,:benefitiary)');
        $req2->execute(array('coupon_name'=>$sample['coupon_name'],'description'=>$sample['description'],'discount'=>$sample['discount'],'benefitiary'=>$referral));
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function getFeed(){
      try{
        $db=Db::getInstance();      
        $filename = "emails" . date('Ymd') . ".xls";
          header("Content-Disposition: attachment; filename=\"$filename\"");
          header("Content-Type: application/vnd.ms-excel");
          mb_convert_encoding($csv, 'UTF-8');
          $mysqli=new mysqli("localhost","u664003458_balk","BalkonPub", "u664003458_balk");
          if ($mysqli->connect_errno) {
            printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
            exit();
          }
          $sql="SELECT name,email FROM users WHERE subscribe='1' UNION SELECT feed_name,email_adress FROM email_feed";
          if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {
              while($row = $result->fetch_array()) {
                echo mb_convert_encoding($row[0], 'UTF-8'). "\t" . $row[1] . "\n";
              }
              $result->close();
            } else {
              echo "No records matching your query were found.";
            }
          } else {
          echo "ERROR: Could not execute $sql. " . $mysqli->error;
          }
          $mysqli->close();
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function search($id,$name,$surname,$email,$phone, $city,$hobby){
      try{
        $filterArray=['id'=>$id, 'name'=>$name,'surname'=>$surname,'email'=>$email,'phone'=>$phone, 'city'=>$city,'hobby'=>$hobby];
        $i=0;
        $query = 'SELECT * FROM users WHERE ';
        foreach($filterArray as $key=>$value){
          if($value!=null){
            if($i>0){
              $query.=' AND ';
            }
            $query.=$key.' LIKE "'.$value.'"';
            $i++;
          }
        }
        $db = Db::getInstance();
        $req = $db->query($query);
        foreach($req->fetchAll() as $user) {
          $list[] = new user($user['id'], $user['name'], $user['surname'],$user['email'], $user['phone'], $user['city'],$user['hobby'],$user['regdate'],$user['referral'],$user['subscribe']);
        }
        return $list;
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

public static function createSubscriber($name, $email){
    try{
      $db = Db::getInstance();
      $req = $db->prepare('INSERT INTO email_feed (feed_name, regdate, email_adress)VALUES (:feed_name,:regdate,:email_adress)');
      $req->execute(array('feed_name'=>$name,'email_adress'=>$email,'regdate'=>date('Y-m-d')));
    }catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function login($name,$password){
      try{  
        $db = Db::getInstance();
        $req = $db->prepare('SELECT id FROM users WHERE name="'.$name.'" AND password="'.$password.'"');
        $req->execute();
        $result=$req->fetch();
        if(!empty($result)){
          return $result['id'];
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