<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-2">Daftar Komik</h1>
      <a href="/Komik/create" class="mt-2 mb-2 btn btn-primary">Create Data Komik</a>
      <?php if( session()->getFlashdata('pesan') ) : ?>
        <div class="mt-2 alert alert-success" role="alert">
          <?= session()->getFlashdata('pesan'); ?>
        </div>
      <?php endif; ?>
         <table class="table table-striped table-dark mt-3 komik-table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Sampul</th>
          <th scope="col">Judul</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
      <?php $no = 1 ?>
      <?php foreach ($komik as $k) : ?>
        <tr>
          <th><?= $no++ ?></th>
          <td>
            <img src="/img/<?= $k['sampul']; ?>" class="img-komik">
          </td>
          <td><?= $k['judul']; ?></td>
          <td>
            <a href="/komik/<?= $k['slug']; ?>" class="btn btn-info">Detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
        </tbody>
        </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>