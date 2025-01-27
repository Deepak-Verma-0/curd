<?php

session_start();


require_once "connection.php";

$flag=false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $flag = true; 
}



if (isset($_POST['id']) && $_POST['name'] && $_POST['date'] && $_POST['email'] && $_POST['number'] && $_POST["Gender"] && $_POST['hobi'] && $_FILES['photo']['name'] && $_POST['about']) {

    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $dob = $_POST['date'];
    $email = $_POST['email'];
    $phone_number = $_POST['number'];
    $gender = $_POST["Gender"];
    $hobi = isset($_POST['hobi']) ? implode(', ', $_POST['hobi']) : '';
    $photo = $_FILES['photo']['name'];
    $about = $_POST['about'];
    $sql = "UPDATE form SET `Name`='$name', `Date of Birth`='$dob', `Email`='$email', `Phone number`='$phone_number', `Gender`='$gender', `Hobi`='$hobi', `Photo`='$photo', `About`='$about' WHERE id= " . $_GET["id"];

    if (mysqli_query($conn, $sql)) {
        header("location: index.php");
    } else {
        echo "Something went wrong. Please try again later.";
    }
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

        <?php
        require_once "connection.php";


        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = intval($_POST["id"]);


            $sql_query = "SELECT * FROM form WHERE id = ?";
            $stmt = $conn->prepare($sql_query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a record exists
            if ($result->num_rows > 0) {
                // Fetch the record data
                $row = $result->fetch_assoc();
                $id = $row['id'];
                $name = $row['name'];
                $dob = $row['date'];
                $email = $row['email'];
                $phone_number = $row['number'];
                $gender = $row['Gender'];
                $hobi = $row['hobi'];
                $photo = $row['photo'];
                $about = $row['about'];
            } else {
                echo "No record found.";
            }

            // Free result and close statement
            $result->free();
            $stmt->close();
        } else {
            echo "Invalid or missing ID.";
        }

        // Close the database connection
        $conn->close();
        ?>




        <form action="form.php" method="POST" enctype="multipart/form-data"
            class="border border-2 border-danger m-5 p-3 w-3 w-50 shadow-sm p-3 mb-5 bg-secondary rounded">

            <p> Name: </p> <input type="text" class="name form-control" name="name"
                value="<?php if (isset($_SESSION['values']['name'])) {
                    echo $_SESSION['values']['name'];
                } ?>">

            <span class="error">
                <?php
                if (isset($_SESSION['error']['nameerror'])) {
                    echo $_SESSION['error']['nameerror'];
                } else {
                    echo '';
                }
                ?>
            </span><br>


            <p> Date of Birth: </p> <input type="date" class="date form-control" name="date"
                value="<?php if (isset($_SESSION['values']['date'])) {
                    echo $_SESSION['values']['date'];
                } ?>">
            <span class="error">
                <?php
                if (isset($_SESSION['derror']['dnerror'])) {
                    echo $_SESSION['derror']['dnerror'];
                } else {
                    echo '';
                }
                ?><br>


                <p> email:</p> <input type="email" class="email form-control" name="email" id="Email"><span
                    id="erremail" class="error"><?php
                    if (isset($_SESSION['error']['erremail'])) {
                        echo $_SESSION['error']['erremail'];
                    } else {
                        echo '';
                    }
                    ?>
                </span><br>


                <p>phone: </p> <input type="tel" class="number form-control" name="number" id="number"><span
                    class="error" id="errnumber"><?php
                    if (isset($_SESSION['error']['errnumber'])) {
                        echo $_SESSION['error']['errnumber'];
                    } else {
                        echo '';
                    }
                    ?></span><br>


                <p>Gender: </p> <input type="radio" class="mgender" id="mgender" name="Gender" value="male"> <span
                    class="p">Male</span> <span class="error" id="errmgender"><?php
                    if (isset($_SESSION['error']['errmgender'])) {
                        echo $_SESSION['error']['errmgender'];
                    } else {
                        echo '';
                    }
                    ?></span>


                <input type="radio" class="fgender" id="fgender" name="Gender" value="female"> <span
                    class="p">Female</span> <span class="error" id="errfgender"><?php
                    if (isset($_SESSION['error']['errfgender'])) {
                        echo $_SESSION['error']['errfgender'];
                    } else {
                        echo '';
                    } ?> <br><br>



                    <p>Hobi:</p>
                    <div>
                        <label><input type="checkbox" name="hobi[]" value="Reading" !important> Reading</label>
                        <label><input type="checkbox" name="hobi[]" value="Traveling"> Traveling</label>
                        <label><input type="checkbox" name="hobi[]" value="Gaming"> Gaming</label><br><br><br>

                    </div>



                    <p>Photo:</p> <input type="file" class="photo" name="photo" id="photo"><span class="errphoto"><span
                            id="errphoto" class="error"><?php
                            if (isset($_SESSION['error']['errphoto'])) {
                                echo $_SESSION['error']['errphoto'];
                            } else {
                                echo '';
                            }
                            ?></span><br><br>


                        <p>About:</p>
                        <textarea cols="60" rows="2" class="about" name="about"></textarea><br><br>


                        <p>password:</p> <input type="password" class="password form-control" id="password"
                            name="password"><span id="errpass" class="error"><?php
                            if (isset($_SESSION['error']['errpass'])) {
                                echo $_SESSION['error']['errpass'];
                            } else {
                                echo '';
                            }
                            ?></span><br>


                        <button type="submit"  class="submit btn btn-primary" name="submit"
                            value=" " id="show">Submit</button>

                        <button type="" class="submit btn btn-primary" name="" value=" "><a href="preview.php" style="color:aliceblue; text-decoration:none"> View Record</a> </button>

                        


        </form>
    </div>

    



    <!-- <script>
        function myfunction() {
            alert('Form submitted successfully.');
        }
    </script> -->


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