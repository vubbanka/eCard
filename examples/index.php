<hr />
<h2>vygenerovany button</h2>
<!-- <p>zivy button, klikni. Presne takto sa ma spravat aj plugin.</p> -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    /* INCLUDNUTIE NASEJ KNIZNICE. IMPLEMENTUJE TO PSR 4, TO ZNAMNEA ZE FUNGUJE
       AUTOLOADING NA ZAKLADE NAMESPACOV. VY NERIESITE NIC, IBA TENTO INCLUDE */
    require_once(/* CESTA K NASEJ KNIZNICI */ '../lib/autoload.php');

    $vub = new VubEcard\VubEcard(10000001 /* ID */, 'Kreslo123987' /* STORE KEY */, null, true /* SANDBOX */);

    /* NAVRATOVE URL Z BANKY (NEVIEM CI DEFINUJE POUZIVATEL ALEBO MAGENTO, JOOMLA DEFINUJE SAMA) */
    $vub->setCallbackUrlSuccesfull('http://vub.forbestclients.com/example/ok.php' /* NAVRATOVA URL DO ESHOPU V PRIPADE OK PLATBY */);
    $vub->setCallbackUrlError('http://vub.forbestclients.com/example/nok.php' /* NAVRATOVA URL DO ESHOPU V PRIPADE CHYBNEJ PLATBY */);

    /* NASTAVENIE UDAJOV O OBJEDNAVKE */
    $vub->setOrderDetails(001 /* ID OBJENAVKY */, 100.99 /* CELKOVA CENA OBJEDNAVKY */);

    /* VYGENERUJE BUTTON NA ODOSLANIE KLIENTA DO BANKY */
    echo $vub->generateForm('vubButton',
                            ['tel'=>'0123456789', 'email'=>'test@test.com', 'BillToCompany'=>'Firma nakupujuceho'],
                            ['style'=>'border:4px solid black;', 'class'=>'form-group'],
                            ['class'=>'btn-primary', 'value'=>'Zaplatit objednavku']);
