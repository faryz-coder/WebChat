<?php

  session_start();

  if(isset($_POST['login']))
  {
    // include database php
    include 'db.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //check if form are Empty
    if(empty($uid)||empty($pwd))
    {
      header("Location: index.html?login=empty");
      exit();
    }
    else
    {
      //check if the username and password match in the database
      $sql = "SELECT * FROM sign_up WHERE uid = '$uid' AND pwd ='$pwd'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);
      //if it does not return result then the login is unsuccessful
      if($resultCheck < 1)
      {
        header("Location: index.html?login=wrong_id_or_password");
        exit();
      }
      // else if it return a result then login success
      else
      {
        //  set session id to recognize the usage
        $_SESSION['u_id'] = $row['uid'];
        $_SESSION['p_wd'] = $row['pwd'];
        //forward user succesful login normal user main page
        header("Location: main.php");
        exit();
      }
    }
  }
  // if user does not press login then it will forward user to login page back
  else
  {
    header("Location: index.html?login=error");
    exit();
  }

 ?>
