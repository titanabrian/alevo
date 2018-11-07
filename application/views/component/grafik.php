<div class="row">
	<div class="col-md-8 center-block" style="background-color: #fff !important;">
		<!-- <h4 class="">Hasil Grafik Setelah 100 Generasi</h4> -->
    <!-- <h5 class="">Jumlah has pada populasi, yaitu 6</h5> -->
		<?php if($this->session->userdata('fitness_log') != false){ ?>
      <!-- <h3></h3> -->
			<canvas id="chartAverage" width="400" height="400"></canvas>
      <canvas id="chartFitness" width="400" height="400"></canvas>

      <script>
       <?php
      // $php_array = $this->session->userdata('fitness_log');
      // $js_array = json_encode($php_array);
      // var_dump($js_array);
      // echo 'var data = '. $js_array . ";\n";
       ?>

      var labelz = [];//create an empty array with length 45
      for(var i=0;i<10000;i++){
        labelz.push(i+1);
      }
      var data_fitness = '<?= json_encode($this->session->userdata('fitness_log'))?>';
      data_fitness = JSON.parse(data_fitness);
      var data_average = '<?= json_encode($this->session->userdata('average_log'))?>';
      data_average = JSON.parse(data_average);
      // console.log(labels);
      var ctx = document.getElementById("chartFitness").getContext('2d');
      var chartAverage = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelz,
            datasets: [{
                label: 'Fitness Tiap Generasi',
                data: data_fitness,
                backgroundColor: "rgba(34, 167, 240, 0.5)",
                // borderColor: "#000000",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

      var ctx = document.getElementById("chartAverage").getContext('2d');
      var chartAverage = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelz,
            datasets: [{
                label: 'Average Fitness Tiap Generasi',
                data: data_average,
                backgroundColor: "rgba(246, 36, 89, 0.5)",
                // borderColor: "#000000",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

      </script>
			<?php }else{ ?>
			<div class="alert alert-danger">
			  Maaf Data tidak ditemukan, pastikan anda memilih kota
			</div>

<?php } ?>
</div>
</div>
