<?php

// $conn = mysqli_connect('localhost','root','','dentalcare') or die('connection failed');
include 'config.php';

session_start();
error_reporting(0);

$page='addpatient';
$title='DentalCare - Add Patient';

if (!isset($_SESSION["user_id"])) {
    header("Location: login");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["type"]=="user") {
    header("Location: index.php");
// echo $_SESSION["user_id"];
}

$get_pid = mysqli_query($conn, "SELECT * FROM `patients_detail` ORDER BY pid DESC") or die('query failed');
$row = mysqli_fetch_assoc($get_pid);
$last_pid = $row['pid'];
$new_pid = $last_pid+1;

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $date = $_POST['date'];
    $status = $_POST['status'];
    $one = $_POST['one'];
    $pid = $new_pid;

    $insert = mysqli_query($conn, "INSERT INTO `patients_detail`(pid, name, gender, age, contact, address, date, status, one) VALUES('$pid', '$name','$gender','$age','$contact','$address','$date','$status', '$one')") or die('query failed');

    if($insert){
        $message[] = 'Patient added successfully!';
        header("Location: admin.php");
    }else{
        $message[] = 'failed to add. try again!';
        header("Location: admin.php");
    }
}

?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DentalCare - Add Patient</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
</head>

<body>
<!-- <div class="relative flex lg:mt-0 lg:ml-4">
    <div class="absolute top-0 right-0">
    <button
        @click="openModal"
        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
    >
    <i class="fa-solid fa-user-plus"></i>
        <span class="ml-2">Add Patient</span>
    </button>
    </div>
</div> -->

    <main class="h-full overflow-y-auto">
        <div class="container mt-4 px-6 mx-auto grid">
            <div class="relative flex lg:mt-0 lg:ml-4">
                <div class="absolute top-0 left-0">
                  <a href="admin.php"><button
                    class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                  >
                  <i class="fa-solid fa-arrow-circle-left"></i>
                    <span class="ml-2">Go Back</span>
                  </button></a>
                </div>
                </div>
            
                    <div class="mt-16 mb-6">
                        
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;Add Patient
                            </p>

                            <hr>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php
                            if(isset($message)){
                                foreach($message as $message){
                                    echo '<p class="message">'.$message.'</p>';
                                }
                            }
                        ?>
                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Patient's Name</span>
                                <!-- focus-within sets the color for the icon when input is focused -->
                                <div
                                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="name"
                                        placeholder="Jane Doe" required />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <i class="fa-solid fa-user"></i>
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
                                <span class="text-gray-700 dark:text-gray-400">Patient's Age</span>
                                <!-- focus-within sets the color for the icon when input is focused -->
                                <div
                                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input type="number"
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="age"
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
                                        placeholder="1234567890" maxlength="10" minlength="10" required />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                </div>
                            </label>

                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Patient's Address</span>
                                <!-- focus-within sets the color for the icon when input is focused -->
                                <div
                                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="address"
                                        placeholder="20,Royal Apartments,Thaltej,Ahmedabad" required />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                </div>
                            </label>

                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">Date</span>
                                <!-- focus-within sets the color for the icon when input is focused -->
                                <div
                                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input type="date"
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="date" value="<?php echo date('Y-m-d'); ?>"
                                        placeholder="19-08-2022" required />
                                    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                                        <i class="fa-solid fa-calendar-day"></i>
                                    </div>
                                </div>
                            </label>

                            <input type="hidden" name="status" value="new">
                            <input type="hidden" name="one" value="1">
                            <button type="submit"
                                class=" mt-4 w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="submit">
                                Add Patient
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of modal backdrop -->
            
    </main>


    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>

</html>