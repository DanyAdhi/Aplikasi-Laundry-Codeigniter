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
            <form class="user" method="POST" action="<?=base_url('admin/tarif/update')?>">
              <?php 
                foreach ($price as $data): 
                $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($data->id));
              ?>
                <input type="hidden" name="id" value="<?=$id?>">
                
                <div class="form-group mb-3">
                  <label class="text-dark">Nama Tarif</label>
                  <input type="text" class="form-control" placeholder="Nama Tarif..." name="name" value="<?=set_value('name', $data->name) ?>">
                  <?=form_error('name', "<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group mb-3">
                  <label class="text-dark">Waktu Proses</label>
                  <input type="text" class="form-control" placeholder="Lama Waktu Proses..." name="time" value="<?=set_value('time',$data->time) ?>">
                  <?=form_error('time',"<small class='text-danger'>",'</small>') ?>
                </div>
                <div class="form-group row pb-3">
                  <div class="col-sm-6 ">
                    <label class="text-dark">Biaya</label>
                    <input type="text" class="form-control" placeholder="Biaya.." name="amount" onkeypress="return inputAngka(event)" value="<?=set_value('amount',$data->amount) ?>">
                    <?=form_error('amount',"<small class='text-danger'>",'</small>') ?> 
                  </div>
                  <div class="col-sm-6">
                    <label class="text-dark">Jenis</label>
                    <select class="form-control text-dark" name="type">
                      <option value="Kg" <?= ($data->type=='Kg') ? 'selected':'' ?> <?= set_select('type', 'Kg') ?> >
                        Kg
                      </option>
                      <option value="Satuan" <?= ($data->type == 'Satuan') ? 'selected':'' ?> <?= set_select('type', 'Satuan')?> >
                        Satuan
                      </option>
                    </select>
                  </div>
                </div>
                <hr>
                <div class="d-flex">
                <button type="submit" class="btn btn-primary mr-3">Simpan</button>
              <?php endforeach ?>
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
  function inputAngka(evt) {
      var charCode = (evt.charCode);
      // jika charCode lebih dari 31(spasi) dan carCode kurang dari 48 atau charCode besar dari 57
      if ( charCode > 32 && (charCode < 48 || charCode > 57) && charCode != 45 ) return false;
      return true;
  }
</script>