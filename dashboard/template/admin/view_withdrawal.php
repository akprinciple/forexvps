<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title> Edit Withdrawal | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
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
                    <h4 class="card-title">View/Update Withdrawal </h4>
                    <button class="btn btn-danger float-right mb-2" onclick="history.back()">Go back</button>
                    <div class="clearfix"></div>
                    <img src="../assets/images/loading.gif" alt="" id="loading">
                    <form class="forms-sample row">
                      <div class="col-md-6">

                        <div class="form-group">
                          <label for="name">Client's Name</label>
                          <input type="text" class="form-control text-dark text-capitalize" disabled id="username" placeholder="Client's Name">
                        </div>
                        <div class="form-group">
                          <label for="name">Client's Email</label>
                          <input type="text" class="form-control text-dark" disabled id="email" placeholder="Client's Email">
                      </div>
                      
                      <div class="form-group">
                        <label for="name">Current Status</label>
                        <input type="text" class="form-control text-dark" disabled id="current_status" placeholder="Current Payment Status">
                      </div>
                      <div class="form-group">
                        <label for="name">Date</label>
                        <input type="text" class="form-control text-dark" disabled id="date" placeholder="Date">
                      </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Amount</label>
                        <input type="text" class="form-control text-dark" disabled id="amount" placeholder="Amount">
                      </div>
                    <div class="form-group">
                        <label for="name">Account Name</label>
                        <input type="text" class="form-control text-dark" disabled id="account_name" placeholder="Payment Method">
                      </div>
                      <div class="form-group">
                        <label for="name">Account Number</label>
                        <input type="text" class="form-control text-dark" disabled id="account_number" >
                      </div>
                      <div class="form-group">
                        <label for="">Bank Name</label>
                        <input type="text" class="form-control text-dark" disabled id="bank_name" placeholder="Bank Name">
                      </div>
                      
                      </div>
                      <div class="col-md-12">

                        <h3 class="border-bottom my-3 p-2">Edit</h3>
                        
                        <div class="row mx-0">
                          
                          
                            <div class="form-group col-md-12">
                              <label for="payment_status">Withdrawal Status</label>
                              <select class="form-control text-white" id="withdrawal_status">
                                <option id="p_status"></option>
                                <option value="Approved">Approve</option>
                                <option value="pending">Pend</option>
                                <option value="Rejected">Reject</option>
                              </select>
                            </div>
                          </div>
                          
                          <img src="../assets/images/loading.gif" style="display: none;" alt="" id="load_ing">
                          
                          <button type="button" class="btn btn-primary mr-2" id="btn" onclick="Update_withdrawal(<?php echo $_GET['id']; ?>)">Update</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          
          <?php require 'inc/footer.php'; ?>
          <script>View_withdrawal(<?php echo $_GET['id']; ?>)</script>
    <!-- End custom js for this page -->
  </body>
</html>