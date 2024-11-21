@extends('layouts/main')

@section('container')

<section class="home">
    <div class="text">Users</div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td> <!-- Note: Displaying password is typically not done in real applications-->
            </tr>
            @endforeach
        </tbody>
    </table>

</section>

@endsection
