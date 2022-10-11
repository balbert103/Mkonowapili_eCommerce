<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Update User</h3>
        <hr>
        <?php if (session()->get('success')): ?>
            <div class="alert alert-success" role="alert">
              <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
        <form class="" action="/admin-user/update" method="post">
          <?= csrf_field() ?>
            
          <div class="row">
              <input type="hidden" id="user_id" name="user_id" value="<?= $user['user_id'] ?>">
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="first_name">First Name:</label>
               <input type="text" class="form-control" name="first_name" id="first_name" value="<?= set_value('first_name', $user['first_name']) ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="last_name">Last Name:</label>
               <input type="text" class="form-control" name="last_name" id="last_name" value="<?= set_value('last_name', $user['last_name']) ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="email">Email address</label>
               <input type="text" class="form-control" readonly id="email" value="<?= $user['email'] ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="password">Password</label>
               <input type="password" class="form-control" name="password" id="password" value="">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="password_confirm">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
            </div>
           </div>
            <?php if (isset($validation)): ?>

              <div class="col-12">
                  <div class="alert alert-danger" role="alert">
                      <?= $validation->listErrors() ?>
                  </div>
              </div>

            <?php endif; ?>
          </div>
          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary">Update User</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>