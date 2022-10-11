<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Edit Product</h3>
        <hr>
        <?php if (session()->get('success')): ?>
            <div class="alert alert-success" role="alert">
              <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
        <form class="" action="/products/update" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          
          <input type="hidden" id="product_id" name="product_id" value="<?= $product['product_id'] ?>">
          <div class="row">
            <div class="col-12">
               <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" value="<?= set_value('product_name'), $product['product_name'] ?>">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="product_description">Product Description:</label>
                    <textarea rows="5" class="form-control" id="product_description" name="product_description" maxlength="2000"><?= set_value('product_description'), $product['product_description'] ?></textarea>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                   <label for="product_price">Product Price:</label>
                   <input type="number" step="0.01" min="0" class="form-control" name="product_price" id="product_price" value="<?= set_value('product_price'), $product['product_price'] ?>">
                </div>
              </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="available_quantity">Available Quantity:</label>
                    <input type="number" min="0" class="form-control" name="available_quantity" id="available_quantity" value="<?= set_value('available_quantity'), $product['available_quantity'] ?>">
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="product_name">Product Image:</label>
                    <input type="file" class="form-control" name="product_image" id="product_image" required>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <img src="<?=  base_url("uploads/".$product['product_image']);?>" height="50px" width="50px" alt="product image">
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
              <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>