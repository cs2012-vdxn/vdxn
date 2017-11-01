<div class="container">
  <div class="col-lg-6 col-md-10" style="min-height: 100%; padding: 0px;">
    <h1>Create a New Task</h1>
    <p>
      Fill in as much information as possible so that we can find the best doers to job done!
    </p>
    <div class="login-form">
      <div class="form-group">
        <form method="post" action="/tasks/newtask">
          <div class="form-group">
            <input type="text" name="title" class="form-control login-field" placeholder="Title">
          </div>

          <div class="form-group">
            <textarea name="description" class="form-control login-field" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <input type="text" name="taskdate" class="form-control login-field" placeholder="Start date">
          </div>

          <div class="form-group">
            <input type="text" name="min_bid" class="form-control login-field" placeholder="Min bid">
          </div>

          <div class="form-group">
            <input type="text" name="max_bid" class="form-control login-field" placeholder="Max bid">
          </div>

          <br/>

          <label style="font-size: 24px;"><b>Category</b></label>
          <br>
          <div class="form-group">
              <label for="sel1">Please Select a Category</label>
              <select class="form-control" id="sel1" name="category">
                  <option> </option>
                  <option>Minor Repairs</option>
                  <option>Mounting</option>
                  <option>Assembly</option>
                  <option>Help Moving</option>
                  <option>Delivery</option>
                  <option>BabySitting</option>
                  <option>Others</option>
              </select>
          </div>
          <br>
          <label style="font-size: 24px;"><b>Tags</b></label>
          <br>
          <div class="tagsinput-primary">
            <input name="tagsinput" class="tagsinput" data-role="tagsinput" value="" />
          </div>
          <br>
          <input class="btn btn-primary btn-lg btn-block" type="submit" value="Create task">
        </form>
      </div>
    </div>
  </div>
</div>
