<?php
require 'database.php';
require 'login.php';
include 'submitpfp.php';
shell_exec("submitpfp.php");

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}



 
// SQL query to select data from database
$sql = " SELECT * FROM user ORDER BY score DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
$query = "SELECT * FROM user"
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechGym</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="http://localhost/TechGym/css/custom.css?<?=time()?>" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
        <script src="http://localhost/TechGym/js/validation.js" defer></script>
        
         <style>
        
                #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #8b0000;
        color: white;
        }
 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
        
</head>
<body class="darkgrey">
        <!-- Adjust behaviour of "#" links -->
        <script>
            // Adjust scroll position when a navigation link is clicked
            document.addEventListener("DOMContentLoaded", function () {
                var navLinks = document.querySelectorAll(".navbar a");

                // Iterate over each navigation link and attach a click event listener
                navLinks.forEach(function (link) {
                    link.addEventListener("click", function (event) {
                        // Get the target element ID from the link's href attribute
                        var targetId = link.getAttribute("href");

                        // Check if the target element ID starts with "#"
                        if (targetId && targetId.startsWith("#")) {
                            event.preventDefault(); // Prevent the default link behavior

                            // Get the target page from the data-page attribute
                            var targetPage = link.getAttribute("data-page");

                            // Check if the target page is null or empty
                            if (targetPage === null || targetPage.trim() === "") {
                                // Scroll to the target element without redirecting or delay
                                scrollToElement(targetId);
                            } else if (targetPage === window.location.pathname) {
                                // Check if the target page is index.php
                                if (targetPage === "index.php") {
                                    // Scroll to the target element with a small delay
                                    setTimeout(function () {
                                        scrollToElement(targetId);
                                    }, 500); // Adjust the delay time as needed
                                } else {
                                    // Scroll to the target element without redirecting or delay
                                    scrollToElement(targetId);
                                }
                            } else {
                                // Redirect to the target page and store the target element ID
                                scrollToTargetElement(targetId, targetPage);
                            }
                        }
                    });
                });
            });

            // Function to scroll to the target element
            function scrollToElement(targetId) {
                var targetElement = document.querySelector(targetId);
                if (targetElement) {
                    // Set the custom scroll position adjustment (in pixels)
                    var customScrollAdjustment = 78; // Modify this value as needed

                    // Calculate the adjusted scroll position with the custom adjustment
                    var scrollPosition = targetElement.offsetTop - customScrollAdjustment;

                    // Scroll to the target element with the adjusted scroll position
                    window.scrollTo({
                        top: scrollPosition,
                        behavior: "smooth", // Optionally, use smooth scrolling behavior
                    });
                }
            }

            // Function to scroll to the target element after redirecting
            function scrollToTargetElement(targetId, targetPage) {
                // Store the target element ID in session storage
                sessionStorage.setItem("scrollTarget", targetId);

                // Redirect the user to the target page
                window.location.href = targetPage;
            }

            // After the page loads, check if there is a stored target element ID in session storage
            window.addEventListener("load", function () {
                var scrollTarget = sessionStorage.getItem("scrollTarget");
                if (scrollTarget) {
                    // Clear the stored target element ID from session storage
                    sessionStorage.removeItem("scrollTarget");

                    // Scroll to the target element with a small delay
                    setTimeout(function () {
                        scrollToElement(scrollTarget);
                    }, 500); // Adjust the delay time as needed
                }
            });
        </script>

        <!-- Dynamically adjusting contents below the Navbar -->
        <script>
            let resizeTimer;

            // Adjusts .content padding-top based on Navbar height
            function adjustContentPadding() {
                const navbarHeight = document.querySelector(".navbar").offsetHeight;
                document.querySelector(".content").style.paddingTop = navbarHeight + "px";
            }

            // On load
            window.addEventListener("load", adjustContentPadding);

            // When window resizes
            window.addEventListener("resize", () => {
                clearTimeout(resizeTimer);
                adjustContentPadding();

                // Continue function after resizing stopped
                resizeTimer = setTimeout(() => {
                    adjustContentPadding();
                    resizeTimer = null;
                }, 300); // ~for how long
            });
        </script>

        <!-- Dropdown fade -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var dropdowns = document.querySelectorAll(".dropdown");

                dropdowns.forEach(function (dropdown) {
                    var dropdownContent = dropdown.querySelector(".dropdown-content");
                    var timeoutId;

                    dropdown.addEventListener("mouseenter", function () {
                        clearTimeout(timeoutId);
                        dropdownContent.style.opacity = "1";
                        dropdownContent.style.visibility = "visible";
                    });

                    dropdown.addEventListener("mouseleave", function () {
                        timeoutId = setTimeout(function () {
                            dropdownContent.style.opacity = "0";
                            dropdownContent.style.visibility = "hidden";
                        }, 200);
                    });
                });
            });
        </script>

<!-- Log in modal -->
<div id="login-modal" class="modal">
          <div class="modal-content section w3-card-4">
      
            <br>
              <form action="login.php" method="post" id="log-in" novalidate>

                <div class="inputdiv">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="inputdiv">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>

                <button type="submit" name="log-in" value="Log in" class="fa-solid fa-right-to-bracket profilesave fa-2xl savemodal"></button>
                
            </form>
            <span id="login-modal-close-button" class="modal-close-button">&times;</span>
            <br><br>

            <div class="w3-display-container" style="margin-top: 60px;">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                        <h2 class="sectiontitle"> Log in </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register modal -->
        <div id="register-modal" class="modal">
          <div class="modal-content section w3-card-4">
            <br>
            <form action="process-signup.php" method="post" id="signup" novalidate>

            <div class="inputdiv">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="inputdiv">
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname">
            </div>

            <div class="inputdiv">
                <label for="username">Username: *</label>
                <input type="text" id="username" name="username">
            </div>

            <div class="inputdiv">
                <label for="email">Email: *</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="inputdiv">
                <label for="password">Password: *</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="inputdiv">
                <label for="confirm_password">Confirm Password: *</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>

            <button type="submit" name="register" value="Register" class="fa-solid fa-user-plus profilesave fa-2xl savemodal"></button>
          </form>
          <span id="register-modal-close-button" class="modal-close-button">&times;</span>
          <br><br>
            <div class="w3-display-container" style="margin-top: 60px;">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                        <h2 class="sectiontitle"> Register </h2>
                    </div>
                 </div>
            </div>
        </div>
        
        <!-- Edit modal -->
        <div id="edit-modal" class="modal">
        <div class="modal-content section w3-card-4">
          <form class="form" id = "form" action="" enctype="multipart/form-data" method="post"><br><br>
          <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
          <div class="upload">
              <img src="img/<?php echo $user['image']; ?>" id = "image">

              <div class="rightRound" id = "upload">
              <input type="file" name="fileImg" id = "fileImg" accept=".jpg, .jpeg, .png">
              <i class = "fa fa-camera"></i>
              </div>

              <div class="leftRound" id = "cancel" style = "display: none;">
              <i class = "fa fa-times"></i>
              </div>

              <div class="rightRound" id = "confirm" style = "display: none;">
              <input type="submit">
              <i class = "fa fa-check"></i>
              </div>
          </div>
          </form>
          <br>
          <form action="process-update-account.php" method="post" id="update-profile" novalidate="novalidate">
              <div class="inputdiv">
                  <label for="name">Name:</label>
                  <input type="text" name="name" id="name" placeholder="<?php echo $user['name']; ?>">
              </div>


              <div class="inputdiv">
                  <label for="surname">Surname:</label>
                  <input type="text" name="surname" id="surname" placeholder="<?php echo $user['surname']; ?>">
              </div>


              <div class="inputdiv">
                  <label for="username">Username:</label>
                  <input type="text" name="username" id="username" placeholder="<?php echo $user['username']; ?>">
              </div>

              <button type="submit" name="updateProfile" value="Save" class="fa-solid fa-floppy-disk profilesave fa-2xl savemodal"></button>
          </form>
          <br><hr><br>
          
          <form action="process-update-email.php" method="post" id="update-email" novalidate="novalidate">
              <div class="inputdiv">
                  <label for="email">Email:</label>
                  <input type="email" name="email" id="email" placeholder="<?php echo $user['email']; ?>">
              </div>

              <div class="inputdiv">
                  <label for="confirm_email">Confirm email:</label>
                  <input type="email" name="confirm_email" id="confirm_email" placeholder="">
              </div>

              <button type="submit" name="updateEmail" value="Save" class="fa-solid fa-floppy-disk profilesave fa-2xl savemodal"></button>
          </form>
          <br><hr><br>

          <form action="process-update-password.php" method="post" id="update-password" novalidate="novalidate">
              <div class="inputdiv">
                  <label for="password">Password:</label>
                  <input type="password" name="password" id="password" placeholder="">
              </div>

              <div class="inputdiv">
                  <label for="confirm_password">Confirm password:</label>
                  <input type="password" name="confirm_password" id="confirm_password" placeholder="">
              </div>

              <button type="submit" name="updatePassword" value="Save" class="fa-solid fa-floppy-disk profilesave fa-2xl savemodal"></button>
          </form>
          <span id="edit-modal-close-button" class="modal-close-button">&times;</span>
          <br><br>

          <div class="w3-display-container" style="margin-top: 60px;">
                        <div class="w3-display-bottomleft w3-container w3-text-black">
                    <h2 class="sectiontitle"> Settings </h2>
                </div>
            </div>

          </div>
        </div>

        <!-- Navbar -->
        <ul class="navbar">
            <li class="dropdown">
                <a href="#index" data-page="" class="dropbtn active"><i class="fa fa-fw fa-home"></i> Home</a>
                <div class="dropdown-content" data-dropdown="home">
                    <div>
                        <a href="index.php#equipment" data-page=""><i class="fa-solid fa-dumbbell"></i> Equipment</a>
                    </div>
                    <div>
                        <a href="vezbe.php" data-page=""><i class="fa-solid fa-dumbbell"></i> Exercises</a>
                    </div>
                    <div>
                        <a href="#trainers" data-page=""><i class="fa-solid fa-users"></i> Trainers</a>
                    </div>
                    <div>
                        <a href="#location" data-page=""><i class="fa-solid fa-location-dot"></i> Location</a>
                    </div>
                    <div>
                        <a href="#aboutus" data-page=""><i class="fa-solid fa-circle-info"></i> About us</a>
                    </div>
                </div>
            </li>

            <li>
                <a href="profili.php"><i class="fa-solid fa-users"></i> Profiles</a>
            </li>

            <?php if (isset($user)): ?>
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fa-solid fa-user"></i>
                    <?php echo $user['username']; ?>
                </a>
                <div class="dropdown-content">
                    <div>
                        <a href="profile.php"><i class="fa-solid fa-user-pen"></i> Profile</a>
                    </div>
                    <div>
                        <a href="#" id="edit-btn"><i class="fa-solid fa-user-gear"></i> Settings</a>
                    </div>
                </div>
            </li>

            <li>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log out</a>
            </li>
            <?php else: ?>
            <li class="dropdown">
                <a href="#" class="dropbtn" data-dropdown-button="nouser"><i class="fa-solid fa-user"></i></a>
                <div class="dropdown-content" data-dropdown="nouser">
                    <div>
                        <a href="#" id="login-btn"><i class="fa-solid fa-right-to-bracket"></i> Log in</a>
                    </div>
                    <div>
                        <a href="#" id="register-btn"><i class="fa-solid fa-user-plus"></i> Register</a>
                    </div>
                </div>
            </li>
            <?php endif; ?>
        </ul>

        <!-- Page Container -->
        <div class="w3-content darkgrey content" style="max-width: 1400px;" id="index">

            
            <br />

        <!-- LISTA KORISNIKA -->
        <h1> PROFILES: </h1>
        
        <section>
       
        <!-- TABLE CONSTRUCTION -->
        <table id="customers"> 
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            
        </tr>

        <?php
        // Database connection information
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'login_db';

        // Create DB connection
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check DB connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from MySQL database
        $sql = "SELECT name, surname, email FROM user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data in HTML table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['surname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "No records found.";
        }

        // Close DB connection
        $conn->close();
        ?>
    </table>

    </section>
    
            <footer id="myFooter">
    <div class="w3-container w3-theme-l2 w3-padding-32">
      
    </div>

    <div class="w3-container w3-theme-l1">
    <footer class="w3-container backdarkred w3-center">
            <h5>Copyright &copy; FIMEK 2023; Projekt Tech Gym &trade;</h5>
        
    </div>
  </footer>
</body>
</html>