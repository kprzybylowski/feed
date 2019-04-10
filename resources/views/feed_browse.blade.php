@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Feed list</div>
                <div class="card-body">
                    <a href="/feed/edit" class="btn btn-outline-secondary btn-sm mb-3">Create feed</a>
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Created by</th>
                            <th scope="col">Items count</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @foreach($feedList as $feed)
                                <tr>
                                    <th scope="row" class="align-middle">{{ $feed->id }}</th>
                                    <td class="align-middle">{{ $feed->name }}</td>
                                    <td class="align-middle">{{ $feed->company->name }}</td>
                                    <td class="align-middle">{{ $feed->creator->name }}</td>
                                    <td class="align-middle">{{ $feed->items->count() }}</td>
                                    <td class="align-middle text-right">
                                        @if ($feed->items->count() === 0)
                                            <button disabled=disabled class="btn btn-outline-success btn-sm">Publish</button>
                                        @else
                                            <a href="/feed/publish/{{$feed->id}}" onclick="return confirm('Are you sure you want to publish this version of feed and overwrite the previous one?')" class="btn btn-success btn-sm">Publish</a>
                                        @endif
                                        <a href="/feed/edit/{{$feed->id}}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                        <a href="/feed/delete/{{$feed->id}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete feed {{ $feed->name }} ?')">Delete</a>
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
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="image" class="img-thumbnail" src="">
      </div>
    </div>
  </div>
</div>
@endsection
