<?php
   include('dbcon.php');
   session_start();
   $eventid=0;
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <meta name="Description" content="Event Management System" />
      <meta
         name="keywords"
         content="Don,DON,don,Don C John,doncjohn,doncjohndcj,doncjohn.dcj,DON C JOHN,IEEE,ieeesahrdaya,Sahrdaya,TFUG,Tensorflow,tfjs"
         />
      <meta name="author" content="Don C John" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="style1.css" />
      <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
      <title>Event Management System</title>
   </head>
   <body>
      <header>
         <div class="container">
            <input type="checkbox" name="checkbox" id="check" />
            <div class="logo-container">
               <h3 class="logo">DZONE<span> EVENT</span></h3>
            </div>
            <div class="nav-btn">
               <div class="nav-links">
                  <ul>
                     <li class="nav-link" style="--i: 0.6s">
                        <a href="#">Home</a>
                     </li>
                     <li class="nav-link" style="--i: 1.35s">
                        <a href="#">About</a>
                     </li>
                     <li class="nav-link" style="--i: 1.35s">
                        <a href="pic.html">Pic Creator</a>
                     </li>
                     <li class="nav-link" style="--i: 1.35s">
                        <a href="#">Contact</a>
                     </li>
                  </ul>
               </div>
               <div class="log-sign" style="--i: 1.8s">
                  <?php
                     if(!isset($_SESSION['id'])){
                         echo'<a href="login.php" class="btn transparent">Log in</a>';
                     }
                     else{
                         echo'<a href="#" class="btn transparent">'.$_SESSION['user'].'</a>';
                         echo'<a href="dashboard/logout.php" class="btn transparent">Log Out</a>';
                     }
                    ?>
               </div>
            </div>
            <div class="hamburger-menu-container">
               <div class="hamburger-menu">
                  <div></div>
               </div>
            </div>
         </div>
      </header>
      <div class="modal" id="modal1">
         <div class="modal_inner">
         <span id="imageHolder"></span>
         <h2><span id="nameHolder"></span></h2>
         Event Location : <span id="locationHolder"></span> <br>
         Event Start From <span id="startdateHolder"></span> to <span id="enddateHolder"></span> <br>
         Registeration Fee : <span id="feeHolder"></span> <br> 
         <span id="buttonHolder"></span>
         </div>
      </div>
      <main>
         <div class="w3-content w3-section" style="width: 100%">
            <img class="mySlides banner1" src="banner/B1.webp" alt="Banner1" style="width: 100%; min-height: 180px" />
            <img class="mySlides banner2" src="banner/B2.webp" alt="Banner2" style="width: 100%; min-height: 180px" />
            <img class="mySlides banner2" src="banner/B3.webp" alt="Banner3" style="width: 100%; min-height: 180px" />
         </div>
         <div class="about">
            <div class="about_content">
               <div class="card">
                  <img src="Images/photo.jpg" alt="Don C John Profile Pic" style="width: 100%" />
                  <div class="ccontainer">
                     <h4><b>Dzone Event</b></h4>
                     <p>Engage your life</p>
                     <p>with blazing Events</p>
                  </div>
               </div>
               <div class="about_content_in">
                  <h1>About us</h1>
                  <br />
                  <div class="flex">
                     <b>
                     <span class="header-sub-title" id="word"></span>
                     <span class="header-sub-title blink">|</span>
                     </b>
                  </div>
                  <br />
                  <b>Dzone Events</b> brings people together through live experiences. <br />
                  Discover events that match your passions, or create your own with online ticketing tools.
                  <br />
                  #Engage & Live <br />
               </div>
            </div>
         </div>
         <div class="projects">
            <center>
               <h1>Exclusive Events ...</h1>
            </center>
         </div>
         <div class="container-cards">
            <div class="grid-cards">
               <?php
                  $sql = "SELECT * FROM `event`";
                  $result = $conn->query($sql);
                  $no = 1;
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                ?> 
               <div class="card-youtube">
                  <div>
                     <img class="img-card" src="dashboard/upload/<?php echo $row["Thumbnail_Image"]; ?> " />
                  </div>
                  <div class="grid-body-card">
                     <div>
                        <img src="logo.png" alt="DCJ" class="img-avatar-card" />
                     </div>
                     <div>
                        <p class="title-card"><?php echo $row["Event_Name"]; ?> </p>
                        <?php 
                           if(!isset($_SESSION['id'])){
                               echo '<a style="text-decoration: none;" href="login.php">
                               <button type="button" style="background-color: #000; color:white; text-decoration: none; padding: 5px 20px;">Register</a> </button>';
                            }
                           else{
                               $eventid = $row["Event_ID"];
                               echo '<button class="button" data-id="'.$row["Event_ID"].'" data-image="'.$row["Thumbnail_Image"].'" data-name="'.$row["Event_Name"].'" data-location="'.$row["Event_Location"].'" data-startdate="'.$row["Event_Start_Date"].'" data-enddate="'.$row["Event_End_Date"].'" data-fee="'.$row["Reg_Fee"].'" data-target="modal1">More Detials</button>';
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <?php
                  $no++;
                      }
                  } else {
                  echo "0 results";
                  }
                ?>
            </div>
         </div>
         <br /><br /><br />
         <div class="netflix">
            <div class="contain">
               <br /><br />
               <h1>A burst of Shots</h1>
               <div class="row">
                  <div class="row__inner">
                     <div class="tile">
                        <div class="tile__media">
                           <img class="tile__img" src="certify/c1.webp" alt="MTA Certification" />
                        </div>
                        <div class="tile__details">
                           <div class="tile__title">
                              <a href="https://www.youracclaim.com/badges/e199435f-9d72-4f74-8d5f-058a6348ddd6"
                                 >Program 1</a
                                 >
                           </div>
                        </div>
                     </div>
                     <div class="tile">
                        <div class="tile__media">
                           <img class="tile__img" src="certify/c2.webp" alt="Google IT Support" />
                        </div>
                        <div class="tile__details">
                           <div class="tile__title">
                              <a href="https://www.youracclaim.com/badges/5214ebc3-989d-4968-a6c6-fd45059f7244"
                                 >Program 2</a
                                 >
                           </div>
                        </div>
                     </div>
                     <div class="tile">
                        <div class="tile__media">
                           <img
                              class="tile__img"
                              src="certify/c3.webp"
                              alt=" IT Fundamentals for Cyber Security"
                              />
                        </div>
                        <div class="tile__details">
                           <div class="tile__title">Program 3</div>
                        </div>
                     </div>
                     <div class="tile">
                        <div class="tile__media">
                           <img class="tile__img" src="certify/c4.webp" alt="IT Fundamentals for Cyber Security" />
                        </div>
                        <div class="tile__details">
                           <div class="tile__title">
                              <a href="https://www.youracclaim.com/badges/47c2ae60-2b69-40dd-a277-8b54ced3314d"
                                 >Program 4</a
                                 >
                           </div>
                        </div>
                     </div>
                     <div class="tile">
                        <div class="tile__media">
                           <img class="tile__img" src="certify/c5.webp" alt="Google Cloud Essentials" />
                        </div>
                        <div class="tile__details">
                           <div class="tile__title">
                              <a
                                 href="https://www.qwiklabs.com/public_profiles/29d3e892-0c5b-4ea6-80e3-e9c390d34235"
                                 >Program 5</a
                                 >
                           </div>
                        </div>
                     </div>
                     <div class="tile">
                        <div class="tile__media">
                           <img class="tile__img" src="certify/c6.webp" alt="Hubspot Inbound Certified" />
                        </div>
                        <div class="tile__details">
                           <div class="tile__title">Tensorflow Road Show</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <br /><br />
         <?php
            if(isset($_SESSION['id'])){
         ?>
         <div class="projects">
            <center>
               <h1>Registered Events ...</h1>
            </center>
         </div>
         <div class="container-cards">
            <div class="grid-cards">
               <?php
                  $sql = "SELECT event.Event_Name,event.Thumbnail_Image FROM event LEFT JOIN register ON register.User_ID='1'";
                  $result = $conn->query($sql);
                  $no = 1;
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                  ?> 
               <div class="card-youtube">
                  <div>
                     <img class="img-card" src="dashboard/upload/<?php echo $row["Thumbnail_Image"];?> " />
                  </div>
                  <div class="grid-body-card">
                     <div>
                        <img src="logo.png" alt="DCJ" class="img-avatar-card" />
                     </div>
                     <div>
                        <p class="title-card"><?php echo $row["Event_Name"];?> </p>
                     </div>
                  </div>
               </div>
               <?php
                  $no++;
                      }
                  } else {
                  echo "0 results";
                  }
                ?>  
            </div>
         </div>
         <br /><br /><br />
         <?php
            }
        ?>
         <center>
            <h1>Contact</h1>
         </center>
         <div id="form-main">
            <div id="form-div">
               <form class="form" id="form1">
                  <p class="name">
                     <input
                        name="name"
                        type="text"
                        class="validate[required,custom[onlyLetter],length[0,100]] feedback-input"
                        placeholder="Name"
                        id="name"
                        />
                  </p>
                  <p class="email">
                     <input
                        name="email"
                        type="text"
                        class="validate[required,custom[email]] feedback-input"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        id="email"
                        placeholder="Email"
                        />
                  </p>
                  <p class="phone">
                     <input
                        name="phone"
                        type="text"
                        class="validate[required,custom[email]] feedback-input"
                        pattern="/(6|7|8|9)\d{9}/"
                        id="phone"
                        placeholder="Phone"
                        />
                  </p>
                  <p class="text">
                     <textarea
                        name="text"
                        class="validate[required,length[6,300]] feedback-input"
                        id="comment"
                        placeholder="Message"
                        ></textarea>
                  </p>
                  <div class="submit">
                     <input type="submit" value="Submit" id="button-blue" />
                     <div class="ease"></div>
                  </div>
               </form>
            </div>
         </div>
         <br /><br />
         <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
         <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
      </main>
      <div class="Frame Works">
         <br /><br />
         <center>
            <h1>Major Event Hosts</h1>
         </center>
      </div>
      <div class="slider">
         <div class="container">
            <div><img src="logo/Tensorflow.png" alt="Tensorflow" /></div>
            <div><img src="logo/firebase.png" alt="Firebase" /></div>
            <div><img src="logo/oracle.png" alt="Oracle" /></div>
            <div><img src="logo/googlecloud.png" alt="Google Cloud" /></div>
            <div><img src="logo/Tensorflow.png" alt="Tensorflow" /></div>
            <div><img src="logo/firebase.png" alt="Firebase" /></div>
            <div><img src="logo/oracle.png" alt="Oracle" /></div>
            <div><img src="logo/googlecloud.png" alt="Google Cloud" /></div>
            <div><img src="logo/Tensorflow.png" alt="Tensorflow" /></div>
            <div><img src="logo/firebase.png" alt="Firebase" /></div>
            <div><img src="logo/oracle.png" alt="Oracle" /></div>
            <div><img src="logo/googlecloud.png" alt="Google Cloud" /></div>
            <div><img src="logo/Tensorflow.png" alt="Tensorflow" /></div>
            <div><img src="logo/firebase.png" alt="Firebase" /></div>
            <div><img src="logo/oracle.png" alt="Oracle" /></div>
            <div><img src="logo/googlecloud.png" alt="Google Cloud" /></div>
         </div>
      </div>
      <br /><br />
      <footer class="footers">
         <div class="footer-text">All Rights Resevered | Copyrights &#169; DCJ</div>
         <div class="social-container">
            <ul class="social-icons">
               <li>
                  <a href="https://www.instagram.com/doncjohn.dcj/" alt="Instagram"
                     ><i class="fa fa-instagram"></i
                     ></a>
               </li>
               <li>
                  <a href="https://twitter.com/doncjohndcj" alt="Twitter"><i class="fa fa-twitter"></i></a>
               </li>
               <li>
                  <a href="https://www.linkedin.com/in/doncjohn/" alt="Linkedin"><i class="fa fa-linkedin"></i></a>
               </li>
               <li>
                  <a href="https://github.com/doncjohn" alt="Github"><i class="fa fa-github"></i></a>
               </li>
            </ul>
         </div>
      </footer>
      <div class="bnavbar">
         <div>
            <a href="#home" class="active" alt="Home"><i class="fa fa-home"></i><br />Home</a>
         </div>
         <div>
            <a href="#about" alt="About"><i class="fa fa-university" aria-hidden="true"></i><br />About</a>
         </div>
         <div>
            <a href="#project" alt="Projects"><i class="fa fa-suitcase" aria-hidden="true"></i><br />Events</a>
         </div>
         <div>
            <a href="#blog" alt="Blog"><i class="fa fa-tasks" aria-hidden="true"></i><br />Blog</a>
         </div>
         <div>
            <a href="#contact" alt="Contact"><i class="fa fa-address-card" aria-hidden="true"></i><br />Contact</a>
         </div>
      </div>
   </body>
   <script src="script.js"></script>
</html>