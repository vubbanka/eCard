<!DOCTYPE html>
<html lang="en">
	<head>

		<?php require_once('./_meta.php'); ?>
		<title>DEMO VUB eCard eshop | cart checkout</title>

	</head>
    <body class="cnt-home">

		<?php require_once('./_header.php'); ?>


		<div class="alert alert-warning container" role="alert">
			<h4>WARNING</h4>
			<b>Step 2.</b> Common cart summary step in eshops. Your customer will provide his information. After clicking on
			<b>"Pay order using VUB eCard"</b> you will be redirected to VUB eCard payment gate. For testing purposes, you can use one of provided cards below.
			<br />
			<br />
			<ul>
				<li>NO. <b>4595980003530975</b> | CVC 001 | Exp. 8/31/16 | Type: VISA</li>
				<li>NO. <b>5434017298706242</b> | CVC 002 | Exp. 8/31/16 | Type: MasterCard</li>
			</ul>
		</div>

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./index.php">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="checkout-box inner-bottom-sm">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	          <span>1</span>Checkout Method
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">

				<!-- guest-login -->
				<div class="col-md-6 col-sm-6 guest-login">
					<h4 class="checkout-subtitle">Checkout as a Guest or Register Login</h4>
					<p class="text title-tag-line">Register with us for future convenience:</p>

					<!-- radio-form  -->
					<form class="register-form" role="form">
					    <div class="radio radio-checkout-unicase">
					        <input id="guest" type="radio" name="text" value="guest" checked>
					        <label class="radio-button guest-check" for="guest">Checkout as Guest</label>
					          <br>
					        <input id="register" type="radio" name="text" value="register">
					        <label class="radio-button" for="register">Register</label>
					    </div>
					</form>
					<!-- radio-form  -->

				</div>
				<!-- guest-login -->

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle">Register and save time</h4>
					<p class="text title-tag-line ">Register with us for future convenience:</p>

					<ul class="text instruction inner-bottom-30">
						<li class="save-time-reg">- Fast and easy check out</li>
						<li>- Easy access to your order history and status</li>
					</ul>
				</div>
				<!-- already-registered-login -->

			</div>

			<div class="row">
				<div class="col-xs-12"><hr></div>
				<div class="col-sm-6">

					<div class="form-group">
						<label class="info-title">Name</label>
						<input type="text" class="form-control unicase-form-control text-input" value="Ivan">
					</div>

					<div class="form-group">
						<label class="info-title">Surname</label>
						<input type="text" class="form-control unicase-form-control text-input" value="Kopcik">
					</div>

					<div class="form-group">
						<label class="info-title">Email</label>
						<input type="email" class="form-control unicase-form-control text-input" value="example@example.com">
					</div>

				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="info-title">City</label>
						<input type="text" class="form-control unicase-form-control text-input" value="Bratislava">
					</div>

					<div class="form-group">
						<label class="info-title">Street</label>
						<input type="email" class="form-control unicase-form-control text-input" value="Mlynske Nivy 1">
					</div>

					<div class="form-group">
						<label class="info-title">ZIP</label>
						<input type="text" class="form-control unicase-form-control text-input" value="82013">
					</div>

				</div>
			</div>


			<div class="row">
				<div class="col-xs-12 text-right">
					<hr /><br />

					<div class="alert alert-danger text-left" role="alert">
						<h4>DANGER</h4>
						By clicking on button, you will be redirected to VUB eCard payment gate. This is <b>TEST ENVIRONMENT</b> for demo purposes, please use one of provided cards.
						<br />
						<br />
						<ul>
							<li>NO. <b>4595980003530975</b> | CVC 001 | Exp. 8/31/16 | Type: VISA</li>
							<li>NO. <b>5434017298706242</b> | CVC 002 | Exp. 8/31/16 | Type: MasterCard</li>
						</ul>
					</div>
					<?php
						error_reporting(E_ALL);
						ini_set('display_errors', 1);

					  require_once('../lib/autoload.php');

					  $vub = new VubEcard\VubEcard(10000001, 'Kreslo123987', null, true);

						$vub->setCallbackUrlSuccesfull('http://vub.forbestclients.com/demo/ok.php');
						$vub->setCallbackUrlError('http://vub.forbestclients.com/demo/fail.php');

					  $vub->setOrderDetails((int)('001' . time()), 1);

					  echo $vub->generateForm('vubButton', [], [], ['value'=>'Pay order using VUB eCard', 'class'=>'btn btn-primary', 'fbc-step'=>'pay']);
					?>
<hr />
<div class="alert alert-info text-left" role="alert">
	<h4>DANGER</h4>
	<p>Example of used <b>PHP</b> code for generating pay button "Pay order using VUB eCardPay order using VUB eCard"</p>
<pre class="text-left">
require_once('../lib/autoload.php');

$vub = new VubEcard\VubEcard(10000001, 'Kreslo123987', null, true);

$vub->setCallbackUrlSuccesfull('http://vub.forbestclients.com/demo/ok.php');
$vub->setCallbackUrlError('http://vub.forbestclients.com/demo/fail.php');

$vub->setOrderDetails((int)('001' . time()), 1);

echo $vub->generateForm('vubButton', [], [], ['value'=>'Pay order using VUB eCard', 'class'=>'btn btn-primary', 'fbc-step'=>'pay']);
</pre>
</alert>

				</div>
			</div>
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->


					</div><!-- /.checkout-steps -->
				</div>
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Ordered Items (1 item)</h4>
		    </div>
		    <div class="panel-body">
					<div class="row">
						<div class="col-xs-3">
							<div class="image">
								<a href="detail.html"><img src="assets/images/cart.jpg" alt=""></a>
							</div>
						</div>
						<div class="col-xs-9">

							<h3 class="name"><a href="index.php?page-detail">Simple Product</a></h3>
							<div class="price">1 &euro;</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
<!-- checkout-progress-sidebar -->				</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
			</div><!-- /.container -->
</div><!-- /.body-content -->

<?php require_once('./_footer.php'); ?>

<script>
	$('a').click(function(e){
		if ($(this).attr('fbc-step') == 'pay') {
			return true;
		}
		else {
			alert('Countinue by clicking "Pay order using VUB eCard" button. The button is located in the bottom of information form.');
			$("[fbc-step='pay']").animate({
				width: "+=15px",
				height: "+=15px"
		  }, 300);
			return false;
		}
	});

	$('input').click(function(e){
		if ($(this).attr('fbc-step') == 'pay') {
			return true;
		}
		else {
			alert('Countinue by clicking "Pay order using VUB eCard" button. The button is located in the bottom of information form.');
			$("[fbc-step='pay']").animate({
				width: "+=15px",
				height: "+=15px"
			}, 300);
			return false;
		}
	});

	$('button').click(function(e){
		if ($(this).attr('fbc-step') == 'pay') {
			return true;
		}
		else {
			alert('Countinue by clicking "Pay order using VUB eCard" button. The button is located in the bottom of information form.');
			$("[fbc-step='pay']").animate({
		    width: "+=15px",
				height: "+=15px"
		  }, 300);
			return false;
		}
	});
</script>

</body>
</html>
