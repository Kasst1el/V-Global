<?php
  class Message {
    // we define 3 attributes
    // they are public so that we can access them using $user->name directly
    public $message_id;
    public $text;
    public $date;
    public $was_read;

    public function __construct($message_id, $text,$date,$was_read) {
      $this->message_id      = $message_id;
      $this->text = $text;
      $this->date = $date;
      $this->was_read=$was_read;
    }

    public static function all() {
      try{
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM messages ORDER BY date DESC');
      foreach($req->fetchAll() as $message) {
        $list[] = new message($message['message_id'], $message['text'],$message['date'], $message['was_read']);
      }
      return $list;
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function create($text){
      try{
      $db = Db::getInstance();
      $req = $db->prepare('INSERT INTO messages (text, date,was_read) VALUES (:text,:date,:was_read)');
      $req->execute(array('text'=>$text,'date'=>date("Y-m-d H:i:s"), 'was_read'=>0));
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function delete($message_id){
      try{
      $db = Db::getInstance();
      $req = $db->prepare('DELETE FROM messages WHERE message_id='.$message_id);
      $req->execute();
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=users');
      }
    }

    public static function readMessage($message_id){
      try{
      $db = Db::getInstance();
      $req = $db->prepare('UPDATE messages SET was_read=1 WHERE message_id="'.$message_id.'"');
      $req->execute();
      } catch(PDOException $e){
        echo 'Ошибка работы с базой данных: ' . $e->getMessage(); 
        header('Refresh: 4; URL =/BalkonPub/index.php?controller=admin&action=messages');
      }
    }
  }