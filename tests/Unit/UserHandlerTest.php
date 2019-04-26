<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserHandlerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample ()
    {
        $this->assertTrue(true);
    }

    public function testSignup (){
        $response = $this -> json('POST', '/api/signup', [
            'username' => 'testUsername', 
            'u_mail' => 'testEmail@test.com',
            'password' => 'testPassword', 
            'c_password' => 'testPassword', 
            'f_name' => 'testFname',
            'l_name' => 'testLname',
            'age' => '18',
            'gender' => 'male',
        ]);

        $response->assertStatus(200) ;
    } 
    
    public function testLogin (){
        $response = $this -> json('POST', '/api/login', [
            'mail' => 'testEmail',
            'password' => 'testPassword',
        ]);
        $response -> assertStatus(200);
    }

    public function testUserData (){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/userdata');
        $response -> assertStatus(200);
    }

    public function testAddSkill(){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/addskill', [
            'skill' => 'testSkill',
        ]);
        $response -> assertStatus(200);
    }

    public function testUpdateScore (){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/updatescore', [
            'skill' => 'testSkill',
            'score' => '5',
        ]);
        $response -> assertStatus(200);
    }

    public function testFollowUser (){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/followuser', [
            'followeduser' => 'testEmail@test.com',
        ]);
        $response -> assertStatus(200);
    }

    public function testFollowCompany (){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/followcompany', [
            'followedcompany' => 'testCompany@test.com',
        ]);
        $response -> assertStatus(200);
    }

    public function testAddResolvedQuiz (){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/addresolvedquiz', [
            'q_id' => '0',
        ]);
        $response -> assertStatus(200);
    }

    public function testGetFollowedCompanies (){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/getfollowedcompanies');
        $response -> assertStatus(200);
    }

    public function testGetFollowedUsers (){
        $user = factory(User::class) -> make();
        $response = $this -> actingAs($user) -> get('/api/getfollowedusers');
        $response -> assertStatus(200);
    }
}
