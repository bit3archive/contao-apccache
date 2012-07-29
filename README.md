APC driven cache for Contao
===========================

Caching class similar to the `Cache` and `FileCache` classes from Contao, but using APC as storage.

```php
$objCache = ApcCache::getInstance('mycache');

// object access...
$objCache->foo = 'foo';
echo $objCache->foo;

// and array access allowed!
$objCache['bar'] = 'bar';
echo $objCache['bar'];
```
