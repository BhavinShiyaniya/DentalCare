<?php 

include 'config.php';

session_start();
error_reporting(0);

if (isset($_SESSION["user_id"])) {
    header("Location: admin");
}

if (isset($_POST["resetPassword"])) {
    $password = mysqli_real_escape_string($conn, md5($_POST["new_password"]));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST["cnew_password"]));
    
    if ($password === $cpassword) {
        $sql = "UPDATE users SET password='$password' WHERE token='{$_GET["token"]}'";
        mysqli_query($conn, $sql);
        header("Location: login");
    } else {
        echo "<script>alert('Password not matched.');</script>";
    }
}
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot password - DentalCare</title>
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
              src="assets/img/reset-password.png"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="assets/img/reset-password.png"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Reset password
              </h1>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">New Password</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                  <input type="password"
                  class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="new_password" id="new_password" value="<?php echo $_POST["new_password"]; ?>"
                  placeholder="********" required />
                <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                  <i class="fa-solid fa-lock"></i>
                </div>
              </div>
              </label>

                <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">New Password</span>
                <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                    <input type="password"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" name="cnew_password" id="cnew_password" value="<?php echo $_POST["cnew_password"]; ?>"
                    placeholder="********" required />
                <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                    <i class="fa-solid fa-lock"></i>
                </div>
                </div>
                </label>

              <button type="submit"
                class=" mt-4 w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="resetPassword">
                Reset password
            </button>
          </form>
          <hr class="my-8" />

              <p class="mt-4">
                <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="./login.php"
                >
                  <i class="fa-solid fa-arrow-left mr-3"></i>Back to Login
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