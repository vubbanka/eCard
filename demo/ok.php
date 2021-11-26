<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once('./_meta.php'); ?>
		<title>DEMO VUB eCard eshop | response ok</title>
	</head>
	<body class="cnt-home">

		<?php require_once('./_header.php'); ?>

			<div class="alert alert-warning container" role="alert">
				<h4>WARNING</h4>
				<b>Step 4.</b> Everything was succesfull. VUB eCard payment gate made succesfull payment and send customer to succesfull url.
			</div>

			<div class="body-content outer-top-bd">
				<div class="container">
					<div class="x-page inner-bottom-sm">
						<div class="row">
							<div class="col-md-12 x-text text-center">
								<h2>Thank you!</h2>
								<p>Your paymant was succesfull.</p>
								<a href="./index.php"><i class="fa fa-home"></i> Go To Homepage</a>
							</div>
						</div><!-- /.row -->
					</div><!-- /.sigin-in-->
				</div><!-- /.container -->
			</div><!-- /.body-content -->

		<?php require_once('./_footer.php'); ?>

<script>
$('a').click(function(e){
	alert('Thank you for testing VUB eCard payments');
	return false;
});

$('input').click(function(e){
	alert('Thank you for testing VUB eCard payments');
	return false;
});

$('button').click(function(e){
	alert('Thank you for testing VUB eCard payments');
	return false;
});
</script>

</body>
</html>
