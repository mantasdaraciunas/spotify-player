<?php


namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * https://developer.spotify.com/documentation/general/guides/authorization-guide/
    */
    public function spotifyAccess() {
        $scopes = implode(' ',[
            'user-read-private',
            'user-read-email',
            'user-read-playback-state',
            'app-remote-control',
            'user-read-currently-playing,',
            'user-read-playback-state',
            'user-modify-playback-state'
        ]);

        return redirect("https://accounts.spotify.com/authorize"
            ."?response_type=code"
            ."&client_id=$spotifyClientID"
            ."&scope=$scopes"
            ."&redirect_uri=".env("APP_URL")."/authorization");
    }

    public function authorization(Request $request) {
        $authorizationCode = $request->query('code');

        $accountService = "https://accounts.spotify.com/api/token";

        try {
            $client = new Client();

            $res = $client->post($accountService, [
                "headers"     => [
                    "Authorization" => "Basic " . base64_encode($spotifyClientID . ":" . $spotifyClientSecret)
                ],
                "form_params" => [
                    "grant_type"   => "authorization_code",
                    "code"         => $authorizationCode,
                    "redirect_uri" => env("APP_URL") . "/authorization",
                ]
            ]);

            /**
             * https://developer.spotify.com/documentation/general/guides/authorization-guide/
             *
             * Return:
             * KEY | VALUE TYPE | VALUE DESCRIPTION
             * access_token | string | An access token that can be provided in subsequent calls, for example to Spotify Web API services.
             * token_type | string | How the access token may be used: always “Bearer”.
             * scope |	string | A space-separated list of scopes which have been granted for this access_token
             * expires_in | int | The time period (in seconds) for which the access token is valid.
             * refresh_token |	string | A token that can be sent to the Spotify Accounts service in place of an authorization code. (When the access code expires, send a POST request to the Accounts service /api/token endpoint, but use this code in place of an authorization code. A new access token will be returned. A new refresh token might be returned too.)
             */
            $response = $res->getBody()->getContents();


            // Save Returned data


            return redirect()->route('user');
        } catch (\Exception $e) {
            Log::error("Authorization failed", ['error' => $e->getMessage()]);
            return redirect()->route('home')->withErrors('Failed to get Access Token');
        }

    }

    public function refreshToken() {
        $accountService = "https://accounts.spotify.com/api/token";

        try {
            $client = new Client();

            $res = $client->post($accountService, [
                "headers"     => [
                    "Authorization" => "Basic "
                        . base64_encode($spotifyClientID . ":" . $spotifyClientSecret)
                ],
                "form_params" => [
                    "grant_type"   => "refresh_token",
                    "refresh_token"   => "",/* User Refresh Token */
                ]
            ]);

            /**
             * https://developer.spotify.com/documentation/general/guides/authorization-guide/
             *
             * Return:
             * "access_token": "NgA6ZcYI...ixn8bUQ",
             * "token_type": "Bearer",
             * "scope": "user-read-private user-read-email",
             * "expires_in": 3600
             */
            $response = $res->getBody()->getContents();


        } catch (\Exception $e) {
            Log::error('Refresh Token error', ['error' => $e->getMessage()]);
            return redirect()->route('home')->withErrors('Failed to Refresh Token');
        }

    }
}
