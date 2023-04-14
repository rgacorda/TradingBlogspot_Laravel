<div class="modal fade" id="editcomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="{{url('/update_comm')}}" method="post">
            @csrf
            <input hidden name="comm_id" id="comm_id">
          <div class="form-outline mb-4">
            <textarea name="content" id="comm_content" cols="30" rows="5" class="form-control"></textarea>
            <label class="form-label" for="content">content</label>
            <span class="text-danger">@error('content') {{$message}}@enderror</span>
          </div>
  

          <div class="form-outline mb-4">
            <ul class="rat">
              <li class="rat"><label class="rat" for="rating_1"></label><i class="fa fa-star" aria-hidden="true"></i><input class="rat" type="radio" name="ratings" id="rating_1" value="1"></li>
              <li class="rat"><label class="rat" for="rating_2"></label><i class="fa fa-star" aria-hidden="true"></i><input class="rat" type="radio" name="ratings" id="rating_2" value="2"></li>
              <li class="rat"><label class="rat" for="rating_3"></label><i class="fa fa-star" aria-hidden="true"></i><input class="rat" type="radio" name="ratings" id="rating_3" value="3"></li>
              <li class="rat"><label class="rat" for="rating_4"></label><i class="fa fa-star" aria-hidden="true"></i><input class="rat" type="radio" name="ratings" id="rating_4" value="4"></li>
              <li class="rat"><label class="rat" for="rating_5"></label><i class="fa fa-star" aria-hidden="true"></i><input class="rat" type="radio" name="ratings" id="rating_5" value="5"></li>
            </ul>

          </div>
          
            <div class="modal-footer">
              <button type="submit" name="delete" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="delcomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this comment?</p>
          <form action="{{url('/delete_comm')}}" method="post">
            @csrf
            <input hidden name="comm_id" id="comm_id">
            <div class="modal-footer">
              <button type="submit" name="delete" class="btn btn-danger">Delete</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  