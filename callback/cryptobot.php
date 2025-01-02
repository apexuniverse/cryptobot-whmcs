<?php
require_once __DIR__ . '/../../../init.php';
require_once __DIR__ . '/../../../includes/gatewayfunctions.php';
require_once __DIR__ . '/../../../includes/invoicefunctions.php';

use WHMCS\Billing\Invoice;
use WHMCS\Database\Capsule;

$gatewayModuleName = basename(__FILE__, '.php');
$gatewayParams = getGatewayVariables($gatewayModuleName);
$data = json_decode(file_get_contents('php://input'), true);
$binaryHash = hash('sha256', $config["cryptobot"]["token"], true);
$hash = hash_hmac('sha256', file_get_contents('php://input'), $binaryHash);
if($hash !== getallheaders()['Crypto-Pay-Api-Signature']){
    die("Hash error.");
}
$id = $data["payload"]["payload"];
$invoice = Capsule::table('tblinvoices')->where('id', $id)->first();
$amount = round($_REQUEST["amount"] / $gatewayParams["rub"], 2);
if ($invoice->status != 'Paid') {
    $invoiceId = $invoice->id;
    addInvoicePayment($invoiceId, $id, 0, 0, $gatewayParams['paymentmethod']);
    header('HTTP/1.1 200 OK');
    echo json_encode(['code' => 200]);
} else {
    die('The invoice has already been paid.');
}
?>