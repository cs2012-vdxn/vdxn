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
      <textarea name="details"></textarea>
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
      <input type="submit">
    </form>
</div>
