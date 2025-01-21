<?php
session_start();
include 'connection.php';
$flag=false;
//  print_r($_POST);die;

    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $dob=$_POST['date'];
        $email=$_POST['email'];
        $phone_number=$_POST['number'];
        $gender=$_POST["Gender"] ;
        $hobi=isset($_POST['hobi']) ? implode(', ', $_POST['hobi']) : '';
        $photo=$_FILES['photo']['name'];
        $about=$_POST['about'];
        $password=$_POST['password'];
        $time=date("Y-m-d h:i:sa");
        
     

        if(empty($name)){
            $_SESSION['error']['nameerror']="Enter name";
            $flag=true;
        }else if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
            $_SESSION['error']['nameerror']="enter Valid name";
            $flag=true;
        }else{
            $_SESSION["values"]['name']=$name;
        }



        if(empty($dob)){
            $_SESSION['error']['phnerror']="Enter Dob";
            $flag=true;
        }

        if (empty($email)) {
            $_SESSION["error"]['erremail'] = "enter email";
            $flag=true;
          } else if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
            $_SESSION["error"]['erremail'] = "enter valid email";
            $flag=true;
          }else {
            $_SESSION["values"]['Email'] = $email;
          }
        


          if (empty($phone_number)) {
            $_SESSION["error"]['errnumber'] = "enter phone";
            $flag=true;
          } else if (!preg_match('/^[0-9]{10}+$/', $phone_number)) {
            $_SESSION["error"]['errnumber'] = 'enter valid phone';
            $flag=true;
          }else {
            $_SESSION["values"]['number'] = $phone_number;
          }



          if (empty($gender)) {
            $_SESSION["error"]['errmgender'] = "<br> chose gender";
            $flag=true;
          } else {
            $_SESSION["values"]['mgender'] = $gender;
          }

          if (isset($_SESSION['error']['errhobi'])) {
            echo $_SESSION['error']['errhobi'];
          } else {
            echo '';
           }


          if (empty($gender)) {
            $_SESSION["error"]['errfgender'] = "<br>  chose gender";
            $flag=true;
          } else {
            $_SESSION["values"]['fgender'] = $gender;
          }






          if (empty($photo)) {
            $_SESSION["error"]['errphoto'] = "Choose an image.";
            $flag=true;
        } else if ($_FILES["photo"]["size"] > 5000000) {
            $_SESSION["error"]['errphoto'] = "File size is too large.";
            $flag=true;
        }
        
        $fileExtension = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, ['jpg', 'png', 'jpeg', 'gif'])) {
            $_SESSION["error"]['errphoto'] = "Only JPG, PNG, JPEG, and GIF files are allowed.";
            $flag=true;
        } else {
            $_SESSION["values"]['photo'] = $photo;
        }
        





          if (empty($password)) {
            $_SESSION["error"]['errpass'] = "enter password";
            $flag=true;
          } else if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
            $_SESSION["error"]['errpass'] = 'enter valid password';
            $flag=true;
          }else {
            $_SESSION["values"]['password'] = $password;
          }



          
          




                  
        $sql="INSERT INTO record (`Name`, `Date of Birth`, `Email`, `Phone number`, `Gender`, `Hobi`, `Photo`, `About`, `Password`, `Submit Time`) VALUES ('$name','$dob','$email','$phone_number','$gender','$Hobi','$photo','$about','$password','$time')";

    
        if (isset($flag) && $flag) {
          if (!empty($_SESSION['error'])) {
              $_SESSION['alert'] = implode("\n", $_SESSION['error']); 
              $flag = true;
          } else {
              $_SESSION['alert'] = "Form submitted successfully!";
              header('location: preview.php'); 
              exit();
          }
      }
      


        



// print_r($sql);die;

        if(isset($_FILES["photo"]["name"])){
             $target_dir = "C:/wamp64/www/Deepak Verma project/New folder/";
            $target_file = $target_dir . basename( $photo);
               
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $uploadOk = 1;
    
            if ($uploadOk == 0) {
             echo "Sorry, your file was not uploaded.";
                  // if everything is ok, try to upload file
            } else {
             if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
            } else {
                 echo "Sorry, there was an error uploading your file.";
            }
        }}



        if (mysqli_query($conn, $sql)) {
            echo "Data stored in the database successfully.";
            
        } else {
            echo "Error storing data: " . mysqli_error($conn); 
        }
        

        






        mysqli_close($conn);


        

        header('location:index.php'); 
        exit();

        

        
        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }if(isset($_SESSION['values'])){
            unset($_SESSION['values']);
        } if(isset($_SESSION['derror'])){
            unset($_SESSION['derror']);
      }
   
    }
    
    
   
?>