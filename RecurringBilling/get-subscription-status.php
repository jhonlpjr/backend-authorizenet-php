<?php
  require 'vendor/autoload.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  
  function getSubscriptionStatus($subscriptionId) {

    // Common Set Up for API Credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName( "5KP3u95bQpv"); 
    $merchantAuthentication->setTransactionKey("4Ktq966gC55GAX7S");

    $refId = 'ref' . time();

    $request = new AnetAPI\ARBGetSubscriptionStatusRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($subscriptionId);

    $controller = new AnetController\ARBGetSubscriptionStatusController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
    {
        echo "SUCCESS: Subscription Status : " . $response->getStatus() . "\n";
     }
    else
    {
        echo "ERROR :  Invalid response\n";
        echo "Response : " . $response->getMessages()->getMessage()[0]->getCode() . "  " .$response->getMessages()->getMessage()[0]->getText() . "\n";
        
    }

    return $response;
  }

  if(!defined('DONT_RUN_SAMPLES'))
    getSubscriptionStatus("3056945");

?>
