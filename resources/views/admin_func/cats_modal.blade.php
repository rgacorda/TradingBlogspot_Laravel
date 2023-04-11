<div class="modal fade" id="createcatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form class="mx-1 mx-md-4" action="" method="POST">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Add Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="form-outline mb-4">
            <input type="text" name="title" class="form-control" >
            <label class="form-label" for="title">Category Name</label>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
          </div>
      </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editcatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form class="mx-1 mx-md-4" action="" method="POST">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Edit Category</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="form-outline mb-4">
            <input type="text" name="title" class="form-control" >
            <label class="form-label" for="title">Category Name</label>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="submit" class="btn btn-default">Cancel</button>
          </div>
      </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delcatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this category?</p>
            <form action="" method="post">
              @csrf
              <input hidden name="cat_id" id="cat_id">
              <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    