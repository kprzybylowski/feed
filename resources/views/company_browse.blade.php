@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Company</div>
                <div class="card-body">
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
                                        <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
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
