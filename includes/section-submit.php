





<form method="post" name="front_end" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Recipe Name</label>
    <input type="text" name="title" class="form-control" >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Recipe Content</label>
    <textarea class="form-control" name="content" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Image</label>
    <input type="file" name="thumbnail" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <input type="hidden" name="action" value="front_post" />
</form>