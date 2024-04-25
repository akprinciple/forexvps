<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');
   
    // Main Wallet Balance
    $query = mysqli_query($connect, "SELECT * FROM wallet 
    WHERE user_id = '{$_SESSION['id']}'");
    $row = mysqli_fetch_array($query);
    $balance = $row['amount'];
    $amount = number_format($balance, 2);
    $wallet_balance = number_format($amount,2);

    // Affiliate Wallet Balance
    $aff_query = mysqli_query($connect, "SELECT * FROM affiliate_wallet 
    WHERE user_id = '{$_SESSION['id']}'");
    $row = mysqli_fetch_array($aff_query);
    $aff_balance = $row['amount'];
    $affiliate_wallet_balance = number_format($aff_balance,2);

   
    // Amount Spent
    $query = mysqli_query($connect, "SELECT SUM(payment_amount) AS total FROM payments 
    WHERE payment_status='Approved' && user_id = '{$_SESSION['id']}'");
    $row = mysqli_fetch_array($query);
    $transactions = $row['total'];
    $total_amount_spent = number_format($transactions, 2);

    // Amount Withdrawn
    $with_query = mysqli_query($connect, "SELECT SUM(amount) AS total FROM withdrawal 
    WHERE with_status='Approved' && user_id = '{$_SESSION['id']}'");
    $row = mysqli_fetch_array($with_query);
    $with_transactions = $row['total'];
    $total_amount_withdrawn = number_format($with_transactions, 2);


    // No of approved Payments
    $pay = mysqli_query($connect, "SELECT COUNT(*) AS sum FROM payments 
    WHERE payment_status='approved' && user_id = '{$_SESSION['id']}'");
    $rw = mysqli_fetch_array($pay);
    $withdrawal = $rw['sum'];
    $approved_payments = number_format($withdrawal);


    $message = ["data" =>[
        "wallet_balance" => $wallet_balance,
        "affiliate_wallet_balance" => $affiliate_wallet_balance,
        "amount_spent" => $total_amount_spent,
        "amount_withdrawn" => $total_amount_withdrawn,
        
        ]];
echo json_encode($message);