<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Page | Myfxvpsm</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      .p_input,.form-control{
        color: white;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h1 class="text-center">Myfxvpsm</h1>
                <h3 class="card-title text-left mb-3">Register</h3>
                <form>
                  <div class="form-group">
                    <label>Firstname:</label>
                    <input type="text" class="form-control p_input text-white" id="firstname" placeholder="Input your Firstname">
                  </div>
                  <div class="form-group">
                    <label>Lastname:</label>
                    <input type="text" class="form-control p_input text-white" id="lastname" placeholder="Input your Lastname">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control p_input text-white" id="email" placeholder="...@*mail.com">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control p_input text-white" id="password" placeholder="******">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control p_input text-white" id="c_password" placeholder="******">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" class="form-control p_input text-white" id="phone" placeholder="+234 *** *** ****">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control p_input text-white" id="address" placeholder="Input your location">
                  </div>
                  <div class="form-group">
                    <label>Referral</label>
                    <input type="hidden" value="<?php if(isset($_GET['ref_id'])){echo $_GET['ref_id'];}else{echo 'admin';} ?>" id="ref_id">
                    <input type="text" class="form-control p_input text-dark" disabled value="<?php if(isset($_GET['ref_id'])){echo $_GET['ref_id'];}else{echo 'admin';} ?>">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="forgot-password" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <img src="assets/images/loading.gif" style="display: none;" alt="" id="loading">
                    <button type="button" id="btn" onclick="Registration()" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  
                  <p class="sign-up text-center">Already have an Account?<a href="login"> Sign In</a></p>
                  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/todolist.js"></script>
   
    <!-- endinject -->
  </body>
</html>