<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Edit Subcategory</h3>
                <hr>
                <form class="" action="/subcategories/update" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" id="subcategory_id" name="subcategory_id" value="<?= $subcategory['subcategory_id'] ?>">
                     <div class="form-group">
                        <label for="category">Choose Category:</label>
                        <select class="form-select" id="category" name="category">
                          <option value="<?= $subcategory['category'] ?>" selected><?= $subcategory['category'] ?></option>
                          <?php foreach($categories as $category){ ?>
                            <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                          <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_name">Subcategory Name:</label>
                        <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="<?= set_value('subcategory_name'), $subcategory['subcategory_name'] ?>">
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
                            <button type="submit" class="btn btn-sm btn-primary">Update Subcategory</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>