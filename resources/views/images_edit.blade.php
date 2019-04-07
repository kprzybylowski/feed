@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header">Image upload</div>
                <div class="card-body">
                    <form method="post" action="/images/save" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="created_by" name="created_by" value="{{ $data['created_by'] }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Company</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" @if ($data['user_role'] !== 'admin') disabled='disabled' @endif required name="company_id" id="company_id">
                                        @foreach ($data['companies'] as $company)
                                            <option value="{{ $company->id }}" @if ($company->id === $data['company_id'] ) selected="selected" @endif >
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
                                    <label for="is_primary">Primary image?</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="checkbox" id="is_primary" name="is_primary" class="align-middle">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="image">File input</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" required class="form-control-file" name="image" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9 text-right">
                                    <button type="submit" class="btn btn-outline-success btn-sm">Upload</button>
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
