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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>TechGym</title>
<meta charset="UTF-8">

        <link rel="stylesheet" href="http://localhost/TechGym/css/custom.css?<?=time()?>" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
        <script src="http://localhost/TechGym/js/validation.js" defer>
        </script>
        <style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}

p {
    color: red;
}
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
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

    



<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->

                </div>
                <div class="w3-card-4 w3-margin box section" id="aboutus">
                          <div class="w3-container" style="color: white;">
                          <img src="images/backmuscle.jpg" alt="" height=300 width=300 class="centralno">
                          <ul class="aboutuslist">
                            <li><p>Lat Pulldowns: Sit at a lat pulldown machine with a wide bar attached. Grip the bar with hands wider than shoulder-width apart, pull it down to your upper chest, then slowly release it back up.</p></li>
                            <li><p>Bent-Over Barbell Rows: Hold a barbell with a pronated grip, bend your knees slightly, hinge forward at the hips, and keep your back straight. Pull the bar up towards your lower chest, then lower it back down.</p></li>
                            <li><p>Seated Cable Rows: Sit on a cable row machine, grab the handles with palms facing each other, keep your back straight, and pull the handles towards your torso. Slowly extend your arms back to the starting position.</p></li>
                            <li><p>One-Arm Dumbbell Rows: Place one hand and knee on a bench, hold a dumbbell in the opposite hand, bring it to your chest while keeping your back parallel to the ground, then lower it back down.</p></li>
                            <li><p>Pull-ups: Hang from a bar with hands shoulder-width apart, palms facing away. Pull your body up until your chin is above the bar, then lower yourself back down.</p></li>
                            <li><p>T-Bar Rows: Place your chest against a cushioned pad, hold the handles with an overhand grip, and pull them towards your torso, squeezing your shoulder blades together. Return to the starting position.</p></li>
                            <li><p>Deadlifts: Stand with your feet shoulder-width apart, hinge at the hips while keeping your back straight, and grasp a weighted barbell. Lift the bar by extending your hips, then slowly lower it back down.</p></li>
                            <li><p>Barbell Shrugs: Stand with your feet shoulder-width apart, hold a barbell with an overhand grip, and shrug your shoulders towards your ears. Lower them back down in a controlled manner.</p></li>
                          </ul>
                        </div>

                        <div class="w3-display-container" style="margin-top: 60px;">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                              <h1 class="sectiontitle">Back</h1>
                            </div>

                        </div>
                    </div>

                </div>
                </section>
                <section>
    <div class="w3-card-4 w3-margin box section" id="aboutus">
                          <div class="w3-container" style="color: white;">
                          <img src="images/chestmuscle.jpg" alt="" height=300 width=300 class="centralno">
                          <ul class="aboutuslist">
                            <li><p>Chest Press Machine: Sit on the machine, grab the handles at chest height, and push forward until your arms are fully extended. Slowly return to the starting position.</p></li>
                            <li><p>Medicine Ball Push-ups: Place your hands on a medicine ball and assume a push-up position. Perform push-ups while maintaining stability on the ball.</p></li>
                            <li><p>Dips: Position your hands on parallel bars with arms straight. Slowly lower yourself until your elbows are at 90 degrees, then push back up.</p></li>
                            <li><p>Incline Dumbbell Bench Press: Lie on an incline bench at a 45-degree angle, holding dumbbells above your chest. Lower them to your shoulders, then press back up.</p></li>
                            <li><p>Cable Chest Press: Stand facing away from a cable machine, grab the handles at chest height, and step forward. Push your arms forward until your hands meet in front, then slowly return to the starting position.</p></li>
                            <li><p>Push-ups: Start in a plank position with hands slightly wider than shoulder-width apart. Lower your body until your chest hovers above the ground, then push back up.</p></li>
                            <li><p>Dumbbell Flyes: Lie on a bench holding dumbbells directly above your chest, with slightly bent elbows. Lower your arms outward in a wide arc until you feel a stretch, then bring them back up.</p></li>
                            <li><p>Barbell Bench Press: Lie flat on a bench, grasp the bar slightly wider than shoulder-width apart, lower it to your chest, and push it back up.</p></li>
                          </ul>
                        </div>

                        <div class="w3-display-container" style="margin-top: 60px;">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                              <h1 class="sectiontitle">Chest</h1>
                            </div>

                        </div>
                    </div>

                </div>
                </section>
                <section>
  <div class="w3-card-4 w3-margin box section" id="aboutus">
                          <div class="w3-container" style="color: white;">
                          <img src="images/biceps.jpg" alt="" height=300 width=300 class="centralno">
                          <ul class="aboutuslist">
                            <li><p>Hammer curls: Hold dumbbells in each hand with palms facing your body. Curl the weights towards your shoulders while keeping your palms facing each other throughout the movement.</p></li>
                            <li><p>Bicep curls: Stand with dumbbells in each hand, palms facing forward. Bend your elbows and curl the dumbbells towards your shoulders, then lower them back down slowly.</p></li>
                            <li><p>Incline curls: Sit on an incline bench with dumbbells in each hand. Start with your arms fully extended, then curl the weights towards your shoulders while keeping your elbows stationary.</p></li>
                            <li><p>Concentration curls: Sit on a bench with a dumbbell in one hand, resting your elbow against your inner thigh. Curl the weight up towards your shoulder while keeping your upper arm stationary.</p></li>
                            <li><p>Preacher curls: Sit at a preacher bench with your upper arms resting on the pad and hold a barbell with an underhand grip. Curl the weight up towards your shoulders, then slowly lower it back down.</p></li>
                            <li><p>Reverse curls: Stand with a barbell in front of you using an overhand grip, hands shoulder-width apart. Keeping your upper arms stationary, curl the barbell up towards your shoulders, then lower it back down.</p></li>
                            <li><p>Cable curls: Attach a handle on a cable machine at a low setting. Stand with one foot forward and one foot back, then curl the handle towards your shoulders while keeping your elbows stationary.</p></li>
                            <li><p>Zottman curls: Start with dumbbells in each hand, palms facing forward. Curl the weights towards your shoulders, then rotate your wrists so that your palms are facing downward and lower the weights.</p></li>
                          </ul>
                        </div>

                        <div class="w3-display-container" style="margin-top: 60px;">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                              <h1 class="sectiontitle">Biceps</h1>
                            </div>

                        </div>
                    </div>

                </div>
                </section>
                <section>
                <div class="w3-card-4 w3-margin box section" id="aboutus">
                          <div class="w3-container" style="color: white;">
                          <img src="images/tricepsmuscle.jpg" alt="" height=300 width=300 class="centralno">
                          <ul class="aboutuslist">
                            <li><p>Single-arm tricep pushdowns: Stand with your side facing a cable machine, grab the handle with one hand, and extend your arm down towards your side, keeping your upper arm stationary. Return to the starting position and switch sides.</p></li>
                            <li><p>Bench dips: Sit on the edge of a bench with your hands gripping the edge. Extend your legs forward and lower your body by bending your elbows until your upper arms are parallel to the ground, then push yourself back up.</p></li>
                            <li><p>Rope tricep extensions: Attach a rope to a cable machine at a high setting. Face away from the machine, grab the rope with both hands, and extend your arms forward. Slowly pull the rope down until your arms are fully extended, then return to the starting position.</p></li>
                            <li><p>Tricep kickbacks: Stand with a dumbbell in each hand, lean forward with your knees slightly bent, and lower your torso until it is almost parallel to the floor. Extend your arms fully backward, then return to the starting position.</p></li>
                            <li><p>Diamond push-ups: Get into a push-up position with your hands close together, forming a diamond shape with your thumbs and index fingers. Lower your body until your chest touches your hands, then push back up.</p></li>
                            <li><p>Skull crushers: Lie on a bench holding a barbell directly above your chest, palms facing forward. Lower the barbell towards your forehead by bending your elbows, then extend your arms back up.</p></li>
                            <li><p>Overhead tricep extension: Hold a dumbbell with both hands and lift it overhead, keeping your elbows close to your head. Slowly lower the weight behind your head, then lift it back up.</p></li>
                            <li><p>Tricep pushdowns: Attach a rope handle to a cable machine at a high setting. Stand facing the machine, grab the ropes with your palms facing each other, and push the ropes downwards until your arms are fully extended. Then return to the starting position.</p></li>
                          </ul>
                        </div>

                        <div class="w3-display-container" style="margin-top: 60px;">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                              <h1 class="sectiontitle">Triceps</h1>
                            </div>

                        </div>
                    </div>

                </div>
                </section>
                <section>
                <div class="w3-card-4 w3-margin box section" id="aboutus">
                          <div class="w3-container" style="color: white;">
                          <img src="images/legmuscle.jpg" alt="" height=300 width=300 class="centralno">
                          <ul class="aboutuslist">
                            <li><p>Squats: Stand with your feet hip-width apart, lower your body as if sitting back into an imaginary chair while keeping your chest lifted, and then return to the starting position by pushing through your heels.</p></li>
                            <li><p>Lunges: Stand with one foot in front of the other, take a step forward, and lower your body until both knees are at a 90-degree angle. Push through the heel of your front foot to return to the starting position, and repeat on the other side.</p></li>
                            <li><p>Deadlifts: Stand with your feet hip-width apart and a barbell in front of you. Hinge at your hips, lower your torso towards the ground, and grab the barbell with your hands shoulder-width apart. Lift the barbell by extending your hips and knees until you are standing tall, and then lower it back down to the starting position.</p></li>
                            <li><p>Calf Raises: Stand with your feet hip-width apart and place the balls of your feet on an elevated surface (like a step). Rise up onto your toes, pause for a moment, and then lower your heels back down below the surface of the step.</p></li>
                            <li><p>Bulgarian Split Squats: Stand facing away from a bench or step, place the top of your rear foot on the bench, and step forward with your other foot. Lower your body until your front thigh is parallel to the ground, and then push through the heel of your front foot to return to the starting position. Repeat on the other side.</p></li>
                            <li><p>Step-ups: Stand in front of a step or bench, place one foot on the surface, and push through that foot to lift your body up until your other leg is parallel to the ground. Lower back down and repeat with the other leg.</p></li>
                            <li><p>Leg Press: Sit on a leg press machine with your back pressed against the seat and your feet shoulder-width apart on the platform. Push the platform away from you by extending your legs until they are almost straight, then slowly return to the starting position.</p></li>
                            <li><p>Hamstring Curls: Lie face-down on a hamstring curl machine and position your heels under the padded lever. Bend your knees to curl your heels toward your glutes, then slowly release back to the starting position.</p></li>
                          </ul>
                        </div>

                        <div class="w3-display-container" style="margin-top: 60px;">
                            <div class="w3-display-bottomleft w3-container w3-text-black">
                              <h1 class="sectiontitle">Legs</h1>
                            </div>

                        </div>
                    </div>

                </div>
                </section>
  <footer id="myFooter">
    <div class="w3-container w3-theme-l2 w3-padding-32">
      
    </div>

    <div class="w3-container w3-theme-l1">
    <footer class="w3-container backdarkred w3-center">
            <h5>Copyright &copy; FIMEK 2023; Projekt Tech Gym &trade;</h5>
        
    </div>
  </footer>

<!-- END MAIN -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
