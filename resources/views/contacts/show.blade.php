@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-12 col-xl-12">
                        <div class="card shadow-0 border rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" class="w-100" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xl-9">
                                        <h6>First name:</h6>
                                        <h3>{{ $contact->first_name }}</h3>

                                        <hr/>

                                        <h6>Last name:</h6>
                                        <h4>{{ $contact->last_name }}</h4>

                                        <hr/>

                                        <h6>Phones:</h6>
                                        @foreach($contact->phones as $phone)
                                            <h4>{{ $phone->phone }}</h4>
                                        @endforeach

                                        <hr/>

                                        <h6>Emails:</h6>
                                        @foreach($contact->emails as $email)
                                            <h4>{{ $email->email }}</h4>
                                        @endforeach

                                        <hr/>

                                        <h6>Addresses:</h6>
                                        @foreach($contact->addresses as $address)
                                            <h4>{{ $address->address }}</h4>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mt-3">
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('contacts.index') }}';">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
