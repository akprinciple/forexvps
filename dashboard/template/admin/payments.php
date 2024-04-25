<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Payments | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        <div class="col-lg-12 grid-margin stretch-card" style="margin-top: 50px;">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Payments</h4>
                    
                    <div class="table-responsive">
                    <img src="../assets/images/loading.gif" alt="" id="loading">

                      <table class="table text-white table-bordered">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Client</th>
                            <th class="text-center">Amount(USD)</th>
                            <th>Method</th>
                            <th>Date/Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody id="vps">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>  
</div>
          <?php require 'inc/footer.php'; ?>
          <script>Payments()</script>
    <!-- End custom js for this page -->
  </body>
</html>