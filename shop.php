<?php 
include("server/connection.php");

if(isset($_POST["search"])){
  if(isset($_GET['page_no']) && $_GET['page_no'] !="" ){
    $page_no = $_GET["page_no"];
  }else{  
    $page_no = 1;
  }
    
  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt1 = $conn -> prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
  $stmt1 ->bind_param('si', $category,$price);
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1-> fetch();

  $total_records_per_page = 8;
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents ="2";
  $total_no_of_pages = ceil($total_records/ $total_records_per_page);

  $stmt2 = $conn -> prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
  $stmt2 ->bind_param("si",$category, $price);
  $stmt2 -> execute();
  $products = $stmt2->get_result();

}
else{
  if(isset($_GET['page_no']) && $_GET['page_no'] !="" ){
    $page_no = $_GET["page_no"];
  }else{  
    $page_no = 1;
  }
    
  $stmt1 = $conn -> prepare("SELECT COUNT(*) As total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1-> fetch();

  $total_records_per_page = 8;
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents ="2";
  $total_no_of_pages = ceil($total_records/ $total_records_per_page);

  $stmt2 = $conn -> prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
  $stmt2 -> execute();
  $products = $stmt2->get_result();
}
?>

<?php include('layouts/header.php'); ?>
      <section id="search" class="my-5 py-5 ms-2" style="width: 300px;">
        <div class="container mt-5 py-5">
            <p>Search Products</p>
            <hr>
        </div>
        <form action="shop.php" method="POST">
          <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <p>Category</p>
                <div class="form-check">
                  <input class="form-check-input" value="My Eco" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='My Eco' ){echo 'checked';} ?>>
                  <label class="form-check-label" for="flexRadioDefault1">
                    Ganapati
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" value="My Green" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=='My Green' ){echo 'checked';} ?>>
                  <label class="form-check-label" for="flexRadioDefault2">
                    pavale
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" value="My Designer" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=='My Designer' ){echo 'checked';} ?>>
                  <label class="form-check-label" for="flexRadioDefault2">
                    Laxmi
                  </label>
                </div>
             </div>
          </div>

          <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <p>Price</p>
              <input type="range" class="form-range w-50" name="price" value="<?php if(isset($price)){echo $price;}else{echo "25";} ?>" min="1" max="25" id="customRange2">
              <div class="w-50">
                <span style="float:left;">1</span>
                <span style="float:right;">25</span>
              </div>
            </div>
          </div>
          <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
          </div>
        </form>

      </section>
      <section id="features" class="my-5 py-5" style=" position:absolute; top:0% ; right:0% ;">
        <div class="container mt-5 py-5" style=" padding-left: 75px;">
          <h3>Our Products</h3>
          <hr>
          <p>Here you can check out our featured products</p>
        </div>
        <div class="row mx-auto container" style=" padding-left: 60px;">
          <?php while($row = $products->fetch_assoc()) {?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
            <a class="btn shop-buy-btn" href="<?php echo"single_product.php?product_id=".$row['product_id']; ?>">Buy Now</a></button>
          </div>
          
          <?php }?>
          <nav aria-label="Page navigation example">
            <ul class="pagination mt-5">
              <li class="page-item <?php if($page_no<=1) {echo 'disabled';} ?>">
                <a class="page-link" href="<?php if($page_no<=1) {echo '#';}else { echo "?page_no=".($page_no-1);}?> ">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
              <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
              
              <?php if($page_no>=3) { ?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
              <?php } ?>

              <li class="page-item o<<?php if($page_no>=$total_no_of_pages) {echo 'disabled';} ?>">
                <a class="page-link" href="<?php if($page_no>=$total_no_of_pages) {echo '#';}else { echo "?page_no=".($page_no+ 1);}?> ">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </section>
      <footer class="mt-5 py-5" style=" position: absolute; width: 100%; top: 1300px;">
        <div class="row container mx-auto pt-5">
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img class="logo" src="assets/imgs/logo.jpg">
            <p class="pt-3">We provide the best products for the most affordable prices</p>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Featured</h5>
            <ul class="text-uppercase">
              <li><a href="#">feature</a></li>
              <li><a href="#">idol</a></li>
              <li><a href="#">gift</a></li>
              <li><a href="#">fragrance</a></li>
              <li><a href="#">murti</a></li>
              <li><a href="#">new arrivals</a></li>
            </ul>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contact Us</h5>
            <div>
              <h6 class="text-uppercase">Address</h6>
              <p>1234 Street Name, City</p>
            </div>
            <div>
              <h6 class="text-uppercase">Phone</h6>
              <p>+91 9372573946</p>
            </div>
            <div>
              <h6 class="text-uppercase">Email</h6>
              <p>test1@gmail.com</p>
            </div>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Instagram</h5>
            <div class="row">
              <img src="assets/imgs/1.jpg" class="img-fluid w-25 h-100 m-2">
              <img src="assets/imgs/4.jpg" class="img-fluid w-25 h-100 m-2">
              <img src="assets/imgs/5.jpg" class="img-fluid w-25 h-100 m-2">
              <img src="assets/imgs/7.jpg" class="img-fluid w-25 h-100 m-2">
            </div>
          </div>
        </div>
        <div class="copyright mt-5">
          <div class="row container mx-auto">
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
              <img src="assets/imgs/payment.jpg">
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
              <p>eCommerce @ 2025 All Right Reserved</p>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
</body>
</html>