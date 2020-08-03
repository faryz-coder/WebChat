<?php

  session_start();
  include 'db.php';

  $admin_uid = mysqli_real_escape_string($conn, $_POST['addAdmin']);
  $room = $_SESSION['u_room'];

  if(empty($admin_uid))
  {
    header("Location: chat.php?admin=empty");
    exit();
  }
  else {
    //check if the user already inside the admin list
    $sql = "SELECT * FROM Admin_list WHERE room_name ='$room' AND uid ='$admin_uid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($resultCheck > 0) {
      header("Location: chat.php?already_admin");
      exit();
    }
    else {
      $sql = "INSERT INTO Admin_list (room_name, uid) VALUES ('$room', '$admin_uid');";
      $result = mysqli_query($conn, $sql);
      header("Location: chat.php?admin=added");
      exit();
    }


  }


 ?>
