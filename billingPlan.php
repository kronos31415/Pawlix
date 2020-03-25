<?php
require_once("includes/payPallConfig.php");
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

// Create a new instance of Plan object
$plan = new Plan();

// # Basic Information
// Fill up the basic information that is required for the plan
$plan->setName('Pawlix monthly plan')
    ->setDescription('Allbest features')
    ->setType('INFINITE');

// # Payment definitions for this billing plan.
$paymentDefinition = new PaymentDefinition();

// The possible values for such setters are mentioned in the setter method documentation.
// Just open the class file. e.g. lib/PayPal/Api/PaymentDefinition.php and look for setFrequency method.
// You should be able to see the acceptable values in the comments.
$paymentDefinition->setName('Regular Payments')
    ->setType('REGULAR')
    ->setFrequency('Month')
    ->setFrequencyInterval("1")
    ->setAmount(new Currency(array('value' => 12, 'currency' => 'PLN')));


$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$returnUrl = str_replace("biling.php" , 'profile.php', $currentUrl);

$merchantPreferences = new MerchantPreferences();

// ReturnURL and CancelURL are not required and used when creating billing agreement with payment_method as "credit_card".
// However, it is generally a good idea to set these values, in case you plan to create billing agreements which accepts "paypal" as payment_method.
// This will keep your plan compatible with both the possible scenarios on how it is being used in agreement.
$merchantPreferences->setReturnUrl($returnUrl . "?success=true")
    ->setCancelUrl($returnUrl . "?success=false")
    ->setAutoBillAmount("yes")
    ->setInitialFailAmountAction("CONTINUE")
    ->setMaxFailAttempts("0");


$plan->setPaymentDefinitions(array($paymentDefinition));
$plan->setMerchantPreferences($merchantPreferences);

//create plan
try {
    $createdPlan = $plan->create($apiContext);
  
    try {
      $patch = new Patch();
      $value = new PayPalModel('{"state":"ACTIVE"}');
      $patch->setOp('replace')
        ->setPath('/')
        ->setValue($value);
      $patchRequest = new PatchRequest();
      $patchRequest->addPatch($patch);
      $createdPlan->update($patchRequest, $apiContext);
      $plan = Plan::get($createdPlan->getId(), $apiContext);
  
      // Output plan id
      echo $plan->getId();
    } catch (PayPal\Exception\PayPalConnectionException $ex) {
      echo $ex->getCode();
      echo $ex->getData();
      die($ex);
    } catch (Exception $ex) {
      die($ex);
    }
  } catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
  } catch (Exception $ex) {
    die($ex);
  }

?>