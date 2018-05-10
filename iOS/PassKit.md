# PassKit

<!-- TOC -->

*   [PassKit](#passkit)
    *   [Adding the certificate](#adding-the-certificate)
    *   [PHP Server](#php-server)
        *   [Plan ticket example](#plan-ticket-example)
        *   [Store card example](#store-card-example)
    *   [More info](#more-info)

<!-- /TOC -->

## Adding the certificate

Head to the iOS dev portal and add the appropriate certificate.

You may need to open Keychain access to generate a new key using `Keychain Access > Certificate Assistant > Req Cert from Cert Auth` and generate a new cert. This cert will be used to generate what you need to import into Keychain Access from the dev portal.

Once created, export it to a folder for the server.

<!-- Once created, download the certificate and export it as .p12 to the server which hosts `node-passbook`. You may need to global install as well `npm install -g passbook` to then use `node-passbook prepare-keys -p keys` to convert .p12 to .pem. Make sure you set the PEM passphrase too - it will be needed. -->

## PHP Server

Using `composer`, you can build out a scaffold using the Slim Framework:

`composer create-project slim/slim-skeleton [project-name]`.

To install the PHP PassKit helper, run `composer require pkpass/pkpass`.

Once built, you can then hit the routes and just require the pkpass and the routes file may end up looking like this:

### Plan ticket example

```php
<?php
// Routes
use PKPass\PKPass;

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'sample.phtml', $args);
});

$app->get('/pass', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/pass' route");

    $pass = new PKPass('<name>.p12', '<insert-password>');

	// Pass content
	$data = [
	    'description' => 'Demo pass',
	    'formatVersion' => 1,
	    'organizationName' => 'Flight Express',
	    'passTypeIdentifier' => 'pass.com.<teamname>.<passname>', // Change this!
	    'serialNumber' => '12345678',
	    'teamIdentifier' => '<insert-team-id>', // Change this! Found on Apple Dev Portal
	    'boardingPass' => [
	        'primaryFields' => [
	            [
	                'key' => 'origin',
	                'label' => 'San Francisco',
	                'value' => 'SFO',
	            ],
	            [
	                'key' => 'destination',
	                'label' => 'London',
	                'value' => 'LHR',
	            ],
	        ],
	        'secondaryFields' => [
	            [
	                'key' => 'gate',
	                'label' => 'Gate',
	                'value' => 'F12',
	            ],
	            [
	                'key' => 'date',
	                'label' => 'Departure date',
	                'value' => '07/11/2012 10:22',
	            ],
	        ],
	        'backFields' => [
	            [
	                'key' => 'passenger-name',
	                'label' => 'Passenger',
	                'value' => 'John Appleseed',
	            ],
	        ],
	        'transitType' => 'PKTransitTypeAir',
	    ],
	    'barcode' => [
	        'format' => 'PKBarcodeFormatQR',
	        'message' => 'Flight-GateF12-ID6643679AH7B',
	        'messageEncoding' => 'iso-8859-1',
	    ],
	    'backgroundColor' => 'rgb(32,110,247)',
	    'logoText' => 'Flight info',
	    'relevantDate' => date('Y-m-d\TH:i:sP')
	];

	$pass->setWWDRcertPath('<path to wwdr.pem>');
	$pass->setData($data);

	// Add files to the pass package
	$pass->addFile('public/icon.png');
	$pass->addFile('public/icon@2x.png');
	$pass->addFile('public/logo.png');

	if($pass->checkError($error) == true) {
		// echo $error;
        // exit('An error occured: ' . $error);
    }

    // echo 'Here';

	$result = $pass->create(true);
	if($result == false) {
	    echo $pass->getError();
	}
    // Render index view
    return $result;
});
```

### Store card example

```php
<?php
// Routes
use PKPass\PKPass;

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'sample.phtml', $args);
});

$app->get('/pass', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/pass' route");

    $pass = new PKPass('<key-path>', 'password');

	// Pass content
	$data = [
	    'formatVersion' => 1,
	    'organizationName' => 'Testing',
	    'passTypeIdentifier' => 'pass.com.<id>.<app>', // Change this!
	    'serialNumber' => '12345678',
	    'teamIdentifier' => '<team-id>', // Change this!
	    'logoText' => 'Loyalty',
		'description' => 'Rewards card',
	    'storeCard' => [
	        'secondaryFields' => [
	            [
	                'key' => 'balance',
	                'label' => 'BALANCE',
	                'value' => '$250.00'
	            ],
	            [
	                'key' => 'name',
	                'label' => 'NICKNAME',
	                'value' => 'Denno'
	            ],
	        ],
	        'backFields' => [
	            [
	                'key' => 'owner-name',
	                'label' => 'Rewards Card',
	                'value' => 'John Appleseed'
	            ],
	        ]
	    ],
	    'barcode' => [
	        'format' => 'PKBarcodeFormatPDF417',
	        'message' => 'ID6643679AH7B',
	        'messageEncoding' => 'iso-8859-1',
	        'altText' => 'ID6643679AH7B'
	    ],
	    'backgroundColor' => 'rgb(32,110,247)',
	    'logoText' => 'Dummy card info'
	];

	$pass->setWWDRcertPath('<wwdr-key>');
	$pass->setData($data);

	// Add files to the pass package
	$pass->addFile('public/icon.png');
	$pass->addFile('public/icon@2x.png');
	$pass->addFile('public/logo.png');

	if($pass->checkError($error) == true) {
		// echo $error;
        // exit('An error occured: ' . $error);
    }

    // echo 'Here';

	$result = $pass->create(true);
	if($result == false) {
	    echo $pass->getError();
	}
    // Render index view
    return $result;
});

?>
```

## More info

If you need to generate a wwdr cert, you can globally install `passbook` eg. `node install -g passbook` and run a command like `node-passbook prepare-keys -p <folder-hosting-exported-keys>` and it can do the conversion for you. Make sure you don't forget the password, though.

Some changes you may need to make are passing `POST` variables to change it for each user.

If you need to change the JSON structure above, refer to https://developer.apple.com/library/content/documentation/UserExperience/Reference/PassKit_Bundle/Chapters/Introduction.html for more info.
