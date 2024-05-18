@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('contacts.update', $contact->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-outline mb-3">
                                <input type="text" class="form-control" name="first_name" value="{{ $contact->first_name }}" required/>
                                <label class="form-label" for="form4Example1">First Name</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="text" class="form-control" name="last_name" value="{{ $contact->last_name }}" required/>
                                <label class="form-label" for="form4Example1">Last Name</label>
                            </div>
                            <div class="form-outline mb-3">
                                @foreach($contact->phones as $phone)
                                    <input type="text" class="form-control" name="phone[]" value="{{ $phone->phone }}" @if ($loop->first) required @endif/>
                                @endforeach
                                <div id='input-phone'></div>
                                <label class="form-label" for="form6Example6">Phone</label>
                                <input type="button" class="btn btn-success" onclick='addInput("phone")' value="+"/>
                            </div>

                            <div class="form-outline mb-3">
                                @foreach($contact->emails as $email)
                                    <input type="email" class="form-control" name="email[]" value="{{ $email->email }}" @if ($loop->first) required @endif/>
                                @endforeach
                                <div id='input-email'></div>
                                <label class="form-label" for="form6Example5">Email</label>
                                <input type="button" class="btn btn-success" onclick='addInput("email")' value="+"/>
                            </div>
                            <div class="form-outline mb-3">
                                @foreach($contact->addresses as $address)
                                    <input type="text" class="form-control" name="address[]" value="{{ $address->address }}" @if ($loop->first) required @endif/>
                                @endforeach
                                <div id='input-address'></div>
                                <label class="form-label" for="form6Example4">Address</label>
                                <input type="button" class="btn btn-success" onclick='addInput("address")' value="+"/>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-outline">
                                        <button type="submit" class="btn btn-primary btn-block mb-3">Update</button>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-outline">
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('contacts.index') }}';">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addInput(name){
            let container = document.getElementById('input-' + name);

            let input = '<input type="text" class="form-control" name="' + name + '[]" />';
            container.innerHTML += input;
        }
    </script>
@endsection
