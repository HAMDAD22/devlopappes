<?php

// Your ipinfo.io API token
$api_token = '5f76d3439cc0b4';

// Get visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Validate and sanitize IP address
if (!filter_var($ip_address, FILTER_VALIDATE_IP)) {
    die("Invalid IP Address");
}

// ipinfo.io API endpoint
$api_endpoint = "https://ipinfo.io/{$ip_address}/json?token={$api_token}";

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session
$location_data = curl_exec($ch);

// Close cURL session
curl_close($ch);

if ($location_data !== false) {
    // Decode JSON response
    $location_info = json_decode($location_data);

    // Extract country code
    $country_code = isset($location_info->country) ? $location_info->country : '';

    // Redirect based on country code
    switch ($country_code) {
        case 'US':
            header("Location: html_france.html");
            exit();
        case 'FR':
            header("Location: html_usa.html");
            exit();
        case 'DE':
            header("Location: html_germany.html");
            exit();
        default:
            header("Location: html_default.html");
            exit();
    }
} else {
    echo "Failed to fetch location information.";
}

?>
