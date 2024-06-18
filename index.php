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
    <link rel="icon" type="png" href="Images/favicon.png">
    <title>Bit's Hardwares</title>
    <style> 

        @media screen and (max-width:  1900px) {  /* On screens that are  1900 wide or less, zoom out to 67 % */
            body {
            zoom : 67%;
            }
        }
    </style>

</head>


<body style="background-image:url(Images/Background.jpg) ; width: fit-content; margin:auto;">
    <h2 id="title"> <img src="Images/favicon.png" alt="Image of CPU" id="animation"> <Strong> Bit's Hardwares </Strong> </h2>

    <header>

        <nav id="nav">
            <ul>
                <li>
                    <a href="javascript:void(0)" > Home </a> 
                </li>

                <li>
                    <a href="Profile.php" > Profile </a> 
                </li>

                <li>
                    <div id="dropdown">
                        <a href="javascript:void(0)"> Search </a>
                            <div class="dropdown-content" id="tabl2">
                                <form action="Profile.php" id="Form2" name="Search1">
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

    <div id="main">
        <?php
            include 'config.php'; // importing config page, to use its properties

            $connect = OpenConnection(); // calling the function to connect to the database and storing its return value

            $query = "SELECT * FROM Category";

            $results = mysqli_query($connect, $query) or die("Unable to retrieve data!");// Execute query using specified connection 

            $results1 = mysqli_query($connect, $query) or die("Unable to retrieve data!");// Another query that stores the same result to be used by another while loop 

            echo "<table>";
           
            echo "<tr>"; // Creating the first row of the table

            /* 
            
                * What the following code does : 
                * While there are still records or rows in the array execute the inner loop 
                * In the inner loop execute the code in the if statements only three times and increments the $index variable to ensure of this
                * This is done to have one row of four items so that another code can be put together to output another row
            
            */

        
        
            $index = 0; 

            while ($records = mysqli_fetch_array($results)) {

                if ($index <= 3){

                    $id = $records["Category_id"]; // Using global variable Post to access data sent via Post method
                    $image = "Images" . "/" . $records["Category_Image"];
                    $name =  $records["Category_Name"];
                    $description = $records["Category_Description"];
                    $alt = $records["Alt"];
                    //$href = $records["href"];
                        
                    echo "<td>";
                    echo "<a href=\"ShowProducts.php?id=$id\" title=\"$description\" class=\"tool\">";
                    echo "<img src=\"$image\" alt=\"$alt\" width=\"450\" height=\"380\">";
                    echo "</a>";
                    echo "</td>";

                    $index = $index + 1;

                }

            }

            echo "</tr>"; // Creating the first row of the table


            echo "<tr>"; // Creating the second row of the table that will hold its four items 

            $count = 0 ; 
            while ($records = mysqli_fetch_array($results1)) {

                if ($count > 3) { // Thus only print this once $count is bigger than 3 which is an indication that the categories that we dont want to be reprinted have been traversed 
            
                    $id = $records["Category_id"]; // Using global variable Post to access data sent via Post method
                    $image = "Images" . "/" .$records["Category_Image"];
                    $name = $records["Category_Name"];
                    $description = $records["Category_Description"];
                    $alt = $records["Alt"];
                    //$href = $records["href"];

                    echo "<td>";
                    echo "<a href=\"ShowProducts.php?id=$id\" title=\"$description\" class=\"tool\">";
                    echo "<img src=\"$image\" alt=\"$alt\" width=\"450\" height=\"380\">";
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
 
    <footer style="background-image:url(Images/Background.jpg) ;">
        <h4 style="font-family:Serif; " > &copy;  Copyright <strong> Bit's Hardwares</strong> </h4>
        <p > <h5>All Rights Reserved </h5></p>
    </footer>
</body>
</html>