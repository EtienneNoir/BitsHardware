<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Index/Navigation/nav&Title.css">
    <link rel="stylesheet" href="CSS/Index/TableMain.css">
    <link rel="stylesheet" href="CSS/Index/Footer.css">
    <link rel="stylesheet" href="CSS/Animation.css">
    <link rel="stylesheet" href="CSS/Laptops/Laptop.css">
    <link rel="stylesheet" href="CSS/Laptops/Backdrop.css">
    <link rel="icon" type="png" href="Images/favicon.png">
    <title>Document</title>
    <style> 

        @media screen and (max-width:  1900px) {  /* On screens that are  1900 wide or less, zoom out to 67 % */
            body {
            zoom : 67%;
            }
        }
    </style>
</head> <!-- The fit-content is to get rid of any overlap or extra spaces that body might allow, which as a result can allow the elements within the body to move around -->
<body style="background-image:url(Images/Background.jpg); width: fit-content; margin:auto"> <!-- Added the margin : Auto to keep the body and its content in the middle -->
    <h2 id="title"> <img src="Images/favicon.png" alt="Image of CPU" id="animation"> <Strong> Bit's Hardwares </Strong> </h2>

    <header> 

        <nav id="nav">
            <ul>

                <li>
                    <a href="javascript:void(0)" onclick="openSide()" > &#9776;Filter </a> 
                </li>


                <li>
                    <a href="index.php" > Home </a> 
                </li>

                <li>
                    <a href="Profile.php" > Profile </a> 
                </li>

                <li>
                    <div id="dropdown">
                        <a href="javascript:void(0)"> Search </a>
                            <div class="dropdown-content" id="tabl2">
                                <form action="Profile.php" id="Form2" name="Search1" >
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
                    <a href="Profile.php"  > Your cart </a> 
                </li>

                <li>
                    <a href="About.html" > About </a> 
                </li>

            </ul>
        </nav>

    </header>

    

    <div id="sideContent" >
        <ul><a id="a" class="f" href="javascript:void(0)" onclick="closeSide()" ><img src="Images/close.png" alt="Image of Close Sign" class="animationClose" width="100" height="100"> </a><br><br><br><br><br><br>
            <a id="a" href="ShowProducts.php?id=8"> <img src="Images/Ram1.png"  class="animationClose" alt="Image of Ram" width="100" height="100"> </a><br><br><br>
            <a id="a" href="ShowProducts.php?id=3"> <img src="Images/Towers1.png"  class="animationClose" alt="Image of a Tower" width="100" height="100"> </a><br><br><br>
            <a id="a" href="ShowProducts.php?id=5"> <img src="Images/Periph1.png"  class="animationClose" alt="Peripherals" width="100" height="100">  </a><br><br><br><br><br>
            <a id="a" href="ShowProducts.php?id=4"> <img src="Images/Speaker1.png"  class="animationClose" alt="Image of a Speaker" width="100" height="100"> </a><br><br><br>
            <a id="a" href="ShowProducts.php?id=7"> <img src="Images/GPU1.png"  class="animationClose" alt="Image of a GPU" width="100" height="100"> </a><br><br><br><br>
            <a id="a" href="ShowProducts.php?id=6"> <img src="Images/Monitor1.png"  class="animationClose" alt="Image of a Monitors" width="100" height="100"></a><br><br><br>
            <a id="a" href="ShowProducts.php?id=2"> <img src="Images/CPU1.png"  class="animationClose" alt="Image of CPU" width="100" height="100"> </a>
        </ul>
    </div>

    <div id="main">
        <?php
            include 'config.php'; // importing config page, to use its properties

            $connect = OpenConnection(); // calling the function to connect to the database and storing its return value


            $id = $_REQUEST['id'];//  taking the value referenced by id which is found in the url segment

            $query = "SELECT * FROM Products WHERE Category_id = '$id'"; // Retrieving all the product based on the selected category which is an image on the front page    

            $results = mysqli_query($connect, $query) or die("Unable to retrieve data!");// Execute query using specified connection);

            $results1 = mysqli_query($connect, $query) or die("Unable to retrieve data!");// Another query that stores the same result to be used by another while loop 


            echo "<table>";
           
            echo "<tr>"; // Creating the first row of the table

            /* 
            
                * What the following code does : 
                * While there are still records or rows in the array execute the inner loop 
                * In the inner loop execute the code in the if statements only three times and increments the $index variable to ensure of this
                * This is done to have one row of four items so that another code can be put together to output another row
            
            */

        
            echo "<table>";
           
            echo "<tr>"; // Creating the first row of the table
            $index = 0; 

            while ($records = mysqli_fetch_array($results)) {

                if ($index <= 2){
                    $id = $records["Product_id"]; // Using global variable Post to access data sent via Post method
                    $image = $records["Product_Image"];
                    $name =  $records["Product_Name"];
                    $description = $records["Product_Description"];
                    $price = $records['Product_Price'];
                    $alt = $records["alt"];
                 

                        
                    echo "<td>";
                    echo "<a >";
                    echo "<img src=\"$image\" alt=\"$alt\" width=\"450\" height=\"380\" onclick=\"myFunction('$image' , '$price' , '$description')\">";
                    echo "</a>";
                    echo "</td>";

                    $index = $index + 1;

                }

            }

            echo "</tr>"; // Creating the first row of the table

            echo "<tr>"; // Creating the second row of the table that will hold its four items 

            $count = 0 ; 
            while ($records = mysqli_fetch_array($results1)) {

                if ($count > 2) { // Thus only print this once $count is bigger than 3 which is an indication that the categories that we dont want to be reprinted have been traversed 
            
                    $names = $records["Product_id"]; // Using global variable Post to access data sent via Post method
                    $image = $records["Product_Image"];
                    $name =  $records["Product_Name"];
                    $description = $records["Product_Description"];
                    $price = $records['Product_Price'];
                    $alt = $records["alt"];
               

                        
                    echo "<td>";
                    echo "<a >";
                    echo "<img src=\"$image\" alt=\"$alt\" width=\"450\" height=\"380\" onclick=\"myFunction('$image' , '$price' , '$description')\">";
                    echo "</a>";
                    echo "</td>";

                }
                
                $count = $count + 1; // Everytime we don't execute the code in the if statement this is incremented to make sure we eventually print out everything
            }

            echo "</tr>";
            
            echo "</table>";

            CloseConnection($connect); // Closing the connection 

        ?>
    </div>

    <!--  The following are the elements that will only be visible once a product is selected or clicked -->

    <div id="popMessage"> 

        <div id="close"> x </div> 
        
        <div id="image"> 

            <img id="images" src="" alt=""  width="450" height="380"/>

        </div>


        <div id="content">

            <h3 id="h3"> </h3> 

            <h4> Key Features: </h4>
            <p id="about">

            </p>

           
            <h4 id="price">  </h4>

        </div>


        <div>
            
            <button id="btn" onclick="checkLogin()"> Add Item to Cart </button>  
        
        </div>


    </div>
    


    <div id="backdrop" > </div> <!-- // The element that will blur out the background -->

    <!--  -->
    <footer style="background-image:url(Images/Background.jpg) ;">
        <h4 style="font-family:Serif; " > &copy;  Copyright <strong> Bit's Hardwares</strong> </h4>
        <p > <h5>All Rights Reserved </h5></p>
    </footer>

    <script type="text/javascript" src="JavaScript/ShowProduct/ShowProduct.js"> </script>

</body>
</html>

