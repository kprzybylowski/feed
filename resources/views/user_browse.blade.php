<?php

//dump($users->toArray());

?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <a href="/user/edit" class="btn btn-outline-secondary btn-sm mb-3">Add user</a>
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Login</th>
                            <th scope="col">Company</th>
                            <th scope="col">Role</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row" class="align-middle">{{ $user->id }}</th>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->company->name }}</td>
                                    <td class="align-middle">{{ $user->role->name }}</td>
                                    <td class="align-middle text-right">
                                        <a href="/user/edit/{{$user->id}}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                        <a href="/user/delete/{{$user->id}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete user {{ $user->name }} ?')">Delete</a>
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
