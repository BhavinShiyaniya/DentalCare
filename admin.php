<?php

// $conn = mysqli_connect('localhost','root','','dentalcare') or die('connection failed');

include 'config.php';

session_start();
error_reporting(0);

$page='admin';
$title='DentalCare Dashboard';

if (!isset($_SESSION["user_id"])) {
  header("Location: login");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["type"]=="user") {
  header("Location: index.php");
  // echo $_SESSION["user_id"];
}

$sql = "SELECT * FROM users WHERE id='{$_SESSION["user_id"]}'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){

    if (!isset($_SESSION["user_id"])) {
      header("Location: login.php");
    } elseif (isset($_SESSION["user_id"]) && $_SESSION['type']=="user") {
      header("Location: index.php");
    }
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
            <div class="relative flex lg:mt-0 lg:ml-4">
              <div class="absolute top-0 right-0">
                <!-- <a href="addpatient.php"><button
                  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <i class="fa-solid fa-user-plus"></i>
                  <span class="ml-2">Add Patient</span>
                </button></a> -->
                <button
                  @click="openModal"
                  class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                <i class="fa-solid fa-user-plus"></i>
                  <span class="ml-2">Add Patient</span>
                </button>
              </div>
              </div>
              <?php include 'addpatientmodal.php'; ?>


            <h2
              class="my-4 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Dashboard
            </h2>
      
            <!-- Cards -->
            <div class="grid mt-6 gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Total Patients
                  </p>
                  <?php
                    $get_pid = mysqli_query($conn, "SELECT * FROM `patients_detail` ORDER BY pid DESC") or die('query failed');
                    $row = mysqli_fetch_assoc($get_pid);
                    $last_pid = $row['pid'];
                  ?>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                    <?php echo $last_pid ?>
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Total Appointments
                  </p>
                <?php
                    $today = date('Y-m-d');
                    $query = "SELECT * FROM contact_form WHERE date>=$today";
                      
                    // Execute the query and store the result set
                    $result = mysqli_query($conn, $query);
                    if ($result)
                    {
                        // it return number of rows in the table.
                        $row = mysqli_num_rows($result);
                          
                           if ($row)
                              {
                  ?>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                    <?php echo $row ?>
                  </p>
                  <?php
                                  }
                          // close the result.
                          mysqli_free_result($result);
                      }
                  ?>
                </div>
              </div>
            </div>
</section>

            <h4
              class="mb-4 mt-2 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              All Patients
            </h4>
            <!-- Patients Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
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
                      <th class="px-4 py-3">Action</th>
                    </tr>
                  </thead>
                  <?php
                      $show_patients = mysqli_query($conn, "SELECT * FROM `patients_detail` ORDER BY pid DESC") or die('query failed');
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
                      <td>
                      <div class="flex items-center space-x-4 text-sm">
                        <a href="view-record.php?edit=<?php echo $row['id']; ?>" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit"> <i class="fas fa-edit mr-3"></i> edit </a>
                      </div>
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
      
        
        <?php

include 'include/footer.php';

?>
