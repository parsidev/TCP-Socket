Laravel TCP Socket
==========

installation
------------
For install this package Edit your project's ```composer.json``` file to require parsidev/tcp-socket

```php
"require": {
    "parsidev/tcp-socket": "5.7.x-dev"
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
for change username, password and other configuration change ```config/tcpsocket.php```

Usage
-----

### Configuration
Open ```config/tcp-socket.php```<br/>
<br />
Enter Server Ip Address and Port
<br />
You can change server protocol between ```SOL_TCP``` and ```SOL_UDP```

### Connect To Server
```php
$socket = Socket::connect();

$socket = Socket::connect($ip);
$socket = Socket::connect(null, $port);
$socket = Socket::connect($ip, $port);
```

### Disconnect from Server
```php
Socket::disconnect($socket);
```

### Send Message
```php
Socket::sendMessage('test message'); //send message to connected server
Socket::sendMessageTo('test message', 'server ip', server port) // send message to a socket

```
