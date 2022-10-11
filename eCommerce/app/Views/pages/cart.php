<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-md-2 mt-5 pt-3 bg-white from-wrapper">
            <div class="container">
                <h3><?php echo session()->get('first_name') ?>'s Cart</h3>
                <hr>
                <?php if (session()->get('message')): ?>
                    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
                      <?= session()->get('message') ?>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">My Cart</div>
                    <div class="card-body">
                        <div class="d-flex flex-row p-3 bg-secondary text-white">
                            <div class="p-2 text-center">
                                <p>Items:</p>
                                <?php if ($orders){ ?>
                                    <?php foreach ($orders as $order) { ?>
                                        <p><?php echo $order->product_name; ?></p>
                                        <br/>
                                    <?php } ?>
                                <?php } else { ?>
                                    <p>Nothing to show</p>
                                <?php } ?>
                            </div>
                            <div class="p-2 text-center">
                                <p>Price</p>
                                <?php if ($orders){ ?>
                                    <?php foreach ($orders as $order) { ?>
                                        <p><?php echo $order->product_price; ?></p>
                                        <br/>
                                    <?php } ?>
                                <?php } else { ?>
                                    <p>0</p>
                                <?php } ?>
                            </div>
                            <div class="p-2 text-center">
                                <p>Quantity:</p>
                                <?php if ($orders){ ?>
                                    <?php foreach ($orders as $order) { ?>
                                        <p>X <?php echo $order->order_quantity; ?></p>
                                        <br/>
                                    <?php } ?>
                                <?php } else { ?>
                                    <p>X 0</p>
                                <?php } ?>
                            </div>
                            <div class="p-2 text-center">
                                <p>Remove:</p>
                                <?php if ($orders){ ?>
                                    <?php foreach ($orders as $order) { ?>
                                         <form action="/orders/remove" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" id="order_id" name="order_id" value="<?= $order->order_id; ?>">
                                            <input type="hidden" id="orderdetails_id" name="orderdetails_id" value="<?= $order->orderdetails_id; ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">-</button>
                                        </form>
                                        <br/>
                                    <?php } ?>
                            <?php } ?>
                            </div>
                            <div class="p-2 text-center">
                                <p>Add:</p>
                                <?php if ($orders){ ?>
                                    <?php foreach ($orders as $order) { ?>
                                        <form action="/orders/add" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" id="order_id" name="order_id" value="<?= $order->order_id; ?>">
                                            <input type="hidden" id="product_id" name="product_id" value="<?= $order->product_id; ?>">
                                            <input type="hidden" id="orderdetails_id" name="orderdetails_id" value="<?= $order->orderdetails_id; ?>">
                                            <button type="submit" class="btn btn-sm btn-success">+</button>
                                        </form>
                                        <br/>
                                    <?php } ?>
                            <?php } ?>
                            </div>
                            <div class="p-2 text-center">
                                <p>Delete:</p>
                                <?php if ($orders){ ?>
                                    <?php foreach ($orders as $order) { ?>
                                        <form action="/orders/delete" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" id="order_id" name="order_id" value="<?= $order->order_id; ?>">
                                            <input type="hidden" id="orderdetails_id" name="orderdetails_id" value="<?= $order->orderdetails_id; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        <br/>
                                    <?php } ?>
                            <?php } ?>
                            </div>      
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="/orders/order" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="payment_type">Payment type:</label>
                                <select class="form-select" id="payment_type" name="payment_type">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <?php foreach($paymenttypes as $paymenttype){ ?>
                                    <option <?php echo set_select('payment_type', $paymenttype->paymenttype_id);?> value="<?php echo $paymenttype->paymenttype_id; ?>"><?php echo $paymenttype->paymenttype_name; ?></option>
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
                            <div class="d-flex flex-row">
                                <div class="p-2 text-center">Total Amount (KES): </div>
                                <div class="p-2 ">

                                    <?php if ($orders){ ?>
                                        <?php foreach ($orders as $order) { ?>
                                            <p><?php echo $order->order_amount; ?></p>
                                            <?php break; ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <p>0</p>
                                    <?php } ?>
                                </div>
                            </div>
                             <div class="d-flex flex-row">
                                 <div class="p-2 text-center"><?php echo session()->get('first_name')?>'s Balance (KES): </div>
                                <div class="p-2 ">

                                    <?php if ($wallets){ ?>
                                        <?php foreach ($wallets as $wallet) { ?>
                                            <p><?php echo $wallet->amount_available; ?></p>
                                            <?php break; ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <p>0</p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="p-2 text-center"><a href="/" class="btn btn-primary">Close</a></div>
                                <?php if ($orders){ ?>
                                    <?php foreach ($orders as $order) { ?>
                                        <input type="hidden" id="order_id" name="order_id" value="<?= $order->order_id; ?>">
                                        <div class="p-2 text-center"><button <?php if (! $orders) {?>disabled<?php } ?>type="submit" class='btn btn-success'>Order</button></div>     
                                        <?php break; ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>