<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-5 text-gray-800">Data <?=$section?></h1>
  <?=$this->session->flashdata('flash') ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
      <div>
        <span class="m-0 font-weight-bold text-primary">Data <?=$section ?></span>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered "  width="100%" cellspacing="0" id="dataTable">
          <thead>
              <tr>
                <th></th>
                <th>No Struk</th>
                <th>Nama</th>
                <th style="text-align: center;">Cuci</th>
                <th style="text-align: center;">Kering</th>
                <th style="text-align: center;">Strika</th>
                <th style="text-align: center;">Siap</th>
                <th style="text-align: center;">Selesai</th>
              </tr>
            </thead>
                <tbody>
                  <?php 
                    foreach ($tampil as $data):
                    $id = $data->id;
                    $transaction_id = str_replace(['=','+','/'], ['-','_','~'], $this->encryption->encrypt($data->transaction_id));
                  ?>
                    <tr>
                      <td>
                        <button class="btn btn-sm btn-info viewDetail" title="Detail" id="#viewDetail" value="<?=$transaction_id?>">
                          <i class="fa fa-eye"></i> detail
                        </button>
                      </td>
                      <td> <?=$data->receipt?> </td>
                      <td> <?=$data->name?> </td>

                      <td>
                        <div class="justify-content-center d-flex">
                          <?php if ($data->cuci == 1) :?>
                            <div class="btn btn-sm btn-success btn-circle" title="Proses Pencucian"><i class="fa fa-check"></i></div>
                          <?php else: ?>
                            <button class="btn btn-sm btn-secondary btn-circle" title="Proses Pencucian"><i class="fa fa-hourglass-half"></i></button>
                          <?php endif; ?>
                        </div>
                      </td>

                      <td>
                        <div class="justify-content-center d-flex">
                          <?php if ($data->kering == 1): ?>
                            <div class="btn btn-sm btn-success btn-circle" title="Proses Pengeringan"><i class="fa fa-check"></i></div>
                          <?php else: ?>
                            <a href="<?=base_url('admin/status/update/'.$id.'/kering') ?>" class="btn btn-sm btn-secondary btn-circle" title="Proses Pengeringan"><i class="fa fa-hourglass-half"></i></a>
                          <?php endif; ?>
                        </div>
                      </td>

                      <td>
                        <div class="justify-content-center d-flex">
                          <?php if ($data->strika == 1): ?>
                            <div class="btn btn-sm btn-success btn-circle" title="Proses Penyetrikaan"><i class="fa fa-check"></i></div>
                          <?php else: ?>
                              <a href="<?=base_url('admin/status/update/'.$id.'/strika') ?>" class="btn btn-sm btn-secondary btn-circle" title="Proses Penyetrikaan"><i class="fa fa-hourglass-half"></i></a>
                          <?php endif; ?>
                        </div>
                      </td>

                      <td>
                        <div class="justify-content-center d-flex">
                          <?php if ($data->siap == 1) :?>
                            <div class="btn btn-sm btn-success btn-circle" title="Siap Diambil"><i class="fa fa-check"></i></div>
                          <?php else: ?>
                            <a href="<?=base_url('admin/status/update/'.$id.'/siap') ?>" class="btn btn-sm btn-secondary btn-circle" title="Siap Diambil"><i class="fa fa-hourglass-half"></i></a>
                          <?php endif; ?>
                        </div>
                      </td>

                      <td>
                        <div class="justify-content-center d-flex">
                          <?php if ($data->selesai == 1): ?>
                            <div class="btn btn-sm btn-success btn-circle" title="Selesai"><i class="fa fa-check"></i></div>
                          <?php else: ?>
                            <a href="<?=base_url('admin/status/update/'.$id.'/selesai') ?>" class="btn btn-sm btn-secondary btn-circle" title="Selesai"><i class="fa fa-hourglass-half"></i></a>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?> 
                </tbody>
          </table>

      </div>
    </div>
  </div>

</div>



<!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <tr>
            <td class="col-sm-3"><strong>No Struk</strong></td>
            <td class="col-sm-9"><span id='receipt'></span></td>
          </tr>
          <tr>
            <td><strong>Nama</strong></td>
            <td><span id='name'></span></td>
          </tr>
          <tr>
            <td><strong>Tanggal Transaksi</strong></td>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>









<script>
  $(document).ready(function() {
    $('.viewDetail').click(function() {
      const id = $(this).val();
      $.ajax({
        type: 'GET',
        url: `<?=base_url('admin/status/detail/')?>${id}`,
        success: function(res) {
          res = JSON.parse(res);
          console.log(res)
          if (res.success) {
            const data = res.data;
            let detail='';
            for(const item of  data.detail){
              detail +=`<li>${item.name} (${item.amount})</li>`;
            };

            $('#modal-detail').modal('show');
            $('#receipt').html(data.receipt);
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