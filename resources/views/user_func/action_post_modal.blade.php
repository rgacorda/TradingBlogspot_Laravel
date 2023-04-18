

  <div class="modal fade" id="editpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="{{url('/update_post')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input id="post_id" name="id" hidden>
          <div class="form-outline mb-4">
            <input type="text" id="post_title" name="title" class="form-control" >
            <label class="form-label" for="title">Title</label>
            <span class="text-danger">@error('title') {{$message}}@enderror</span>
          </div>
          <div class="form-outline mb-4">
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            <label class="form-label" for="textAreaExample6">Content and Details</label>
            <span class="text-danger">@error('content') {{$message}}@enderror</span>
          </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" name='image' type="file" id="formFile">
          </div>
  
  
          <?php 
          $categories = DB::table('cats')->get();
        ?>
  
          <div class="mb-4">
            <select name="cats" id="post_cat" class="form-control">
              <option value="" selected>Select Category</option>
              @foreach ($categories as $cat)
                <option value="{{$cat->id}}">{{$cat->cat_desc}}</option>  
              @endforeach
            </select>
            <span class="text-danger">@error('cats') {{$message}}@enderror</span>
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


  <div class="modal fade" id="delpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this post?</p>
          <form action="{{url('/delete_post')}}" method="post">
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

  {{-- add photos --}}
  