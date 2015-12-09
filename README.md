# php-dot-get
Array dot notation access

##Installation

The package can be installed via Composer by adding to the ```composer.json``` require block.
```javascript
{
    "require": {
        "mkomorowski/php-dot-get": "dev-master"
    }
}
```

Then update application packages by running the command:
```sh
php composer.phar install
```

##Usage
```php
$dot = new mKomorowski\Notation\Dot;
```
Get value from array
```php
$array = array(
    'name' => 'Name',
    'firstname' => 'FirstName',
    'address' => array(
        'street' => '',
        'city' => 'Leeds'
    )
);

$dot->get($array, 'address.city'); // 'Leeds'
```

Tell if the value isset in array
```php
$dot->exists($array, 'address.city'); // true
```

Set default value returned if given key is not found in array
```php
$dot->get($array, 'address.country') // null

$dot->setDefault('undefined');

$dot->get($array, 'address.country') // 'undefined'
```

Compare requested value with given one
```php
$dot->assert($array, 'name', 'Name') // true
```
