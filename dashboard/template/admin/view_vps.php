<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title> Edit VPS | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit VPS</h4>
                    <img src="../assets/images/loading.gif" alt="" id="loading">
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
                        <label for="status">Status</label>
                        <select class="form-control text-white" id="vps_status">
                          <option id="current_status"></option>
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control text-white" placeholder="Describe the Virtual Private Server" id="description" rows="10"></textarea>
                      </div>
                    <img src="../assets/images/loading.gif" style="display: none;" alt="" id="load_ing">

                      <button type="button" class="btn btn-primary mr-2" id="btn" onclick="Update_vps(<?php echo $_GET['id']; ?>)">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          
          <?php require 'inc/footer.php'; ?>
          <script>ViewVPS(<?php echo $_GET['id']; ?>)</script>
    <!-- End custom js for this page -->
  </body>
</html>