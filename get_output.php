<?php
  session_start();
  include 'db.php';
  $room = $_SESSION['u_room'];

  $sql = "SELECT * FROM $room";
  $result = mysqli_query($conn,$sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck > 0)
  {
      while($row = mysqli_fetch_assoc($result))
      {

        //check if the db contain img
        if(stripos($row['msg'], 'upload/') !==false)
        {
          if(stripos($row['msg'], '.png') !==false){
            echo $row['uid']." > "."<label><a href=\"./"
            .$row['msg']."\">".$row['msg']."</a>".
            "<P><img src='".$row['msg']."'></p></label>";
          }
          //if other type than img
          else{
            echo $row['uid']." > "."<label><a href=\"./"
            .$row['msg']."\">".$row['msg']."</a>";
          }
        }
        else{
          //output the msg stored
          echo "<p>".$row['uid']. " > ". $row['msg']. "<br>";
        }
      }
  }

 ?>
