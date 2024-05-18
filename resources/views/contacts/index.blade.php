@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('list') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('contacts.create') }}';">Add</button>
                    </div>

                    <div class="mb-3">
                        <form action="{{ route('contacts.index') }}" method="GET">
                            <div class="row">
                                <div class="col">
                                    <div class="form-outline">
                                        <select class="form-select" name="column" aria-label="Default select example" required>
                                            <option value="" selected>Select column</option>
                                            <option value="first_name">First name</option>
                                            <option value="last_name">Last name</option>
                                            <option value="phone">Phone</option>
                                            <option value="email">Email</option>
                                            <option value="address">Addresses</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-outline">
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" required/>
                                            <button type="submit" class="btn btn-outline-primary">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>photo</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Show</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img
                                                src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                                                alt=""
                                                style="width: 45px; height: 45px"
                                                class="rounded-circle"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{ $contact->first_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{ $contact->last_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info">Show</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-secondary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
