APC driven cache for Contao
===========================

Used similar to the `Cache` and `FileCache` classes from Contao, but using APC.

```php
$objCache = ApcCache::getInstance('mycache');

// object access...
$objCache->foo = 'foo';
echo $objCache->foo;

// and array access allowed!
$objCache['bar'] = 'bar';
echo $objCache['bar'];
```
