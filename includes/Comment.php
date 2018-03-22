<?php

require_once("database.php");
require_once("send_mail.php");


class Comment{

    public $id;
    public $appreciationId;
    public $user;
    public $commentText;
    public $date;




    function __construct($params = array()){

        if (count($params) > 0){
            $this->initialize($params);
        }
    }

    function initialize($params = array()){
        if (count($params) > 0){
            foreach ($params as $key => $val){
                if (!isset($this->$key)){
                    $this->$key = $val;
                }
            }
        }
    }

    public function create() {
        global $database;
        $sql = "INSERT INTO comments ( appreciationId, user, commentText, date) VALUES ('";
        $sql .= $database->escape_value($this->appreciationId)."', '";
        $sql .= $database->escape_value($this->user)."', '";
        $sql .= $database->escape_value($this->commentText)."', '";
        $sql .= $database->escape_value($this->date)."')";
        if ($database->query($sql)) {
            return true;
        } else {
            return false;
        }
    }


    public function getLastID(){
        global $database;
        $sql = "SELECT MAX(id) FROM comments";
        $result = $database->query($sql);
        $row = $database->fetch_array($result);
        return $row["MAX(id)"];
    }





   public function getAllComments(){

    }

    public function delete_Comment() {
        global $database;

        $sql = "DELETE from comments ";
        $sql .= "' WHERE id = ".$database->escape_value($this->id);
        if ($database->query($sql)) {
            return true;
        } else {
            return false;
        }
    }


    public function get_picture_id() {
        global $database;
        $sql = "SELECT picture_id FROM user WHERE id={$this->user}";
        $result = $database->query($sql);
        $row = $database->fetch_array($result);
        return $row['picture_id'];
    }
}
