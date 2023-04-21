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
              <th width="20px">Id Transaksi</th>
              <th >Nama</th>
              <th width="170px">Tanggal</th>
              <th width="100px" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($transactions as $data) { 
              $id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($data->id));
            ?>
              <tr>
                <td> <?=$data->receipt?> </td>
                <td> <?=$data->name?> </td>
                <td> <?=$data->createDate?> </td>
                <td>
                    <button class="btn btn-sm btn-info viewDetail" title="Detail" value="<?=$id?>"><i class="fa fa-eye"></i></button>
                    <a href="<?=base_url('admin/transaksi/cetak/'.$id)?>" target="_blank" class="btn btn-sm btn-primary" title="Print" ><i class="fa fa-print"></i></a>
                </td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


<!-- Modal -->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle"><strong >Detail Data Laundry</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <tr>
            <td class="col-sm-3"><strong>No Struk</strong></td>
            <td class="col-sm-9"> <span id="receipt"></span></td>
          </tr>
          <tr>
            <td><strong>Nama</strong></td>
            <td><span id='name'></span></td>
          </tr>
          <tr>
            <td><strong>Tanggal</strong></td>
            <td><span id='createDate'></span></td>
          </tr>
          <tr>
            <td><strong>Paket</strong></td>
            <td><span id='package'></span></td>
          </tr>
          <tr>
            <td><strong>Jumlah/Berat</strong></td>
            <td>
              <span id='amount'></span>
              <span id='type'></span>
            </td>
          </tr>
          <tr>
            <td><strong>Detail Pakaian</strong></td>
            <td><div class="ml-2"><span id='detail'></span></div></td>
          </tr>
          <tr>
            <td><strong>Total Transaksi</strong></td>
            <td><span id='amount_transaction'></span></td>
          </tr>
          
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    $('.viewDetail').click(function(){
      let id = $(this).val();
      $.ajax({
        type: 'GET',
        url: `<?=base_url('admin/transaksi/detail/')?>${id}`,
        success: function(res){
            res = JSON.parse(res);
          if(res.success){
            var detail='';
            for(var item of  res.data.detail){
              detail +=`<li>${item.name} (${item.amount})</li>`;
            };

            $('#modalView').modal('show');
            $('#receipt').html(res.data.receipt);
            $('#name').html(res.data.name);
            $('#createDate').html(res.data.createDate);
            $('#package').html(res.data.package);
            $('#amount').html(res.data.amount);
            $('#type').html(res.data.type);
            $('#amount_transaction').html(res.data.amount_transaction);
            $('#detail').html(detail)
          }
        }
      });

    });

  });
</script>