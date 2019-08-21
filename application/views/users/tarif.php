<!-- Contact -->
  <div class="harga mb-5">
    <div class="container ">
      <div class="row py-5">
        <div class="col text-center ">
          <h2 class="font-weight-bold text-dark">Daftar Tarif Laundry</h2> 
          <hr width="400px">
        </div>
      </div>
      <div class="row justify-content-center ">
        <div class="col-lg-12">
        	 <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr style="background-color: #3fa1c6; color:#eaeaea">
                  <th width="20px">No</th>
                  <th>Paket</th>
                  <th>Waktu Proses</th>
                  <th>Biaya</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach($data as $d): ?>
                <tr>
                  <td align="center"><?=$i ?></td>
                  <td><?=$d->nama_tarif ?></td>
                  <td><?=$d->waktu_tarif ?></td>
                  <td ><?=$d->biaya_tarif?> <span style="font-size: 12px"><?="/".$d->jenis_tarif ?></span></td>
                </tr>
                <?php $i++ ; endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- End Contact -->
