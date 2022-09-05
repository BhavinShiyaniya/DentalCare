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
};

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

<div class="container grid px-6 mx-auto">
              

                <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div
    x-show="isModalOpen"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
  >
    <!-- Modal -->
    <div
      x-show="isModalOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0  transform translate-y-1/2"
      @click.away="closeModal"
      @keydown.escape="closeModal"
      class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
      role="dialog"
      id="modal"
    >
      <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
      <header class="flex justify-end">
        <button
          class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
          aria-label="close"
          @click="closeModal"
        >
          <svg
            class="w-4 h-4"
            fill="currentColor"
            viewBox="0 0 20 20"
            role="img"
            aria-hidden="true"
          >
            <path
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
              fill-rule="evenodd"
            ></path>
          </svg>
        </button>
      </header>
      <!-- Modal body -->
      <div class="mt-4 mb-6">
        <!-- Modal title -->
        <!-- <p
          class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
        >
        <i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;Add Patient
        </p> -->
        <!-- Modal description -->
        <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <p
          class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
        >
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