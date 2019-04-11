@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header">{{ empty($data['feed']->id)?'New feed':'Feed edit'}}</div>
                <div class="card-body">
                    <form method="post" action="/feed/save">
                        {{ csrf_field() }}
                        @if (!empty($data['feed']->id))
                            <input type="hidden" id="id" name="id" value="{{ $data['feed']->id }}">
                        @endif
                        <input type="hidden" id="created_by" name="created_by" value="{{ $data['created_by'] }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Feed name</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required id="name" name="name" placeholder="Feed name" class="form-control" value="{{ !empty($data['feed']->id)?$data['feed']->name:null }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Company</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" @if ($data['user_role'] !== 'admin') disabled='disabled' @endif required name="company_id" id="company_id">
                                        @foreach ($data['companies'] as $company)
                                            <option value="{{ $company->id }}" 
                                            @if ((empty($data['feed']->id) && $company->id === $data['company_id']) || (!empty($data['feed']->id) && $company->id === $data['feed']->company_id)) selected="selected" 
                                            @endif >
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                    @include('feed_item_browse', ['feed' => !empty($data['feed'])?$data['feed']:[]])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
