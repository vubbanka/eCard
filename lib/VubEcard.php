<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard;

use VubEcard\helpers\VubEcardTransactionType;
use VubEcard\helpers\VubEcardLanguage;
use VubEcard\helpers\VubEcardStoreType;
use VubEcard\helpers\HtmlHelper;

/**
* Provides access to the VUB eCard API. This class provides
* all necessary functionality for creating and handling requests. It is
* also able to build HTML form.
*
* @throws VubException
*
* @author For Best Clients, s.r.o. <info@forbestclients.com>
* @author <http://www.forbestclients.com>
*/
class VubEcard
{
    const HASH_PARAM_DELIMETER = "|";
    const DEFAULT_CURRENCY_CODE = 978; //ISO 4217 CURRENCY CODE
    const HASH_ALGORYTHM_VER_2 = 'Ver2';

    const APPROVED_RESPONSE = "Approved";

    const DEFAULT_TEST_ORDER_ID = 999999;
    const DEFAULT_TEST_ORDER_AMOUNT = 123321;

    /**
     * Base VUB eCard client ID
     * @var int
     */
    protected $VUBClientId;

    /**
     * Base VUB eCard store Key
     * @var string
     */
    protected $VUBStoreKey;

    /**
     * callback url for successful request
     * @var string
     */
    protected $callbackUrlSuccesfull;

    /**
     * callback url for unsuccessful request
     * @var string
     */
    protected $callbackUrlError;

    /**
     * Basic payment gate url. In the time of implementation where those:
     * test env: https://testsecurepay.eway2pay.com/fim/est3dgate
     * production: https://vub.eway2pay.com/fim/est3dgate
     *
     * @var string
     */
    protected $urlPaymentGate;

    // INIT
    protected $configTransactionType;
    protected $configLanguage;
    protected $storeType;

    /**
     * External eshop Order ID
     * @var mixed
     */
    protected $orderId;

    /**
     * External eshop order amount
     * @var number
     */
    protected $orderAmount;

    protected $rnd;
    protected $currency = self::DEFAULT_CURRENCY_CODE; // Numerical code of currency ISO 4217

    //-------- OLD
    protected $msAuthType = '';
    protected $msKey = '';

    protected $installment = '';// number of installment, TODO we don't have implemented payment by installment
    protected $hashAlgorithm = self::HASH_ALGORYTHM_VER_2;       //version of a sent hash

    public $errors = array();
    // private $allowedOptionalParams = [
    //   'tel', 'email',
    //   'BillToName', 'BillToStreet1', 'BillToCity', 'BillToPostalCode',
    //   'ShipToName', 'ShipToStreet1', 'ShipToCity', 'ShipToPostalCode', 'BillToCompany'
    // ];

    /**
    * Constructs base VubEcard class and sets all necessary variables
    *
    * @param int $clientId ClientID provided by VUB bank.
    * @param string $storeKey Store Key provided by VUB bank.
    * @param string $int currency ISO 4217 Currency code https://en.wikipedia.org/wiki/ISO_4217
    * @param bool $test True for test environment, false for production. Default false
    * @return void
    */
    public function __construct($clientId, $storeKey, $currency = null, $test = false)
    {
      $this->VUBClientId = $clientId;
      $this->VUBStoreKey = $storeKey;
      $this->rnd = substr(hash('sha256', microtime() . $storeKey . $currency . rand(0,100)), 0, 20);

      if ($currency === null) {
        $this->currency = self::DEFAULT_CURRENCY_CODE;
      }
      else {
        $this->currency = $currency;
      }

      if ($test) {
        $this->urlPaymentGate = "https://testsecurepay.eway2pay.com/fim/est3dgate";
      } else {
        $this->urlPaymentGate = "https://vub.eway2pay.com/fim/est3dgate";
      }

      $this->configTransactionType = VubEcardTransactionType::getDefaultValue();
      $this->configLanguage = VubEcardLanguage::getDefaultValue();
      $this->storeType = VubEcardStoreType::getDefaultValue();
    }

    /**
     * Returns VUB client ID.
     *
     * @return int Previously set VUB client ID
     */
    public function getClientId() {
      return $this->VUBClientId;
    }

    /**
     * Returns VUB Store Key value
     *
     * @return string Previously set VUB store key
     */
    public function getStoreKey() {
      return $this->VUBStoreKey;
    }

    /**
     * Set main payment gate url
     *
     * @param string $url Url provided by bank
     */
    public function setUrlPaymentGate($url)
    {
      if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
      }

      return $this->urlPaymentGate = $url;
    }

    /**
     * Set callback url destination for succesfull payment
     *
     * @param string $url Url for callback after succesfull payment
     */
    public function setCallbackUrlSuccesfull($url)
    {
      if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
      }

      return $this->callbackUrlSuccesfull = $url;
    }

    /**
     * Set callback url destination for unsuccesfull / error payment
     *
     * @param string $url Url for callback after unsuccesfull / error payment
     */
    public function setCallbackUrlError($url)
    {
      if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
      }

      return $this->callbackUrlError = $url;
    }

    //TODO vymazat?
    public function setConfigProperty($configPropertyName, $value)
    {
      switch ($configPropertyName) {

          case 'transactionType':

            if (VubEcardTransactionType::isAllowed($value)) {
              return $this->configTransactionType = $value;
            }
          break;

          case 'language':

            if (VubEcardLanguage::isAllowed($value)) {
              return $this->configLanguage = $value;
            }
          break;

        default:
          # code...
          break;
      }
    }

    /**
     * Magic method for getting private properties, if property doesn't exists
     * trigers notice error.
     *
     * @param  string $propertyName Name of property which value has to be returned
     * @return mixed Property value
     */
    public function __get($propertyName)
    {
      if (isset($this->$propertyName)) {
        return $this->$propertyName;
      }

      $methodName = str_replace('()', '', $propertyName);
      if (strpos($propertyName, '()') && method_exists($this, $methodName)) {
        return $this->$methodName();
      }

      $trace = debug_backtrace();
      $notice = 'Undefined property ' . $propertyName .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'];

      VubLog::writeNotice($notice);
      trigger_error($notice, E_USER_NOTICE);

      return null;
    }

    /**
     * Hash is necessary part in the process of bank communication. Method
     * generates hash.
     *
     * @return string Hash value
     */
    public function getHash(){
        return $this->generateHash($this->getPlainHashValue());
    }

    /**
     * Perform basic encryption on plain hash value
     *
     * @return string Hash vlaue
     */
    private function generateHash($plainHashValue){
        return base64_encode(pack('H*', hash('sha512', $plainHashValue))) ;
    }

    /**
     * Concat base hash parts into string. Construct parts for comunication hash
     *
     * @return string
     */
    private function getPlainHashValue()
    {
        return  $this->replaceSpecialChars($this->VUBClientId)            . self::HASH_PARAM_DELIMETER .

                // ESHOP ORDER DETAILS
                $this->replaceSpecialChars($this->orderId)                . self::HASH_PARAM_DELIMETER .
                $this->replaceSpecialChars($this->orderAmount)            . self::HASH_PARAM_DELIMETER .

                // CALLBACK URLS
                $this->replaceSpecialChars($this->callbackUrlSuccesfull)  . self::HASH_PARAM_DELIMETER .
                $this->replaceSpecialChars($this->callbackUrlError)       . self::HASH_PARAM_DELIMETER .

                $this->replaceSpecialChars($this->configTransactionType)        . self::HASH_PARAM_DELIMETER .
                $this->replaceSpecialChars($this->installment)            . self::HASH_PARAM_DELIMETER .
                $this->replaceSpecialChars($this->rnd)                    . self::HASH_PARAM_DELIMETER .

                $this->replaceSpecialChars($this->msAuthType)             . self::HASH_PARAM_DELIMETER .
                $this->replaceSpecialChars($this->msKey)                  . self::HASH_PARAM_DELIMETER . self::HASH_PARAM_DELIMETER .

                // ESHOP DETAILS
                $this->replaceSpecialChars($this->currency)               . self::HASH_PARAM_DELIMETER .
                $this->replaceSpecialChars($this->VUBStoreKey);
    }

    /**
     * Set necessary information about order
     *
     * @param string  $orderId    Unique identificcation for Order
     * @param number  $orderPrice Amount / price of order
     * @return void
     */
    public function setOrderDetails($orderId, $orderPrice = 0)
    {
        $this->orderId = $orderId;
        $this->orderAmount = $orderPrice;
    }

    /**
     * Increment Order price
     *
     * @param number $price Price to be added to whole amount of order
     * @return number Sum price of order
     */
    public function addOrderItemPrice($price)
    {
        if ($this->orderAmount === null) {
          return $this->orderAmount = $price;
        }

        return $this->orderAmount += $price;
    }

    /**
     * Replacing special characters from input value. Special chars are "/" and "|"
     *
     * @param string $value
     * @return string $value Cleared from special chars
     */
    protected function replaceSpecialChars($value){
        return str_replace("|", "\\|", str_replace("\\", "\\\\", $value));
    }

    /**
     * Validate response from bank.
     *
     * @param Array $post $_POST values from callback
     * @return bool
     */
    public function validateResponse($post)
    {

      try {
          if (!$this->validateResponseParams(["clientid", "oid", "Response"], $post)) {
            throw new VubException('The digital signature is not valid. Required Paramaters are missing');
          }

          if($post["clientid"] != $this->VUBClientId) {
            throw new VubException('Incorrect Client Id');
          }

          if (!$this->validateHashValue($post)) {
            throw new VubException('Incorrect hash value');
          }

          if (!$this->validateStatusCode($post)) {
            throw new VubException('Incorect status code');
          }
      } catch (VubException $e) {
        return false;
      }

      return true;
    }

    /**
     * Check required parameters in bank response
     *
     * @param  Array $requiredParams List of required parameters
     * @param  Array $post Parameters provided from bank callback
     * @return bool Validates occurance of parameters
     */
    protected function validateResponseParams($requiredParams, $post)
    {
      foreach ($requiredParams as $parameter) {

        if (!isset($post[$parameter]) || (isset($post[$parameter]) && ($post[$parameter] == null || $post[$parameter] == ""))) {
          if ($parameter == "oid") {
              if (!isset($post["ReturnOid"]) || (isset($post["ReturnOid"]) && ($post["ReturnOid"] == null || $post["ReturnOid"] == ""))) {
                  throw new VubException('Missing required parameter "oid / ReturnOid" in response');
              }
          } else {
              throw new VubException('Missing required parameter "'.$parameter.'" in response');
          }
        }
      }

      return true;
    }

    /**
     * Validates hash response value
     *
     * @param  Array  $post Parameters obtained from bank callback $_POST
     * @return bool
     */
    protected function validateHashValue(Array $post)
    {
        if(!isset($post["HASHPARAMS"],$post["HASHPARAMSVAL"],$post["HASH"],$post["hashAlgorithm"])){
            throw new VubException('Missing one of hash parameters. [HASHPARAMS, HASHPARAMSVAL, HASH, hashAlgorithm]');
        }

        $hashparams = $post["HASHPARAMS"];
        $hashparamsval = $post["HASHPARAMSVAL"];
        $hashparam = $post["HASH"];

        $paramsval = "";
        $escapedStoreKey = "";
        $hashval = "";
        $hash = "";

        if ($post["hashAlgorithm"] == self::HASH_ALGORYTHM_VER_2) {

            $parsedHashParams = explode(self::HASH_PARAM_DELIMETER, $hashparams);

            foreach ($parsedHashParams as $parsedHashParam) {

                if(!isset($post[$parsedHashParam])) {
                    $paramsval .= self::HASH_PARAM_DELIMETER;
                    continue;
                }
                $vl = $post[$parsedHashParam];
                if ($vl == null)
                    $vl = "";
                $escapedValue = $this->replaceSpecialChars($vl);
                $paramsval = $paramsval . $escapedValue . self::HASH_PARAM_DELIMETER;
            }
            $escapedStoreKey = $this->replaceSpecialChars($this->VUBStoreKey);
            $hashval = $paramsval . $escapedStoreKey;
            $hash = $this->generateHash($hashval);
        }

        $hashparamsval = $hashparamsval . self::HASH_PARAM_DELIMETER . $escapedStoreKey;

        if ($hashval != $hashparamsval || $hashparam != $hash) {

            return false;
        }

        return true;
    }

    /**
     * Validate status code or procesor
     *
     * @param  Array  $post $_POST data obtained from callback
     * @return bool True if validation is succesfull
     */
    protected function validateStatusCode(Array $post)
    {
        $mdStatus = isset($post["mdStatus"]) ? $post["mdStatus"] : false;
        $procReturnCode = isset($post["ProcReturnCode"]) ? $post["ProcReturnCode"] : false;

        if ($mdStatus == 1 ||
            $mdStatus == 2 ||
            $mdStatus == 3 ||
            $mdStatus == 4 ||
            ($mdStatus === false && $procReturnCode == "00")) {

            if (isset($post["Response"]) && $post["Response"] == self::APPROVED_RESPONSE) {
                return true;
            }
        }

        if(isset($post["ErrMsg"])) {
          $this->errors[] = $post['ErrMsg'];
        }

        return false;
    }

    /**
     * Get error message.
     *
     * @return array|string
     * TODO delete?
     */
    public function getErrorMessage()
    {
        $errMessage = "";
        if(is_array($this->errors))
            $errMessage = implode('<br/>',$this->errors);
        else
            $errMessage = $this->errors;
        return $errMessage;
    }

    /**
     * Provides set for generating pay button
     *
     * @return Array Containing attribute name and value
     */
    private function getHiddenData()
    {
      $data = [
                ['value'=>'utf-8', 'name'=>'encoding'],
                ['value'=>$this->getClientId(), 'name'=>'clientid'],
                ['value'=>$this->orderAmount, 'name'=>'amount'],
                ['value'=>$this->orderId, 'name'=>'oid'],
                ['value'=>$this->callbackUrlSuccesfull, 'name'=>'okUrl'],
                ['value'=>$this->callbackUrlError, 'name'=>'failUrl'],
                ['value'=>$this->configTransactionType, 'name'=>'trantype'],
                ['value'=>$this->installment, 'name'=>'instalment'],
                ['value'=>$this->msAuthType, 'name'=>'MERCHANTSAFEAUTHTYPE'],
                ['value'=>$this->msKey, 'name'=>'MERCHANTSAFEKEY'],
                ['value'=>$this->currency, 'name'=>'currency'],
                ['value'=>$this->rnd, 'name'=>'rnd'],
                ['value'=>$this->getHash(), 'name'=>'hash'],
                ['value'=>$this->storeType, 'name'=>'storetype'],
                ['value'=>$this->hashAlgorithm, 'name'=>'hashAlgorithm'],
                ['value'=>$this->configLanguage, 'name'=>'lang'],
              ];

      return $data;
    }

    /**
    * Validates credentials and basic setup for communication. Mainly used for validating
    * VUB bank Client ID and Store Key. Generates http request, and searches for specific string values in response.
    *
    * @return bool
    */
    public function validateCredentials()
    {
      $orderIdOld = $this->orderId;
      $orderAmountOld = $this->orderAmount;

      $this->orderId = self::DEFAULT_TEST_ORDER_ID;
      $this->orderAmount = self::DEFAULT_TEST_ORDER_AMOUNT;

      $data = $this->getHiddenData();
      $postFields = [];

      foreach ($data as $dataRow) {
        $postFields[$dataRow['name']] = $dataRow['value'];
      }

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_HEADER, false);

      curl_setopt($curl, CURLOPT_REFERER, "http://www.grandus.sk");

      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');

      curl_setopt($curl, CURLOPT_URL, $this->urlPaymentGate);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postFields));

      $response = curl_exec($curl);
      curl_close($curl);

      $this->orderId = $orderIdOld;
      $this->orderAmountOld = $orderAmountOld;

      return !(strpos((string)$response, (string)self::DEFAULT_TEST_ORDER_ID) === false || strpos((string)$response, (string)self::DEFAULT_TEST_ORDER_AMOUNT) === false);
    }

    /**
     * Sets language of payment gateway interface.
     * @param string $lang ISO 639-1 Language Code. Allowed values can be found in  {@see VubEcardLanguage::$allowedLanguages}
     * @return void
     */
    public function setLang($lang){
        if (!in_array($lang, VubEcardLanguage::$allowedLanguages)) {
            $this->configLanguage = VubEcardLanguage::getDefaultValue();
            return;
        }

        $this->configLanguage = strtolower($lang);
    }

    /**
     * Generates button for paying order. Button is encapsulated in form
     *
     * @param  string $name                      Form name
     * @param  array $optionalHiddenInputsValues Array containing name, value of hidden attributes
     * @param  array $formHtmlAttributes         Array of HTML attributes for form
     * @param  array $buttonHtmlAttributes       Array of HTML attributes for button
     * @return string                              Form HTML which sends user to bank for payment
     */
    public function generateForm($name = '', $optionalHiddenInputsValues = [], $formHtmlAttributes = [], $buttonHtmlAttributes = [])
    {

      $form = HtmlHelper::formOpen(array_merge(['method'=>'post', 'action'=>$this->urlPaymentGate], $formHtmlAttributes));

      $form .= HtmlHelper::input(array_merge(['type'=>'submit', 'value'=>'Objednaj'], $buttonHtmlAttributes));
      $form .= $this->generateHiddenInputs();
      $form .= $this->generateHiddenInputsOptional($optionalHiddenInputsValues);

      $form .= HtmlHelper::formClose();

      return $form;
    }

    /**
     * Generates HTML optional hidden inputs
     *
     * @param  array $params  Array containing name and attribute value
     * @return string           HTML of hidden inputs
     */
    public function generateHiddenInputsOptional($params)
    {
      if (!(isset($params) && is_array($params) && !empty($params))) {
        return;
      }

      $hiddenInputs = '';
      foreach ($params as $key => $value) {

        // if (!in_array($key, $this->allowedOptionalParams)) {
        //   continue;
        // }

        $hiddenInputs .= HtmlHelper::inputHidden(['name' => $key, 'value' => $value]) . PHP_EOL;
      }

      return $hiddenInputs;
    }

    /**
     * Generates HTML necessary hidden inputs
     *
     * @return string HTML of hidden inputs
     */
    public function generateHiddenInputs()
    {
      $data = $this->getHiddenData();
      $hiddenInputs = '';

      foreach ($data as $rowData) {

        $hiddenInputs .= HtmlHelper::inputHidden($rowData) . PHP_EOL;
      }

      return $hiddenInputs;
    }
}
