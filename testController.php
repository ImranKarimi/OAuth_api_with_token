<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // ✅ Correct one

class testController extends Controller
{
    public function getAccessToken()
    {
        $client = new Client();
    
        // Send POST request to OAuth token endpoint to get access token
        $response = $client->post('https://api.dummy.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',  // OAuth2.0 grant type
                'client_id' => 'dummy-client-id',      // Your dummy client ID
                'client_secret' => 'dummy-client-secret', // Your dummy client secret or secret key
            ],
        ]);
    
        // Decode the response body to get the access token
        $data = json_decode($response->getBody()->getContents(), true);
    
        // Return the access token (you can store this token for later use)
        return $data['access_token'];
    }
    public function makeApiRequest()
{
    // Step 1: Get the access token
    $accessToken = $this->getAccessToken();

    $client = new Client();

    // Step 2: Send GET request to the protected API endpoint
    $response = $client->get('https://api.dummy.com/protected-data', [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,  // Include the access token in the header
        ],
    ]);

    // Step 3: Process the response data
    $data = json_decode($response->getBody()->getContents(), true);

    // Return or process the data as needed
    return $data;  // Example data returned from the protected endpoint
}


}
