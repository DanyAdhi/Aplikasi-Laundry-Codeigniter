<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-5 text-gray-800">Overview Data <?=$section?> Satuan</h1>
<?=$this->session->flashdata('flash') ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
      <div>
        <span class="m-0 font-weight-bold text-primary">Data <?=$section ?> Satuan</span>
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
                <th style="text-align: left; width: 650px;">Jenis Barang</th>
                <th style="width: 50px">Jumlah</th>
                <th width="150px">Harga</th>
                <th width="200px">Total</th>
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
                  <td style="text-align:center;"> <?php echo number_format($items['price']);?></td>   
                  <td style="text-align:center;"> <?php echo number_format($items['subtotal']);?></td>   
                  <td style="text-align:center;"><a href="<?php echo base_url().'admin/transaksi/remove_satuan/'.$items['rowid'];?>" class="btn btn-danger btn-md"> Batal</a></td>
              </tr>
            </tbody>      
              <?php 
                $no++;
                endforeach; 
              ?>
          </table>
          <form method="POST" action="save_satuan">
            <table class="mt-5">
              <tr>
                <td>Nama</td>
                <td class="mb-2">
                  <input type="text" name="nama" class="form-control form-control-sm ml-3" value="<?=set_value('nama')?>">
                  <?=form_error('nama', "<small class='text-danger ml-3'>",'</small>') ?>
                </td>
              </tr>
              <tr>
                <td>Jumlah Barang</td>
                <td>
                  <input type="text" name="jumlah" class="form-control form-control-sm  ml-3" value="<?php echo number_format($this->cart->total_items());?>" readonly> 
                  <?=form_error('jumlah', "<small class='text-danger ml-3'>",'</small>') ?>
                </td>
              </tr>
              <tr>
                <td>Total bayar</td>
                <td><input type="text" name="total" class="form-control form-control-sm ml-3" id="total" value="<?php echo number_format($this->cart->total());?>" disabled></td>
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
                <th style="width: 500px">Nama Barang</th>
                <th width="100px">Jumlah</th>
                <th width="10px" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no=1;
                foreach($tampil as $t){ 
                $id = $t->id_tarif; 
              ?>
              <tr>
                <td align="center"><?=$no ?></td>
                <td><?=$t->nama_tarif ?></td>

                  <form method="POST" action="add_cart_satuan">
                <td><input type="number" name="jumlah" class="form-control form-contrl-sm" style="width:70px" value="1"></td>
                <td align="center">
                    <input type="hidden" name="id" value="<?=$id ?>">
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

<!-- <script>
  $(document).ready(function(){
    $('#paket').change(function(){
      var paket = $(this).val();
      var berat = $('#berat').val();
      var total = berat*paket;
      $('#total').val(total);
    });
        

        
    $('#berat').on("input", function(){
      var berat = $('#berat').val();
      var paket = $('#paket').val();

      var total = berat*paket;
      $('#total').val(total);
    });


  });
</script> -->