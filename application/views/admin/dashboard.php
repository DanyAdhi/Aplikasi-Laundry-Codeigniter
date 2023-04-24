<!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-12 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pelanggan per-Hari</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?=$totalCustomer['daily']?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-12 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Pelanggan per-Bulan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?=$totalCustomer['monthly']?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-12 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Pelanggan per-Tahun</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?=$totalCustomer['yearly']?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div> 
<!-- END ROW-->

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan Perbulan</h6>
      </div>
      <div class="card-body">
        <div class="chart-area">
          <canvas id="earningChart"></canvas>
        </div>
        <hr>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  $(document).ready(function() {
    $.ajax({
      type: 'GET',
      url: `<?=base_url('admin/dashboard/chart')?>`,
      success: function(response) {
        const res = JSON.parse(response);

        if (res.success) {
          const data = res.data;

          const months = data.map(obj => obj.month);
          const earning = data.map(obj => obj.total);
          createChart(data, months, earning);
        }
      }
    });

    function createChart(data) {
      const {months, earnings} = processData(data);

      const ctx = document.getElementById("earningChart");
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: months,
          datasets: [{
            label: "Pendapatan",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: earnings,
          }],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            y: { 
              beginAtZero: true,
              suggestedMin: 1000,
              suggestedMax: 100000
            }
          }
        }
      }); 
    }

    function processData(data) {
      const months = getMonths();
      let earnings = []
      for (const month of months) {
        const index = data.find(item => item.month == month);
        const total = (index ? index.total : 0);
        earnings.push(total);
      }

      const result = {months, earnings};
      return result;
    }

    function getMonths() {
      const now = new Date(); // creates a new Date object with the current date and time
      const currentYear = now.getFullYear(); // gets the current year as a four-digit number
      const currentMonth = (now.getMonth() + 1);
      const months = Array.from({ length: currentMonth }, (_, index) => new Date(currentYear, index, 1).toLocaleString('default', { month: 'long' }));
      return months;
    }
  });
</script>

