<?php
  session_start();
  $uid = $_SESSION['u_id'];
  if(empty($uid)){
    header("Location: index.html");
    exit();
  }
  $room = $_SESSION['u_room'];
  echo $_SESSION['u_room'];
  echo $_SESSION['u_id'];
  echo $_SESSION['u_stat'];
  //$room = $_SESSION['u_room']; // room name
  //$status = $_SESSION['u_stat']; // user status
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="Bomoh_iT" content="K_Ryz">
    <title>CHAT</title>
    <link rel="stylesheet" href="./css/chatbox.css">

    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous">
    </script>

    <script>
      $(document).ready(function(){
          $("#output").load("get_output.php")
      });
    </script>
  </head>
  <body>
    <div class="bg-image"></div>
    <div class="bg-form">
    <!-- chat box -->
    <div id="output">
      <?php
        include 'db.php';
        // select from need to change it
        $sql = "SELECT * FROM $room";
        //$sql =  "SELECT * FROM $room";
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
              echo $row['uid']. " > ". $row['msg']. "<br>";
            }
          }
        }

       ?>

    </div>
    <!-- can be enable or disable -->
    <div id="admin">
      <!-- admin logo -->
      <?php
      $stat = $_SESSION['u_stat'];
      if($stat == "admin"){

      echo "<div class=\"admin_logo\">";
        echo "<p>ADMIN</p>";
      echo "</div>";

      //<!-- Selection Panel -->
      //<!-- Add Member -->
      echo "<div class=\"add_member\">";
        echo "<form action=\"process_add_member.php\" method=\"POST\">";
        echo "<p>Add Member</p>";
        echo "<p><input type=\"text\" name=\"add\" placeholder=\"Enter user id...\"></p>";
        echo "<p><button type=\"Submit\" name=\"submit-add\">+</button></p>";
        echo "</form>";
      echo "</div>";
      //<!-- Remove Member -->
      echo "<div class=\"remove_member\">";
        echo "<form action=\"process_remove_member.php\" method=\"POST\">";
        echo "<p>Remove Member</p>";
        echo "<p><input type=\"text\" name=\"remove\" placeholder=\"Enter user id...\"></p>";
        echo "<p><button type=\"Submit\" name=\"submit-remove\">+</button></p>";
        echo "</form>";
      echo "</div>";
      //<!-- Add Admin -->
      echo "<div class=\"add_admin\">";
        echo "<form action=\"process_add_admin.php\" method=\"POST\">";
        echo "<p>Add Admin</p>";
        echo "<p><input type=\"text\" name=\"addAdmin\" placeholder=\"Enter user id...\"></p>";
        echo "<p><button type=\"Submit\" name=\"submit-admin\">+</button></p>";
        echo "</form>";

      echo "</div>";

      echo "<div class=\"secondary\">";
        echo "<p><a href=\"main.php\"><button>MAIN</button></a>";
          echo "<a href=\"sign_out.php\"><button>SIGN OUT</button></a></p>";
      echo "</div> ";
    }
    else {
      echo "<div class=\"admin_logo\">";
        echo "<p>".$_SESSION['u_id']."</p>";
      echo "</div>";

      echo "<div class=\"secondary\">";
        echo "<p><a href=\"main.php\"><button>MAIN</button></a>";
          echo "<a href=\"sign_out.php\"><button>SIGN OUT</button></a></p>";
      echo "</div> ";
    }
      ?>
    </div>

    <!-- massenger -->
    <div class="input">
      <form class="" action="process_send.php" method="POST" enctype="multipart/form-data">
        <!-- Text area for input msg -->
        <input name="msg" placeholder="Type to send message...">
        <!-- Submit button to send the msg-->
        <button type="submit" name="submit" class="input_submit">SENT</button>
        <!-- upload file -->
        <label class="upload_file"><input type="file" name="file"></label>

      </form>
    </div>
  </div>

  </body>
</html>
