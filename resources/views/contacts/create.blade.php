@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('contacts.store') }}">
                        @csrf
                        <div class="form-outline mb-3">
                            <input type="text" class="form-control" name="first_name" required/>
                            <label class="form-label" for="form4Example1">First Name</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" class="form-control" name="last_name" required/>
                            <label class="form-label" for="form4Example1">Last Name</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" class="form-control" name="phone[]" required/>
                            <div id='input-phone'></div>
                            <label class="form-label" for="form6Example6">Phone</label>
                            <input type="button" class="btn btn-success" onclick='addInput("phone")' value="+"/>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="email" class="form-control" name="email[]" required/>
                            <div id='input-email'></div>
                            <label class="form-label" for="form6Example5">Email</label>
                            <input type="button" class="btn btn-success" onclick='addInput("email")' value="+"/>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" class="form-control" name="address[]" required/>
                            <div id='input-address'></div>
                            <label class="form-label" for="form6Example4">Address</label>
                            <input type="button" class="btn btn-success" onclick='addInput("address")' value="+"/>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-outline">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Create</button>
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
