<?php
include 'connection.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td{
            border: 1px solid black;
           
        }
        .col{
            border: 1px solid blue;
            background-color: wheat;
            
        }
        table,th,td{
            border-collapse: collapse;
            
        }
        
        .alert {
            padding: 20px;
            background-color: #f44336;
            
            color: white;
            margin-bottom: 15px;
            position: fixed;
            top: 0;
           
            left: 33%;
            right: 18%;
            }

       
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        
        .closebtn:hover {
            color: black;
        }
       
    </style>
</head>

<body>
<?php 
        $per_page_record = 10;       
        if (isset($_GET["page"])) {    
            $page  = $_GET["page"];    
        }    
        else {    
          $page=1;    
        }    
    
        $start_from = ($page-1) * $per_page_record;     
    
        $query = "SELECT * FROM record ORDER BY `submit_time` DESC LIMIT $start_from, $per_page_record";     
        $rs_result = mysqli_query ($conn, $query);   
        
        

        
        
?>    



    <div class="container-fluid">
        <?php

        $query = "SELECT * FROM `record`;";

       
        $result = $conn->query($query);

        
       
        ?>
        <table>
            <thead >
                <tr>
                <th class="col">Sr. No.</th>
                <th class="col">Id</th>
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
            
          
                <?php
                $i=1;
                while ($row = mysqli_fetch_array($rs_result)) {    
                    if ($result->num_rows > 0) {
                    
                        // print_r($row['Photo']);die;
                       
                        ?>
                        <tr>
                            
                            <th class="col">
                                <?php
                                echo $i;

                                  
                                ?>
                            </th>
                            <td style="font-weight:bold"><?php echo $row["id"]; ?> </td>
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
                            

                        
                            <td style="text-align:center; position:relative;">

                                <p><button type="button">
                                <a href="test.php?id=<?php echo $row['id']; ?>  ">Edit</button></p>

                                <button type="button">
                                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>

                                </button>
                            </td>
                          

                        </tr>
                        <?php
                    
                    } else {
                    echo "0 result";
                    }
               $i++;
                }    
                ?>
                
            </tbody>
         
        </table>
        <?php  
        $query = "SELECT COUNT(*) FROM record";     
        $rs_result = mysqli_query($conn, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
        echo "</br>";     
        
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='preview.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='preview.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='preview.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='preview.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
    </div>  
  
  
            <div class="inline">   
            <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   
             placeholder="<?php echo $page."/".$total_pages; ?>" required>   
            <button onClick="go2Page();">Go</button>   
            </div>    
        </div>   
    </div>
        




    <div>
   
    <div class="alert" id="show">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          orm submitted successfully.
        </div>
    </div>

 



    <script>   
    function go2Page()   
    {   
        var page = document.getElementById("page").value;   
        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
        window.location.href = 'preview.php?page='+page;   
    }   
  </script>  
</body>
<?php
 mysqli_close($conn);
?>
</html>