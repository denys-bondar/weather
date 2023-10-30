<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected const CLIENT_ID = 1;

    protected static array $config = [];
    protected static bool $setUpRun = false;

    public function setUp(): void
    {
        parent::setUp();

        if (config('database.connections.mysql.database') !== 'weather_autotest') {
            throw new \Exception('Database is not testing');
        }

        if (!static::$setUpRun) {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed');

            static::$setUpRun = true;
        }
    }

    protected static function config(mixed $key = null, $default = null): mixed
    {
        if (is_null($key)) {
            return self::$config;
        }

        if (is_array($key)) {
            foreach ($key as $index => $value) {
                Arr::set(self::$config, $index, $value);
            }

            return true;
        }

        return Arr::get(self::$config, $key, $default);
    }

    protected static function route($name, $parameters = [], $absolute = false)
    {
        return route($name, $parameters, $absolute);
    }

}
