<!-- Button trigger modal -->

<!-- Modal -->
<div id="createPostModal" class="modal fade rounded-0" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <form action="" method="POST" enctype="multipart/form-data" id="createPostForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title">Post Title:</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter post title">
                            <div class="titleError" class="text-danger"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="description">Post Description:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Enter post description"></textarea>
                            <div class="descriptionError" class="text-danger"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="image">Post Image:</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <div class="imageError" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="createPostBtn" class="btn btn-primary btn-sm text-white">Create Post</button>
                </div>
            </div>
        </div>
    </form>
</div>
