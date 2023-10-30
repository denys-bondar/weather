<?php

namespace Tests\Feature\App\Http\Controllers\Api\V1;

use App\Models\User;

class AuthControllerTest extends \Tests\TestCase
{

    public function test_registerUser(): void
    {
        $route = self::route('api-v1.register');

        $response = $this->postJson($route, [
            'name' => "Denys Bondar",
            'phone' => "+380951234567",
            'city' => "Lviv",
            'email' => "asd@asd.gg",
            'password' => "84805338",
        ]);

        $response->assertStatus(200);

        if ($response->getStatusCode() === 200) {
            $content = $response->getContent();
            $content = json_decode($content, true);
        } else {
            throw new \Exception('Error register user');
        }

    }

    public function test_token(): void
    {
        $route = self::route('api-v1.login');
        $response = $this->postJson($route, [
            'phone' => "+380951234567",
            'password' => "84805338",
        ]);

        $response->assertStatus(200);

        if ($response->getStatusCode() === 200) {
            $content = $response->getContent();
            $content = json_decode($content, true);
            self::config(['access_token' => $content['data']['access_token']]);
        } else {
            throw new \Exception('Error get token');
        }
    }
}
