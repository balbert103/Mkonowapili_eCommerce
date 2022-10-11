<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Edit Role</h3>
                <hr>
                <form class="" action="/roles/update" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" id="role_id" name="role_id" value="<?= $role['role_id'] ?>">
                    <div class="form-group">
                        <label for="role_name">Role Name:</label>
                        <input type="text" class="form-control" name="role_name" id="role_name" value="<?= set_value('role_name'), $role['role_name'] ?>">
                    </div>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary">Update Role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>