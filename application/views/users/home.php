<!-- Masthead -->
    <header class="masthead text-white text-center" style="">
      <div class="overlay"></div>
      <div class="container" style="">
        <div class="row">
          <div class="col-xl-9 text-left mx-auto">
            <h1 >Dijamin Bersih, Rapi, dan Wangi.</h1>
              <p class="mb-5" style="margin-top:-10px; font-size: 13px ">Jasa laundry kiloan dan satuan, Kami sudah melayani ratusan pelanggan dari seluruh Lubuk Linggau</p>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-9 mx-auto">
            <form method="GET" action="<?=base_url('cari')?>">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" name="idOrder" class="form-control form-control-lg" placeholder="Masukkan ID Order Kamu..." onkeypress="return inputAngka(event)" autocomplete="OFF">
                  <p class="text-left font-italic">Input 08041912181802 or 08041912181803 for demo</p>
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" class="btn btn-block btn-lg tombol-cari">Cari !</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>

  <!-- Icons Grid -->
    <section class="features-icons text-center" style="background-color: rgba(65,188,234,.07)">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex mb-2">
                <img src="<?=base_url('assets/users/')?>img/svg/mesin_cuci.svg" class="h-100 mx-auto">
              </div>
              <h3>Pakaian Bersih</h3>
              <p class="lead mb-0">Dicuci dengan mesin dan detergen yang terbaik.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex mb-2">
                <img src="<?=base_url('assets/users/')?>img/svg/baju.svg" class="h-100 mx-auto">
              </div>
              <h3>Pakaian Rapi</h3>
              <p class="lead mb-0">Pakaian disetrika dengan teliti baik.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-0 mb-lg-3">
              <div class="features-icons-icon d-flex mb-2">
                <img src="<?=base_url('assets/users/')?>img/svg/perfume.svg" class="h-100 mx-auto">
              </div>
              <h3>Pakaian Wangi</h3>
              <p class="lead mb-0">Menggunakan pewangi pakaian yang terbaik dan wangi tahan lama.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  <!-- Image Showcases -->
    <section class="showcase">
      <div class="container-fluid p-0">
        <div class="row no-gutters">

          <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('<?=base_url('assets/users/')?>img/mesin_cuci.jpg');"></div>
          <div class="col-lg-6 order-lg-1 my-auto showcase-text">
            <h2>Pakaian Dijamin Bersih</h2>
            <p class="lead mb-0">Pakaian dicuci menggunakan mesin dan detergen terbaik, sehingga dapat membantu mengangkat noda pada pakaian lebih baik.</p>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-lg-6 text-white showcase-img" style="background-image: url('<?=base_url('assets/users/')?>img/setrika.jpg'); "></div>
          <div class="col-lg-6 my-auto showcase-text">
            <h2>Pakaian Menjadi Rapi</h2>
            <p class="lead mb-0">Pakaian di setrika dengan menggunakan panas strika yang disesuaikan dengan jenis pakaian agar pakaian tetap rapi dan tidak membuat pakaian cepat rusak.</p>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('<?=base_url('assets/users/')?>img/parfum.jpg');"></div>
          <div class="col-lg-6 order-lg-1 my-auto showcase-text">
            <h2>Pakaian Menjadi Lebih Wangi</h2>
            <p class="lead mb-0">Dicuci Menggunakan pewangi pakaian terbaik yang tidak merusak pakaian dan membuat pakaian wangi lebih lama.</p>
          </div>
        </div>
      </div>
    </section>

  <!-- Testimonials -->
    <section class="testimonials text-center" style="background-color: rgba(65,188,234,.07)">
      <div class="container">
        <h2 class="mb-5">Apa yang orang-orang katakan...</h2>
        <div class="row">
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="<?=base_url('assets/users/')?>img/testimonials-1.jpg" alt="">
              <h5>Margaret E.</h5>
              <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="<?=base_url('assets/users/')?>img/testimonials-2.jpg" alt="">
              <h5>Fred S.</h5>
              <p class="font-weight-light mb-0">"this is amazing. I allways using it."</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="<?=base_url('assets/users/')?>img/testimonials-3.jpg" alt="">
              <h5>Sarah W.</h5>
              <p class="font-weight-light mb-0">"Thanks so much for making these awesome"</p>
            </div>
          </div>
        </div>
      </div>
    </section>


<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  function inputAngka(evt){
      var charCode = (evt.charCode);
      if(charCode>31 && (charCode<48 || charCode>57) && charCode!=45) { return false; } else { return true; }
  }
</script>