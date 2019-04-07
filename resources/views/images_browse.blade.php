@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Images</div>
                <div class="card-body">
                    <a href="/images/edit" class="btn btn-outline-secondary btn-sm mb-3">Add image</a>
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Uploaded by</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <th scope="row" class="align-middle">{{ $image->id }}</th>
                                    <td class="align-middle"><a href='#' class="openImageModal" data-src="http://feed.uniled/storage/{{$image->name}}" data-label="{{$image->original_name}}" data-toggle="modal" data-target="#imageModal">{{ $image->original_name }}</a></td>
                                    <td class="align-middle">{{ $image->company->name }}</td>
                                    <td class="align-middle">{{ $image->creator->name }}</td>
                                    <td class="align-middle text-right">
                                        <a href="/images/delete/{{$image->id}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete image {{ $image->name }} ?')">Delete</a>
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
