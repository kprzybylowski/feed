@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header">{{ empty($data['feed_item']->id)?'New feed item':'Feed item edit'}}</div>
                <div class="card-body">
                    <form method="post" action="/feed/item_save">
                        {{ csrf_field() }}
                        @if (!empty($data['item']->id))
                            <input type="hidden" id="id" name="id" value="{{ $data['item']->id }}">
                        @endif
                        <input type="hidden" id="created_by" name="created_by" value="{{ $data['created_by'] }}">
                        <input type="hidden" id="feed_id" name="feed_id" value="{{ $data['feed_id'] }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Title</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required id="title" name="title" placeholder="Feed item title" class="form-control" value="{{ !empty($data['item']->id)?$data['item']->title:null }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Primary image</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control selectpicker" required name="primary_image" id="primary_image">
                                        <option disabled hidden value @if (empty($data['item'])) selected="selected" @endif>Primary image</option>
                                        @foreach ($data['images'] as $image)
                                            <option value="{{ $image->id }}" @if (!empty($data['item']) && $image->id === $data['item']->primary_image ) selected="selected" @endif data-thumbnail="{{ asset('storage/'.$image->name) }}">
                                                {{ $image->original_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Secondary image</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control selectpicker" required name="secondary_image" id="primary_image">
                                        <option disabled hidden value @if (empty($data['item'])) selected="selected" @endif>Secondary image</option>
                                        @foreach ($data['images'] as $image)
                                            <option value="{{ $image->id }}" @if (!empty($data['item']) && $image->id === $data['item']->secondary_image ) selected="selected" @endif data-thumbnail="{{ asset('storage/'.$image->name) }}">
                                                {{ $image->original_name }}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
