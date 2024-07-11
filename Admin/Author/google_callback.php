<?php
session_start();
include("../../Config/connection.php");

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Exchange the code for access token
    $token_url = 'https://oauth2.googleapis.com/token';
    $params = array(
        'code' => $code,
        'client_id' => 'YOUR_GOOGLE_CLIENT_ID',
        'client_secret' => 'YOUR_GOOGLE_CLIENT_SECRET',
        'redirect_uri' => 'YOUR_GOOGLE_REDIRECT_URI',
        'grant_type' => 'authorization_code'
    );

    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // Get user info using the access token
        $user_info_url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;
        $user_info = json_decode(file_get_contents($user_info_url), true);

        // Use $user_info array to create or update user in your database
        // Example: $email = $user_info['email'];
        // Perform signup process using $email or other user information

        // Redirect to success page or dashboard
        header("Location: ../../User/index.php");
        exit();
    } else {
        echo "Failed to get access token.";
    }
} else {
    echo "Code parameter not found.";
}
