<?php
// creating room process

session_start();
include 'db.php';
$uid = $_SESSION['u_id'];
$bcreate = mysqli_real_escape_string($conn,$_POST['Bcreate_r']);
$createroom = mysqli_real_escape_string($conn,$_POST['Create_room']);
if(empty($bcreate) && empty($createroom)){
  header("Location: main.php?empty");
  exit();
}

if(isset($_POST['Bcreate_r']) || isset($_POST['Create_room']))
{
    //pass the input room name
    $rn = mysqli_real_escape_string($conn,$_POST['Create_room']);

    //check if the room name is already used
    $sql = "SELECT * FROM list_room WHERE room_name = '$rn'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    { //if the room taken return error to main.php
      header("Location: main.php?room_name= taken");
      exit();
    }
    else { // else if it not taken , register & create the new room with the name

      // create new table for the new chat room
      $sql = "CREATE TABLE $rn".'(
        no int(11) not null auto_increment primary key,
        uid varchar(255),
        msg varchar(500)
      );';
      $result = mysqli_query($conn, $sql);

      //register the new room into list room db
      $sql = "INSERT INTO list_room (room_name) VALUES ('$rn');";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      //register the new room into Admin_list db
      $sql = "INSERT INTO Admin_list (room_name, uid) VALUES ('$rn', '$uid');";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      //add into user list of active room
      $ruid = "ur_".$uid;
      $sql = "INSERT INTO $ruid (room) VALUES ('$rn');";
      $result = mysqli_query($conn, $sql);

      //create new table for the room list of member
      $listmember = "lm_".$rn;
      $sql = "CREATE TABLE $listmember".'(
        no int(11) not null auto_increment primary key,
        uid varchar(255)
      );';
      $result = mysqli_query($conn, $sql);

      //insert user into the room list of member
      $sql = "INSERT INTO $listmember (uid) VALUES ('$uid');";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      //return to main
      header("Location: main.php?create_room=success");
      exit();
    }

}
else{
  header("Location: main.php?error=error");
  exit();
}
 ?>
