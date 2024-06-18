<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Index/Navigation/nav&Title.css">
    <link rel="stylesheet" href="../CSS/Index/TableMain.css">
    <link rel="stylesheet" href="../CSS/Index/Footer.css">
    <link rel="stylesheet" href="../CSS/Animation.css">
    <link rel="icon" type="png" href="../Images/favicon.png">
    <link rel="stylesheet" href="../CSS/Cart/Cart.css">
    <title>Bit's Hardwares</title>
    <style> 

        @media screen and (max-width:  1900px) {  /* On screens that are  1900 wide or less, zoom out to 67 % */
            body {
            zoom : 67%;
            }
        }
    </style>

</head>


<body style="background-image:url(../Images/Background.jpg) ; margin:auto; width: fit-content;">
    <h2 id="title"> <img src="../Images/favicon.png" alt="Image of CPU" id="animation"> <Strong> Bit's Hardwares </Strong> </h2>

    <header id="headerCart">

        <nav id="nav">
            <ul>
                <li>
                    <a href="index2.php" > Home </a> 
                </li>

                <li>
                    <div id="dropdown">
                        <a href="javascript:void(0)"><b> <?php echo $_SESSION["User_Name"]; ?> </b> <img src="../Images/user.png" alt="Image of User"  class="Icons"> </a>
                            <div class="dropdown-content" id="table1">
                                <form action="" id="Form2">
                                    <table>
                                        <tr>
                                            <div id="Log" style="padding-bottom:10px;">
                                                <button class="glowEffect" > <a href="Edit.php" >Account Settings</a></button>
                                            </div>
                                       
                                            <div id="Log">
                                                <button class="glowEffect" ><a href="../index.php" >Log out</a></button>
                                            </div>
                                        </tr> 
                                    </table> 
                                </form>
                            </div>
                    </div>
                </li>


                <li>
                    <div id="dropdown">
                        <a href="javascript:void(0)"> Search </a>
                            <div class="dropdown-content" id="tabl2">
                                <form action="Search.php" id="Form2" name="Search1">
                                    <table>
                                        <tr>
                                            <td> <input type="text" id="in" placeholder="Search.." name="search" style="height: 45px; width: 210px; border-radius: 15px; text-align: center;"> </td>
                                            <td> <button type="submit" id="Se" class="glowEffect">&#128269;</button> </td>
                                        </tr> 
                                    </table> 
                                </form>
                            </div>
                    </div>
                </li>
                <li>
                    <a href="About.php" > About </a> 
                </li>

            
            </ul>
        </nav>

    </header>
  
    <?php

    echo "<div id=\"CartMain\">";
    $Customer_id = $_SESSION["id"];
    $email = $_SESSION["email"];
    $phone = $_SESSION["phone"];
    $address = $_SESSION["tel"];

    // Retrieve all the items stored in the Cart_Item table linked to the current user (Customer_id); 
    // Retrieve the Product_id and get its information like price, feature from the product table

    include '../config.php'; // importing config page, to use its properties
    

    $connect = OpenConnection(); // calling the function to connect to the database and storing its return value

    if(isset($_REQUEST['Cart'])){

        //Getting the total Price of the items in the cart 

        $priceQuery = "SELECT SUM(Price ) FROM Cart_Items WHERE Customer_id = '$Customer_id'"; // Getting the Total proce of all the items 


        $Price_Result = mysqli_query($connect,  $priceQuery) or die("Unable to connect to database!"); // Execute query 

        $Price_records = mysqli_fetch_array($Price_Result);

        $Price_Total = $Price_records['SUM(Price )'];

        $date = date("Y-m-d H:i:s");   // The current Date format acceptable in mysql, which is the time of the time zone or location that the server is in 

        $orderQuery = "INSERT INTO Orders(Customer_id, Date, Phone, Email, Address, Total_Price) VALUES ('$Customer_id','$date','$phone', '$email', '$address', '$Price_Total')";

        $orderResult = mysqli_query($connect, $orderQuery) or die("Unable to connect to database!"); // Execute query then return the result

        //To retrieve the order_id in order to link it to all the products purchased based on the customer id and the current date and time the items where bought:

        $retrieve = "SELECT Order_id FROM Orders WHERE Customer_id = '$Customer_id' and Date = '$date'";

        $retrieveResult = mysqli_query($connect, $retrieve) or die("Unable to connect to database!"); // Execute query then return the result

        $recordsid = mysqli_fetch_array($retrieveResult);

        $order_id =  $recordsid['Order_id']; // unqiue order id based on the customer id

        //Link the order to all the purchased items so that we can actually know what the customer ordered 

        $Item_Query = "SELECT * FROM Cart_Items WHERE Customer_id = '$Customer_id'";

        $Item_Result = mysqli_query($connect, $Item_Query) or die("Unable to connect to database!"); // Execute query then return the result


        while ($Item_records = mysqli_fetch_array($Item_Result)) {

            $P_ID = $Item_records['Product_id'];
            

            $details = "INSERT INTO Order_Records(`Order_id`, Product_id) VALUES ( $order_id,$P_ID )";

            $execute = mysqli_query($connect, $details) or die("Unable to connect to database!"); // Execute query then return the result

        }


         // Remove items in the cart as the items in the cart have been purchased

        $deItems = "DELETE FROM Cart_Items WHERE Customer_id = '$Customer_id'";

        $delResults = mysqli_query($connect, $deItems) or die("Unable to connect to database!"); // Execute query then return the result

        $_SESSION['Quantity'] = 0; // Indicating that all the items have been removed;

        CloseConnection($connect); // Closing the connection 
        
        header("Location: index2.php");  
    

    } else {
        if (isset($_REQUEST["remove"])) {

            $Item_id = $_REQUEST['id'];

            $delQuery = "DELETE FROM Cart_Items WHERE Cart_item_id = '$Item_id'";

            $delResult = mysqli_query($connect, $delQuery) or die("Unable to connect to database!"); // Execute query then return the result
    
            $store = $_SESSION['Quantity'] - 1; // To visually show that an item has been removed

            $_SESSION['Quantity'] = max($store, 0); // to make sure that the number never goes below zero 

            echo '<script>alert("Item has been Removed from cart")</script>';
        
            
        }
        $IdQuery = "SELECT * FROM Cart_Items WHERE Customer_id = '$Customer_id'";

        $idResult = mysqli_query($connect, $IdQuery) or die("Unable to connect to database!"); // Execute query then return the result


        $priceQuery = "SELECT SUM(Price ) FROM Cart_Items WHERE Customer_id = '$Customer_id'"; // Getting the Total proce of all the items 


        $Price_Result = mysqli_query($connect,  $priceQuery) or die("Unable to connect to database!"); // Execute query 

        $Price_records = mysqli_fetch_array($Price_Result);

        $Price_Total = $Price_records['SUM(Price )'];

        echo "<ul id=\"items\">";
        while ($recordsid = mysqli_fetch_array($idResult)) {

            $Product_id = $recordsid['Product_id'];

            $Cart_id = $recordsid['Cart_item_id'];

            $Product_Query = "SELECT * FROM Products WHERE Product_id = '$Product_id'";

            $Product_Result = mysqli_query($connect, $Product_Query) or die("Unable to connect to database!"); // Execute query then return the result
    
            $Product_Info = mysqli_fetch_array($Product_Result);

            $image = $Product_Info["Product_Image"];
            $about = $Product_Info["Product_Description"];
            $price = $Product_Info['Product_Price'];
            $name = $Product_Info['Product_Name'];

            echo "<li>";

            echo "<div id=\"Cart\">
            
            <div id=\"popMessage\"> 
                <form action=\"Cart.php?id=$Cart_id\" method=\"post\">
                    <input type=\"submit\" id=\"remove\" value=\"Remove Item\" name=\"remove\"> 
                    <input type=\"hidden\" name=\"P_id\" value=\"$name\" id=\"ids\">
                </form>
                
                <div id=\"image\"> 

                    <img id=\"images\" src=\"../$image\" alt=\"\"  width=\"450\" height=\"380\" title=\"$name\"/>

                </div>

                <div id=\"content\">

                    <h3 id=\"h3\"> </h3> 

                    <h4> Key Features: </h4>
                    <p id=\"about\">
                        $about
                    </p>

                    
                    <h4 id=\"price\"> R $price </h4>

                </div>

            </div>";

            echo "</li>";
        }
        echo "</ul><br>";

        echo "<form action=\"Cart.php\" method=\"post\" id=\"Purchase_form\" >
            <input type=\"submit\" value=\"Total Price: R $Price_Total\" title=\"Confirm Order\" id=\"buy\" name=\"Cart\">
            </form>";

        echo "</div><br>";



        CloseConnection($connect); // Closing the connection 
    
       
    }
       
    echo "<br><br>"
    
    ?>
 
    <footer style="background-image:url(../Images/Background.jpg) ;">
        <h4 style="font-family:Serif; " > &copy;  Copyright <strong> Bit's Hardwares</strong> </h4>
        <p > <h5>All Rights Reserved </h5></p>
    </footer>

    

</body>
</html>