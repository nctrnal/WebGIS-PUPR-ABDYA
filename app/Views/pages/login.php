<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container align-item-center">
    <div class="col-8">
        <div class="row-8">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url(); ?>/Login/process">
                <?= csrf_field(); ?>
                <div class="form-floating my-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus required>
                    <label for="username" class="form-label">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <label for="password" class="form-label">Password</label>
                </div>
                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>