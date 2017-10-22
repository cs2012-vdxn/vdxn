<div class="container">
    <h1>New Task</h1>
    <p>
      Here is where a new task is created.
    </p>
    <form method="post" action="/tasks/newtask">
      <label>Title</label>
      <br>
      <input type="text" name="title">
      <br>
      <label>Description</label>
      <br>
      <textarea name="description"></textarea>
      <br>
      <label>Task Date</label>
      <br>
      <input type="text" name="taskdate">
      <br>
      <label>Min bid</label>
      <br>
      <input type="text" name="min_bid">
      <br>
      <label>Max bid</label>
      <br>
      <input type="text" name="max_bid">
      <br>
        <label>Category</label>
        <br>
        <div class="form-group">
            <label for="sel1">Please Select a Category</label>
            <select class="form-control" id="sel1" name="category">
                <option> </option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
        <br>
        <label>Tags</label>
        <br>
        <div class="tagsinput-primary">
            <input name="tagsinput" class="tagsinput" data-role="tagsinput" value="" />
        </div>
        <br>
        <input type="submit">
    </form>
</div>
