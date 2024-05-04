<?php
session_start();
include("connection.php");

if(isset($_GET['transaction_id']) && isset( $_GET['order_id']))
 {
    $order_id = $_GET['order_id'];
    $order_status = 'paid';
    $transaction_id = $_GET['transaction_id'];
    $user_id = $_SESSION['user_id'];
    $payment_date = date('Y-m-d H:i:s');

    $stmt = $conn ->prepare("UPDATE orders SET order_status=? WHERE order_id =?");
    $stmt ->bind_param("si",$order_status ,$order_id);
    $stmt -> execute();

    $stmt1 = $conn ->prepare("INSERT INTO  payments(order_id,user_id,transaction_id,payment_date) 
                     VALUES (?,?,?,?); ");
    $stmt1 ->bind_param("iiss", $order_id, $user_id, $transaction_id, $payment_date);
    $stmt1 -> execute();
    header("location: ../account.php?payment_message=Paid successfully, thank you for shopping with us");
}
else {
    header("location: index.php");
    exit;
}
