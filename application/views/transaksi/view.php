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
        <a class="btn btn-sm btn-primary text-light" href="<?=base_url('admin/transaksi/paket')?>"><i class="fa fa-plus"></i> <b>Tambah Transaksi</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="10px">No</th>
              <th width="20px">Id Transaksi</th>
              <th >Nama</th>
              <th width="100px">Tanggal</th>
              <th width="100px" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach($tampil as $t){ 
                    $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($t->id_transaksi));
            ?>
            <tr>
                    <td><?=$no?></td>
                    <td><?=$t->id_transaksi?></td>
                    <td><?=$t->nama?></td>
                    <td><?=$t->tgl_transaksi?></td>
                    <td>
                        <button class="btn btn-sm btn-info" title="Detail" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-sm btn-primary" title="Print"><i class="fa fa-print"></i></button>
                    </td>
            </tr>
          <?php $no++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


