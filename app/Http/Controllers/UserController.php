<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {

        /**
         * https://developer.spotify.com/documentation/web-api/reference/users-profile/get-current-users-profile/
         *
         * Get user data
         */


        return view('user', [
            /*
             * Return these fields:
             * - display_name
             * - images
             * - product
             * */
        ]);
    }

    public function logout(Request $request) {

        // Implement logout function

        return redirect()->route('home');
    }
}
