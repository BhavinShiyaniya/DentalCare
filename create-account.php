<?php 

// $conn = mysqli_connect('localhost','root','','dentalcare') or die('connection failed');
include 'config.php';

session_start();

error_reporting(0);

$title='DentalCare - Create Account';

if (isset($_SESSION["user_id"])) {
    header("Location: admin.php");
}

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST["cpassword"]));
    $type = $_POST['type'];
    $token = md5(rand());
    
    $profile_image = $_FILES['profile_image']['name'];
    $profile_image_tmp_name = $_FILES['profile_image']['tmp_name'];
    $profile_image_size = $_FILES['profile_image']['size'];
    $profile_image_new_name = rand() . $profile_image;

    $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

    if ($password !== $cpassword) {
        echo "<script>alert('Password did not match.');</script>";
    } elseif($check_email > 0) {
        echo "<script>alert('Email already exists.');</script>";
    } 
    else {
        $sql = mysqli_query($conn, "INSERT INTO users (name, email, degree, gender, age, contact, profile_image, address, password, type, token, status) VALUES ('$name', '$email', '$degree', '$gender', '$age', '$contact', '$profile_image', '$address', '$password', '$type', '$token', '0')") or die('query failed');
        $result = mysqli_query($conn, $sql);
        if ($result) {
          move_uploaded_file($profile_image_tmp_name, "uploaded_image/" . $profile_image_new_name);
            $_POST["name"] = "";
            $_POST["email"] = "";
            $_POST["degree"] = "";
            $_POST["gender"] = "";
            $_POST["age"] = "";
            $_POST["contact"] = "";
            $_POST["profile_image"] = "";
            $_POST["address"] = "";
            $_POST["password"] = "";
            $_POST["cpassword"] = "";
            $to = $email;
            $subject = "Email verification - DentalCare";

            $message = "
            <html>
            <head>
            <title>{$subject}</title>
            </head>
            <body>
            <p><strong>Dear {$name},</strong></p>
            <p>Thanks for registration! Verify your email to access our website. Click below link to verify your email.</p>
            <p><a href='{$base_url}verify-email.php?token={$token}'>Verify Email</a></p>
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= "From: ". $my_email;

            if (mail($to,$subject,$message,$headers)) {
                echo "<script>alert('We have sent a verification link to your email - {$email}.');</script>";
                header("Location: login.php");
            } else {
                echo "<script>alert('Mail not sent. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('User registration failed.');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create account - DentalCare</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/tailwind.output.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="assets/js/init-alpine.js"></script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="assets/img/doctor7.png"
              alt=""
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="assets/img/doctor7.png"
              alt=""
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Create account
              </h1>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
              <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Doctor's Name</span>
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input
                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="name"
                        value="<?php echo $_POST["name"]; ?>"
                        placeholder="Jane Doe" required />
                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            </label>

            <label class="block text-sm mt-4">
              <span class="text-gray-700 dark:text-gray-400">Email</span>
              <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input
                class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="email"
                value="<?php echo $_POST["email"]; ?>"
                placeholder="janedoe@gmail.com" required />
              <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                <i class="fa-solid fa-envelope"></i>
              </div>
            </div>
            </label>

            <label class="block text-sm mt-4">
              <span class="text-gray-700 dark:text-gray-400">Specialization</span>
              <!-- focus-within sets the color for the icon when input is focused -->
              <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                  <input type="text"
                      class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="degree"
                      value="<?php echo $row['degree']; ?>"
                      placeholder="MBBS - Internal Medicine" required />
                  <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                  <i class="fa-solid fa-user-graduate"></i>
                  </div>
              </div>
          </label>

            <div class="mt-4 text-sm">
              <i class="fa-solid fa-mars"></i>
              <span class="text-gray-700 dark:text-gray-400">
                  Gender
              </span>
              <div class="mt-2">
                  <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                      <input type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="gender" value="male" required />
                      <span class="ml-2">Male</span>
                  </label>
                  <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                      <input type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="gender" value="female" required />
                      <span class="ml-2">Female</span>
                  </label>
                  <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                      <input type="radio"
                          class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          name="gender" value="other" required />
                      <span class="ml-2">Other</span>
                  </label>
              </div>
          </div>

          <label class="block text-sm mt-4">
              <span class="text-gray-700 dark:text-gray-400">Doctor's Age</span>
              <!-- focus-within sets the color for the icon when input is focused -->
              <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                  <input type="number"
                      class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="age"
                      value="<?php echo $_POST["age"]; ?>"
                      placeholder="32" required />
                  <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                      <i class="fa-brands fa-adn"></i>
                  </div>
              </div>
          </label>

          <label class="block text-sm mt-4">
              <span class="text-gray-700 dark:text-gray-400">Contact No</span>
              <!-- focus-within sets the color for the icon when input is focused -->
              <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                  <input type="tel"
                      class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="contact"
                      value="<?php echo $_POST["contact"]; ?>"
                      placeholder="1234567890" maxlength="10" minlength="10" required />
                  <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                      <i class="fa-solid fa-phone"></i>
                  </div>
              </div>
          </label>

          <label class="block text-sm mt-4">
            <span class="text-gray-700 dark:text-gray-400">Profile Image</span>
            <!-- focus-within sets the color for the icon when input is focused -->
            <div
                class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input type="file" accept="image/*"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    value="<?php echo $_POST["profile_image"]; ?>" name="profile_image" required />
                <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                <i class="fa-solid fa-image"></i>
                </div>
            </div>
        </label>

        <label class="block text-sm mt-4">
            <span class="text-gray-700 dark:text-gray-400">Doctor's Address</span>
            <!-- focus-within sets the color for the icon when input is focused -->
            <div
                class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="address"
                    value="<?php echo $_POST["address"]; ?>"
                    placeholder="20,Royal Apartments,Thaltej,Ahmedabad" required />
                <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
            </div>
        </label>

        <label class="block text-sm mt-4">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <!-- focus-within sets the color for the icon when input is focused -->
            <div
                class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input type="password"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="password"
                    value="<?php echo $_POST["password"]; ?>"
                    placeholder="**********" required />
                <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                <i class="fa-solid fa-lock"></i>
                </div>
            </div>
        </label>

        <label class="block text-sm mt-4">
            <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
            <!-- focus-within sets the color for the icon when input is focused -->
            <div
                class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                <input type="password"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="cpassword"
                    value="<?php echo $_POST["cpassword"]; ?>"
                    placeholder="**********" required />
                <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                <i class="fa-solid fa-lock"></i>
                </div>
            </div>
        </label>
        <input type="hidden" name="type" value="user">

        <button type="submit"
        class=" mt-4 w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="signup">
        Create account
        </button>
      </form>

              <hr class="my-8" />

              <p class="mt-4">
                <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="./login.php"
                >
                  Already have an account? Login
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
  </body>
</html>
