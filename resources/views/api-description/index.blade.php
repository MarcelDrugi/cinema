@extends('layouts.base')

@section('content')
	<div class="apiTitle"> {{ __('REPERTOIRE-API DESCRIPTION') }}  </div>
	@if($info)
		{!! trans($info->content) !!} <br>
	@endif
	<div class="apiSubtitle"> {{ __('You can use 2 endpoints to download information about the screening schedule and description of movies.') }}</div>
	<div class="screeningEndpoint">
		<div class="endpointPath">
			<div class="apiBackground"></div>
			<ul><li>{{ env('APP_URL') }}/api/screenings</li></ul>
		</div>
		<table class="table">
            <tr>
                <th>&nbsp;{{ __('Filter') }}</th>
                <th>{{ __('Action') }}</th>
                <th>{{ __('Example') }}</th>
            </tr>
            <tr>
                <td>&nbsp;-{{ __('no filter') }}-</td>
                <td>{{ __('All future screenings in the database.') }}</td>
                <td>{{ env('APP_URL') }}/api/screenings</td>
            </tr>
            <tr>
                <td>&nbsp;title</td>
                <td>{{ __('Filters screenings by movie title.') }}</td>
                <td>{{ env('APP_URL') }}/api/screenings?title=Ben Hur</td>
            </tr>
            <tr>
                <td>&nbsp;sevenDays</td>
                <td>{{ __('Screenings from the next 7 days.') }}</td>
                <td>{{ env('APP_URL') }}/api/screenings?sevenDays=true</td>
            </tr>
            <tr>
                <td>&nbsp;day</td>
                <td>{{ __('Screenings on a specific single day.') }}</td>
                <td>{{ env('APP_URL') }}/api/screenings?day=2020-11-24</td>
            </tr>
        </table>
        <div class="endpointExample">
            <div class="apiResponseTitle">Request: </div>
            <div class="endpointExamplePath">
    			<div class="apiBackground"></div>
    			<p>{{ env('APP_URL') }}/api/screenings?day=2020-11-29&title=Przeminęło z wiatrem<p>
    		</div>
            <div class="apiResponseTitle">Response: </div>
            <div class="apiResponse">
            	<div class="apiBackground"></div>
                <xmp>
                    {
                        "data": [
                            {
                                "freeTickets": true,
                                "term": "2020-11-29 15:25:00",
                                "time": 226,
                                "title": "Przeminęło z wiatrem"
                            },
                            {
                                "freeTickets": true,
                                "term": "2020-11-29 20:40:00",
                                "time": 226,
                                "title": "Przeminęło z wiatrem"
                            },
                        ]
                    }
                </xmp>
            </div>
        </div>
	</div>
	<div class="movieEndpoint">
		<div class="endpointPath">
			<div class="apiBackground"></div>
			<ul><li>{{ env('APP_URL') }}/api/movie/{title}</li></ul>
		</div>
		<table class="table">
            <tr>
                <th>&nbsp;{{ __('Filter') }}</th>
                <th>{{ __('Action') }}</th>
                <th>{{ __('Example') }}</th>
            </tr>
            <tr>
                <td>&nbsp;{{ __('This endpoint does not support filters.') }}</td>
                <td>{{ __('Returns information about the selected movie.') }}</td>
                <td>{{ env('APP_URL') }}/api/movie/Rocky</td>
            </tr>
        </table>
        <div>
            <div class="apiResponseTitle">Request: </div>
            <div class="endpointExamplePath">
    			<div class="apiBackground"></div>
    			<p>{{ env('APP_URL') }}/api/movie/Rocky<p>
    		</div>
            <div class="apiResponseTitle">Response: </div>
            <div class="apiResponse">
            	<div class="apiBackground"></div>
            	<div class="apiBackgroundImg1">
            		<img src="{{ asset('images/api1.png') }}">
            	</div>
                <xmp>
                    {
                        "data": [
                            {
                                "title": "Rocky",
                                "description": "Historia Rocky'ego Balboa, boksera-amatora, któremu nadarza się okazja stoczenia walki\no tytuł mistrza świata wagi ciężkiej.",
                                "poster": "http://some/url/path/to/AWS/image",
                                "published": 1976,
                                "time": 119,
                                "age_limit": 12
                            }
                        ]
                    }
                </xmp>
            </div>
        </div>
	</div>
	<div class="apiBackgroundImg2">
		<img src="{{ asset('images/api2.png') }}">
	</div>
@endsection