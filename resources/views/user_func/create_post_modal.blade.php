<div class="modal fade" id="createpostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form class="mx-1 mx-md-4" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Create a Thread</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body mx-3">
  
          <div class="form-outline mb-4">
            <input type="text" name="title" class="form-control" >
            <label class="form-label" for="title">Title</label>
            <span class="text-danger">@error('title') {{$message}}@enderror</span>
          </div>
          <div class="form-outline mb-4">
            <textarea class="form-control" name="content" rows="8"></textarea>
            <label class="form-label" for="textAreaExample6">Content and Details</label>
            <span class="text-danger">@error('content') {{$message}}@enderror</span>
          </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Upload Image</label>
            <input class="form-control" name='image' type="file" id="formFile">
          </div>

          <?php 
            $categories = DB::table('cats')->get();
          ?>

          <div class="mb-4">
            <select name="cats" class="form-control">
              <option value="" selected>Select Category</option>
              @foreach ($categories as $cat)
                <option value="{{$cat->id}}">{{$cat->cat_desc}}</option>
                  
              @endforeach
            </select>
            <span class="text-danger">@error('cats') {{$message}}@enderror</span>
          </div>  

          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Post</button>
          </div>
      </form>
      </div>
    </div>
  </div>

{{-- add photos --}}

