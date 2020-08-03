<?php
  session_start();
  echo "<form action=\"process_getchat.php\" method=\"POST\">";
  include 'db.php';
  $uid = $_SESSION['u_id'];

    $uid = "ur_".$uid;
    $sql = "SELECT * FROM $uid";
    $result =  mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
      //echo "<form action=\"process_getchat.php\" method=\"POST\">";
      while($row = mysqli_fetch_assoc($result))
      {
        echo "<p><button type=\"submit\" name=\"select\" value=\"".$row['room']."\">"
        .$row['room']. "</button></p>";
      }
    }
    else{
      echo "empty";
    }

    echo "</form>";
 ?>
