<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once('./_meta.php'); ?>
		<title>DEMO VUB eCard eshop | response error</title>

	</head>
    <body class="cnt-home">

			<?php require_once('./_header.php'); ?>

			<div class="alert alert-warning container" role="alert">
				<h4>WARNING</h4>
				<b>Step 4.</b> Error occured during a process of payment. This can be caused by wrong expiration date, wrong cvc etc... Customer is correctly redirected to fail url.
			</div>

				<div class="body-content outer-top-bd">
					<div class="container">
						<div class="x-page inner-bottom-sm">
							<div class="row">
								<div class="col-md-12 x-text text-center">
									<h1>Error</h1>
									<p>Unfortunately your payment contains an error. Please contact administrator.</p>
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
