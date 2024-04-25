<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Affilaite Withdrawal | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        <div class="main-panel" style="padding-top: 10px;">
          <div class="content-wrapper">
          <div class="row">

          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">$<span id="affiliate_earnings">0</span></h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Affiliate Earnings</h6>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">$<span id="wallet_balance">0</span></h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Wallet Balance</h6>
                  </div>
                </div>
              </div>
              
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">$<span id="amount_spent">0</span></h3>
                          <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Amount Spent</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">$<span id="amount_withdrawn">0</span></h3>
                          <p class="text-danger ml-2 mb-0 font-weight-medium">-3.5%</p>
                        </div>
                      </div>
                      <div class="col-3">
                      <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Amount Withdrawn</h6>
                  </div>
                </div>
              </div>
            </div>


            <div class="row mx-0">

            
            <div class="col-lg-4 grid-margin stretch-card pl-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Request a withdrawal</h4>
                    <span>
                        <mark>Note:</mark> 
                        <span class="text-danger">You can only work withdraw into a local Nigeria bank. Your dollar withdrawal will be converted to Naira.</span>
                    </span>
                    <div class="form-group">
                    <label>Amount($)</label>
                    <input type="number" class="form-control p_input text-white border-white" id="amount" placeholder="Minimum is 10 USD">
                  </div>
                  <div class="form-group">
                        <label for="a_number">Account Number</label>
                    <input type="number" class="form-control p_input text-white border-white" id="a_number" placeholder="Input your Account Number">
                        
                      </div>
                      <div class="form-group">
                        <label for="bank_name">Bank Name</label>
                    <input type="text" class="form-control p_input text-white border-white" id="bank_name" placeholder="Input your Bank Name">
                        
                      </div>
                    <div class="form-group">
                        <label for="a_name">Account Name</label>
                    <input type="text" class="form-control p_input text-white border-white" id="a_name" placeholder="Input your Account Name">
                        
                      </div>
                      <img src="../assets/images/loading.gif" style="display: none;" alt="" id="load_ing">

                          <button type="button" class="btn btn-success mr-2" id="btn" onclick="Withdrawal()">Submit</button>
                    
                  </div>
                </div>
            </div>
            <div class="col-lg-8 grid-margin stretch-card pr-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Your Withdrawal History</h4>
                    
                    <div class="table-responsive">
                    <img src="../assets/images/loading.gif" alt="" id="loading">

                      <table class="table text-white">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Account Details</th>
                            <th>Amount(USD)</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody id="withdrawal">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
      <?php require 'inc/footer.php'; ?>
      <script>Withdrawal_history(), Summary()</script>
          <script></script>
    <!-- End custom js for this page -->
  </body>
</html>