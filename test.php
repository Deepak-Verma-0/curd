<?php
include 'connection.php';

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

<?php





    // $update="UPDATE record SET name='$name', dob='$dob', email='$email', phone_number='$phone_number', gender='$gender', hobi='$hobi', photo='$photo', about='$about', password='$password' WHERE id='$id';"

?>






    <div class="container-fluid d-flex justify-content-center bg-dark">

     



        <form action="form.php" method="POST" enctype="multipart/form-data"
            class="border border-2 border-danger m-5 p-3 w-3 w-50 shadow-sm p-3 mb-5 bg-secondary rounded">

            <p> Name: </p> <input type="text" class="name form-control" name="name"
                value="<?php echo $name ?>">

            <br>


            <p> Date of Birth: </p> <input type="date" class="date form-control" name="date"    value="<?php echo $dob ?>">
            <br>


                <p> email:</p> <input type="email" class="email form-control" name="email" id="Email" value="<?php echo $email ?>>
                <br>


                <p>phone: </p> <input type="tel" class="number form-control" name="number" id="number" value="<?php echo $phone_number ?>><br>


                <p>Gender: </p> <input type="radio" class="mgender" id="mgender" name="Gender" value="male" value="<?php echo $gender ?>> <span
                    class="p">Male</span> <span class="error" id="errmgender"></span>


                <input type="radio" class="fgender" id="fgender" name="Gender" value="female" value="<?php echo $gender ?>>  <br><br>



                    <p>Hobi:</p>
                    <div>
                        <label><input type="checkbox" name="hobi[]" value="Reading" !important> Reading</label>
                        <label><input type="checkbox" name="hobi[]" value="Traveling"> Traveling</label>
                        <label><input type="checkbox" name="hobi[]" value="Gaming"> Gaming</label><br><br><br>

                    </div>



                    <p>Photo:</p> <input type="file" class="photo" name="photo" id="photo"><span class="errphoto"><span
                            id="errphoto" class="error">
                           <br><br>


                        <p>About:</p>
                        <textarea cols="60" rows="2" class="about" name="about"></textarea><br><br>


                        <p>password:</p> <input type="password" class="password form-control" id="password"
                            name="password"><br>


                        <button type="submit"  class="submit btn btn-primary" name="update"
                            value=" update" id="show">Update</button>

                        <button type="" class="submit btn btn-primary" name="" value=" "><a href="preview.php" style="color:aliceblue; text-decoration:none"> View Record</a> </button>

                        


        </form>
    </div>
<?php



?>
</body>

</html>

