# refactor-code
overall code was good and well structured I have modified the code and 
removed some extra code to make it more clean and well structured.These are the changes that I’ve made in the code
Changes
## Removed extra variables
For Example in this function
```php
public function immediateJobEmail(Request $request)
    {
        $adminSenderEmail = config('app.adminemail');
        $data = $request->all();

        $response = $this->repository->storeJobEmail($data);
}
```
There is no use of variable $adminSenderEmail 

## Removed extra if else statements and make it single line code
For example
```php
if (isset($data['distance']) && $data['distance'] != "") {
            $distance = $data['distance'];
        } else {
            $distance = "";
        }
```
After change
```php
$distance = isset($data['distance']) ? $data['distance'] : '';
```
Similarly I’ve made other changes

## Added laratrust role 
```php
if($request->__authenticatedUser->user_type == env('ADMIN_ROLE_ID') || $request->__authenticatedUser->user_type == env('SUPERADMIN_ROLE_ID'))
```
After adding laratrust role
```php
if($request->__authenticatedUser->hasRole(['admin','super_admin'])) 
```
