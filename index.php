<?php

    session_start();


    require_once "connection.php";
    if(isset($_POST['name']) && $_POST['date'] && $_POST['email'] && $_POST['number'] && $_POST["Gender"]  && $_POST['hobi'] && $_FILES['photo']['name'] && $_POST['about']){
        $name=$_POST['name'];
        $dob=$_POST['date'];
        $email=$_POST['email'];
        $phone_number=$_POST['number'];
        $gender=$_POST["Gender"] ;
        $hobi=isset($_POST['hobi']) ? implode(', ', $_POST['hobi']) : '';
        $photo=$_FILES['photo']['name'];
        $about=$_POST['about'];
        $sql="UPDATE form SET `Name`='$name', `Date of Birth`='$dob', `Email`='$email', `Phone number`='$phone_number', `Gender`='$gender', `Hobi`='$hobi, `Photo`='$photo, `About`='$about' WHERE id= ".$_GET["id"]; 
        
        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    
         if (isset($_SESSION['alert'])) {
            echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
            unset($_SESSION['alert']);
        }
   

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

        <script>
            <?php if (isset($_SESSION['alert'])):?> alert("<?php echo $_SESSION['alert']; ?>");
                <?php unset($_SESSION['alert']); ?>
            <?php endif; ?>
    </script>


    <style>
        .error {
            color: red;
        }

        p {
            font-size: 20px;
            color: yellow;
            font-weight: bold;
        }

        .p {
            font-size: 20px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center bg-dark">
        <form action="form.php" method="POST" enctype="multipart/form-data"
            class=" border border-2 border-danger m-5 p-3 w-3 w-50 shadow-sm p-3 mb-5 bg-secondary rounded">
            <p> Name: </p> <input type="text" class="name form-control" name="name" >
            <span class="error">
                <?php
                if (isset($_SESSION['error']['nameerror'])) {
                    echo $_SESSION['error']['nameerror'];
                } else {
                    echo '';
                }
                ?>
            </span><br>


            <p> Date of Birth: </p> <input type="date" class="date form-control" name="date" >
            <span class="error">
                <?php
                if (isset($_SESSION['derror']['dnerror'])) {
                    echo $_SESSION['derror']['dnerror'];
                } else {
                    echo '';
                }
                ?><br>


                <p> email:</p> <input type="email" class="email form-control" name="email" id="Email" ><span id="erremail" class="error"><?php
                if (isset($_SESSION['error']['erremail'])) {
                    echo $_SESSION['error']['erremail'];
                } else {
                    echo '';
                }
                ?>
                </span><br>


                <p>phone: </p> <input type="tel" class="number form-control" name="number" id="number" ><span class="error" id="errnumber"><?php
                if (isset($_SESSION['error']['errnumber'])) {
                    echo $_SESSION['error']['errnumber'];
                } else {
                    echo '';
                }
                ?></span><br>


                <p>Gender: </p> <input type="radio" class="mgender" id="mgender" name="Gender" value="male     <?php
                if (isset($_SESSION['values']['mgender'])) {
                    echo $_SESSION['values']['mgender'];
                } else {
                    echo '';
                }
                ?>"> <span class="p">Male</span> <span class="error" id="errmgender"><?php
                if (isset($_SESSION['error']['errmgender'])) {
                    echo $_SESSION['error']['errmgender'];
                } else {
                    echo '';
                }
                ?></span>


                <input type="radio" class="fgender" id="fgender" name="Gender" value="female value=" <?php
                if (isset($_SESSION['values']['fgender'])) {
                    echo $_SESSION['values']['fgender'];
                } else {
                    echo '';
                }
                ?>"> <span class="p">Female</span> <span class="error" id="errfgender"><?php
                if (isset($_SESSION['error']['errfgender'])) {
                    echo $_SESSION['error']['errfgender'];
                } else {
                    echo '';
                } ?> <br><br>






                    <p>Hobi:</p>
                    <input type="checkbox" class="hobi" name="hobi[]" id="hobi_cricket" value="cricket" <?php
                    if (isset($_SESSION['values']['hobi']) && in_array('cricket', explode(', ', $_SESSION['values']['hobi']))) {
                        echo 'checked';
                    }
                    ?>> <span class="p">Cricket</span>

                    <input type="checkbox" class="hobi" name="hobi[]" id="hobi_singing" value="singing" <?php
                    if (isset($_SESSION['values']['hobi']) && in_array('singing', explode(', ', $_SESSION['values']['hobi']))) {
                        echo 'checked';
                    }
                    ?>> <span class="p">Singing</span>

                    <input type="checkbox" class="hobi" name="hobi[]" id="hobi_watching" value="watching reels" <?php
                    if (isset($_SESSION['values']['hobi']) && in_array('watching reels', explode(', ', $_SESSION['values']['hobi']))) {
                        echo 'checked';
                    }
                    ?>> <span class="p">Watching Reels</span>

                    <br>
                    <span id="errhobi" class="error">
                        <?php
                        if (isset($_SESSION['error']['errhobi'])) {
                            echo $_SESSION['error']['errhobi'];
                        } else {
                            echo '';
                        }
                        ?>
                    </span><br><br>













                    <p>Photo:</p> <input type="file" class="photo" name="photo" id="photo"><span class="errphoto" value="<?php
                    if (isset($_SESSION['values']['photo'])) {
                        echo $_SESSION['values']['photo'];
                    } else {
                        echo '';
                    }
                    ?>"><span id="errphoto" class="error"><?php
                    if (isset($_SESSION['error']['errphoto'])) {
                        echo $_SESSION['error']['errphoto'];
                    } else {
                        echo '';
                    }
                    ?></span><br><br>


                        <p>About:</p>
                        <textarea cols="60" rows="2" class="about" name="about"></textarea><br><br>


                        <p>password:</p> <input type="password" class="password form-control" id="password"
                            name="password" ><span id="errpass" class="error"><?php
                            if (isset($_SESSION['error']['errpass'])) {
                                echo $_SESSION['error']['errpass'];
                            } else {
                                echo '';
                            }
                            ?></span><br>


                        <button type="submit" onclick="myFunction()" class="submit btn btn-primary" name="submit" value="
                    ">Submit</button>





        </form>
    </div>

   

</body>

</html>
<?php



if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}
if (isset($_SESSION['values'])) {
    unset($_SESSION['values']);
}
if (isset($_SESSION['derror'])) {
    unset($_SESSION['derror']);
}
?>