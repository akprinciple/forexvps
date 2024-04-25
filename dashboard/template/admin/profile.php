<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Admin Profile | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
    <style>
      html{
        scroll-behavior: smooth;
      }
    </style>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        
<br>
<br>
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Admin Profile</h4>
                    <button class="btn btn-danger float-right mb-2" onclick="history.back()">Go back</button>
                    <div class="clearfix"></div>
                    <img src="../assets/images/loading.gif" alt="" id="loading">

                    <form class="row mx-0">
                    <div class="form-group col-md-12">
                    <label>Dollar to Naira Rate</label>
                    <input type="number" id="rate" class="form-control p_input text-white"  value="" placeholder="Input your location">
                  </div>
                  <div class="text-center ">
                  <img src="assets/images/loading.gif" style="display: none;" alt="" id="loader">
                  <button type="button" id="rate_btn" onclick="Update_rate()" class="btn btn-success enter-btn ml-3">Update</button>
                </div>

                <div class="col-md-12" >
                      <h3 class="border-bottom mt-3">Bio Data</h3>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Firstname:</label>
                    <input type="text" class="form-control p_input text-white" id="firstname" placeholder="Input your Firstname">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Lastname:</label>
                    <input type="text" class="form-control p_input text-white" id="lastname" placeholder="Input your Lastname">
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label>Phone Number</label>
                    <input type="number" class="form-control p_input text-white" id="phone" placeholder="+234 *** *** ****">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Address</label>
                    <input type="text" class="form-control p_input text-white" id="address" placeholder="Input your location">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control p_input text-dark" id="email" disabled placeholder="...@*mail.com">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Registration Date</label>
                    <input type="text" class="form-control p_input text-dark" disabled id="date" placeholder="Input your location">
                  </div>
                  
                  
                  <div class="text-center">
                    <img src="assets/images/loading.gif" style="display: none;" alt="" id="loading">
                    <button type="button" id="btn" onclick="Update_Profile()" class="btn btn-primary btn-block enter-btn">Update</button>
                  </div>
                  

                  <div class="col-md-12" id="password">
                      <h3 class="border-bottom mt-3">Current Password</h3>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Current Password</label>
                    <input type="password" class="form-control p_input text-white" id="old_password" placeholder="******">
                  </div>
                  <div class="form-group col-md-6">
                    <label>New Password</label>
                    <input type="password" class="form-control p_input text-white" id="new_password" placeholder="******">
                  </div>
                  <div class="form-group col-md-12">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control p_input text-white" id="c_password" placeholder="******">
                  </div>
                </form>
                <div class="text-center ">
                  <img src="assets/images/loading.gif" style="display: none;" alt="" id="load_ing">
                  <button type="button" id="btn" onclick="Password()" class="btn btn-success enter-btn">Update</button>
                </div>
                  </div>
                </div>
                
            </div>
               
        
</div>
          <?php require 'inc/footer.php'; ?>
          <script>Show_rate(), Profile()</script>
    <!-- End custom js for this page -->
  </body>
</html>