## Installation
- run composer install
- php artisan:migrate
- php artisan:seed

## PHP Unit test for UserRepository Function createOrUpdate
- Open your terminal
- move to the root directory
- run this command
```php
vendor/bin/phpunit --filter 'UserTest'
```
## First Code suggestion
remove these line of code 
```php
 if ($langidUpdated) {
     $userLang::deleteLang($model->id, $langidUpdated);
 }
```
From
```php
if ($request['user_language']) {
                 
        foreach ($request['user_language'] as $langId) {
            $userLang = new UserLanguages();
            $already_exit = $userLang::langExist($model->id, $langId);

            if ($already_exit == 0) {
                $userLang->user_id = $model->id;
                $userLang->lang_id = $langId;
                $userLang->save();

            }
            $langidUpdated[] = $langId;

        }
        // if ($langidUpdated) {
        //     $userLang::deleteLang($model->id, $langidUpdated);
        // }
    }
```
Because every time if new language added then it remove all user languages from the database along with the new language added.
## Second Code suggestion
 From the below code
 
 ```php
 if ($request['status'] == '1') {
        if ($model->status != '1') {
             $this->enable($model->id);
        }
    } else {
        if ($model->status != '0') {
             $this->disable($model->id);
        }
    }
return $model ? $model : false;    
```     
after change 

```php
if ($request['status'] == '1') {
        if ($model->status != '1') {
            $model = $this->enable($model->id);
        }
    } else {
        if ($model->status != '0') {
            $model = $this->disable($model->id);
        }
    }
 return $model ? $model : false;   
```
Because it was not updating the model variable with status attribute
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
