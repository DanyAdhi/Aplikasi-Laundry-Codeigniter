<div class="container-fluid">
  <!-- Page Heading -->
<?=$this->session->flashdata('flash') ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4 ">
    <div class="card-body">
      <div class="row mb-5 mt-3 ">
        <div class="col text-dark justify-content-center d-flex ">
          <h2 class="font-weight-bold">
            Pilih Paket Transaksi yang akan dilakukan.
          </h2>
        </div>
      </div>
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-4 d-flex justify-content-center">
          <a href="<?=base_url('admin/transaksi/kiloan') ?>"> 
            <button class="btn btn-info" style="height: 200px; width: 200px; font-size: 40px"> Kiloan </button>
          </a>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
          <a href="<?=base_url('admin/transaksi/satuan') ?>">
            <button class="btn btn-primary" style="height: 200px; width: 200px; font-size: 40px"> Satuan </button>
          </a>
        </div>
      </div>
    </div>
  </div>

</div>