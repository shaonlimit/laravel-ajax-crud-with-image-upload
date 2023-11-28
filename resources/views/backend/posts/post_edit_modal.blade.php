<!-- Button trigger modal -->

<!-- Modal -->
<div id="editPostModal" class="modal fade rounded-0" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <form action="" method="POST" enctype="multipart/form-data" id="editPostForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" name="id" id="update_id">
                        <div class="col-md-12">
                            <label for="title">Post Title:</label>
                            <input type="text" name="title" id="update_title" class="form-control" placeholder="Enter post title" required>
                            <div class="titleError" class="text-danger"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="description">Post Description:</label>
                            <textarea class="form-control" name="description" id="update_description" cols="30" rows="10" placeholder="Enter post description" required></textarea>
                            <div class="descriptionError" class="text-danger"></div>
                        </div>
                        <!-- Add an img tag to display the image -->
                        <div class="col-md-12" id='currentImageDiv'>

                            <p>Current Image:</p>
                            <img id="currentImagePreview" class="border border-1 rounded" style="width:250px;" src="">

                        </div>
                        <div class="col-md-12 p-2" id='imagePreviewDiv' style='display:none'>
                            <p>Uploaded Image:</p>
                            <img id="imagePreview" class="border border-1 rounded" src="#" alt="Image Preview" style="display: none;width:250px;">
                        </div>
                        <div class="col-md-12">
                            <label for="image">Post Image:</label>
                            <input type="file" name="image" id="update_image" class="form-control">
                            <div class="imageError" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="editPostBtn" class="btn btn-primary btn-sm text-white updatePostBtn">Edit Post</button>
                </div>
            </div>
        </div>
    </form>
</div>
