<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title> Edit Payment | Myfxvpsm</title>
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
                    <h4 class="card-title">View/Update Payment </h4>
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
                        <label for="name">Payment Method</label>
                        <input type="text" class="form-control text-dark" disabled id="method" placeholder="Payment Method">
                      </div>
                      <div class="form-group">
                        <label for="name">Payment Id</label>
                        <input type="text" class="form-control text-dark" disabled id="payment_id" >
                      </div>
                      <div class="form-group">
                        <label for="name">Current Status</label>
                        <input type="text" class="form-control text-dark" disabled id="current_status" placeholder="Current Payment Status">
                      </div>
                    </div>
                    <div class="col-md-6">

                      <!-- Payment Evidence -->
                      <h3>Payment receipt</h3>
                      <div id="img">
                        
                        </div>
                      </div>
                      <div class="col-md-12">

                        <h3 class="border-bottom my-3 p-2">Edit</h3>
                        
                        <div class="row mx-0">
                          
                          <div class="form-group col-md-6">
                            <label for="price">Amount($)</label>
                              <input type="number" step=".01" class="form-control text-white" value="" min="0" id="amount" placeholder="Price">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="payment_status">Payment Status</label>
                              <select class="form-control text-white" id="payment_status">
                                <option id="p_status"></option>
                                <option value="Approved">Approve</option>
                                <option value="pending">Pend</option>
                                <option value="Rejected">Reject</option>
                              </select>
                            </div>
                          </div>
                          <div class="text-danger col-md-6">
                            <mark>Note:</mark> You cannot Unapprove an already approved payment. Kindly check thoroughly before approving a payment.
                          </div>
                          <div class="my-3">
                            <b>Double-click</b> to update a payment!
                          </div>
                          <img src="../assets/images/loading.gif" style="display: none;" alt="" id="load_ing">
                          
                          <button type="button" class="btn btn-primary mr-2" id="btn" ondblclick="Update_payments(<?php echo $_GET['id']; ?>)">Update</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          
          <?php require 'inc/footer.php'; ?>
          <script>View_payment(<?php echo $_GET['id']; ?>)</script>
    <!-- End custom js for this page -->
  </body>
</html>