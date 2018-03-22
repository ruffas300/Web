<?php
require_once("includes/initialize.php");
require_once("includes/Comment.php");


/**
 * Created by PhpStorm.
 * User: Ed
 * Date: 3/22/18
 * Time: 10:16 AM
 */


if (isset($_POST['submit'])) {

    $commentToPost = new Comment();
    $commentToPost->appreciationId = $_POST['appId'];
    $commentToPost->user = (int)$_POST['userId'];
    $commentToPost->date = $_POST['date'];
    $commentToPost->commentText = $_POST['comment'];
    $commentToPost->create();
    unset($_POST);
    redirect_to("main.php");

}




