<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-5 text-gray-800">Overview Data <?=$section?> Kiloan</h1>
<?=$this->session->flashdata('flash') ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
      <div>
        <span class="m-0 font-weight-bold text-primary">Data <?=$section ?> Kiloan</span>
      </div>
      <div class="ml-auto">
        <a class="btn btn-sm btn-primary text-light" data-toggle="modal" data-target="#pakaian"><i class="fa fa-plus"></i> <b>Tambah</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-responsive"  width="100%" cellspacing="0">
          <thead>
              <tr>
                <th style="text-align:center;width: 60px">NO</th>
                <th style="text-align: left; width: 650px;">Jenis Pakaian</th>
                <th style="width: 50px">Jumlah</th>
                <th style="text-align:center; width: 150px">Aksi</th>
              </tr>
            </thead>

              <?php 
                $no=1;
                foreach ($this->cart->contents() as $items): 
              ?>
            <tbody>
              <tr>
                  <td align="center"><?=$no ?></td>
                  <td><?=$items['name'];?></td>
                  <td style="text-align:center;"> <?php echo number_format($items['qty']);?></td>   
                  <td style="text-align:center;"><a href="<?php echo base_url().'admin/transaksi/remove_kiloan/'.$items['rowid'];?>" class="btn btn-danger btn-md"> Batal</a></td>
              </tr>
            </tbody>      
              <?php 
                $no++;
                endforeach; 
              ?>
          </table>
          <form method="POST" action="save_kiloan">
            <table class="mt-5">
              <tr>
                <td>Nama</td>
                <td>
                  <input type="text" name="nama" class="form-control form-control-sm ml-3" value="<?=set_value('nama')?>"> 
                  <?=form_error('nama', "<small class='text-danger ml-3'>",'</small>') ?>
                </td>
              </tr>
              <tr>
                <td>Paket</td>
                <td>
                  <select class="custom-select my-2 ml-3" name="paket" id="paket">
                    <?php foreach ($tarif as $tr) {?>
                      <option value="<?=$tr->nama_tarif.' ('.$tr->biaya_tarif?>">
                        <?=$tr->nama_tarif.' ('.$tr->biaya_tarif.')' ?>
                      </option>  
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Berat</td>
                <td>
                  <input type="text" name="berat" class="form-control form-control-sm  ml-3" id="berat" value="<?=set_value('berat')?>">
                  <?=form_error('berat', "<small class='text-danger ml-3'>",'</small>') ?>
                </td>
              </tr>
              <tr>
                <td>Total bayar</td>
                <td><input type="text" name="total" class="form-control form-control-sm my-2 ml-3" id="total" value="<?=set_value('total')?>"></td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <button class="btn btn-sm btn-primary ml-3">Simpan</button>
          </form>
                  <a href="<?=base_url('admin/transaksi/paket')?>" class="btn btn-sm btn-secondary ml-3">Kembali</a>
                </td>
              </tr>
            </table>
      </div>
    </div>
  </div>

</div>


<!-- Modal Add -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="pakaian">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold">Pilih Data Pakaian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-responsive" id="dataTable">
            <thead>
              <tr>
                <th style="width: 30px">No</th>
                <th style="width: 500px">Jenis Pakaian</th>
                <th width="100px">Jumlah</th>
                <th width="10px" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no=1;
                foreach($tampil as $t){ 
                $id = $t->id_pakaian; 
              ?>
              <tr>
                <td align="center"><?=$no ?></td>
                <td><?=$t->nama_pakaian ?></td>

                  <form method="POST" action="<?=base_url('admin/transaksi/add_cart_kiloan') ?>">
                <td><input type="number" name="jumlah" class="form-control form-contrl-sm" style="width:70px" value="1"></td>
                <td align="center">
                    <input type="hidden" name="id" value="<?=$t->id_pakaian ?>">
                    <button href="" class="btn btn-sm btn-danger" title="Hapus" >Pilih</button>
                  </form>
                </td>
              </tr>
            <?php $no++; }; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-- End Modal add -->

<script>
  $(document).ready(function(){
    $('#paket').change(function(){
      var berat = $('#berat').val();
      var paket = $(this).val();
      var paket = paket.split('(');
      var paket = paket[1];
      console.log(paket);
      var total = berat*paket;
      $('#total').val(total);
    });
        

        
    $('#berat').on("input", function(){
      var berat = $('#berat').val();
      var paket = $('#paket').val();
      var paket = paket.split('(');
      var paket = paket[1];

      console.log(paket);

      var total = berat*paket;
      $('#total').val(total);
    });


  });
</script>