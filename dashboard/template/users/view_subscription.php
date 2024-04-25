<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>View Subscription | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        <?php
            if (isset($_GET['sub'])) {
                $subscription = $_GET['sub'];
                ?>
<br>
<br>
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Subscription Details</h4>
                    <button class="btn btn-danger float-right mb-2">Go back</button>
                    <div class="clearfix" onclick="history.back()"></div>
                    <img src="../assets/images/loading.gif" alt="" id="loading">

                    <div class="row mx-0">
                      <div class="col-md-8">
                        <div id="content"></div>

                        <div class="form-group mt-4">
                      <label for="duration">Duration</label>
                      <div class="p-3 rounded border border-light" ><span id="duration"></span> Month(s)</div>
                    <div class="row mt-3">
                      <div class="form-group col-md-6">
                    <label>Amount</label>
                    <div class="p-3 rounded border border-light" >$ <span id="amount"></span></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label> Subscription ID </label>
                    <div class="p-3 rounded border border-light" id="sub">**** </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label> Status </label>
                    <div class="p-3 rounded font-weight-bold border border-light" id="subStatus">**** </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label> Date </label>
                    <div class="p-3 rounded font-weight-bold border border-light" id="date">**** </div>
                  </div>
                      </div>
                    </div>
                      </div>
                      <div class="col-md-4">
                        <div class="border">
                          <div class="bg-success p-2 text-center">VPS Setup</div>
                          <div class="p-2">
                            <b id="vps_name"></b>
                            <p>Forex VPS</p>
                            
                            <div class="row justify-content-between pt-2 border-top mx-0">
                              <i>Username</i>
                              <span>
                                <span id="username"></span>
                              </span>
                            </div>
                            <div class="row justify-content-between pb-2 mx-0">
                              <i id="">Password</i>
                              <span>
                                <span id="password">****</span>
                              </span>
                            </div>
                            <div class="row justify-content-between pb-2 border-bottom mx-0">
                              <i id="">IP Address</i>
                              <span>
                                <span id="ip">****</span>
                              </span>
                            </div>
                            <h4 class="row justify-content-between pb-2 mt-4 mx-0">
                              <i>Status</i>
                              <span>
                                <span id="Sub_status"></span>
                              </span>
                            </h4>
                            
                    
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
                <?php
            }
        ?>
        
</div>
          <?php require 'inc/footer.php'; ?>
          <script>View_Subscription('<?php if (isset($_GET['sub'])) { echo  $_GET['sub'];}?>')</script>
    <!-- End custom js for this page -->
  </body>
</html>