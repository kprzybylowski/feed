@extends('layouts.app')

<?php
//    dump($company);
?>


@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ empty($company)?'New company':'Company edit'}}</div>
                <div class="card-body">
                    <form method="post" action="/company/save">
                        {{ csrf_field() }}
                        <input type="hidden" id="id" name="id" value="{{ !empty($company->id)?$company->id:null }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Company name</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required id="name" name="name" placeholder="Company name" class="form-control" value="{{ !empty($company->name)?$company->name:null }}">
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
