<?=$this->session->flashdata('flash') ?>

<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-11">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Input Data <?=$section ?></h1>
            </div>
            <form class="user" method="POST" action="<?=base_url('admin/user/save')?>">
              <div class="form-group mb-3">
                <label class="text-dark">Nama</label>
                <input type="text" class="form-control" placeholder="Nama Lengkap..." name="nama" value="<?=set_value('nama') ?>">
                <?=form_error('nama', "<small class='text-danger'>",'</small>') ?>
              </div>
              <div class="form-group mb-3">
                <label class="text-dark">Username</label>
                <input type="text" class="form-control" placeholder="Username..." name="username" value="<?=set_value('username') ?>">
                <?=form_error('username',"<small class='text-danger'>",'</small>') ?>
              </div>
              <div class="form-group row pb-3">
                <div class="col-sm-6 ">
                  <label class="text-dark">Password</label>
                  <input type="password" class="form-control" placeholder="Password.." name="password1">
                   <?=form_error('password1',"<small class='text-danger'>",'</small>') ?> 
                </div>
                <div class="col-sm-6">
                  <label class="text-dark">Ulangi Password</label>
                  <input type="password" class="form-control" placeholder="Ulangi password.." name="password2">
                </div>
              </div>
              <div class="form-group">
                <label class="text-dark">Level</label>
                <select class="form-control text-dark" name="level">
                  <option value="1" <?=set_select('level','1') ?> >Admin</option>
                  <option value="2" <?=set_select('level','2') ?> >Karyawan</option>
                </select>
              </div>


              <hr>
              <div class="d-flex">
              <button type="submit" class="btn btn-primary mr-3">Simpan</button>
            </form>        
            <a href="<?=base_url('admin/user') ?>" class="btn btn-secondary">Kembali</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>