<?php

/* --------- Configuration for Users Start ----------- */
$endpointType = 's3'; // 's3' or 'traditional'
$enableCors = false; // false or true
$password = ''; //password protect your uploader, blank = no password protection. 


//S3 bucket details.
if($endpointType == 's3') {
	$_ENV['AWS_CLIENT_SECRET_KEY'] = $_ENV['AWS_SERVER_PRIVATE_KEY'] = '<your secret key>';

	$_ENV['AWS_SERVER_PUBLIC_KEY'] = 'AKIAJTDD4UWDJJF46FOA';

	$_ENV['S3_BUCKET_NAME'] = 's3-eu-demo-test';

	$_ENV['S3_HOST_NAME'] = '';
}

/* --------- Configuration for Users End ----------- */



