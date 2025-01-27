<?php
session_start();
include 'connection.php';

//  print_r($_POST);die;

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $dob = $_POST['date'];
  $email = $_POST['email'];
  $phone_number = $_POST['number'];
  $gender = $_POST["Gender"];
  $hobi = isset($_POST['hobi']) ? implode(', ', $_POST['hobi']) : '';
  $photo = $_FILES['photo']['name'];
  $about = $_POST['about'];
  $password = $_POST['password'];

  $time = date('Y-m-d H:i:s');
  






  $flag = false;

  if (empty($name)) {
    $_SESSION['error']['nameerror'] = "Enter name";
    $flag = true;
  } else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
    $_SESSION['error']['nameerror'] = "enter Valid name";
    $flag = true;
  }else{
    $_SESSION['values']['name']=$name;
  }



  if (empty($dob)) {
    $_SESSION['error']['phnerror'] = "Enter Dob";
    $flag = true;
  }$_SESSION['values']['date']=$dob;

  if (empty($email)) {
    $_SESSION["error"]['erremail'] = "enter email";
    $flag = true;
  } else if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
    $_SESSION["error"]['erremail'] = "enter valid email";
    $flag = true;
  }



  if (empty($phone_number)) {
    $_SESSION["error"]['errnumber'] = "enter phone";
    $flag = true;
  } else if (!preg_match('/^[0-9]{10}+$/', $phone_number)) {
    $_SESSION["error"]['errnumber'] = 'enter valid phone';
    $flag = true;
  }



  if (empty($gender)) {
    $_SESSION["error"]['errmgender'] = "<br> chose gender";
    $flag = true;
  }

  if (isset($_SESSION['error']['errhobi'])) {
    $_SESSION['error']['errhobi'] = 'enter valid phone';
  }


  
    if (!empty($_POST['hobi'])) {
        $hobbies = $_POST['hobi']; // This will be an array
        echo "You selected: " . implode(", ", $hobbies);
    } else {
        echo "Please select at least one hobby.";
    }


  if (empty($photo)) {
    $_SESSION["error"]['errphoto'] = "Choose an image.";
    $flag = true;
  } else if ($_FILES["photo"]["size"] > 5000000) {
    $_SESSION["error"]['errphoto'] = "File size is too large.";
    $flag = true;
  }

  $fileExtension = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
  if (!in_array($fileExtension, ['jpg', 'png', 'jpeg', 'gif'])) {
    $_SESSION["error"]['errphoto'] = "Only JPG, PNG, JPEG, and GIF files are allowed.";
    $flag = true;
  }



  if (empty($password)) {
    $_SESSION["error"]['errpass'] = "enter password";
    $flag = true;
  } else if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
    $_SESSION["error"]['errpass'] = 'enter valid password';
    $flag = true;
  }


  if ($flag === false) {
    if (isset($_FILES["photo"]["name"])) {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($photo);

      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $uploadOk = 1;

      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
          echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }
  
    $sql = "INSERT INTO record (`name`, `dob`, `email`, `phone_number`, `gender`, `hobi`, `photo`, `about`, `password`, `submit_time`) VALUES ('$name','$dob','$email','$phone_number','$gender','$hobi','$photo','$about','$password','$time')";
    // print_r($time);die;
    if (mysqli_query($conn, $sql)) {
      echo "Data stored in the database successfully.";
      header('location: preview.php');
      exit();
    }else{
      echo "data not store in database";
    } 

  } else {
    echo "Data stored in the database successfully.";
      header('location: index.php');
      exit();
  }


  mysqli_close($conn);

  if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
  }
  if (isset($_SESSION['values'])) {
    unset($_SESSION['values']);
  }
  if (isset($_SESSION['derror'])) {
    unset($_SESSION['derror']);
  }

}







?>