# VUB eCard extension PHP

## Package contents

### Documentation folder

Contains technical documentation for extension. Documentation has been generated from extension's code by [apigen](http://www.apigen.org). Folder consists of versions.

### Examples folder

Basic simple PHP examples of usage. Folder contains 3 files. File *index.php* which constructs the form and 2 callback files. File *ok.php* for successfull reply from bank and file *nok.php* for error response.

### Lib folder

Actual classes for extension. Contains base classes and helpers. For successfull implementation you have to include *autoload.php* in your application.

### Logs folder

Errors, warnings and notices are and can be logged into this folder. Each error type will be in separate file corresponds to ints type.

### Test cases folder

Contains VUB bank test cases with demo cards. You can use them for testing.

### Tutorial folder

Contains HTML page, with basic info about instalation

## Installation

1. Include autoload file in your project
2. Set authorization properties (Client ID and Store Key)
3. Provide callback url (for recieving response from bank)
4. Build form with containing button <tt>echo $vub->generateForm('vubButton');</tt>.

## Usage

### Inicialization
``` php
<?php
require_once('PATH/TO/autoload.php');

$vub = new VubEcard\VubEcard(CLIENT_ID, STORE_KEY);

/* SET OK URL */
$vub->setCallbackUrlSuccesfull('http://yourpage.domain/ok');

/* SET ERROR URL */
$vub->setCallbackUrlError('http://yourpage.domain/fail')
```

### Generating request button
```php
/* SETUP ORDER INFO */
$vub->setOrderDetails(123456 /* ORDER ID */, 10.99 /* ORDER PRICE */);

/* GENERATE FORM + BUTTON */
echo $vub->generateForm(
  'vubButton',  //FORM NAME
  [],           //ADDITIONAL INFO (CUSTOMER NAME, CUSTOMER PHONE, CUSTOMER LOCATION, ...)
  [],           //HTML ATTRIBUTES OF FORM
  []            //HTML ATTRIBUTES OF FORM BUTTON (PAY BUTTON)
  );
```

### Receiving and validating response
```php
<?php
  $vub = new VubEcard\VubEcard(CLIENT_ID, STORE_KEY);
  echo $vub->validateResponse($_POST) ? 'ok' : 'fail';
```

# Copyright
Copyright (c) 2021, [For Best Clients, s.r.o.](https://www.forbestclients.com)
