<?php 
	
	require_once("../src/FoursquareAPI.class.php");
	// Set your client key and secret
	
	$client_key = "4EWJIA1OG3FMSFAGXDJE303GQLG3NUQEOQ0XKRVCDCPLCVQC";
	$client_secret = "SODIJLE5ZV40YSIKTDCG4201EVS2VZNQCMC53BRIFB0VKIR4";
	
	// Load the Foursquare API library

	if($client_key=="" or $client_secret=="")
	{
        echo 'Load client key and client secret from <a href="https://developer.foursquare.com/">foursquare</a>';
        exit;
	}

	$foursquare = new FoursquareAPI($client_key,$client_secret);
	$location = $zip;
?>

<?php 
	
	
	// Generate a latitude/longitude pair using Google Maps API
	list($lat,$lng) = $foursquare->GeoLocate($location);
	
	// Prepare parameters
	$params = array("ll"=>"$lat,$lng", "query"=>"wearable world headquarters", "limit"=>"1");
	
	// Perform a request to a public resource
	$response = $foursquare->GetPublic("venues/search",$params);
	
	$venues = json_decode($response);
	
?>
	
		<?php foreach($venues->response->venues as $venue): ?>

				<?php 
					
					echo $venue->name;
                    echo $venue->stats->usersCount;
					
				?>
			
			
		<?php endforeach; ?>
