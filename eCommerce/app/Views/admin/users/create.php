<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Add User</h3>
        <hr>
        <?php if (session()->get('success')): ?>
            <div class="alert alert-success" role="alert">
              <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
        <form class="" action="/admin-user/create" method="post">
          <?= csrf_field() ?>
      
          <div class="row">
            <div class="form-group">
              <label for="role">Choose role:</label>
              <select class="form-select" id="role" name="role">
                 <option value="" selected disabled hidden>Choose here</option>
                <?php foreach($roles as $role){ ?>
                 <option <?= set_select('role', $role->role_id ); ?> value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="first_name">First Name:</label>
               <input type="text" class="form-control" name="first_name" id="first_name" value="<?= set_value('first_name') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="last_name">Last Name:</label>
               <input type="text" class="form-control" name="last_name" id="last_name" value="<?= set_value('last_name') ?>">
              </div>
            </div>
            <div class="form-group">
                <label for="gender">Choose gender:</label>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                  <label class="form-check-label" for="male">
                    Male
                  </label>
                </div>
              </div>
            <div class="col-12 col-sm-6">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                <label class="form-check-label" for="female">
                  Female
                </label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="email">Email address</label>
               <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="password">Password</label>
               <input type="password" class="form-control" name="password" id="password">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="password_confirm">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm">
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
              <button type="submit" class="btn btn-primary">Add New User</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>