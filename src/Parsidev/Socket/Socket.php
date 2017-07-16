<?php

namespace Parsidev\Socket;

class Socket
{

    protected $config;
    protected $socket;
    protected $isConnected = false;

    public function __construct($config)
    {
        $this->config = $config;
        if (!($this->socket = socket_create(AF_INET, SOCK_STREAM, $this->config('protocol')))) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            $this->isConnected = false;
            throw new \Exception($errormsg, $errorcode);
        }
    }

    public function connect()
    {
        if (!socket_connect($this->socket, $this->config('address'), $this->config('port'))) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            $this->isConnected = false;
            throw new \Exception($errormsg, $errorcode);
        } else {
            $this->isConnected = true;
        }
    }

    public function disconnect()
    {
        socket_close($this->socket);
    }

    public function readMessage($length = 2048, $type = PHP_BINARY_READ)
    {
        return socket_read($this->socket, $length);
    }

    public function sendMessage($message)
    {
        $result = socket_write($this->socket, $message, strlen($message));
        if (!$result) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            $this->isConnected = false;
            throw new \Exception($errormsg, $errorcode);
        }
        return $result;
    }

    public function sendMessageTo($message, $ip, $port)
    {
        $result = socket_sendto($this->socket, $message, strlen($message), 0, $ip, $port);
        if (!$result) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            $this->isConnected = false;
            throw new \Exception($errormsg, $errorcode);
        }
        return $result;
    }
}
