<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-md-2 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <h3>Available Items</h3>
            <hr>
            <?php if (session()->get('message')): ?>
                <div class="alert <?= session()->get('alert-class') ?>" role="alert">
                  <?= session()->get('message') ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="container">
                    <form action="/home/sort" method="post">
                        <?= csrf_field() ?>
                        
                        <label for="sort">Sort By:</label>
                        <select class="form-select" id="sort" name="sort" onchange="this.form.submit()">
                            <option value="" selected disabled hidden>Choose here</option>
                            <option <?php echo set_select('sort', 'reset');?> value="reset">Default</option>
                            <option <?php echo set_select('sort', 'oldest_first');?> value="oldest_first">Oldest First</option>
                            <option <?php echo set_select('sort', 'newest_first');?> value="newest_first">Newest First</option>
                            <option <?php echo set_select('sort', 'lowest_price_first');?> value="lowest_price_first">Lowest Price First</option>
                            <option <?php echo set_select('sort', 'highest_price_first');?> value="highest_price_first">Highest Price First</option>
                        </select>
                   </form>
                </div>   
                <?php if ($products) {?>
                    <?php foreach($products as $product) { ?>
                    <div class="col-sm-6">
                        <div class="card">
                          <img class="card-img-top" src="<?= base_url("uploads/".$product->product_image);?>" alt="product image">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $product->product_name; ?></h5>
                            <p class="card-text"><?php echo $product->product_description; ?></p>
                            <p class="card-text"><h3><?php echo $product->product_price; ?>/=</h3></p>
                          <p class="card-text"><h6>Available in Stock: <?php echo $product->available_quantity; ?></h6></p>
                            <form action="/orders/create" method="post">
                                <?= csrf_field() ?>
                                
                                <input type="hidden" id="product_id" name="product_id" value="<?php echo $product->product_id; ?>">
                                <input type="hidden" id="product_price" name="product_price" value="<?php echo $product->product_price; ?>">
                                <div class="d-flex flex-row">
                                    <div class="p-2"><p>Quantity:</p></div>
                                    <div class="p-2"><input type="number" min="1" class="form-control" name="order_quantity" id="order_quantity"></div>
                                    <div class="p-2"><button type="submit" class="btn btn-sm btn-success">+ Add</button></div>  
                                </div>
                                <?php if (isset($validation)): ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                 </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <?php } else { ?>
                <h1>No Products available</h1>
                <?php } ?>
            </div>
        </div>
    </div>
</div>