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
        <a class="btn btn-sm btn-primary text-light" href="" data-target="#addModal" data-toggle="modal"><i class="fa fa-plus"></i> <b>Tambah</b></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="30px">No</th>
              <th>Jenis Pakaian</th>
              <th width="100px" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=1;
             foreach($tampil as $t){ 
              $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($t->id_pakaian));
              $idd = $t->id_pakaian;
              ?>
            <tr>
              <td align="center"><?=$no ?></td>
              <td><?=$t->nama_pakaian ?></td>
              <td><button  class="btn btn-sm btn-warning" title="Edit" data-target="#exampleModalLong<?=$idd?>" data-toggle="modal">Edit</button>
                  <button href="" onclick="deleteConfirm('<?=base_url('admin/pakaian/delete/'.$id) ?>')" class="btn btn-sm btn-danger" title="Hapus" data-target="#modalDelete" data-toggle="modal">Hapus</button>
              </td>
            </tr>

          <?php $no++; }; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


<!-- Modal Add -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?=base_url('admin/pakaian/add')?>">
          
          <div class="modal-body">
            <div>          
              <input type="text" name="nama" placeholder="Jenis Pakaian" class="form-control" id="nama">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-info" id="add">Tambah</button>
        </form>
          </div>
      </div>
    </div>
  </div>
<!-- End Modal Add -->

<!-- Modal Edit-->
<?php foreach ($tampil as $tm) { 
  $a    = $tm->id_pakaian;
  $iid   = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($tm->id_pakaian));
  ?>
  <div class="modal fade" id="exampleModalLong<?=$a?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?=base_url('admin/pakaian/edit')?>">
          
          <div class="modal-body">
            <div> 
              <input type="hidden" name="oldNama" value="<?=$tm->nama_pakaian?>">
              <input type="text" name="nama" placeholder="Jenis Pakaian" class="form-control" id="nama" value="<?=$tm->nama_pakaian ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-info" id="add">Update</button>
        </form>
          </div>
      </div>
    </div>
  </div>
<?php } ?>

<!-- End Modal Edit -->


<!-- Modal Delete -->
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
<!-- End Modal Delete -->


<script>
  function deleteConfirm(url)
  {
    $('#hapus').attr('href',url);
    $('#modalDelete').modal();
  }

</script>