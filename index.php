<?php

// $conn = mysqli_connect('localhost','root','','dentalcare') or die('connection failed');
include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];

    $insert = mysqli_query($conn, "INSERT INTO `contact_form`(name, email, number, date, time, status) VALUES('$name','$email','$number','$date','$time','$status')") or die('query failed');

    if($insert){
        $message[] = 'appointment made successfully!';
    }else{
        $message[] = 'appointment failed';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Care</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- bootstrap cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- header section starts -->

    <header class="header fixed-top">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <a href="#home" class="logo">dental<span>Care.</span></a>

                <nav class="nav">
                    <a href="#home">home</a>
                    <a href="#about">about</a>
                    <a href="#services">services</a>
                    <a href="#reviews">reviews</a>
                    <a href="#contact">contact</a>
                </nav>

                <a href="#contact" class="link-btn">make appointment</a>

                <div id="menu-btn" class="fas fa-bars"></div>

            </div>

        </div>

    </header>

    <!-- header section ends -->

    <!-- home section starts -->

    <section class="home" id="home">

        <div class="container">

            <div class="row min-vh-100 align-items-center">
                <div class="content text-center text-md-left">
                    <h3>let us brighten your smile</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut possimus qui tempora odio quae
                        aliquam?</p>
                    <a href="#contact" class="link-btn">make appointment</a>
                    <br>
                    <p>or call (+91) 8795643215</p>
                </div>
            </div>

        </div>

    </section>

    <!-- home section ends -->
    
    <!-- profile section starts -->
    <section class="about" id="about" style="max-height:50vh;">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-md-6 image d-flex justify-content-center">
                    <img src="images/user-2.png" class="rounded-circle mb-5 mb-md-0 rounded" width="200px" height="200px" alt="">
                </div>

                <div class="col-md-6 content">
                    <span>meet doctor</span>
                    <h3>Dr John Doe</h3>
                    <p>Orthodontist - BDS,MDS</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore incidunt repudiandae dolore, quasi molestiae quas quos eaque earum corporis ad!</p>
                </div>
            </div>
        </div>

    </section>

    <!-- profile section ends -->

    <!-- about section starts -->

    <section class="about" id="about">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-md-6 image">
                    <img src="images/about-img.jpg" class="w-100 mb-5 mb-md-0" alt="">
                </div>

                <div class="col-md-6 content">
                    <span>about us</span>
                    <h3>True Healthcare For Your Family</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, assumenda. Nostrum optio, incidunt
                        aperiam explicabo dolore amet voluptates corporis expedita et excepturi iste fugit sint dolorum
                        veniam maiores, enim culpa.</p>
                    <a href="#contact" class="link-btn">make appointment</a>
                </div>
            </div>

        </div>

    </section>

    <!-- about section ends -->

    <!-- services section starts -->

    <section class="services" id="services">

        <h1 class="heading">our services</h1>

        <div class="box-container container">

            <div class="box">
                <img src="images/icon-1.svg" alt="">
                <h3>Alignment specialist</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, saepe.</p>
            </div>

            <div class="box">
                <img src="images/icon-2.svg" alt="">
                <h3>Cosmetic dentistry</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, saepe.</p>
            </div>

            <div class="box">
                <img src="images/icon-3.svg" alt="">
                <h3>Oral hygiene experts</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, saepe.</p>
            </div>

            <div class="box">
                <img src="images/icon-4.svg" alt="">
                <h3>Root canal specialist</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, saepe.</p>
            </div>

            <div class="box">
                <img src="images/icon-5.svg" alt="">
                <h3>Live dental advisory</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, saepe.</p>
            </div>

            <div class="box">
                <img src="images/icon-6.svg" alt="">
                <h3>Cavity inspection</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia, saepe.</p>
            </div>

        </div>

    </section>

    <!-- services section ends -->

    <!-- process section starts -->

    <section class="process">

        <h1 class="heading">work process</h1>

        <div class="box-container container">

            <div class="box">
                <img src="images/process-1.png" alt="">
                <h3>Cosmetic Dentistry</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum, beatae!</p>
            </div>

            <div class="box">
                <img src="images/process-2.png" alt="">
                <h3>Pediatric Dentistry</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum, beatae!</p>
            </div>

            <div class="box">
                <img src="images/process-3.png" alt="">
                <h3>Dental Implants</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum, beatae!</p>
            </div>

        </div>

    </section>

    <!-- process section ends -->

    <!-- reviews section starts -->

    <section class="reviews" id="reviews">

        <h1 class="heading"> satisfied patients </h1>

        <div class="box-container container">

            <div class="box">
                <img src="images/pic-1.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum odit illum autem hic accusantium
                    expedita veritatis quasi eum assumenda. Deleniti.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
                <span>satisfied client</span>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum odit illum autem hic accusantium
                    expedita veritatis quasi eum assumenda. Deleniti.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
                <span>satisfied client</span>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum odit illum autem hic accusantium
                    expedita veritatis quasi eum assumenda. Deleniti.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
                <span>satisfied client</span>
            </div>

        </div>

    </section>

    <!-- reviews section ends -->

    <!-- contact section starts -->

    <section class="contact" id="contact">

        <h1 class="heading">make appointment</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<p class="message">'.$message.'</p>';
                }
            }
        ?>
            <span>your name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" required>
            <span>your email :</span>
            <input type="email" name="email" placeholder="enter your email" class="box">
            <span>your number :</span>
            <input type="tel" name="number" placeholder="enter your number" class="box" required>
            <span>Is it your first time?</span><br>
            <input type="radio" id="yes" name="status" value="new" required>
            <span>Yes</span><br>
            <input type="radio" id="no" name="status" value="old" required>
            <span>No</span><br>
            <span>appointment date :</span>
            <input type="date" name="date" class="box">
            <input type="time" name="time" class="box">
            <input type="submit" value="make appointment" name="submit" class="link-btn">
        </form>

    </section>

    <!-- contact section ends -->

    <!-- footer section starts -->

    <section class="footer">

        <div class="box-container container">

            <div class="box">
                <i class="fas fa-phone"></i>
                <h3>phone number</h3>
                <p>+123-456-7890</p>
                <p>+111-222-3333</p>
            </div>

            <div class="box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>our address</h3>
                <p>Ahmedabad, Gujarat, India - 382345</p>
            </div>

            <div class="box">
                <i class="fas fa-clock"></i>
                <h3>opening hours</h3>
                <p>Monday to Saturday</p>
                <p>10:00am to 02:00pm</p>
                <p>05:00pm to 08:00pm</p>
            </div>

            <div class="box">
                <i class="fas fa-envelope"></i>
                <h3>email</h3>
                <p>dentalcare@gmail.com</p>
                <p>help.dentalcare@gmail.com</p>
            </div>

        </div>
        <div class="credit"> &copy; all copyright reserved -
            <?php echo date('Y') ?> |<span> Dental Care </span>
        </div>

    </section>

    <!-- footer section ends -->


    <!-- custom js file link -->
    <script src="js/script.js"></script>
    <script>
        // to prevent resubmission on refresh and back
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>

</html>