<?php

namespace Tests\Feature\App\Http\Controllers\Api\V1;

class UserControllerTest extends \Tests\TestCase
{
    public function test_info_user(): void
    {
        $route = self::route('api-v1.user.info');
        $response = $this
            ->withHeaders(['Authorization' => 'Bearer ' . self::config('access_token')])
            ->getJson($route);
        $response->assertStatus(200);
        if ($response->getStatusCode() === 200) {
            $content = $response->getContent();
        }
    }

    public function test_update_user(): void
    {
        $route = self::route('api-v1.user.update');
        $response = $this
            ->withHeaders(['Authorization' => 'Bearer ' . self::config('access_token')])
            ->patchJson($route, [
                'email' => "bondar.denis.php@gmail.com",
                'phone' => "+380661234567",
                'city' => "Kyiv",
                'name' => "bondar denys",
            ]);
        $response->assertStatus(200);
        if ($response->getStatusCode() === 200) {
            $content = $response->getContent();
        }
    }

}
