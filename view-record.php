<?php

// $conn = mysqli_connect('localhost','root','','dentalcare') or die('connection failed');
include 'config.php';

session_start();
error_reporting(0);

$page='addpatient';
$title='DentalCare - Add Patient';

$id = $_GET['edit'];

if (!isset($_SESSION["user_id"])) {
    header("Location: login");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["type"]=="user") {
    header("Location: index.php");
// echo $_SESSION["user_id"];
}

if(isset($_POST['update'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $date = $_POST['date'];
    $status = $_POST['status'];
    $one = $_POST['one'];
    $pid = $_POST['pid'];

    $insert = mysqli_query($conn, "INSERT INTO `patients_detail`(pid, name, gender, age, contact, address, date, status, one) VALUES('$pid', '$name','$gender','$age','$contact','$address','$date','$status', '$one')") or die('query failed');

    if($insert){
        $message[] = 'Patient updated successfully!';
        header("Location: admin.php");
    }else{
        $message[] = 'failed to update. try again!';
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
                  <?php include 'addpatientmodal.php'; ?>

                  <div class="mt-16 mb-6">
                        
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                <i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;Update Patient
                            </p>

                            <hr>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php

                        $sql = "SELECT * FROM `patients_detail` WHERE id='$id'";
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
                                <span class="text-gray-700 dark:text-gray-400">Patient's Name</span>
                                <!-- focus-within sets the color for the icon when input is focused -->
                                <div
                                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                                    <input
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="name" value="<?php echo $row['name']; ?>"
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
                                            name="gender" value="male" <?php if($row['gender']=="male") { ?>checked="true" <?php } ?> required />
                                        <span class="ml-2">Male</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                        <input type="radio"
                                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                            name="gender" value="female" <?php if($row['gender']=="female") { ?>checked="true" <?php } ?> required />
                                        <span class="ml-2">Female</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                        <input type="radio"
                                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                            name="gender" value="other" <?php if($row['gender']=="other") { ?>checked="true" <?php } ?> required />
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
                                        class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="age" value="<?php echo $row['age']; ?>"
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
                                        placeholder="1234567890" value="<?php echo $row['contact']; ?>" maxlength="10" minlength="10" required />
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
                                        placeholder="20,Royal Apartments,Thaltej,Ahmedabad" value="<?php echo $row['address']; ?>" required />
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

                            <input type="hidden" name="status" value="old">
                            <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                            <input type="hidden" name="one" value="0">
                            <?php
                            }
                        }

                    ?>
                            <button type="submit"
                                class=" mt-4 w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="update">
                                Update Patient
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of modal backdrop -->

                  <h4
              class="mb-4 mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Patient's Record
            </h4>
            
            <hr>
            <!-- With actions -->
            
            <!-- Patients Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs mt-6">
              <div class="w-full overflow-x-auto">
            
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Patient</th>
                      <th class="px-4 py-3">Contact</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Date</th>
                    </tr>
                  </thead>
                  <?php
                        
                      $get_pid = mysqli_query($conn, "SELECT * FROM `patients_detail` WHERE id=$id ORDER BY id DESC") or die('query failed');
                      $res = mysqli_fetch_assoc($get_pid);
                      $p_id = $res['pid'];
                      $show_patients = mysqli_query($conn, "SELECT * FROM `patients_detail` WHERE pid=$p_id ORDER BY id DESC") or die('query failed');
                      if(mysqli_num_rows($show_patients) > 0){
                      while($row = mysqli_fetch_assoc($show_patients)){
                  ?>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <!-- <img
                              class="object-cover w-full h-full rounded-full"
                              src="user.png"
                              alt=""
                              loading="lazy"
                            /> -->
                            <i class="fa-regular fa-user"></i>
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold"><?php echo $row['name']; ?></p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                            <?php echo $row['address']; ?>
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                      <?php echo $row['contact']; ?>
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <?php
                            if($row['status'] == 'new'){
                            
                        ?>
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                        <?php echo $row['status']; ?>
                        </span>
                        <?php
                            }else{
                        ?>
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100"
                        >
                        <?php echo $row['status']; ?>
                        </span>
                        <?php
                            }
                        ?>
                      </td>
                      <td class="px-4 py-3 text-sm">
                      <?php echo $row['date']; ?>
                      </td>
                    </tr>

                  </tbody>
                  <?php
                    }
                  }
                  ?>
                  </table>
              </div>
              </div>

              </div>
            </div>
          </div>
    </main>


    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>

</html>