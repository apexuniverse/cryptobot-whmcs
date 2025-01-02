<?php
function cryptobot_config() {
    $configarray = array(
        "FriendlyName" => array(
            "Type" => "System",
            "Value" => "cryptobot"
        ),
        "receiver" => array(
            "FriendlyName" => "Token",
            "Type" => "text",
            "Size" => "128",
            "Description" => "Enter the API interaction token"
        )
    );
    return $configarray;
}

function cryptobot_link($params){
    $gatewayParams = getGatewayVariables('cryptobot');
    if(!$gatewayParams['token']){
        die('Not all data in the module settings are specified');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://pay.crypt.bot/api/createInvoice?currency_type=fiat&fiat=USD&amount=".$params['amount']."&payload=".$params['invoiceid']."&paid_btn_name=callback&paid_btn_url=https://".$_SERVER['HTTP_HOST']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Crypto-Pay-API-Token: ".$gatewayParams["token"]
    ]);
    $result = json_decode(curl_exec($ch), true);
    if(curl_errno($ch)){
        header("Location: /");
    }
    if(!$result["ok"]){
        header("Location: /");
    }
    header("Location: ".$result["result"]["pay_url"]);
}
?>