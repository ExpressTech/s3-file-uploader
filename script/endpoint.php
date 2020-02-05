<?php

include('config.php');

if($endpointType == 's3') {
	chdir('vendor/fineuploader/php-s3-server');
} else {
	chdir('vendor/fineuploader/php-traditional-server');
}

if($enableCors) {
	@include('endpoint-cors.php');
} else {
	@include('endpoint.php');
}
