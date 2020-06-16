
  <style type="text/css">
    .multi_step_form{
        background: #f6f9fb;
        display: block;
        overflow: hidden;
    }

    #msform {
        text-align: center;
        position: relative;
        padding-top: 50px;
        min-height: 150px;  
        max-width: 810px;
        margin: 0 auto;
        background: #f8f9fa !important;
        z-index: 1; 
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;  
        
    } 

    .multi_step_form li {
        list-style-type: none !important;
        color: #99a2a8;   
        font-size: 20px;
        width: calc(100%/5);
        float: left;
        position: relative; 
        font: 500 13px/1 sans-serif; 
    }

    .multi_step_form li:nth-child(2)::before{content: "\f00c";}
    .multi_step_form li:nth-child(3)::before{content: "\f00c";}

    .multi_step_form li:before {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f00c";
        font-size: 25px;
        width: 50px;
        height: 50px;
        line-height: 50px;
        display: block; 
        background: #d6dfe3;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        } 
    .multi_step_form li:after {
            content: '';
            width: 100%;
            height: 10px;
            background: #cdd2d5;
            position: absolute;
            left: -50%;
            top: 21px;
            z-index: -1; 
        } 
    .multi_step_form li:last-child:after{width: 150%;}
    .multi_step_form li.active{
            color: #5cb85c;
        }
    .multi_step_form li.active:before, li.active:after{
            background: #5cb85c;
            color: white;
        }
  </style>

  <!-- Search -->
  <section class="py-5">
    <div class="container pt-5">
      <div class="row">
        <div class="col">
          <form method="GET" action="<?=base_url('cari')?>" autocomplete="off">
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
                <input type="text" class="form-control form-control-lg bg-light" placeholder="Masukkan ID Order Kamu..." name="idOrder" value="<?=$id ?>" onkeypress="return inputAngka(event)">
                <p class="text-left font-italic text-muted">Input 08041912181802 or 08041912181803 for demo</p>
              </div>
              <div class="col-12 col-md-2">
                <button type="submit" class="btn btn-block btn-lg btn-primary">Cari !</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>  
  </section>

  <!-- Result -->
  <section class=" pb-5 bg-light" style="min-height: 100px">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="mx-auto pt-4 pb-2">
            <?php if ($tampil == null): ?>
              <div align="center">
                <p class="mt-2 font-weight-bold" style="color: #6C7A89">Mulai lacak status laundry anda dengan memasukkan ID laundry anda pada form diatas.</p>
                <img src="<?=base_url('assets/users/')?>img/Searching.png" width="200rem">
              </div>
            <?php elseif($tampil == 'noData'): ?>
              <div align="center">
                <img src="<?=base_url('assets/users/')?>img/notfound.png" width="300px">
              </div>
            <?php else: ?>
                <h1 class="text-center">Status</h1>
                  <section class="multi_step_form bg-light pb-4">  
                    <div id="msform"> 
                      <ul id="progressbar">
                        <li class="<?=($data[0]['cuci']=='1')?'active':'';?>">Proses Cuci</li>  
                        <li class="<?=($data[0]['kering']=='1')?'active':'';?>">Proses Pengeringan</li> 
                        <li class="<?=($data[0]['strika']=='1')?'active':'';?>">Strika</li>
                        <li class="<?=($data[0]['siap']=='1')?'active':'';?>">Siap diambil</li>
                        <li class="<?=($data[0]['selesai']=='1')?'active':'';?>">Selesai</li>
                      </ul>
                    </div>  
                  </section>
            <?php endif; ?>
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