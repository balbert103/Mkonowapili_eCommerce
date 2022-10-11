<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?php echo session()->get('first_name') ?>'s Wallet</h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                      <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <div class="d-flex flex-row">
                    <div class="p-2"><h4>Balance (KES): </h4></div>
                    <?php if ($wallet) :?>
                        <div class="p-2"><h4><?php echo $wallet['amount_available'] ?></h4></div>
                        <div class="text-left">
                            <a class="btn btn-success" href="/wallet/recharge">Recharge</a>
                        </div>
                    <?php else: ?>
                        <div class="text-left">
                            <a class="btn btn-primary" href="/wallet/create">Create Wallet</a>
                        </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</div>