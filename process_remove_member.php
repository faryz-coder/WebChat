<?php

  session_start();

  include 'db.php';
  $duid = mysqli_real_escape_string($conn, $_POST['remove']);
  $room = $_SESSION['u_room'];

  if(empty($duid))
  {
    header("Location: chat.php?empty=removeMember");
    exit();
  }
  else {

    $u_roomlist = "ur_".$duid;
    $sql = "SELECT * FROM $u_roomlist WHERE room ='$room'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if($resultCheck < 1)
    {
      header("Location: chat.php?already=remove");
      exit();
    }
    else{

      //delete user from the room list of member
      $listmem = "lm_".$room;
      $sql ="DELETE FROM $listmem WHERE uid = '$duid'";
      $result = mysqli_query($conn, $sql);

      //delete from the member list of active room

      $sql = "DELETE FROM $u_roomlist WHERE room = '$room'";
      $result = mysqli_query($conn, $sql);
      header("Location: chat.php?done=removeMember");
      exit();


    }

  }

 ?>
