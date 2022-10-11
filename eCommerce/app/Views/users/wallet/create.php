<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Create Wallet</h3>
                <hr>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success" role="alert">
                      <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                <form class="" action="/wallet/create" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <p>Enter the amount of money you want to add to your wallet: </p>
                    </div>
                    <div class="form-group">
                        <label for="email">Amount (KES):</label>
                        <input type="number" step="0.01" min="1" class="form-control" name="amount" id="amount" value="<?= set_value('amount') ?>">
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
                            <button type="submit" class="btn btn-success">Pay Now</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a class="btn btn-primary" href="/wallet">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>