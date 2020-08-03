<?php
  session_start();
  $_SESSION['u_stat'] = "";
  $uid = $_SESSION['u_id'];
  if(empty($uid)){
    header("Location: index.html");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="Bomoh_iT" content="K_Ryz">
    <title>Welcome || Login </title>
    <link rel="stylesheet" href="./css/main_chat.css">
    <!-- load jquery lib -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous">
    </script>

    <!-- auto load list room -->
    <script>
      $(document).ready(function(){
        setInterval(function(){
          $("#list_room").load("process_select_room.php")
        },500);
      });
    </script>

  </head>
  <body>

    <div class="bg-image"></div><!-- Background image  -->
    <div class="bg-overlay"></div>
    <div class="bg-form"><!-- Login Form  -->
    <div class="title">
      <h1>Welcome <?php echo $uid?></h1>
    </div>
    <div class="list">
      <h2>Room List</h2>
    </div>
    <div id="list_room">

      <?php
        echo "<form action=\"process_getchat.php\" method=\"POST\">";
        include 'db.php';
          // accessing database and list out all the active room
          $uid = "ur_".$uid;
          $sql = "SELECT * FROM $uid";
          $result =  mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if($resultCheck > 0)
          {
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

    </div>

    <div class="logo"></div> <!--login form logo -->
    <div id="so">
      <button><a href="sign_out.php">LOG OUT</a></button>
    </div>
      <form class="main_section" action="process_create.php" method="POST"><!-- create room section-->
        <!-- Create Room section-->
        <p><input type="text" name="Create_room" placeholder="Enter room name .. "></p>
        <button type="submit" name="Bcreate_r" class="button_login" >Create Room</button>

      </form>

      </div>



  </body>
</html>
