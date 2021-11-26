<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once('./_meta.php'); ?>
		<title>DEMO VUB eCard eshop | product listing</title>
	</head>
    <body class="cnt-homepage">

<?php require_once('./_header.php'); ?>

<div class="alert alert-warning container" role="alert">
	<h4>WARNING</h4>
	<p>Welcome to VUB eCard demo eshop. This eshop is only for demo purposes.</p>
<hr />

	<p><b>Step 1.</b> Proceed to cart checkout summary. On the right upper corner click on <b>"cart"</b> and continue to checkout by clicking on <b>"checkout"</b> button.</p>
</div>

<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
		<div class="homepage-container">

		<!-- ============================================== SCROLL TABS ============================================== -->
		<div id="product-tabs-slider" class="scroll-tabs inner-bottom-xs  wow fadeInUp">
			<div class="more-info-tab clearfix ">
			   <h3 class="new-product-title pull-left">Products</h3>
				<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
					<!-- <li class="active"><a href="#all" data-toggle="tab">All</a></li> -->
				</ul><!-- /.nav-tabs -->
			</div>

			<div class="tab-content outer-top-xs">

				<div class="tab-pane in active" id="all">

					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

<?php
	$products = [
		[
			'img'=>'assets/images/fashion-products/4.jpg',
			'name'=>'Simple product',
			'price'=>'650',
		],
		[
			'img'=>'assets/images/fashion-products/4.jpg',
			'name'=>'Simple product',
			'price'=>'700',
		],
		[
			'img'=>'assets/images/fashion-products/4.jpg',
			'name'=>'Simple product',
			'price'=>'250',
		],
		[
			'img'=>'assets/images/fashion-products/4.jpg',
			'name'=>'Simple product',
			'price'=>'350.33',
		],
		[
			'img'=>'assets/images/fashion-products/4.jpg',
			'name'=>'Simple product',
			'price'=>'234',
		],
		[
			'img'=>'assets/images/fashion-products/4.jpg',
			'name'=>'Simple product',
			'price'=>'250',
		]
	]

?>

		<?php foreach ($products as $key => $product) : ?>
				<div class="item item-carousel">
					<div class="products">
					<div class="product">
							<div class="product-image">
									<div class="image">
										<a href="detail.html"><img  src="assets/images/blank.gif" data-echo="<?php echo $product['img']?>" alt=""></a>
									</div><!-- /.image -->
							</div>

							<div class="product-info text-left">
								<h3 class="name"><a href="detail.html"><?php echo $product['name']  . ' ' . ++$key?></a></h3>
								<div class="product-price">
									<span class="price"><?php echo $product['price']?> &euro;</span>

								</div><!-- /.product-price -->

							</div><!-- /.product-info -->
					</div>
				</div><!-- /.products -->
			</div><!-- /.item -->
		<?php endforeach; ?>

								</div><!-- /.home-owl-carousel -->
					</div><!-- /.product-slider -->
				</div><!-- /.tab-pane -->

			</div><!-- /.tab-content -->
		</div><!-- /.scroll-tabs -->
	    <!-- ============================================== SCROLL TABS : END ============================================== -->


		  <div class="clearfix"></div>

		</div><!-- /.furniture-container -->
	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<?php require_once('./_footer.php'); ?>

<script>
	$('a').click(function(e){
		if ($(this).attr('fbc-step') == 'continue') {
			return true;
		}
		else {
			alert('Step 1. Proceed to cart checkout summary. On the right upper corner click on "cart" and continue to checkout by clicking on "checkout" button.');
			$("[fbc-step='continue']").animate({
				borderWidth: "+=5px"
		  }, 300);
			return false;
		}
	});

	$('input').click(function(e){
		if ($(this).attr('fbc-step') == 'continue') {
			return true;
		}
		else {
			alert('Step 1. Proceed to cart checkout summary. On the right upper corner click on "cart" and continue to checkout by clicking on "checkout" button.');
			$("[fbc-step='continue']").animate({
				borderWidth: "+=5px"
			}, 300);
			return false;
		}
	});

	$('button').click(function(e){
		if ($(this).attr('fbc-step') == 'continue') {
			return true;
		}
		else {
			alert('Step 1. Proceed to cart checkout summary. On the right upper corner click on "cart" and continue to checkout by clicking on "checkout" button.');
			$("[fbc-step='continue']").animate({
		    borderWidth: "+=5px"
		  }, 300);
			return false;
		}
	});
</script>



</body>
</html>
