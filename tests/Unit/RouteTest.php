<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Unit tests of routes.
 *
 */
class RouteTest extends TestCase
{
 
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);
        $this->withoutMiddleware(\App\Http\Middleware\CheckRole::class);
    }

    public function testHomepageGetFirstRoute()
    {
        $url = '/';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testHomepageGetSecondRoute()
    {
        $url = '/homepage';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testHomepageGetWithParameterSecondRoute()
    {
        $url = '/homepage/abc';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testAboutGetRoute()
    {
        $url = '/about';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testAdminGetRoute()
    {
        $url = '/admin';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testAdminPostRoute()
    {
        $url = '/admin';
        $response = $this->post($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testApiDescriptionGetRoute()
    {
        $url = '/api-description';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testOrderPostRoute()
    {
        $url = '/order';
        $response = $this->post($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testOrderWithParameterGetRoute()
    {
        $url = '/order/425';
        $response = $this->get($url);
        $this->assertEquals(404, $response->status());  // The route is correct, but record doesnt exist
    }
    
    public function testSummaryGetRoute()
    {
        $url = '/summary';
        $response = $this->call('GET', $url, [], [], [],  ['HTTP_REFERER' => env('APP_URL') . '/order']);
        $this->assertEquals(200, $response->status());
    }
    
    public function testPricingGetRoute()
    {
        $url = '/pricing';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testProfileWithoutParameterGetRoute()
    {
        $url = '/profile/info';
        $response = $this->get($url);
        $this->assertEquals(500, $response->status()); // The route is correct, but cant find logged user
    }
    
    public function testProfileWithParameterGetRoute()
    {
        $url = '/profile/info/abc';
        $response = $this->get($url);
        $this->assertEquals(500, $response->status()); // The route is correct, but cant find logged user Auth::user()
    }
    
    public function testProfilePostRoute()
    {
        $url = '/profile';
        $response = $this->post($url);
        $this->assertEquals(404, $response->status()); // The route is correct, but fail 'findOfFaril' method
    }
    
    public function testProfilePutRoute()
    {
        $url = '/profile/28';
        $response = $this->put($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testRepertoireGetRoute()
    {
        $url = '/repertoire';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testNoPermGetRoute()
    {
        $url = '/noperm/admin';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testLoginGetRoute()
    {
        $url = '/login';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testLoginPostRoute()
    {
        $url = '/login';
        $response = $this->post($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testRegisterGetRoute()
    {
        $url = '/register';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testRegisterPostRoute()
    {
        $url = '/register';
        $response = $this->post($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testHomeGetRoute()
    {
        $url = '/home';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testLogoutGetRoute()
    {
        $url = '/logout';
        $response = $this->get($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testReservationPostRoute()
    {
        $url = '/reservation';
        $response = $this->call('POST', $url, [], [], [],  ['HTTP_REFERER' => 'env("APP_URL") . /summary']);
        $this->assertEquals(404, $response->status());  // The route is correct, but cant create ReservationService()
    }
    
    public function testMovieGetRoute()
    {
        $url = '/movie';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testMoviePostRoute()
    {
        $url = '/movie';
        $response = $this->post($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testMoviePutRoute()
    {
        $url = '/movie';
        $response = $this->put($url);
        $this->assertEquals(302, $response->status());
    }
    
    /*
     * Deleting a record is done with a put request with diferent url.
     */
    public function testMovieDeleteRoute()
    {
        $url = '/movie/delete';
        $response = $this->put($url);
        $this->assertEquals(500, $response->status());  // no key 'id'
    }
    
    public function testMovieRequestRoute()
    {
        $url = '/movie';
        $response = $this->delete($url);
        $this->assertEquals(405, $response->status());
    }
    
    public function testScreeningGetRoute()
    {
        $url = '/screening';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testScreeningPostRoute()
    {
        $url = '/screening';
        $response = $this->post($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testScreeningPutRoute()
    {
        $url = '/screening';
        $response = $this->put($url);
        $this->assertEquals(302, $response->status());
    }
    
    /*
     * Deleting a record is done with a put request with diferent url.
     */
    public function testScreeningDeleteRoute()
    {
        $url = '/screening/delete';
        $response = $this->put($url);
        $this->assertEquals(500, $response->status());  // no key 'id'
    }
    
    public function testDiscountGetRoute()
    {
        $url = '/discount';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testDiscountPostRoute()
    {
        $url = '/discount';
        $response = $this->post($url);
        $this->assertEquals(302, $response->status());
    }
    
    
    public function testDiscountDeleteRoute()
    {
        $url = '/discount/delete';
        $response = $this->delete($url);
        $this->assertEquals(302, $response->status());
    }
    
    public function testDiscountPutRoute()
    {
        $url = '/discount';
        $response = $this->put($url);
        $this->assertEquals(405, $response->status());
    }
    
    public function testDiscountPatchRoute()
    {
        $url = '/discount';
        $response = $this->patch($url);
        $this->assertEquals(405, $response->status());
    }
}
