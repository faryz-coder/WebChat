<?php

  session_start();
  include 'db.php';
  $uid = $_SESSION['u_id'];
  $msg = mysqli_real_escape_string($conn,$_POST['msg']);
  $upload = $_FILES['file']['name'];
  $room =  $_SESSION['u_room'];

  if(!empty($upload))
  {

    $upload = $_FILES['file']['name'];
    $store = $_FILES['file']['tmp_name'];
    $fileDestination = 'upload/'.$upload;

    $sql = "INSERT INTO $room (uid, msg) VALUES ('$uid', '$fileDestination');";
    $result = mysqli_query($conn, $sql);
    move_uploaded_file($store,$fileDestination);

  }
  //set the id, and get the message
  //$uid = $_SESSION['u_id'];
  //$msg = mysqli_real_escape_string($conn,$_POST['msg']);

  //check if the msg box is Empty
  //if it msg empty or the uid is empty return the user to chat.php
  if(empty($msg)||empty($uid))
  {
    header("Location: chat.php?empty=id||msg");
    exit();
  }
  // else its not empty and insert the msg into db
  else
  {
    $sql =  "INSERT INTO $room (uid, msg) VALUES ('$uid', '$msg');";
    $result = mysqli_query($conn, $sql);
    header("Location: chat.php?success=insert");
    exit();
  }

 ?>
