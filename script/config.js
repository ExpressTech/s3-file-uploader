var endpointType = 's3'; // 's3' or 'traditional'

//traditional endpoint details
if(endpointType == 's3') {
	//S3 endpoint details.
	var endpoint = 'http://s3-eu-demo-test.s3.eu-central-1.amazonaws.com'; //complete end point details. 
	var bucket = 's3-eu-demo-test';
	var region = 'us-east-1'; //or eu-central-1, etc.. 
	var accessKey = 'AKIAJTDD4UWDJJF46FOA';
	var cloudFrontUrl = ''; //if you wish to use cloudfront enter the cloudfront url for this S3 endpoint
	var actionsEndpoint = 'endpoint.php';
	
	
} else {
	var endpoint = 'endpoint.php'; //possible to specify remote URL
	//leave below as default / blank (they are not needed for traditional uploader)
	var accessKey = ''; 
	var actionsEndpoint = endpoint;
	var region = '';
	var bucket = '';
}


