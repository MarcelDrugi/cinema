@extends('layouts.base')

@section('content')
	<h2> {{ __('REPERTOIRE-API DESCRIPTION') }}  </h2>
	@if($info)
		{!! trans($info->content) !!} <br>
	@endif
	<h2>{{ __('You can use 2 endpoints to download information about the screening schedule and description of movies.') }}</h4>
	<ul class="list-group">
		<li class="list-group-item list-group-item-secondary">
			<h4>{{ env('APP_URL') }}/api/screenings</h4>
			<table class="table table-dark">
                <tr>
                    <th>{{ __('Filter') }}</th>
                    <th>{{ __('Action') }}</th>
                    <th>{{ __('Example') }}</th>
                </tr>
                <tr>
                    <td>-{{ __('no filter') }}-</td>
                    <td>{{ __('All future screenings in the database.') }}</td>
                    <td>{{ env('APP_URL') }}/api/screenings</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>{{ __('Filters screenings by movie title.') }}</td>
                    <td>{{ env('APP_URL') }}/api/screenings?title=Ben Hur</td>
                </tr>
                <tr>
                    <td>sevenDays</td>
                    <td>{{ __('Screenings from the next 7 days.') }}</td>
                    <td>{{ env('APP_URL') }}/api/screenings?sevenDays=true</td>
                </tr>
                <tr>
                    <td>day</td>
                    <td>{{ __('Screenings on a specific single day.') }}</td>
                    <td>{{ env('APP_URL') }}/api/screenings?day=2020-11-24</td>
                </tr>
            </table>
            <div>
                <h5>Przykład: </h5>
                {{ env('APP_URL') }}/api/screenings?day=2020-11-29&title=Gone with the Wind
                <div>Response: </div>
                <xmp>
                    {
                        "data": [
                            {
                                "freeTickets": true,
                                "term": "2020-11-29 15:25:00",
                                "time": 226,
                                "title": "Gone with the Wind"
                            },
                            {
                                "freeTickets": true,
                                "term": "2020-11-29 20:40:00",
                                "time": 226,
                                "title": "Gone with the Wind"
                            },
                        ]
                    }
                </xmp>
            </div>
		</li>
		<li class="list-group-item list-group-item-secondary">
			<h4>{{ env('APP_URL') }}/api/movie/{title}</h4>
			<table class="table table-dark">
                <tr>
                    <th>{{ __('Filter') }}</th>
                    <th>{{ __('Action') }}</th>
                    <th>{{ __('Example') }}</th>
                </tr>
                <tr>
                    <td>{{ __('This endpoint does not support filters.') }}</td>
                    <td>{{ __('Returns information about the selected movie.') }}</td>
                    <td>{{ env('APP_URL') }}/api/movie/"Gone with the Wind"</td>
                </tr>
            </table>
            <div>
                <h5>Przykład: </h5>
                {{ env('APP_URL') }}/api/movie/"Rocky"
                <div>Response: </div>
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
		</li>
    </ul>
@endsection