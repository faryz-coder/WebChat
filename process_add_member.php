<?php

  session_start();
  include 'db.php';

  $auid = mysqli_real_escape_string($conn, $_POST['add']);
  $room = $_SESSION['u_room'];

  if(isset($_POST['submit-add']))
  {
    if(empty($auid))
    {
      header("Location: chat.php?empty=add_member");
      exit();
    }
    else {

      $u_roomlist = "ur_".$auid;
      $sql = "SELECT * FROM $u_roomlist WHERE room ='$room'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);

      if($resultCheck > 0)
      {
        header("Location: chat.php?already=member");
        exit();
      }
      else{

        // add user into room list member
        $listmem = "lm_".$room;
        $sql = "INSERT INTO $listmem (uid) VALUES ('$auid');";
        $result = mysqli_query($conn, $sql);


        // add room into user list of active room

        $sql = "INSERT INTO $u_roomlist (room) VALUES ('$room');";
        $result = mysqli_query($conn, $sql);

        header("Location: chat.php?done=add_member");
        exit();
      }

    }
  }

 ?>
