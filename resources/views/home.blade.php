@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hi <em><strong>{{ $driver_name }}</strong> </em>{{ __('You are now logged in') }} into <strong>St. John Ambulance Portal</strong>!
                    <br>
                    <br>
                    @if ($status == 0)
                        Your ambulance is on stand by, once an emergency occurs you will be notified via email.
                    @else
                        Your ambulance is on duty, click this <a href="{{ route('ambulance.status')}}">link</a> to change its status to stand by once you have completed dispatch.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
