Laravel TCP Socket
==========

installation
------------
For install this package Edit your project's ```composer.json``` file to require parsidev/tcp-socket

```php
"require": {
    "parsidev/tcp-socket": "dev-master"
},
```
Now, update Composer:
```
composer update
```
Once composer is finished, you need to add the service provider. Open ```config/app.php```, and add a new item to the providers array.
```
'Parsidev\Socket\SocketServiceProvider',
```
Next, add a Facade for more convenient usage. In ```config/app.php``` add the following line to the aliases array:
```
'Socket' => 'Parsidev\Socket\Facades\Socket',
```
Publish config files:
```
php artisan vendor:publish --provider="Parsidev\Socket\SocketServiceProvider"
```
for change username, password and other configuration change ```config/tcp-socket.php```

Usage
-----

###Configuration
Open ```config/tcp-socket.php```<br/>
<br />
Enter Server Ip Address and Port
<br />
You can change server protocol between ```SOL_TCP``` and ```SOL_UDP```

### Connect To Server
```php
Socket::connect();

Socket::connect($ip);
Socket::connect(null, $port);
Socket::connect($ip, $port);
```

### Disconnect from Server
```php
Socket::disconnect();
```

### Send Message
```php
Socket::sendMessage('test message'); //send message to connected server
Socket::sendMessageTo('test message', 'server ip', server port) // send message to a socket

```

### Read Message
```php
$response = Socket::readMessage(); //Read message with 2048 byte buffer

Or

$response = Socket::readMessage($length)//Read message with custom byte buffer;

$response = Socket::readMessage($length,$type)//Read message with custom byte buffer and custom type(PHP_NORMAL_READ or PHP_BINARY_READ);


``` 
