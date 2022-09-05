<?php

include 'config.php';

session_start();
error_reporting(0);

$page='patients';
$title='DentalCare - Patients';

if (!isset($_SESSION["user_id"])) {
  header("Location: login");
} elseif (isset($_SESSION["user_id"]) && $_SESSION["type"]=="user") {
  header("Location: index.php");
  // echo $_SESSION["user_id"];
}

?>

<?php

include 'include/header.php';
include 'include/sidebar.php';
include 'include/topnav.php';

?>

        <main class="h-full pb-16 overflow-y-auto">
            <div class="container mt-4 px-6 mx-auto grid">
                <div class="relative flex lg:mt-0 lg:ml-4">
                  <div class="absolute top-0 right-0">
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
                  <h4
              class="mb-4 mt-2 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              All Patients
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
