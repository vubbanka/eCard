<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 ?>

<h1>OK</h1>
<pre>

<?php
  require_once(/* CESTA K NASEJ KNIZNICI */ '../lib/autoload.php');

  $vub = new VubEcard\VubEcard(
                    10741501 /* ID */,
                    'KReslo123' /* STORE KEY */,
                    null, true /* SANDBOX */);

  if ($vub->validateResponse($_POST)) {
    echo 'ok';
  }
  else {
    echo 'chyba';
  };
