<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Virtual Private Server | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Available VPS</h4>
            <img src="../assets/images/loading.gif" alt="loading..." id="loading">
            <div class="row mx-0 justify-content-center" id="vps">
                
                
            </div>

        </div>
        </div>
          
          <?php require 'inc/footer.php'; ?>
          <script>Vps()</script>
    <!-- End custom js for this page -->
  </body>
</html>