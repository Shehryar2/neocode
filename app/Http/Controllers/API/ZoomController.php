<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use http\Exception;

class ZoomController extends Controller
{

    public function getAccessTokenOauth2($accessCode){

        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);

            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(env('ZOOM_CLIENT_KEY').':'.env('ZOOM_CLIENT_SECRET'))
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $accessCode,
                    "redirect_uri" => env('REDIRECT_URI')
                ],
            ]);

            $token = json_decode($response->getBody()->getContents(), true);

            return $token;

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCallBackAccessCode(Request $request){

        $token = $this->getAccessTokenOauth2($request->code);
        return $this->listZoomMeetings($token['access_token']);
    }


    public function listZoomMeetings($token){

        $client = new Client(['base_uri' => 'https://api.zoom.us']);


        $response = $client->request('GET', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $token"
            ]
        ]);

        $data = json_decode($response->getBody());

        return $response->getBody();

        if ( !empty($data) ) {
            foreach ( $data->meetings as $d ) {
                $topic = $d->topic;
                $join_url = $d->join_url;
                echo "<h3>Topic: $topic</h3>";
                echo "Join URL: $join_url";
            }
        }
    }
}
