<!DOCTYPE html>
<html lang="en">
	<head>
		<?php require_once('./_meta.php'); ?>
		<title>DEMO VUB eCard eshop | response ok</title>
	</head>
	<body class="cnt-home">

		<?php require_once('./_header.php'); ?>

			<div class="alert alert-warning container" role="alert">
				<h4>Upozornenie</h4>
				<b>Krok 4.</b> Všetko prebehlo v poriadku. VÚB platobná brána zaznamenala úspešnú platbu a boli ste presmerovaný späť na demo eshop.
			</div>

			<div class="body-content outer-top-bd">
				<div class="container">
					<div class="x-page inner-bottom-sm">
						<div class="row">
							<div class="col-md-12 x-text text-center">
								<h2>Ďakujeme</h2>
								<p>Vaša platba prebehla úspešne</p>
								<a href="./index.php"><i class="fa fa-home"></i> Pokračovať späť na hlavnú stránku</a>
							</div>
						</div><!-- /.row -->
					</div><!-- /.sigin-in-->
				</div><!-- /.container -->
			</div><!-- /.body-content -->

		<?php require_once('./_footer.php'); ?>

<script>
$('a').click(function(e){
	alert('Ďakujeme, Vaše testovanie je uspešne ukončené');
	return false;
});

$('input').click(function(e){
	alert('Ďakujeme, Vaše testovanie je uspešne ukončené');
	return false;
});

$('button').click(function(e){
	alert('Ďakujeme, Vaše testovanie je uspešne ukončené');
	return false;
});
</script>

</body>
</html>
