<?php 
session_start();
if(isset($_POST['order_pay_btn'])){
  $order_status = $_POST['order_status'];
  $order_total_price = $_POST['order_total_price'];
}
?>
<?php include('layouts/header.php'); ?>
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
        <?php  if(isset($_POST['order_status']) && $_POST['order_status'] == "Not Paid" ){ ?>
                  <?php $amount = strval($_POST['order_total_price']); ?> 
                  <?php $order_id = $_POST['order_id']; ?>
                   <p>Total payment:$ <?php echo $_POST['order_total_price']; ?></p> 
                   <!--input class="btn btn-primary" type="submit" value="Pay Now"/-->
                   <div id="paypal-button-container" style="padding-left: 21.5%;"></div>

          <?php } else if(isset($_SESSION['total']) && $_SESSION['total']!= 0 ) { ?>
              <?php $amount = strval($_SESSION['total']); ?>
              <?php $order_id = $_SESSION['order_id']; ?>
                <p>Total payment:$ <?php echo $_SESSION['total']; ?></p> 
                <!--input class="btn btn-primary" type="submit" value="Pay Now"/-->
                <div id="paypal-button-container" style="padding-left: 21.5%;"></div> 

          <?php }else { ?>
                   <p>You don't have an order</p>
          <?php } ?>
        </div>
      </section>
      <script src="https://www.paypal.com/sdk/js?client-id=ATmu4nJC1XWl9UTRuOHHG8N6AsrJWBq6TBGa2huSuo-vmt5uGN2NyQewgV7K-Sr8fCzMs_aoRdvYfq37&currency=USD"></script>
      <script>
        paypal.Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: '<?php echo $amount; ?>'
                }
              }]
            });
          },
          onApprove: function(data, actions){
            return actions.order.capture().then(function(orderData){
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
              var transaction = orderData.purchase_units[0].payments.captures[0];
              alert('Transaction'+ transaction.status + ':' + transaction.id +'\n\n See console for all available details' );
              window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id; ?>;
            });
          }
        }).render('#paypal-button-container');
      </script>
<?php include('layouts/footer.php'); ?>w