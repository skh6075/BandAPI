# BandAPI
[PMMP][4.0.0] Naver Band API

# Usage.

```php

/**
 * @description get Join Bands.
 * @return array
 */
var_dump (
    (new BandAPI)
        ->setToken ("write token")
        ->getBands ()
);

/**
 * @description write band Post
 * @return array
 */

$result = (new BandAPI)
        ->setToken ("write token")
        ->writeBandPost ("band_key", "content", bool $announce);

var_dump ([$bandKey, $contentKey] = $result);
```
