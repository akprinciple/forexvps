<?php
    require 'inc/session.php';
    header('Content-Type: Application/json');
   
    // Main Wallet Balance
    $query = mysqli_query($connect, "SELECT SUM(amount) AS total FROM wallet");
    $row = mysqli_fetch_array($query);
    $balance = $row['total'];
    $amount = number_format($balance, 2);
    $wallet_balance = number_format($amount,2);

    // Affiliate Wallet Balance
    $aff_query = mysqli_query($connect, "SELECT SUM(amount) AS total FROM affiliate_wallet");
    $row = mysqli_fetch_array($aff_query);
    $aff_balance = $row['total'];
    $affiliate_wallet_balance = number_format($aff_balance,2);

   
    // Amount Spent
    $query = mysqli_query($connect, "SELECT SUM(payment_amount) AS total FROM payments 
    WHERE payment_status='Approved'");
    $row = mysqli_fetch_array($query);
    $transactions = $row['total'];
    $total_amount_spent = number_format($transactions, 2);

    // Amount Withdrawn
    $with_query = mysqli_query($connect, "SELECT SUM(amount) AS total FROM withdrawal 
    WHERE with_status='Approved'");
    $row = mysqli_fetch_array($with_query);
    $with_transactions = $row['total'];
    $total_amount_withdrawn = number_format($with_transactions, 2);


    // No of approved subscriptions
    $pay = mysqli_query($connect, "SELECT COUNT(*) AS sum FROM subscriptions 
    WHERE sub_status ='Activated'");
    $rw = mysqli_fetch_array($pay);
    $withdrawal = $rw['sum'];
    $activated_sub = number_format($withdrawal);

    // No of Pending Withdrawals
    $with = mysqli_query($connect, "SELECT COUNT(*) AS num FROM withdrawal 
    WHERE with_status ='pending'");
    $rw = mysqli_fetch_array($with);
    $withdraw = $rw['num'];
    $pending_withdrawal = number_format($withdraw);

// No of Active VPS
    $sql = mysqli_query($connect, "SELECT COUNT(*) AS v FROM vps 
    WHERE status ='Active'");
    $rw = mysqli_fetch_array($sql);
    
    $vps = number_format($rw['v']);

    $message = ["data" =>[
        "wallet_balance" => $wallet_balance,
        "affiliate_wallet_balance" => $affiliate_wallet_balance,
        "amount_spent" => $total_amount_spent,
        "amount_withdrawn" => $total_amount_withdrawn,
        "activated_sub" => $activated_sub,
        "pending_withdrawal" => $pending_withdrawal,
        "vps" => $vps
        
        ]];
echo json_encode($message);