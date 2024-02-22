<?php

// Your ipinfo.io API token
$api_token = '5f76d3439cc0b4';

// Get visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// ipinfo.io API endpoint
$api_endpoint = "https://ipinfo.io/{$ip_address}/json?token={$api_token}";

// Fetch location information from the API
$location_data = file_get_contents($api_endpoint);

if ($location_data !== false) {
    // Decode JSON response
    $location_info = json_decode($location_data);

    // Extract country and city information
    $country = isset($location_info->country) ? $location_info->country : 'Unknown';
    $city = isset($location_info->city) ? $location_info->city : 'Unknown';

    // Save visitor's IP and city to a text file
    $file = 'visitors.txt';
    $current = file_get_contents($file);
    $current .= "IP Address: $ip_address, Country: $country, City: $city\n";
    file_put_contents($file, $current);

    // Serve different HTML content based on the country
    switch ($country) {
        case 'FR':
            include 'https://github.com/'; // HTML content for France
            break;
        case 'US':
            include 'html_usa.html'; // HTML content for USA
            break;
        case 'DE':
            include 'html_germany.html'; // HTML content for Germany
            break;
        default:
            include 'html_usa.html'; // Default to USA HTML for other countries
            break;
    }
} else {
    echo "Failed to fetch location information.";
}

?>
