<?php
$PartnerServiceApiRoot = "https://api.partnercenter.microsoft.com";
$Authority = "https://login.windows.net";
$ResourceUrl = "https://graph.windows.net";
$ApplicationId = "";
$ApplicationSecret = "";
$ApplicationDomain = "";
$resellerDomain = '';
$UserName = "username@domainname.onmicrosoft.com";
$Password = "password";
$ClientSecret = '';




function getUsageData($token, $TenantId, $suscription_id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$TenantId.'/subscriptions/'.$suscription_id.'/usagerecords/resources';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Host: api.partnercenter.microsoft.com',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'Accept: application/json',
        'X-Locale: es-AR',
        'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $server_output = curl_exec ($ch);
    //$information = curl_getinfo($ch);
    //$_SESSION['usersss'] = $information;
    curl_close ($ch);
    return $server_output;  


}

function getUserAndPassToken(){
    global $PartnerServiceApiRoot, $ApplicationId, $UserName, $Password, $ClientSecret;

    $ch = curl_init();
    $urlgenerada = 'https://login.windows.net/domainname.onmicrosoft.com/oauth2/token';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "resource=".$PartnerServiceApiRoot."&client_id=".$ApplicationId."&grant_type=password&username=".urlencode($UserName)."&password=".$Password."&client_secret=" . $ClientSecret . "&scope=openid");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $server_output = curl_exec ($ch);
    $information = curl_getinfo($ch);
    curl_close ($ch);
    return $server_output;
}



function randomGUID($seed = '') {
    $rnd = md5(microtime() . $seed);
    return substr($rnd, 0, 8) . "-"
        . substr($rnd, 8, 4) . "-"
        . substr($rnd, 12, 4) . "-"
        . substr($rnd, 16, 4) . "-"
        . substr($rnd, 20, 12);
                  
}

function remove_utf8_bom($text){
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}

function createUser($token, $customer_id, $newUSer){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$customer_id.'/users';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $newUSer);
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $server_output = curl_exec ($ch);
    $information = curl_getinfo($ch);
    $_SESSION['usersss2'] = $information;
    curl_close ($ch);
    return $server_output;

}


function createUser2($token, $customer_id, $newUSer){
    $ch = curl_init();
    $urlgenerada2 = 'http://azure.tasacsp.com/check.php';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $newUSer);
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}

function getAccessToken($ApplicationId,$ApplicationSecret, $ResourceUrl){
    $ch = curl_init();
    $urlgenerada = 'https://login.windows.net/telefonicargentina.onmicrosoft.com/oauth2/token';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "grant_type=client_credentials&client_id=".$ApplicationId."&client_secret=".urlencode($ApplicationSecret)."&resource=".urlencode($ResourceUrl));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $server_output = curl_exec ($ch);
    $information = curl_getinfo($ch);
    curl_close ($ch);
    return $server_output;
}






function generateTokenForrequest($token){
  $ch = curl_init();
  $urlgenerada2 = 'https://api.partnercenter.microsoft.com/generatetoken';
  curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,
    "grant_type=jwt_token");
  $headers = array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer '.$token); // <---

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $server_output = curl_exec ($ch);
  curl_close ($ch); 
  return $server_output; 

}
function getUsers($token, $customer_id){

$ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$customer_id.'/users';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Host: api.partnercenter.microsoft.com',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'Accept: application/json',
        'X-Locale: es-AR',
        'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $server_output = curl_exec ($ch);
    $information = curl_getinfo($ch);
    $_SESSION['usersss'] = $information;
    curl_close ($ch);
    return $server_output;   

}

function getCustomers($token){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Accept: application/json',
        'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch); 
    return $server_output; 
}



function getcustomersLimit($token, $limit){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers?size='.$limit;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;
}


function getCustomerbyId($token, $customer_id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$customer_id;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $server_output = curl_exec ($ch);
    $information = curl_getinfo($ch);
    $_SESSION['userss3'] = $information;
    curl_close ($ch);
    return $server_output;

}

function getCustomerbyDomain($token, $domain){
    $ch = curl_init();
    $filter = urlencode ('{"Field":"domain","Value":"'.$domain.'","Operator":"starts_with"}');
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers?size=999&filter='.$filter;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    

}
function GetcustomersOrderById($token, $id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$id.'/orders';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}
function getcustomerordersbyid($token, $id,$suscription_id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$id.'/orders/'.$suscription_id;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;
}


function getcustomersuscriptionsbyid($token, $id,$suscription_id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$id.'/subscriptions/'.$suscription_id;
     curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
     $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'X-Locale: en-US',
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;
}

function updateNicknameSuscription($token, $id, $suscription_id, $suscription){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$id.'/subscriptions/'.$suscription_id;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $suscription);
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}

function getCustomersbillingprofilebyid($token, $id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$id.'/profiles/billing';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}


function getAddressValidation($token, $isoCountry){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/countryvalidationrules/'.$isoCountry;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);

    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}


function getOffers($token, $isoCountry){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/offers?country='.$isoCountry;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);

    $headers = array(
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}

function createCustomer($token, $newCustomer){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $newCustomer);
    $guid1 = randomGUID();
    $guid2 = randomGUID(1);
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'MS-RequestId: ' . $guid1,
        'MS-CorrelationId: ' . $guid2,
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    $_SESSION['g1'] = $guid1;
    $_SESSION['g2'] = $guid2;
    curl_close ($ch);
    return $server_output;

}

function createCustomer2($token, $newCustomer){
     $ch = curl_init();
    $urlgenerada2 = 'http://azure.tasacsp.com/check.php';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $newCustomer);
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    $server_output = curl_exec ($ch);
    $information = curl_getinfo($ch);
    $_SESSION['datas'] = $information;
    curl_close ($ch);
    return $server_output;




}




function createOrder($token, $order, $customer_id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$customer_id.'/orders';
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $order);
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'X-Locale: en-US',
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}

function EditQuantity($token, $order, $customer_id, $suscription_id){
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$customer_id.'/subscriptions/'.$suscription_id;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $order);
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'X-Locale: en-US',
        'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}



function suspendSubscription($token, $order, $customer_id, $suscription_id){
    //Mandar con suspended
    $ch = curl_init();
    $urlgenerada2 = 'https://api.partnercenter.microsoft.com/v1/customers/'.$customer_id.'/subscriptions/'.$suscription_id;
    curl_setopt($ch, CURLOPT_URL,$urlgenerada2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $order);
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'MS-RequestId: ' . randomGUID(),
        'MS-CorrelationId: ' . randomGUID(1),
        'X-Locale: en-US',
    'Authorization: Bearer '.$token); // <---
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;

}
//https://msdn.microsoft.com/es-es/library/partnercenter/mt634685.aspx
//https://msdn.microsoft.com/es-es/library/partnercenter/mt634715.aspx

?>
