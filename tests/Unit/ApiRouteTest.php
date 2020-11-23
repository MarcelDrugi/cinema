<?php

namespace Tests\Unit;

use Tests\TestCase;

/**
 * Unit tests of API-routes.
 *
 */
class ApiRouteTest extends TestCase
{
    public function testScreeningWithoutFilters()
    {
        $url = 'api/screenings';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testScreeningWithTitleFilter()
    {
        $url = 'api/screenings?title=Some Title';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testScreeningWithDayFilter()
    {
        $url = 'api/screenings?day=2020-12-19';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testScreeningWithSevenDaysFilter()
    {
        $url = 'api/screenings?sevenDays=true';
        $response = $this->get($url);
        $this->assertEquals(200, $response->status());
    }
    
    public function testScreeningWithIncorrectFilter()
    {
        $url = 'api/screenings?incorrect=something';
        $response = $this->get($url);
        $this->assertEquals(400, $response->status());
    }
    
    public function testMovieWithTitleParameter()
    {
        $url = 'api/movie/NotExist';
        $response = $this->get($url);
        $this->assertEquals(404, $response->status());
    }
    
    public function testMovieWithoutParameter()
    {
        $url = 'api/movie';
        $response = $this->get($url);
        $this->assertEquals(404, $response->status());
    }
}