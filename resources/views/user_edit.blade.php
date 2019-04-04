@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ empty($user)?'New user':'User edit'}}</div>
                <div class="card-body">
                    <form method="post" action="/user/save">
                        {{ csrf_field() }}
                        <input type="hidden" id="id" name="id" value="{{ !empty($user->id)?$user->id:null }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">User name</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required id="name" name="name" placeholder="User name" class="form-control" value="{{ !empty($user->name)?$user->name:null }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Email/login</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required id="email" name="email" placeholder="Email/login" class="form-control" value="{{ !empty($user->email)?$user->email:null }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Role</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option disabled hidden value @if (empty($user)) selected="selected" @endif>Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if (!empty($user) && $role->id === $user->role->id ) selected="selected" @endif >
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Company</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" required name="company_id" id="company_id">
                                        <option disabled hidden value @if (empty($user)) selected="selected" @endif>Company</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}" @if (!empty($user) && $company->id === $user->company->id ) selected="selected" @endif >
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Password</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" @if (empty($user)) required @endif id="password" name="password" placeholder="Password - leave empty to not change" class="form-control" value="{{ null }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9 text-right">
                                    <button type="submit" class="btn btn-outline-success btn-sm">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
