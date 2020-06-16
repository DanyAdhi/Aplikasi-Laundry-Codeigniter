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
        <a class="btn btn-sm btn-primary text-light" href="<?=base_url('admin/user/add')?>"><i class="fa fa-plus"></i> <b>Tambah</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Username</th>
              <th>Level</th>
              <th width="100px" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($tampil as $t){ 
              $id = str_replace(['=','+','/'],['-','_','~',], $this->encryption->encrypt($t->id));
              ?>
            <tr>
              <td><?=$t->nama ?></td>
              <td><?=$t->username ?></td>
              <td><?php if($t->level!='1'){echo 'Karyawan';}else{echo 'Admin';} ?></td>
              <td><a href="<?=base_url('admin/user/reset/'.$id) ?>" class="btn btn-sm btn-info" title="Reset Password">Reset</a>
                  <a href="" onclick="deleteConfirm('<?=base_url('admin/user/delete/'.$id)?>')" class="btn btn-sm btn-danger" title="Hapus Data" data-target="#deleteModal" data-toggle="modal">Hapus</a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold">Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-sm btn-danger btn-ok" id="btn-delete">Hapus</a>
      </div>
    </div>
  </div>
</div>

<script>
    function deleteConfirm(url){
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
    };  
</script>