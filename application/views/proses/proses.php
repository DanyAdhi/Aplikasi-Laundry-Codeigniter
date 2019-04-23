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
                  foreach ($tampil as $t) {
                    $id = $t->id_transaksi;
                ?>
                    <tr>
                        <td><button class="btn btn-sm btn-info" title="Detail" data-toggle="modal" data-target="#exampleModalLong<?=$id?>"><i class="fa fa-eye"></i></button></td>
                        <td><?=$t->id_transaksi?></td>
                        <td><?=$t->nama?></td>

                        <td>
                          <div class="justify-content-center d-flex">
                            <?php if ($t->cuci==1){?>
                              <div class="btn btn-sm btn-success btn-circle" title="Proses Pencucian"><i class="fa fa-check"></i></div>
                            <?php }else{ ?>
                              <button class="btn btn-sm btn-secondary btn-circle" title="Proses Pencucian"><i class="fa fa-hourglass-half"></i></button>
                            <?php } ?>
                          </div>
                        </td>

                        <td>
                          <div class="justify-content-center d-flex">
                            <?php if ($t->kering==1){?>
                              <div class="btn btn-sm btn-success btn-circle" title="Proses Pengeringan"><i class="fa fa-check"></i></div>
                            <?php }else{ ?>
                              <a href="<?=base_url('admin/status/kering/').$id ?>" class="btn btn-sm btn-secondary btn-circle" title="Proses Pengeringan"><i class="fa fa-hourglass-half"></i></a>
                            <?php } ?>
                          </div>
                        </td>


                        <td>
                          <div class="justify-content-center d-flex">
                            <?php if ($t->strika==1){?>
                              <div class="btn btn-sm btn-success btn-circle" title="Proses Penyetrikaan"><i class="fa fa-check"></i></div>
                            <?php }elseif ($t->kering==1) { ?>
                                <a href="<?=base_url('admin/status/strika/').$id ?>" class="btn btn-sm btn-secondary btn-circle" title="Proses Penyetrikaan"><i class="fa fa-hourglass-half"></i></a>
                            <?php }else{ ?>
                              
                              <div class="btn btn-sm btn-circle btn-secondary" title="Proses Penyetrikaan"><i class="fa fa-hourglass-half"></i></div>
                            <?php } ?>
                          </div>
                        </td>


                        <td>
                          <div class="justify-content-center d-flex">
                            <?php if ($t->siap==1){?>
                              <div class="btn btn-sm btn-success btn-circle" title="Siap Diambil"><i class="fa fa-check"></i></div>
                            <?php }elseif ($t->strika==1) { ?>
                                <a href="<?=base_url('admin/status/siap/').$id ?>" class="btn btn-sm btn-secondary btn-circle" title="Siap Diambil"><i class="fa fa-hourglass-half"></i></a>
                            <?php }else{ ?>
                              <div class="btn btn-sm btn-secondary btn-circle" title="Siap Diambil"><i class="fa fa-hourglass-half"></i></div>
                            <?php } ?>
                          </div>
                        </td>
                        <td>
                          <div class="justify-content-center d-flex">
                            <?php if ($t->selesai==1){?>
                              <div class="btn btn-sm btn-success btn-circle" title="Selesai"><i class="fa fa-check"></i></div>
                            <?php }elseif ($t->siap==1) { ?>
                                <a href="<?=base_url('admin/status/status_selesai/').$id ?>" class="btn btn-sm btn-secondary btn-circle" title="Selesai"><i class="fa fa-hourglass-half"></i></a>
                            <?php }else{ ?>
                              <div class="btn btn-sm btn-secondary btn-circle" title="Selesai"><i class="fa fa-hourglass-half"></i></div>
                            <?php } ?>
                          </div>
                        </td>
                    </tr>
                        
                 
                <?php
                  }
                ?> 
                </tbody>
          </table>

      </div>
    </div>
  </div>

</div>




<?php
foreach ($tampil as $p):
  $a=$p->id_transaksi;
?>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong<?=$a?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                    <td class="col-sm-9"><?=$a ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nama</strong></td>
                    <td><?=$p->nama ?></td>
                  </tr>
                  <tr>
                    <td><strong>Tanggal Transaksi</strong></td>
                    <td><?=$p->tgl_transaksi ?></td>
                  </tr>
                  <tr>
                    <td><strong>Jam Transaksi</strong></td>
                    <td><?=$p->jam_transaksi ?></td>
                  </tr>
                  <tr>
                    <td><strong>Paket</strong></td>
                    <td><?=$p->paket_transaksi ?></td>
                  </tr>
                  <tr>
                    <td><strong>Jumlah/Berat</strong></td>
                    <td><?=$p->berat_jumlah.' '.$p->jenis_paket ?></td>
                  </tr>
                  <tr>
                    <td><strong>Detail Pakaian</strong></td>
                    <td>
                      <?php
                        $pakaian = $this->model->get_by('transaksi_detail','id_transaksi_d',$a)->result();
                        $no=1;
                        foreach ($pakaian as $pk){
                          echo $no.'. '.$pk->nama_d.' <b>('.$pk->jumlah_d.')</b><br>';
                        $no++;
                        }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Total Transaksi</strong></td>
                    <td><?='Rp '. number_format($p->total_transaksi,'0') ?></td>
                  </tr>
                  
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
 <?php endforeach;?>