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
        <a class="btn btn-sm btn-primary text-light" href="<?=base_url('admin/tarif/add')?>"><i class="fa fa-plus"></i> <b>Tambah</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Paket</th>
              <th>Waktu Proses</th>
              <th>Biaya</th>
              <th>Jenis</th>
              <th width="100px" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($t->id_tarif));
              ?>
            <tr>
              <td><?=$t->nama_tarif ?></td>
              <td><?=$t->waktu_tarif ?></td>
              <td><?=$t->biaya_tarif ?></td>
              <td><?=$t->jenis_tarif ?></td>
              <td><a href="<?=base_url('admin/tarif/edit/'.$id) ?>" class="btn btn-sm btn-warning" title="Edit">Edit</a>
                  <button href="" onclick="deleteConfirm('<?=base_url('admin/tarif/delete/'.$id) ?>')" class="btn btn-sm btn-danger" title="Hapus" data-target="#modalDelete" data-toggle="modal">Hapus</button>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Anda Yakin ingin Menghapus Data?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a type="button" class="btn btn-danger" id="hapus">Hapus</a>
      </div>
    </div>
  </div>
</div>



<script>
  function deleteConfirm(url)
  {
    $('#hapus').attr('href',url);
    $('#modalDelete').modal();
  }

</script>