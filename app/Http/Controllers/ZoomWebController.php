<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use http\Exception;
use Illuminate\Http\Request;
use Session;

class ZoomWebController extends Controller
{
    public $neocodeZoomAuth;

    public function listMeetings(Request $request)
    {
        try {
            $this->neocodeZoomAuth = session()->get('neocodeZoomAuth');
            $zoom_code = $request->code;
            if (!$this->neocodeZoomAuth) {
                $auth = $this->getAccessTokenOauth2($zoom_code);
                session()->put('neocodeZoomAuth', $auth);
                $this->neocodeZoomAuth = $auth;
            }

            // Auth Token
            $token = $this->neocodeZoomAuth['access_token'];
            $data = $this->listZoomMeetings($token);

            return view('meetings.list', ['data' => $data->meetings]);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAccessTokenOauth2($accessCode)
    {
        try {
            $client = new Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode(env('ZOOM_CLIENT_KEY') . ':' . env('ZOOM_CLIENT_SECRET'))
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $accessCode,
                    "redirect_uri" => env('REDIRECT_URI')
                ],
            ]);
            return $token = json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listZoomMeetings($token)
    {
        $client = new Client(['base_uri' => 'https://api.zoom.us']);
        $response = $client->request('GET', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $token"
            ]
        ]);

        return $data = json_decode($response->getBody());
    }
}
