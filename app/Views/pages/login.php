<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <title>Login Admin</title>
</head>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:  #5bbf86">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="<?php echo base_url('img/logo.png') ?>" alt="ini logo" class="icon">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link border border-3 rounded" style="margin-right: 5px;" href="/">Beranda</a>
                <a class="nav-item nav-link border border-3 rounded" style="margin-right: 5px;" href="/Pages/jaringanIrigasi">Jaringan Irigasi</a>
                <a class="nav-item nav-link border border-3 rounded" style="margin-right: 5px;" href="/Pages/bangunanIrigasi">Bangunan Irigasi</a>
                <a class="nav-item nav-link border border-3 rounded" style="margin-right: 5px;" href="/Pages/daerahIrigasi">Daerah Irigasi</a>
                <a class="nav-item nav-link border border-3 rounded" style="margin-right: 5px;" href="/Pages/dokumentasi">Dokumentasi</a>
                <a class="nav-item nav-link border border-3 rounded" style="margin-right: 20px;" href="/Pages/dataIrigasi">Data</a>
            </div>
            <div class="navbar-nav">
                <div class="container">
                    <a class="nav-item nav-link border border-3 rounded-pill" style="margin-left:18cm; border:10px; border-color:black;" href="/Login">Login</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="col">
        <div class="row-8">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url(); ?>/Login/process">
                <?= csrf_field(); ?>
                <div class="my-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" autofocus required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
</div>

<body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>