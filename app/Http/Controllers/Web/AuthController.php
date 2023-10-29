<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\RedirectResponse;

class AuthController
{
    /**
     * Show the application dashboard.
     *
     * @return RedirectResponse
     */
    public function login(): RedirectResponse
    {
        return to_route('l5-swagger.default.api');
    }
}
