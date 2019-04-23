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
    </div>
    <div class="card-body">
      <!-- <?php var_dump($tampil) ?> -->
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Struk</th>
              <th>Tanggal</th>
              <th>Paket</th>
              <th>Berat/Jumlah</th>
              <th>Biaya</th>
              <th width="100px" class="text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              ?>
            <tr>
              <td><?=$t->id_transaksi ?></td>
              <td><?=$t->nama ?></td>
              <td><?=$t->paket_transaksi ?></td>
              <td><?=$t->berat_jumlah.' ('.$t->jenis_paket.')' ?></td>
              <td><?=$t->total_transaksi ?></td>
              <td>
                <?php 
                  if($t->status=='1'){
                    echo "<a href='' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Selesai</a>";

                  }else{
                echo "<a href='' class='btn btn-sm btn-secondary'><i class='fa fa-hourglass-half'></i> Proses</a>";

                  }
                 ?>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>