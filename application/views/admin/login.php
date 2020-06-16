<body id="page-top" class="bg-gradient-primary">

<div class="container mt-5">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-7 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 font-weight-bolder">Welcome!</h1>
                  </div>
                  <form class="user" method="POST" action="<?=base_url('admin/auth/login')?>"> 
                    <?=$this->session->flashdata('flash') ?>
                    <div class="form-group">
                      <label class="ml-3 font-weight-bold">Username</label>
                      <input type="text" class="form-control form-control-user" placeholder="Enter Your Username..." name="username" value="<?=set_value('username')?>" required>
                      <?= form_error('username',"<small class='text-danger ml-3'>","</small>")  ?>
                    </div>
                    <div class="form-group">
                      <label class="ml-3 font-weight-bold">Password</label>
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                      <?=form_error('password',"<small class='text-danger ml-3'>","</small>")?>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>