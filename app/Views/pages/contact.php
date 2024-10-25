<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h2>Contact Us</h2>
      <table class="table table-striped table-dark mt-3">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tipe</th>
          <th scope="col">Alamat</th>
          <th scope="col">Kota</th>
        </tr>
        </thead>
        <tbody>
      <?php foreach ($alamat as $a) : ?>
        <tr>
          <th><?= $a['no']; ?></th>
          <td><?= $a['tipe']; ?></td>
          <td><?= $a['alamat']; ?></td>
          <td><?= $a['kota']; ?></td>
        </tr>
      <?php endforeach; ?>
        </tbody>
        </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>