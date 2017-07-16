<?php

namespace Parsidev\Socket\Facades;

use Illuminate\Support\Facades\Facade;

class Socket extends Facade {

    protected static function getFacadeAccessor() {
        return 'tcpsocket';
    }
}
