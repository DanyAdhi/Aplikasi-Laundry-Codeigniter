<?=$this->session->flashdata('flash') ?>

<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-11">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Input Data <?=$section ?></h1>
            </div>
            <form class="user" method="POST" action="<?=base_url('admin/tarif/save')?>">
              <div class="form-group mb-3">
                <label class="text-dark">Nama Tarif</label>
                <input type="text" class="form-control" placeholder="Nama Tarif..." name="nama" value="<?=set_value('nama') ?>">
                <?=form_error('nama', "<small class='text-danger'>",'</small>') ?>
              </div>
              <div class="form-group mb-3">
                <label class="text-dark">Waktu Proses</label>
                <input type="text" class="form-control" placeholder="Lama Waktu Proses..." name="waktu" value="<?=set_value('waktu') ?>">
                <?=form_error('waktu',"<small class='text-danger'>",'</small>') ?>
              </div>
              <div class="form-group row pb-3">
                <div class="col-sm-6 ">
                  <label class="text-dark">Biaya</label>
                  <input type="text" class="form-control" placeholder="Biaya.." name="biaya" onkeypress="return inputAngka(event)" value="<?=set_value('biaya') ?>">
                   <?=form_error('biaya',"<small class='text-danger'>",'</small>') ?> 
                </div>
                <div class="col-sm-6">
                  <label class="text-dark">Jenis</label>
                  <select class="form-control text-dark" name="jenis">
                    <option value="Kg" <?=set_select('jenis','Kg') ?> >Kg</option>
                    <option value="Satuan" <?=set_select('jenis','Satuan') ?> >Satuan</option>
                  </select>
                </div>
              </div>
              <hr>
              <div class="d-flex">
              <button type="submit" class="btn btn-primary mr-3">Simpan</button>
            </form>        
            <a href="<?=base_url('admin/tarif') ?>" class="btn btn-secondary">Kembali</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  function inputAngka(evt){
      var charCode = (evt.charCode);
      // console.log(charCode)
      // jika charCode lebih dari 31(spasi) dan carCode kurang dari 48 atau charCode besar dari 57
      if(charCode>32 && (charCode<48 || charCode>57) && charCode!=45)
      {
        return false;
      }
      else
      {
        return true;
      }
  }
</script>