@extends("backend.layout.master")
@section("content")
    <input type="text" name="search" id="search" class="form-control mb-3" placeholder='Search posts.....'>
    <div class="containeer">
        <div class="alert"></div>
        <div class="table-data table-responsive">
            <button data-bs-toggle="modal" data-bs-target="#createPostModal" class="btn btn-sm btn-success rounded-0 text-white mb-3">Create Post</button>

            <div class="table-data">

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
                                    <button data-bs-toggle="modal" data-bs-target="#showPostModal" data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                        data-description="{{ $post->description }}" data-image="{{ $post->image }}" class="btn btn-sm btn-info btn-sm rounded-0 text-white showPostBtn">Show</button>
                                    <button data-bs-toggle="modal" data-bs-target="#editPostModal" data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                        data-description="{{ $post->description }}" data-image="{{ $post->image }}" class="btn btn-sm btn-warning btn-sm rounded-0 text-white editBtn">Edit</button>
                                    <a data-id="{{ $post->id }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger btn-sm rounded-0 text-white deleteBtn">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $posts->links("pagination::bootstrap-4") }}
        </div>
    </div>
    @include("backend.posts.post_create_modal")
    @include("backend.posts.post_edit_modal")
    @include("backend.posts.post_show_modal")
    <script>
        $(document).ready(function() {
            $(document).on('click', '#createPostBtn', function(e) {
                // console.log('okay');
                e.preventDefault();
                let title = $('#title').val();
                let description = $('#description').val();
                let image = $('#image')[0].files[0]; // Use [0].files[0] to get the file object

                let formData = new FormData();
                formData.append('title', title);
                formData.append('description', description);
                formData.append('image', image);

                // Add the content type option and processData option
                $.ajax({
                    url: "{{ route("post.store") }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        // console.log(res);
                        if (res.status == 'success') {
                            $('#createPostModal').modal('hide');
                            $('#createPostForm')[0].reset();
                            $('.table').load(location.href + ' .table');
                            $('.alert').empty();
                            $('.alert').append(`<p class='alert alert-success'>Post created successfully</p>`);
                        }
                    },
                    error: function(err) {
                        let error = err.responseJSON;
                        console.log(error);
                        if (error.errors.title) {
                            $('.titleError').empty();
                            $('.titleError').append(`<p class="text-danger">${error.errors.title}</p>`);
                        }
                        if (error.errors.description) {
                            $('.descriptionError').empty();
                            $('.descriptionError').append(`<p class="text-danger">${error.errors.description}</p>`);
                        }
                        if (error.errors.image) {
                            $('.imageError').empty();
                            $('.imageError').append(`<p class="text-danger">${error.errors.image}</p>`);
                        }
                    }
                });
                console.log(formData);
            });

            // delete
            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route("post.delete") }}",
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function(res) {
                        if (res.status == 'success') {

                            $('.table').load(location.href + ' .table');
                            $('.alert').empty();
                            $('.alert').append(
                                `<p class='alert alert-danger'>Post deleted</p>`)
                        }
                    },
                })
            });

            //Edit
            $(document).on('click', '.editBtn', function() {
                let id = $(this).data('id');
                let title = $(this).data('title');
                let description = $(this).data('description');
                let image = $(this).data('image');
                // Display the image preview
                $('#currentImagePreview').attr('src', "{{ asset("images/posts/") }}" + '/' + image);
                $('#update_id').val(id);
                $('#update_title').val(title);
                $('#update_description').val(description);
            })

            //update
            $(document).on('click', '.updatePostBtn', function(e) {
                e.preventDefault();
                let id = $('#update_id').val();
                let title = $('#update_title').val();
                let description = $('#update_description').val();
                let image = $('#update_image')[0].files[0]; // Use [0].files[0] to get the file object
                // console.log(id, title, description, image);

                let formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('id', id);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('image', image);

                $.ajax({
                    url: "{{ route("post.update") }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#editPostModal').modal('hide');
                            $('#editPostForm')[0].reset();
                            $('.table').load(location.href + ' .table');
                            $('.alert').empty();
                            $('.alert').append(
                                `<p class='alert alert-success'>Post updated</p>`)
                        }
                    },
                    error: function(err) {
                        let error = err.responseJSON;


                        if (error.errors.title) {
                            $('.titleError').empty();
                            $('.titleError').append(`<p class="text-danger">${error.errors.title}</p>`);
                        }
                        if (error.errors.description) {
                            $('.descriptionError').empty();
                            $('.descriptionError').append(`<p class="text-danger">${error.errors.description}</p>`);
                        }
                        if (error.errors.image) {
                            $('.imageError').empty();
                            $('.imageError').append(`<p class="text-danger">${error.errors.image}</p>`);
                        }

                    }
                });
            });

            //show

            $(document).on('click', '.showPostBtn', function(e) {

                e.preventDefault();
                let id = $(this).data('id');
                let title = $(this).data('title');
                let description = $(this).data('description');
                let image = $(this).data('image');




                $.ajax({
                    url: "{{ route("post.show") }}",
                    method: 'POST',
                    data: {
                        id: id,
                        title: title,
                        description: description,
                        image: image,
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('.showPostTitle').empty();
                            $('.showPostTitle').append(
                                `<p>${ title}</p>`)
                            $('.showPostDescription').empty();
                            $('.showPostDescription').append(
                                `<p>${ description}</p>`)
                            $('.showPostImage').empty();
                            $('.showPostImage').empty().append(`<img src="{{ asset("images/posts/") }}/${image}" alt="Post Image" style="width: 100px">`);
                        }
                    },

                });

            });
            //pagination function
            function post_pagination(page) {
                $.ajax({
                    url: "/pagination/paginate-data?page=" + page,
                    success: function(res) {
                        $('.table-data').html(res);
                    }
                })
            }
            //pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                post_pagination(page);
            });
            //serarch
            $(document).on('keyup', function(e) {
                e.preventDefault();
                let search_string = $('#search').val();
                // console.log(search_string);
                $.ajax({
                    url: "{{ route("post.search") }}",
                    method: 'GET',
                    data: {
                        search_string: search_string
                    },
                    success: function(res) {
                        $('.table-data').html(res);
                        if (res.status == 'nothing_found') {
                            $('.table-data').html(
                                `<span class='text-danger'>Nothing Found</span>`)
                        }
                    }
                })

            })
        });
    </script>
    <script>
        document.getElementById('update_image').addEventListener('change', function() {
            var input = this;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Update the src attribute of the image element to show the preview
                    document.getElementById('imagePreview').src = e.target.result;
                    // Show the image preview
                    document.getElementById('imagePreview').style.display = 'block';
                    document.getElementById('imagePreviewDiv').style.display = 'block';
                    document.getElementById('currentImageDiv').style.display = 'none';
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection
