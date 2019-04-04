@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Company</div>
                <div class="card-body">
                    <a href="/company/edit" class="btn btn-outline-secondary btn-sm mb-3">Add company</a>
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <th scope="row" class="align-middle">{{ $company->id }}</th>
                                    <td class="align-middle">{{ $company->name }}</td>
                                    <td class="align-middle text-right">
                                        <a href="/company/edit/{{$company->id}}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                        <a href="/company/delete/{{$company->id}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete company {{ $company->name }} ?')">Delete</a>
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
