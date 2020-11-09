<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * Tests of route name.
 * Not everyone route has a custom name.
 *
 */
class RouteNamesTest extends TestCase
{
    public function testHomepageGetRouteName()
    {
        $this->assertEquals(route('homepage.index'), env('APP_URL') . '/homepage');
    }
    
    public function testHomepagePostRouteName()
    {
        $this->assertEquals(route('homepage.store'), env('APP_URL'));
    }
    
    public function testAdminRouteName()
    {
        $url = env('APP_URL') . '/admin';
        $this->assertEquals(route('adminpanel.index'), $url);
        $this->assertEquals(route('adminpanel.store'), $url);
    }
    
    public function testOrderGetRouteName()
    {
        $id = 35;
        $this->assertEquals(route('order.index', ['id' => $id]), env('APP_URL') . '/order/' . $id);
    }
    
    public function testOrderPostRouteName()
    {
        $this->assertEquals(route('order.store'), env('APP_URL') . '/order');
    }
    
    public function testOrderSummaryRouteName()
    {
        $url = env('APP_URL') . '/summary';
        $this->assertEquals(route('summary.index'), $url);
        $this->assertEquals(route('summary.store'), $url);
    }
    
    public function testProfileGetRouteName()
    {
        $this->assertEquals(route('profile.index'), env('APP_URL') . '/profile/info');
    }
    
    public function testProfilePostRouteName()
    {
        $this->assertEquals(route('profile.store'), env('APP_URL') . '/profile');
    }
    
    public function testProfilePutRouteName()
    {
        $profile = 3915;
        $this->assertEquals(route('profile.update', ['profile' => $profile]), env('APP_URL') . '/profile/' . $profile);
    }
    
    public function testRepertoireRouteName()
    {
        $this->assertEquals(route('repertoire.index'), env('APP_URL') . '/repertoire');
    }
    
    public function testNoPermGetRouteName()
    {
        $role = 'some-role';
        $this->assertEquals(route('no-perm', ['role' => $role]), env('APP_URL') . '/noperm/' . $role);
    }
    
    public function testHomeRouteName()
    {
        $this->assertEquals(route('home'), env('APP_URL') . '/home');
    }
    
    public function testLogoutRouteName()
    {
        $this->assertEquals(route('logout'), env('APP_URL') . '/logout');
    }
    
    public function testReservationRouteName()
    {
        $this->assertEquals(route('create-reservation'), env('APP_URL') . '/reservation');
    }
}
