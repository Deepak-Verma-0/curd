<?php
include_once 'connection.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php
   
?>
        <table>
            <thead >
                <tr>
                <th class="col">Name</th>
                <th class="col">Date of Birth</th>
                <th class="col">Email</th>
                <th class="col">Phone number</th>
                <th class="col">Gender</th>
                <th class="col">Hobi</th>
                <th class="col">Photo</th>
                <th class="col">About</th>
                <th class="col">Password</th>
                <th class="col">Time</th>
                <th class="col">Action</th>
                </tr>
            </thead>
           

            <tbody>
                        <tr>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["dob"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["phone_number"]; ?></td>
                            <td><?php echo $row["gender"]; ?></td>
                            <td><?php echo $row["hobi"]; ?></td>
                            <td><img src="<?php echo 'uploads/' . trim($row['photo']) ?>" alt="Image" width="100" height="100"></td>
                            <td><?php echo $row["about"]; ?></td>
                            <td><?php echo $row["password"]; ?></td>
                            <td><?php echo  date('d-m-Y h:i:s',strtotime($row["submit_time"])); ?></td>
                         </tr>
            </tbody> 
</table> 
<?php
   
 ?>
</body>
</html>