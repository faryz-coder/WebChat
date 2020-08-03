<?php
  // start session
  include 'db.php';

  //passing post variable
  $uid =  mysqli_real_escape_string($conn, $_POST['uid']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  // check if sign up button is pressed or not
  if (isset($_POST['sign_up']))
  {
    // check if form is empty
    if(empty($uid) || empty($pwd) || empty($email))
    {
      header("Location: sign_up.html?empty");
      exit();
    }
    //check if the email format is correct or not
    else {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: sign_up.html?email=wrong");
        exit();
      }
      // if the email is correct
      else {
        //check the id if it already taken or not
        $sql = "SELECT * FROM sign_up WHERE uid = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0)
        {
          header("Location: sign_up?user_id=taken");
          exit();
        }
        else {
          // proceed to registering the info into db
          $sql = "INSERT INTO sign_up (uid, pwd, email) VALUES ('$uid', '$pwd', '$email');";
          $result = mysqli_query($conn, $sql);

          // create new db for user list room
          $uid = "ur_".$uid;

          $sql = "CREATE TABLE $uid".'(
            no int(11) not null auto_increment primary key,
            room varchar(50)
          );';
          $result = mysqli_query($conn, $sql);

          // forward user to login page when success
          header("Location: index.html?sign_up=successful");
          exit();

        }
      }
    }
  }


 ?>
