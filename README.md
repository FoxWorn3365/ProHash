# ProHash
ProHash is a system for encrypting and decrypting strings with an auto-generated key. Without that it will be almost impossible to decipher the content

## Installation
You can install it with **composer**:
```sh
composer require foxworn3365/prohash
```
or you can download the file called `prohash.php` and include it:
```php
require_once('prohash.php');
```

## How to use ProHash
### How ProHash works
ProHash generates a string completely randomly but also provides you with a key to decrypt it.<br>
The only function that can offer you this key is `Class->new(<STRING>)`

### Hash without a key - New key
```
Class->new(<STRING>);
```
Will return an `array`:
```php
{
   [string] => <ENCODED STRING>,
   [key] => <FULL KEY FOR ENCRYPT/DECRYPT>
}
```

### Hash with a key
```
Class->encode(<STRING>, <KEY>);
```
Will return a `string` with hashed content

### Decrypt with a key
```
Class->decode(<STRING>, <KEY>);
```
Will return a `string` with normal content

## Example
```php
<?php
require 'prohash.php';
use Fox\Hash as Hash;

$hash = new Hash();

// Now let's go encrypt the string
$result = $hash->new('my name is Federico'); // STRING: 18444^1333537^1267562^11461^604604^18444^305210^1267562^661014^202788^1267562^656169^305210^392471^305210^1214056^661014^548144^171148^

// The key is in $result["key"] and the encrypted string is in $result["string"];

// Now let's go decrypt the string
$myString = $hash->decrypt($result["string"], $result["key"]); // OUTPUT: my name is Federico

// Now we can also encrypt a string with an existent key
$temp = $hash->encrypt('my name is Federico', $result["key"]); // THE OUTPUT WILL BE EQUAL TO $result["string"];
```
