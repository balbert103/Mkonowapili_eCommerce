<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Add API Product</h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                      <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <form class="" action="/api-product/create" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="category">Choose Category:</label>
                        <select class="form-select" id="productname" name="productname">
                            <option value="" selected disabled hidden>Choose here</option>
                            <option value="userdetails">User Details</option>
                            <option value="products">Products</option>
                            <option value="transactions">Transactions</option>
                        </select>
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
                            <button type="submit" class="btn btn-sm btn-primary">Add API Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>