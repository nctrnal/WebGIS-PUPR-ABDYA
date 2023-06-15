<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <embed src="<?= base_url('uploads/berkas/'. $jaringan->pdf) ?>" type="application/pdf" width=100% height=800>
</div>

<?= $this->endSection('content'); ?>