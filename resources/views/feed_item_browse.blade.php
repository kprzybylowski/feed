<div>
    <a href="/feed/{{$feed->id}}/item_edit" class="btn btn-outline-secondary btn-sm mb-3">Create item</a>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Primary image</th>
            <th scope="col">Secondary image</th>
            <th scope="col">Sort</th>
            <th scope="col"></th>
        </thead>
        <tbody>
            @if (isset($feed->items))
                @foreach($feed->items as $feedItem)
                    <tr>
                        <th scope="row" class="align-middle">{{ $feed->id }}</th>
                        <td class="align-middle">{{ $feedItem->title }}</td>
                        <td class="align-middle">{{ $feedItem->primaryImg->original_name }}</td>
                        <td class="align-middle">{{ $feedItem->secondaryImg->original_name }}</td>
                        <td class="align-middle">{{ $feedItem->sort }}</td>
                        <td class="align-middle text-right">
                            <a href="/feed/{{$feedItem->feed_id}}/item_edit/{{$feedItem->id}}" class="btn btn-outline-secondary btn-sm">Edit</a>
                            <a href="/feed/item_delete/{{$feedItem->id}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete feed item {{ $feedItem->title }} ?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>