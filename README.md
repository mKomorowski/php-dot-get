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
    'name' => 'Name'
    'firstname' => 'FirstName',
    'address' > array(
        'street' => '',
        'city' => 'Leeds'
    )
);

$city = $dot->get($array, 'address.city');
```

Tell if the value isset in array
```php
$exists = $dot->exists($array, 'address.city');
```

Set default value returned if given key is not found in array
```php
$dot->setDefault('undefined');
```
