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
    <link rel="stylesheet" href="../CSS/About/About.css">
    <link rel="stylesheet" href="../CSS/Cart/Quantity.css">
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

    <header>

        <nav id="nav">
            <ul>
                <li>
                    <a href="index2.php" > Home </a> 
                </li>

                <li>
                    <div id="dropdown">
                        <a href="javascript:void(0)"> <b> <?php echo $_SESSION["User_Name"]; ?> </b> <img src="../Images/user.png" alt="Image of User"  class="Icons"> </a>
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
                    <a href="Cart.php"  > Your Cart <div id="quantity"> <?php echo $_SESSION['Quantity']; ?></div>   </a> 
                </li>

            </ul>
        </nav>

    </header>

    <div id="mains">
        <div id="about"  >

       
    
            <div class="OuterContainer" id="ticker2" >
            <div class="InnerContainer">
                    <div class="ticker">Our orginzation prides itself in helping</div>
                    <div class="ticker">our customers find their dream</div>
                    <div class="ticker">computer</div>
                    <div class="ticker">hardware</div>
            </div>
            </div>
    
            <div id="p"><img class="Slides"  id="EB" title="Etienne Banza" src="../Images/IMG-20220501-WA0002.jpg" width="350" height="380" ></div>
        
            <div id="Etienne" class="OuterEtienne"> 
            <div class="innerEtienne">
                <div><h3>Etienne</h3></div>
                <div>"The difference in the results that people produce comes down to what they've done differently from others in the same situations".</div>
                <div>The above quote according to Etienne is something he uses to remind himself of what needs to be done to get to where one desires.<br><br> Etienne is a Full time developer in this Organization and enjoys coming up with a variety of algorithms in an attempt to solve hardware-software based problems.</div>
            </div>
            </div>
        </div>


    </div>

 
    <footer style="background-image:url(../Images/Background.jpg) ;">
        <h4 style="font-family:Serif; " > &copy;  Copyright <strong> Bit's Hardwares</strong> </h4>
        <p > <h5>All Rights Reserved </h5></p>
    </footer>

    

</body>
</html>