<?php 

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets with Primo');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');

$service = new Google_Service_Sheets($client);
$spreadsheetId = "10xX1_Bz-X7oSiwSm1KGh0sIEQZ7qSIqIWgnNJF3-9gs";

$range = "Sheet1"; // Sheet name

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$state = $_POST['state'];
$message = $_POST['message'];

$values = [
	[$name, $email, $phone, $state, $message]
];

// echo "<pre>";print_r($values);echo "</pre>";exit;

$body = new Google_Service_Sheets_ValueRange([
	'values' => $values
]);

$params = [
	'valueInputOption' => 'RAW'
];

$result = $service->spreadsheets_values->append(
	$spreadsheetId,
	$range,
	$body,
	$params
);

if($result->updates->updatedRows == 1){
    header("Location: thankyou.php");
	// echo "Success";
    exit;
} else {
	echo "Some Error Occured!";
}