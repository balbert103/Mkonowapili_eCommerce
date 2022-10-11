<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Subscribe to API product</h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                      <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <form class="" action="/api-token/create" method="post">
                    <?= csrf_field() ?>
                    <p>Token will be automatically generated</p>
                    
                    <div class="form-group">
                        <label for="category">Choose API product:</label>
                        <select class="form-select" id="api_productid" name="api_productid">
                            <option value="" selected disabled hidden>Choose here</option>
                                <?php foreach($api_products as $api_product){ ?>
                                    <option <?php echo set_select('subcategory_id', $api_product->apiproduct_id);?> value="<?php echo $api_product->apiproduct_id; ?>"><?php echo $api_product->productname; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Choose Username:</label>
                        <select class="form-select" id="api_userid" name="api_userid">
                        <?php if (! empty($api_users)) {?>
                            <option value="" selected disabled hidden>Choose here</option>
                                <?php foreach($api_users as $api_user){ ?>
                                    <option <?php echo set_select('api_userid', $api_user->apiuser_id);?> value="<?php echo $api_user->apiuser_id; ?>"><?php echo $api_user->username; ?></option>
                                <?php } ?>
                            
                            <?php } else {?> 
                                <option value="" selected disabled hidden>You haven't registered as an API user</option>
                        <?php } ?>
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
                            <button type="submit" class="btn btn-sm btn-primary">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>