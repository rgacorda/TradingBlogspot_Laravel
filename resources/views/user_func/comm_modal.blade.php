<div class="modal fade" id="editcommModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form class="mx-1 mx-md-4" action="" method="POST">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Edit Thread</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body mx-3">
 {{-- add values containing database --}}
          <div class="form-outline mb-4">
            <input type="text" name="title" class="form-control" >
            <label class="form-label" for="title">Title</label>
          </div>
          <div class="form-outline mb-4">
            <textarea class="form-control" id="textAreaExample6" rows="8"></textarea>
            <label class="form-label" for="textAreaExample6">Content and Details</label>
          </div>
            
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Update</button>
          </div>
      </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this comment?</p>
          <form action="" method="post">
            @csrf
            <input hidden name="post_id" id="post_id">
            <div class="modal-footer">
              <button type="submit" name="delete" class="btn btn-danger">Delete</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  