<?php

// $conn = mysqli_connect('localhost','root','','dentalcare') or die('connection failed');
include 'config.php';

session_start();
error_reporting(0);

$page='profile';
$title='DentalCare - Profile';

if (!isset($_SESSION["user_id"])) {
  header("Location: login");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["type"]=="user") {
  header("Location: index.php");
  // echo $_SESSION["user_id"];
}

if (isset($_POST["update"])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    $profile_image = $_FILES['profile_image']['name'];
    $profile_image_tmp_name = $_FILES['profile_image']['tmp_name'];
    $profile_image_size = $_FILES['profile_image']['size'];
    $profile_image_new_name = rand() . $profile_image;

    $sql = "UPDATE `users` SET name='$name', degree='$degree', age='$age', contact='$contact', profile_image='$profile_image_new_name', address='$address' WHERE id='{$_SESSION["user_id"]}'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Profile updated successfully.');</script>";
        move_uploaded_file($profile_image_tmp_name, "uploaded_image/" . $profile_image_new_name);
        } else {
        echo "<script>alert('Profile can not updated.');</script>";
        }
}

?>

<?php

include 'include/header.php';
include 'include/sidebar.php';
include 'include/topnav.php';

?>
        <main class="h-full overflow-y-auto">
          <div class="container mt-4 px-6 mx-auto grid">
            <h2
              class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Profile
            </h2>

            <hr>

            

            <!-- Responsive cards -->
            <div class="flex w-full mt-4">
              <!-- Card -->
              <div
                class="w-4/12 h-full"
              >
              <?php
                    $sql = "SELECT * FROM users WHERE id='{$_SESSION["user_id"]}'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                ?>
              <div class="flex flex-col justify-center max-w-xs p-6 shadow-md rounded-xl sm:px-12 dark:bg-gray-900 dark:text-gray-100">
                    <img src="uploaded_image/<?php echo $row["profile_image"]; ?>" alt="" class="w-32 h-32 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                    <div class="space-y-4 text-center divide-y divide-gray-700">
                        <div class="my-2 space-y-1">
                            <h2 class="text-xl font-semibold sm:text-2xl"><?php echo $row["name"]; ?></h2>
                            <p class="px-5 text-xs sm:text-base dark:text-gray-400"><?php echo $row["degree"]; ?></p>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }

                ?>
              </div>
              <!-- Card -->
              <div
                class="w-4/12 h-full w-full ml-4"
              >
                <div class="flex flex-col justify-center max-w-xs p-6 shadow-md rounded-xl sm:px-12 dark:bg-gray-900 dark:text-gray-100 w-full">
                <div class="mt-0 mb-6">
                        
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-user-doctor"></i></i>&nbsp;&nbsp;Doctor Profile
                            </p>
            
                            <hr>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <?php

                        $sql = "SELECT * FROM `users` WHERE id='{$_SESSION["user_id"]}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>


                        <?php
                            if(isset($message)){
                                foreach($message as $message){
                                    echo '<p class="message">'.$message.'</p>';
                                }
                            }
                        ?>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Doctor's Name</span>
                                <!-- focus-within sets the color for the icon when input is focused -->
                                <div
                                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="name"
                                        value="<?php echo $row['name']; ?>"
                                        placeholder="Jane Doe" required />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <!-- focus-within sets the color for the icon when input is focused -->
                                <div
                                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input type="email"
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="email"
                                        value="<?php echo $row['email']; ?>"
                                        placeholder="abc@gmail.com" required />
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
                                            name="gender" <?php if($row['gender']=="male") { ?>checked="true" <?php } ?> value="male" required />
                                        <span class="ml-2">Male</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                        <input type="radio"
                                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                            name="gender" <?php if($row['gender']=="female") { ?>checked="true" <?php } ?> value="female" required />
                                        <span class="ml-2">Female</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                        <input type="radio"
                                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                            name="gender" <?php if($row['gender']=="other") { ?>checked="true" <?php } ?> value="other" required />
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
                                        value="<?php echo $row['age']; ?>"
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
                                        placeholder="1234567890"
                                        value="<?php echo $row['contact']; ?>" maxlength="10" minlength="10" required />
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
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="profile_image" required />
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
                                        value="<?php echo $row['address']; ?>"
                                        placeholder="20,Royal Apartments,Thaltej,Ahmedabad" required />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                </div>
                            </label>
            
                            <!-- <input type="hidden" name="new" value="new"> -->

                            <?php
                            }
                        }

                    ?>
                            <button type="submit"
                                class=" mt-4 w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="update">
                                Update Profile
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
              </div>
              </div>

        
              </div>
            </div>
          </div>
        </main>
      
        
        <?php

include 'include/footer.php';
?>
