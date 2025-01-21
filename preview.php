<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <style>
        .error{
            
            color:red;
        }
    </style> -->
</head>

<body>
    <div class="container-fluid">
        <table>
            <thead>
                <tr class="col">Id</tr>
                <tr class="col">Name</tr>
                <tr class="col">Date of Birth</tr>
                <tr class="col">Email</tr>
                <tr class="col">Phone number</tr>
                <tr class="col">Gender</tr>
                <tr class="col">Hobi</tr>
                <tr class="col">Photo</tr>
                <tr class="col">About</tr>
                
            </thead>
            <tbody>
                <?php
                require_once "connection.php";
                $sql_query = "SELECT * FROM form";
                if ($result = $conn->query($sql_query)) {
                    while ($row = $result->fetch_assoc()) {
                        $id=['id'];
                        $name = ['name'];
                        $dob = ['date'];
                        $email = ['email'];
                        $phone_number = ['number'];
                        $gender = ["Gender"];
                        $hobi = ['hobi'];
                        $photo = ['photo'];
                        $about = ['about'];
                         
                 ?> 
                    <tr>
                        <td><?php  $id; ?> </td>
                        <td><?php $name; ?></php></td>
                        <td><?php $dob ?></td>
                        <td><?php $email ?></td>
                        <td><?php $phone_number ?></td>
                        <td><?php $gender ?></td>
                        <td><?php $hobi ?></td>
                        <td><?php $photo ?></td>
                        <td><?php $about ?></td>
                        
                        <td>
                            <a href="updatedata.php?id=<?php echo $Id; ?>" class="btn   btn-primary">Edit</a>
                        </td>
                        <td>
                            <a href="deletedata.php?id=<?php echo $Id; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php 
                    }
                }
                if (!$result) {
                    die("Query failed: " . $conn->error);
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php

?>