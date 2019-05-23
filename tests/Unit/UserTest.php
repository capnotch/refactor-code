<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\TeHelper;
use Carbon\Carbon;
use App\User;
use App\Models\Languages;
use App\Repository\UserRepository;
class UserTest extends TestCase
{
    protected $data = array();
     
    function setup() {
        parent::setUp();
        $this->data['role'] = "";
        $this->data['name'] = "Test";
        $this->data['status'] = "";
        $this->data['username'] = "Test";
        $this->data['company_id'] = 1;
        $this->data['department_id'] = 1;
        $this->data['consumer_type'] = '';
        $this->data['post_code'] = 123;
        $this->data['customer_type'] = 'client';
        $this->data['email'] = 'test@gmail.com';
        $this->data['dob_or_orgid'] = Carbon::parse('2000-01-01 00:00:00');;
        $this->data['phone'] = '0123456';
        $this->data['mobile'] = '0123456';
        $this->data['password'] = '123123';
        $this->data['new_towns'] = true;
        $this->data['town'] = 'Taxila';
        $this->data['address'] = 'Taxila';
        $this->data['address_2'] = 'Taxila';
        $this->data['user_language'] = array(1,2,3);
        $this->data['country'] = 'Pakistan';
        $this->data['city'] = 'Taxila';
        $this->data['additional_info'] = 'Additional info';
        $this->data['user_towns_projects'] = false;
   
        $this->data['translator_ex'] = false;
        $this->data['translator_type'] = 'abc';
        $this->data['gender'] = 'M';
        $this->data['translator_level'] = 'Lavel 1';
        $this->data['additional_info'] = 'additional_info';
        $this->data['post_code'] = '123123';
        $this->data['organization_number'] = '123123';
     
        $this->data['worked_for'] = 'yes';
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        }
        

        $controller = new UserRepository(new User());
        $response = $controller->createOrUpdate( null ,$this->data );
        $this->assertEquals($response->email ,$this->data['email']);
    }

    public function testNewUser(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        }    

        $controller = new UserRepository(new User());
              
        $controller->createOrUpdate( null ,$this->data );
        $this->assertTrue(true);
    }

     /**
     * @group RoleIsClient
     */
    public function testNewUserRoleIsClient(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['role'] = 'client';
        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );
        $this->assertEquals($response->user_type,'client');

        // update existing user

        $user = User::where('email',$this->data['email'])->first();
        
        $this->data['role'] = 'client';
        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( $user->id ,$this->data );
        $this->assertEquals($response->user_type,'client');
    }

    /**
     * @group RoleIsClient
     */
    public function testNewUserRoleIsPaidClient(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['role'] = 'client';
        $this->data['consumer_type'] = 'paid';

        
        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );
        $this->assertEquals($response->user_type,'client');
        $this->assertNotEquals($response->company_id,Null);

        // if company id is null
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['role'] = 'client';
        $this->data['consumer_type'] = 'paid';
        $this->data['company_id'] = '';
        
        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );
        $this->assertEquals($response->user_type,'client');
        $this->assertNotEquals($response->company_id,"");

        // update existing user

        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['role'] = 'client';
        $this->data['consumer_type'] = 'paid';

        
        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );
        $this->assertEquals($response->user_type,'client');
        $this->assertNotEquals($response->company_id,Null);

        // if company id is null
        $user = User::where('email',$this->data['email'])->first();
        
        $this->data['role'] = 'client';
        $this->data['consumer_type'] = 'paid';
        $this->data['company_id'] = '';
        
        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( $user->id ,$this->data );
        $this->assertEquals($response->user_type,'client');
        $this->assertNotEquals($response->company_id,"");
    }
    /**
     * @group RoleIsTranslator
     */
    public function testNewUserRoleIsTranslator(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['role'] = 'translator';

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );

        $this->assertEquals($response->user_type,'translator');
        $this->assertEquals($response->usermeta->translator_type,'abc');

        // update existing user

        $user = User::where('email',$this->data['email'])->first();
        
        $this->data['role'] = 'translator';

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( $user->id ,$this->data );

        $this->assertEquals($response->user_type,'translator');
        $this->assertEquals($response->usermeta->translator_type,'abc');
    }

    /**
     * @group RoleIsTranslator
     */
    public function testNewUserRoleIsTranslatorWorkedForYes(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['role'] = 'translator';
        $this->data['worked_for'] == 'yes';
        $this->data['organization_number'] == '123123';

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );

        $this->assertEquals($response->user_type,'translator');
        $this->assertEquals($response->usermeta->translator_type,'abc');
        $this->assertEquals($response->usermeta->worked_for,'yes');
        $this->assertEquals($response->usermeta->organization_number,$this->data['organization_number']);

        // update existing user

        $user = User::where('email',$this->data['email'])->first();
        
        $this->data['role'] = 'translator';
        $this->data['worked_for'] == 'yes';
        $this->data['organization_number'] == '123123';

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( $user->id ,$this->data );

        $this->assertEquals($response->user_type,'translator');
        $this->assertEquals($response->usermeta->translator_type,'abc');
        $this->assertEquals($response->usermeta->worked_for,'yes');
        $this->assertEquals($response->usermeta->organization_number,$this->data['organization_number']);
    }
    /**
    * @group WithUserStatusOn 
    */
    public function testWithUserStatusOn(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['status'] = '1';
         

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );

        $this->assertEquals($response->status,true); 

         // update existing user

         $user = User::where('email',$this->data['email'])->first();
         
        $this->data['status'] = '1';
         

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( $user->id ,$this->data );

        $this->assertEquals($response->status,true); 
    }
    /**
    * @group WithUserStatusOf 
    */
    public function testWithUserStatusOf(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 
        $this->data['status'] = '0';

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );

        $this->assertEquals($response->status,"0"); 

         // update existing user

         $user = User::where('email',$this->data['email'])->first();
          
        $this->data['status'] = '0';

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( $user->id ,$this->data );

        $this->assertEquals($response->status,"0"); 
    }
    /**
     * @group RoleIsTranslator
     * @group RoleIsTranslatorNewLanguage
     */
    public function testNewUserRoleIsTranslatorNewLanguage(){
        $user = User::where('email',$this->data['email'])->first();
        if($user){
            $user->delete();
        } 

        $language = Languages::where('languagename','Test')->first();
         

        $this->data['role'] = 'translator';
        $this->data['worked_for'] = 'yes';
        $this->data['organization_number'] = '123123';
        $this->data['user_language'] = array($language->id);

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( null ,$this->data );
        
        $this->assertEquals($response->user_type,'translator');
        $this->assertEquals($response->usermeta->translator_type,'abc');
        $this->assertEquals($response->usermeta->worked_for,'yes');
        $this->assertEquals($response->usermeta->organization_number,$this->data['organization_number']);

         // update existing user

         $user = User::where('email',$this->data['email'])->first();
         

        $language = Languages::where('languagename','Test')->first();
         

        $this->data['role'] = 'translator';
        $this->data['worked_for'] = 'yes';
        $this->data['organization_number'] = '123123';
        $this->data['user_language'] = array($language->id);

        $controller = new UserRepository(new User());
              
        $response = $controller->createOrUpdate( $user->id ,$this->data );
        
        $this->assertEquals($response->user_type,'translator');
        $this->assertEquals($response->usermeta->translator_type,'abc');
        $this->assertEquals($response->usermeta->worked_for,'yes');
        $this->assertEquals($response->usermeta->organization_number,$this->data['organization_number']);
    }

   
    
}
