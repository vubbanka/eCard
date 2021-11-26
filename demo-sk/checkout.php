<!DOCTYPE html>
<html lang="en">
	<head>

		<?php require_once('./_meta.php'); ?>
		<title>DEMO VÚB eCard eshop | druhý krok</title>

	</head>
    <body class="cnt-home">

		<?php require_once('./_header.php'); ?>


		<div class="alert alert-warning container" role="alert">
			<h4>Upozornenie</h4>
			<b>Krok 2.</b> Nachádzate sa v bežnom rozhraní pre zhrnutie objednávky. Kupujúci zákazník v tomto kroku poskytne potrebné informácie a pokračuje k platbe. Po kliknuti na tlačidlo
			<b>"Zaplatiť objednávku"</b> budete automaticky presmerovaný na platobnú bránu VÚB eCard riešenia. Pre uskutočnenie testovacej platby, môžete použiť údaje z poskytnutých platobných kariet nižšie.
			<br />
			<br />
			<ul>
				<li>Číslo: <b>4595980003530975</b> | CVC 001 | Expirácia: 31.8.2016 | Typ: VISA</li>
				<li>Číslo: <b>5434017298706242</b> | CVC 002 | Expirácia: 31.8.2016 | Typ: MasterCard</li>
			</ul>
		</div>

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Domov</a></li>
				<li class='active'>Objednávka</li>
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
	          <span>1</span>Informácie o objednávke
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">

			<div class="row">
				<div class="col-xs-12"><hr></div>
				<div class="col-sm-6">

					<div class="form-group">
						<label class="info-title">Meno</label>
						<input type="text" class="form-control unicase-form-control text-input" value="Ivan">
					</div>

					<div class="form-group">
						<label class="info-title">Priezvisko</label>
						<input type="text" class="form-control unicase-form-control text-input" value="Testovací">
					</div>

					<div class="form-group">
						<label class="info-title">Email</label>
						<input type="email" class="form-control unicase-form-control text-input" value="example@example.com">
					</div>

				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="info-title">Mesto</label>
						<input type="text" class="form-control unicase-form-control text-input" value="Bratislava">
					</div>

					<div class="form-group">
						<label class="info-title">Ulica</label>
						<input type="email" class="form-control unicase-form-control text-input" value="Mlynske Nivy 1">
					</div>

					<div class="form-group">
						<label class="info-title">PSČ</label>
						<input type="text" class="form-control unicase-form-control text-input" value="82013">
					</div>

				</div>
			</div>


			<div class="row">
				<div class="col-xs-12 text-right">
					<hr /><br />

					<div class="alert alert-danger text-left" role="alert">
						<h4>POZOR</h4>
						Kliknutím na <b>"Zaplatiť objednávku"</b> budete presmerovaný do <b>TESTOVACIEHO ROZHRANIA</b> platobnej brány VÚB eCard. V rozhraní prosím použite údaje z poskytnutých platobných kariet nižšie.
						<br />
						<br />
						<ul>
							<li>Číslo: <b>4595980003530975</b> | CVC 001 | Expirácia 31.8.2016 | Typ: VISA</li>
							<li>Číslo: <b>5434017298706242</b> | CVC 002 | Expirácia 31.8.2016 | Typ: MasterCard</li>
						</ul>
					</div>
					<?php
					  require_once('../lib/autoload.php');

					  $vub = new VubEcard\VubEcard(10000001, 'Kreslo123987', null, true);

						$vub->setCallbackUrlSuccesfull('http://vub.forbestclients.com/demo-sk/ok.php');
						$vub->setCallbackUrlError('http://vub.forbestclients.com/demo-sk/fail.php');

					  $vub->setOrderDetails((int)('001' . time()), 1);

					  echo $vub->generateForm('vubButton', [], [], ['value'=>'Zaplatiť objednávku', 'class'=>'btn btn-primary', 'fbc-step'=>'pay']);
					?>
<hr />
<div class="alert alert-info text-left" role="alert">
	<h4>Príklad</h4>
	<p>Príklad bol vygenerovaný knižnicou v jazyku <b>PHP</b>. Nasleduje ukážka volania knižnice, ktorá je potrebná na vygenerovanie tlačidla "Zaplatiť objednávku".</p>
<pre class="text-left">
require_once('../lib/autoload.php');

$vub = new VubEcard\VubEcard(10000001, 'Kreslo123987', null, true);

$vub->setCallbackUrlSuccesfull('http://vub.forbestclients.com/demo-sk/ok.php');
$vub->setCallbackUrlError('http://vub.forbestclients.com/demo-sk/fail.php');

$vub->setOrderDetails((int)('001' . time()), 1);

echo $vub->generateForm('vubButton', [], [], ['value'=>'Zaplatiť objednávku', 'class'=>'btn btn-primary', 'fbc-step'=>'pay']);
</pre>
<p>Uvedených 6 riadkov je potrebných pre kompletnú integráciu platieb VÚB eCard pomocou programovacieho jazyka PHP.</p>
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
		    	<h4 class="unicase-checkout-title">Objednané produkty</h4>
		    </div>
		    <div class="panel-body">
					<div class="row">
						<div class="col-xs-3">
							<div class="image">
								<a href="detail.html"><img src="assets/images/cart.jpg" alt=""></a>
							</div>
						</div>
						<div class="col-xs-9">

							<h3 class="name"><a href="index.php?page-detail">Vzorový produkt</a></h3>
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
			alert('Krok 2. Pokračujte kliknutím na tlačidlo "Zaplatiť objednávku". Následne budete presmerovaný na testovaciu platobnú bránu eCard od VÚB banky.');
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
			alert('Krok 2. Pokračujte kliknutím na tlačidlo "Zaplatiť objednávku". Následne budete presmerovaný na testovaciu platobnú bránu eCard od VÚB banky.');
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
			alert('Krok 2. Pokračujte kliknutím na tlačidlo "Zaplatiť objednávku". Následne budete presmerovaný na testovaciu platobnú bránu eCard od VÚB banky.');
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
