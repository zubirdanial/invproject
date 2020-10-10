<!-- Modal -->
<div class="modal fade" id="form_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change User Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="update_user_form" onsubmit="return false">
          <div class="form-group">
              <label>Username</label>
              <input type="hidden" name="id" id="id" value=""/>
              <input type="text" class="form-control" name="update_user" id="update_user" aria-describedby="emailHelp">
              <small id="cat_error" class="form-text text-muted"></small>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
