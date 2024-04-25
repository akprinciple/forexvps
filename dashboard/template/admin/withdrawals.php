<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Affiliate Withdrawals | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        <br>
        <br>
        <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Withdrawal Requests</h4>
                    
                    
                    <div class="table-responsive">
                    <img src="../assets/images/loading.gif" alt="" id="loading">

                      <table class="table text-white">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Account Details</th>
                            <th>Amount(USD)</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
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
          <?php require 'inc/footer.php'; ?>
          <script>Withdrawal_history()</script>
          
    <!-- End custom js for this page -->
  </body>
</html>