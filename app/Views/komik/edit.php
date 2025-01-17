<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-10">
      <h2 class="my-3">Form Edit Data Komik</h2>
      <form action="/komik/update/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
      <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
      <input type="hidden" name="sampulLama" value="<?= $komik['sampul']; ?>">
      <div class="form-group row">
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
          <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= (old('judul')) ? old('judul') : $komik['judul'] ?>" autofocus>
          <div class="invalid-feedback">
            <?= $validation->getError('judul'); ?>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
        <div class="col-sm-10">
          <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('penulis'); ?>
          </div>          
        </div>
      </div>
      <div class="form-group row">
        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
        <div class="col-sm-10">
          <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('penerbit'); ?>
          </div>          
        </div>
      </div>
      <div class="form-group row">
        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                <div class="col-sm-2">
          <img src="/img/<?= $komik['sampul'] ?>" alt="default gambar..." class="img-thumbnail img-preview">
        </div>
        <div class="col-sm-8">
          <div class="custom-file">
            <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="preViewImg()">
          <div class="invalid-feedback">
            <?= $validation->getError('sampul'); ?>
          </div>
            <label class="custom-file-label" for="sampul"><?= $komik['sampul'] ?></label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <a href="/Komik" class="btn btn-info">Back</a>
          <button type="submit" class="btn btn-primary">Edit Data</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>