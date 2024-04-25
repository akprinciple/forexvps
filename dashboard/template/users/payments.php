<?php require '../../api/inc/accounts.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Fund Wallet | Myfxvpsm</title>
    <?php require 'inc/toplink.php'; ?>
    <style>
      /* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 0px;
    border: 1px solid #ccc;
    border-top: none;
}
    </style>
</head>
  <body>
      <!-- partial:partials/_sidebar.html -->
        <?php require 'inc/sidebar.php' ?>
        
        <!-- partial -->
        <div class="main-panel" style="padding-top: 10px;">
          <div class="content-wrapper">
            <h3 class="mt-3">Fund your wallet </h3>
        <div class="tab">
          <button class="tablinks active" onclick="openCity(event, 'London')">Local Bank Transfer</button>
          <button class="tablinks" onclick="openCity(event, 'Paris')">USDT</button>
          <button class="tablinks" onclick="openCity(event, 'Tokyo')">Bitcoin</button>
        </div>

        <div id="London" class="tabcontent" style="display: block;">
        <div class="col-12 grid-margin stretch-card p-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Local Bank Transfer</h4>
                    <!-- <p class="card-description"> Basic form elements </p> -->
                    <form class="forms-sample">
                    <div class="form-group">
                        <label for="bank_amount">Amount($)</label>
                        <input type="number" step=".01" class="form-control text-white" value="0" min="0" 
                        id="bank_amount" placeholder="Amount in USD" onkeydown="Convert1()">
                      </div>
                        <img src="../assets/images/loading.gif" alt="" id="loading" style="display: none;">

                      <div class="form-group">
                        <label for="converted_amount">Amount in Naira(&#8358)</label>
                        <input type="number" disabled class="form-control text-dark" min="0" value="0" id="converted_amount" placeholder="Amount in Naira">
                      </div>
                        <div class="form-group">
                      <label for="">Bank Name</label>
                        <input type="text" disabled class="form-control text-dark" 
                        value="<?php echo $bank_name; ?>" placeholder="<?php echo $bank_name; ?>">
                      </div>
                      
                     <div class="form-group">
                      <label for="">Bank Account Number</label>
                        <input type="text" disabled class="form-control text-dark" 
                        value="<?php echo $account_number; ?>" placeholder="<?php echo $account_number; ?>">
                    </div>

                    <div class="form-group">
                      <label for=""> Account Name</label>
                        <input type="text" disabled class="form-control text-dark" 
                        value="<?php echo $account_name; ?>" placeholder="<?php echo $account_name; ?>">
                    </div>

                    <div class="form-group">
                      <label for="">Upload </label>
                        <input type="file"  class="form-control" accept="image/*" id="image">
                    </div>
                    <img src="../assets/images/loading.gif" style="display: none;" alt="" id="load_ing">

                      <button type="button" class="btn btn-primary mr-2" id="btn" onclick="Bank_Payment()">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        

        <div id="Paris" class="tabcontent">
        <div class="col-12 grid-margin stretch-card p-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Fund using USDT</h4>
                    <!-- <p class="card-description"> Basic form elements </p> -->
                    <form class="forms-sample">
                    <div class="form-group">
                        <label for="usdt_amount">Amount($)</label>
                        <input type="number" step=".01" class="form-control text-white" value="0" min="0" 
                        id="usdt_amount" placeholder="Amount in USD">
                      </div>
                        <div class="form-group">
                      <label for="">USDT Wallet Address</label>
                        <input type="text" disabled class="form-control text-dark" 
                        value="<?php echo $usdt_wallet; ?>" placeholder="<?php echo $usdt_wallet; ?>">
                      </div>
                    <div class="form-group">
                      <label for="">Upload </label>
                        <input type="file"  class="form-control" accept="image/*" id="usdt_image">
                    </div>
                    <img src="../assets/images/loading.gif" style="display: none;" alt="" id="usdt_loading">

                      <button type="button" class="btn btn-primary mr-2" id="usdt_btn" onclick="Usdt_Payment()">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>

        <div id="Tokyo" class="tabcontent">
        <div class="col-12 grid-margin stretch-card p-0">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Fund using Bitcoin</h4>
                    <!-- <p class="card-description"> Basic form elements </p> -->
                    <form class="forms-sample">
                    <div class="form-group">
                        <label for="btc_amount">Amount($)</label>
                        <input type="number" step=".01" class="form-control text-white" value="0" min="0" 
                        id="btc_amount" placeholder="Amount in USD">
                      </div>
                        <div class="form-group">
                      <label for="">Bitcoin Wallet Address</label>
                        <input type="text" disabled class="form-control text-dark" 
                        value="<?php echo $bitcoin_wallet; ?>" placeholder="<?php echo $bitcoin_wallet; ?>">
                      </div>
                    <div class="form-group">
                      <label for="">Upload </label>
                        <input type="file"  class="form-control" accept="image/*" id="btc_image">
                    </div>
                    <img src="../assets/images/loading.gif" style="display: none;" alt="" id="btc_loading">

                      <button type="button" class="btn btn-primary mr-2" id="btc_btn" onclick="Btc_Payment()">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        </div>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>

          </div>
          </div>
          <?php require 'inc/footer.php'; ?>
          
    <!-- End custom js for this page -->
  </body>
</html>