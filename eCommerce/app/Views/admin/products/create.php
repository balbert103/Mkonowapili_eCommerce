<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Add Product</h3>
        <hr>
        <?php if (session()->get('success')): ?>
            <div class="alert alert-success" role="alert">
              <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <form action="/products/category" method="post">
                <label for="category">Choose Category:</label>
                <select class="form-select" id="category" name="category" onchange="this.form.submit()">
                <option value="" selected disabled hidden>Choose here</option>
                    <?php foreach($categories as $category){ ?>
                    <option <?php echo set_select('category', $category->category_id);?> value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                    <?php } ?>
                </select>
           </form>
        </div>
        <form class="" action="/products/create" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
      
          <div class="row">
            <div class="form-group">
                <label for="subcategory_id">Choose Product Category:</label>
                <select class="form-select" id="subcategory_id" name="subcategory_id">
                    <option value="" selected disabled hidden>Choose here</option>
                    <?php foreach($subcategories as $subcategory){ ?>
                    <option <?php echo set_select('subcategory_id', $subcategory->subcategory_id);?> value="<?php echo $subcategory->subcategory_id; ?>"><?php echo $subcategory->subcategory_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12">
               <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" value="<?= set_value('product_name') ?>">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="product_description">Product Description:</label>
                    <textarea rows="5" class="form-control" id="product_description" name="product_description" maxlength="2000"><?= set_value('product_description') ?></textarea>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                   <label for="product_price">Product Price:</label>
                   <input type="number" step="0.01" min="0" class="form-control" name="product_price" id="product_price" value="<?= set_value('product_price') ?>">
                </div>
              </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="available_quantity">Available Quantity:</label>
                    <input type="number" min="0" class="form-control" name="available_quantity" id="available_quantity" value="<?= set_value('available_quantity') ?>">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="product_name">Product Image:</label>
                    <input type="file" class="form-control" name="product_image" id="product_image" required>
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
              <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>