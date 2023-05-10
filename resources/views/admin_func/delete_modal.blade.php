<div class="modal fade" id="approvedeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Approve Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to approve this delete post request?</p>
          <form action="{{url('delete_post')}}" method="post">
            @csrf
            <input hidden name="post_id" id="post_id">
            <div class="modal-footer">
              <button type="submit" name="delete" class="btn btn-success">Proceed</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="rejectdeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reject Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to reject this delete post request?</p>
          <form action="{{url('/rejectDelete')}}" method="post">
            @csrf
            <input hidden name="post_id" id="post_id">
            <div class="modal-footer">
              <button type="submit" name="delete" class="btn btn-danger">Proceed</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>