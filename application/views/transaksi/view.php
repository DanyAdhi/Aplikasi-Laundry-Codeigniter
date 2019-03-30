<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-5 text-gray-800">Overview Data <?=$section?></h1>
<?=$this->session->flashdata('flash') ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
      <div>
        <span class="m-0 font-weight-bold text-primary">Data <?=$section ?></span>
      </div>
      <div class="ml-auto">
        <a class="btn btn-sm btn-primary text-light" data-toggle="modal" data-target="#pakaian"><i class="fa fa-plus"></i> <b>Tambah</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered "  width="100%" cellspacing="0">
          <thead>
              <tr>
                <th style="text-align: left; width: 300px;">Jenis Pakaian</th>
                <th style="text-align:right;width: 50px">Jumlah</th>
                <th style="text-align:center; width: 150px">Aksi</th>
              </tr>
            </thead>
                    <?php foreach ($this->cart->contents() as $items): ?>
                    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                <tbody>
                    <tr>
                         <td><?=$items['name'];?></td>
                         <td style="text-align:center;"> <?php echo number_format($items['qty']);?></td>   
                         <td style="text-align:center;"><a href="<?php echo base_url().'admin/transaksi/remove/'.$items['rowid'];?>" class="btn btn-danger btn-xs"> Batal</a></td>
                    </tr>
                </tbody>
                        
                    <?php endforeach; ?>
          </table>

          <table class="mt-5">
            <tr>
              <td>Paket</td>
              <td>
                <select class="custom-select mb-2 ml-3" name="paket">
                  <?php foreach ($tarif as $tr) {?>
                    <option value="<?=$tr->id_tarif?>">
                      <?=$tr->nama_tarif.' ('.$tr->biaya_tarif.')' ?>
                    </option>  
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Berat</td>
              <td><input type="text" name="" class="form-control form-control-sm mb-2 ml-3"></td>
            </tr>
            <tr>
              <td>Total bayar</td>
              <td><input type="text" name="" class="form-control form-control-sm mb-2 ml-3"></td>
            </tr>
            <tr>
              <td></td>
              <td><button class="btn btn-sm btn-primary ml-3">Simpan</button></td>
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
              $id = $t->id_pakaian; ?>
            <tr>
              <td align="center"><?=$no ?></td>
              <td><?=$t->nama_pakaian ?></td>
              <td><input type="number" name="qty" class="form-control form-contrl-sm" style="width:70px" value="1"></td>
              <td align="center">
                  <button href="" class="btn btn-sm btn-danger" title="Hapus" >Pilih</button>
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
  
</script>