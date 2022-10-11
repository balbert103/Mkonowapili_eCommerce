<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Add Subcategory</h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                      <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <form class="" action="/subcategories/create" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="category">Choose Category:</label>
                        <select class="form-select" id="category" name="category">
                            <option value="" selected disabled hidden>Choose here</option>
                          <?php foreach($categories as $category){ ?>
                            <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                          <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory_name">Subcategory Name:</label>
                        <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="<?= set_value('subcategory_name') ?>">
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
                            <button type="submit" class="btn btn-sm btn-primary">Add Subcategory</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>