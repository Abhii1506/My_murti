<?php
include('connection.php');

$stmt=$conn->prepare("SELECT * FROM products WHERE product_category='My Green' LIMIT 4");

$stmt->execute();

$idols_products=$stmt->get_result();


?>