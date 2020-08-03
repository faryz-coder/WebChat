<?php
  //start session
  session_start();
  include 'db.php';
  $room = $_POST['select'];
  $_SESSION['u_room'] =  $room;
  $uid = $_SESSION['u_id'];

  //check if the user is the admin for choosen room
  $sql = "SELECT * FROM Admin_list WHERE uid = '$uid' AND room_name = '$room'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows ($result);

  // if admin, set session status to admin
  if($resultCheck > 0)
  {
    $_SESSION['u_stat'] = "admin";
    header("Location: chat.php");
    exit();
  }
  // else no , set session to normal
  else {
    $_SESSION['u_stat'] = "normal";
    header("Location: chat.php");
    exit();
  }

 ?>
