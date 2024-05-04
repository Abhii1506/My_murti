<?php include('layouts/header.php'); ?>
      <section id="home">
        <div class="">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span> This Season</h1>
            <p>Eshop offers the best idols for the most affordable prices</p>
            <a href="shop.php"><button>Shop Now</button></a>
        </div>
      </section>
      <section id="best" class="my-3 pb-1">
        <div class="container text-center mt-3 py-3">
          <h3>Our Bests</h3>
          <hr class="mx-auto">
          <p>Here you can check out our best products</p>
          </div>
          </section>
      </section>
      <section id="new" class="w-100">
        <div class="row p-0 m-0">
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/12.jpg">
            <div class="details">
              <h2>Extremely Awesome</h2>
              <button class="text-uppercase">Shop Now</button>
            </div>
          </div>
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/3.jpg">
            <div class="details">
              <h2>Awesome</h2>
              <button class="text-uppercase">Shop Now</button>
            </div>
          </div>
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img class="img-fluid" src="assets/imgs/6.jpg">
            <div class="details">
              <h2>50% OFF Gifts</h2>
              <button class="text-uppercase">Shop Now</button>
            </div>
          </div>
        </div>
      </section>
      <section id="features" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>My Eco</h3>
          <hr class="mx-auto">
          <p>Here you can check out our eco murti</p>
        </div>
        <div class="row mx-auto container-fluid">
          <?php include('server/get_featured_products.php');  ?>
          <?php while($row=$featured_products->fetch_assoc()){  ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
            <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>
          <?php } ?>
        </div>
      </section>
      <section id="banner" class="my-5 py-5">
        <div class="container">
          <h4>MID SEASON'S SALE</h4>
          <h1>Autum Collection <br> UPTO 30% OFF</h1>
          <button class="text-uppercase">Shop Now</button>
        </div>
      </section>
      <section id="idols" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>My Green</h3>
          <hr class="mx-auto">
          <p>Here you can check out our green murti</p>
        </div>
        <div class="row mx-auto container-fluid">
          <?php include('server/get_idols&more.php'); ?>
          <?php while($row=$idols_products->fetch_assoc()){  ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
            <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>
          <?php } ?>
        </div>
      </section>     
      <section id="gifts" class="my-5">
        <div class="container text-center mt-5 py-5">
          <h3>My Designer's</h3>
          <hr class="mx-auto">
          <p>Here you can check out our designer murti</p>
        </div>
        <div class="row mx-auto container-fluid">
        <?php include('server/get_designer.php'); ?>
          <?php while($row=$designer_products->fetch_assoc()){  ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
            <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>
          <?php } ?>
        </div>
      </section> 
<?php include('layouts/footer.php'); ?>