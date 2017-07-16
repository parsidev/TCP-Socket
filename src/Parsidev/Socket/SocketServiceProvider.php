<?php

namespace Parsidev\Socket;

use Illuminate\Support\ServiceProvider;

class SocketServiceProvider extends ServiceProvider {

    protected $defer = true;

    public function boot() {
        $this->publishes([
            __DIR__ . '/../../config/tcpsocket.php' => config_path('tcpsocket.php'),
        ]);
    }

    public function register() {
        $this->app->singleton('tcpsocket', function($app) {
            $ip = config('tcpsocket.address');
            $port = config('tcpsocket.port');
            $protocol = config('tcpsocket.protocol');
            return new Socket($ip,$port,$protocol);
        });
    }

    public function provides() {
        return ['tcpsocket'];
    }

}
