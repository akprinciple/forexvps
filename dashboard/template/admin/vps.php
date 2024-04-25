<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Add VPS | Myfxvpsm</title>
    <script src="../assets/js/admin_session.js"></script>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        
          <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add VPS</h4>
                    <!-- <p class="card-description"> Basic form elements </p> -->
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="name">VPS Name</label>
                        <input type="text" class="form-control text-white" id="vps" placeholder="VPS Name">
                      </div>
                      <div class="form-group">
                        <label for="price">Original Price($)</label>
                        <input type="number" step=".01" class="form-control text-white" value="0" min="0" id="price" placeholder="Price">
                      </div>
                      <div class="form-group">
                        <label for="old_price">Old Price($)</label>
                        <input type="number" class="form-control text-white" min="0" value="0" id="old_price" placeholder="Old Price">
                      </div>
                      
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control text-white" placeholder="Describe the Virtual Private Server" id="description" rows="10"></textarea>
                      </div>
                    <img src="../assets/images/loading.gif" style="display: none;" alt="" id="loading">

                      <button type="button" class="btn btn-primary mr-2" id="btn" onclick="AddVPS()">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <?php require 'inc/footer.php'; ?>
          <script></script>
    <!-- End custom js for this page -->
  </body>
</html>