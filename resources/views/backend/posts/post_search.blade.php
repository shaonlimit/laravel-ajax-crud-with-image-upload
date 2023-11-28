<table class="table table-bordered table-sm">
    <thead>
        <th>SL No.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ ++$sl }}</td>
                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $post->title }}</td>
                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $post->description }}</td>
                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><img style="width: 100px" src="{{ asset("images/posts/" . $post->image) }}"
                        alt="{{ $post->title }}">
                </td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#showPostModal" data-id="{{ $post->id }}" data-title="{{ $post->title }}" data-description="{{ $post->description }}"
                        data-image="{{ $post->image }}" class="btn btn-sm btn-info btn-sm rounded-0 text-white showPostBtn">Show</button>
                    <button data-bs-toggle="modal" data-bs-target="#editPostModal" data-id="{{ $post->id }}" data-title="{{ $post->title }}" data-description="{{ $post->description }}"
                        data-image="{{ $post->image }}" class="btn btn-sm btn-warning btn-sm rounded-0 text-white editBtn">Edit</button>
                    <a data-id="{{ $post->id }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger btn-sm rounded-0 text-white deleteBtn">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->links("pagination::bootstrap-4") }}
