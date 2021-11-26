<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(/* CESTA K NASEJ KNIZNICI */ '../lib/autoload.php');?>

<h1>CHYBA</h1>
<pre>

<?php
  $vub = new VubEcard\VubEcard(10741501 /* ID */, 'KReslo123' /* STORE KEY */, null, true /* SANDBOX */);
  var_dump($vub->validateResponse($_POST));
  var_dump($_POST);
