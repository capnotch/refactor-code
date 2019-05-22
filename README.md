## PHP Unit test for TeHelper Function willExpireAt
- Open your terminal
- move to the root directory
- run this command
```php
vendor/bin/phpunit --filter 'TeHelperTest'
```
## Code suggestion
As we have this code
```php
    if($difference <= 90)
        $time = $due_time;
    elseif ($difference <= 24) {
        $time = $created_at->addMinutes(90);
    } elseif ($difference > 24 && $difference <= 72) {
        $time = $created_at->addHours(16);
    } else {
        $time = $due_time->subHours(48);
    }
```
Every time we run test these condition will not meet because this condition ``php if($difference <= 90) `` at the top 
```php
 elseif ($difference <= 24) {
        $time = $created_at->addMinutes(90);
    } elseif ($difference > 24 && $difference <= 72) {
        $time = $created_at->addHours(16);
    }
```
My suggested code is this 
```php
   if ($difference <= 24) {
        $time = $created_at->addMinutes(90);
    } elseif ($difference > 24 && $difference <= 72) {
        $time = $created_at->addHours(16);
    }elseif($difference <= 90){
       $time = $due_time;
    }
    else {
        $time = $due_time->subHours(48);
    }
```
