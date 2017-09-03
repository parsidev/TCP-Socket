<?php

namespace Parsidev\Socket;

class Socket
{

    protected $ip;
    protected $port;
    protected $protocol;
    protected $socket;
    protected $isConnected = false;

    public function __construct($ip, $port, $protocol)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->protocol = $protocol;
        if (!($this->socket = socket_create(AF_INET, SOCK_STREAM, $protocol))) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            $this->isConnected = false;
            throw new \Exception($errormsg, $errorcode);
        }
    }

    public function connect()
    {
        if (!socket_connect($this->socket, $this->ip, intval($this->port))) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            $this->isConnected = false;
            throw new \Exception($errormsg, $errorcode);
        } else {
            $this->isConnected = true;
            socket_getsockname($this->socket, $IP, $PORT);
            return ['IP' => $IP, "PORT" => $PORT];
        }
    }

    public function receiveMessage($len = 500000, $flag = 0)
    {
        $result = null;
        if ($this->isConnected) {
            socket_bind($this->socket,$this->ip, intval($this->port));
            while (is_null($result)) {
                socket_recvfrom($this->socket, $buf, $len, $flag, $this->ip, intval($this->port));
                if (!is_null($buf))
                    $result = $buf;
            }
        }
        return $result;
    }


    public function disconnect()
    {
        socket_close($this->socket);
    }

    public function readMessage($length = 2048, $type = PHP_BINARY_READ)
    {
        return socket_read($this->socket, $length, $type);
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
