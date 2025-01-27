<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <input type="text" id="num1" placeholder="Enter number 1">
    <input type="text" id="num2" placeholder="Enter number 2">
    <input type="text" id="num3" placeholder="Enter number 3">
    <button id="sub">Submit</button>

    <div id="result"></div> <!-- Optional: for displaying the result -->

    <script>
        $(document).ready(function(){
            $("#sub").click(function(){
                var ab = $("#num1").val();
                var ac = $("#num2").val();
                var abc = $("#num3").val();
                
                ab = parseFloat(ab);
                ac = parseFloat(ac);
                abc = parseFloat(abc);
                
                var aa = ab + ac + abc;  // Example operation: adding the numbers
                
                alert("The result is: " + aa);  // Display result in an alert
                // Or display it in a div:
                // $("#result").text("The result is: " + aa);
            });
        });
    </script>
</body>
</html>
