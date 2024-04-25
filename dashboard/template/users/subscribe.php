<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Subscribe | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <br>
        <br>
        <!-- partial -->
        <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Subscribe to Our Forex VPS</h4>
                    <img src="../assets/images/loading.gif" alt="" id="loading">

                    <div class="row mx-0">
                      <div class="col-md-8">
                        <div id="content"></div>

                        <div class="form-group mt-4">
                      <label for="duration">Duration</label>
                      <select class="form-control form-control-lg text-light" id="duration" onchange="Change_Duration_On_Select()">
                        <option value="1">Monthly</option>
                        <option value="3">Quarterly</option>
                        <option value="6">Semi Annually</option>
                        <option value="12">Annually</option>
                      </select>
                      <input type="hidden" id="vps" value="<?php if (isset($_GET['vps'])){echo $_GET['vps'];}?>">
                      <div class="row mt-3">
                      <div class="form-group col-md-6">
                    <label>Preferred Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control p_input text-white" id="username" placeholder="Preferred Username">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Preferred Password </label>
                    <input type="password" id="password" class="form-control p_input text-white" placeholder="Input preferred password">
                  </div>
                      </div>
                    </div>
                      </div>
                      <div class="col-md-4">
                        <div class="border">
                          <div class="bg-success p-2 text-center">Order Summary</div>
                          <div class="p-2">
                            <b id="vps_name"></b>
                            <p>Forex VPS</p>
                            <div class="row justify-content-between py-2 border-bottom mx-0">
                              <i id="vps_name2"></i>
                              <span>
                                $ <span id="price"></span>
                              </span>
                            </div>
                            <div class="row justify-content-between pt-2  mx-0">
                              <i>Setup Fees</i>
                              <span>
                                $ <span>0.00</span>
                              </span>
                            </div>
                            <div class="row justify-content-between pb-2 border-bottom mx-0">
                              <i id="plan">Monthly</i>
                              <span>
                                $ <span id="price2"></span>
                              </span>
                            </div>
                            <h4 class="row justify-content-between pb-2 mt-4 mx-0">
                              <i>Total</i>
                              <span>
                                $ <span id="total"></span>
                              </span>
                            </h4>
                            <div class="row justify-content-between pb-2 border-bottom mx-0">
                              <i id="plan_duration">Wallet Balance</i>
                              <span>
                                $ <span id="wal_balance">0</span>
                              </span>
                            </div>
                            <img src="../assets/images/loading.gif" style="display: none;" alt="" id="load_ing">

                          <button type="button" class="btn btn-success mr-2 w-100" id="btn" onclick="Subscribe()">Subscribe</button>
                    
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          
          <?php require 'inc/footer.php'; ?>
          <script>
          Select_Vps_For_Subscription('<?php if (isset($_GET['vps'])){echo $_GET['vps'];}?>')</script>
    <!-- End custom js for this page -->
  </body>
</html>