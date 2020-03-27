
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Beranda | info-corona.id</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
<?php
$url='https://api.kawalcorona.com/';
$reqs = file_get_contents($url);
$json = json_decode($reqs);
?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Info Corona</h3>
            </div>

            <ul class="list-unstyled components">
                <p align="center">Live Corona Data</p>
                <li>
                  <a href="/">Beranda</a>
                </li>
                <li>
                  <a href="/berita">Berita</a>
                </li>
                <li>
                  <a href="/rumahsakit">Info Rumah Sakit</a>
                </li>
                <li>
                    <a href="/prediksi">Prediksi</a>
                </li>
                <li>
                    <a href="/kontak">Kontak</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="/dev" class="download">Developer web</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>
                </div>
            </nav>
                <div class="container-fluid pt-4">
                <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card bg-warning img-card box-primary-shadow rounded-sm">
                      <div class="card-body ">
                        <div class="d-flex ">
                          <div class="text-white">
                            <p class="text-white mb-0">TOTAL POSITIF</p>
                            <h2 class="mb-0 number-font"><?php echo $json[35]->attributes->Confirmed ?></h2>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card bg-success img-card box-primary-shadow">
                      <div class="card-body">
                        <div class="d-flex">
                          <div class="text-white">
                            <p class="text-white mb-0">TOTAL PULIH</p>
                            <h2 class="mb-0 number-font"><?php echo $json[35]->attributes->Recovered ?></h2>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                  <div class="card bg-danger img-card box-primary-shadow">
                    <div class="card-body">
                      <div class="d-flex">
                        <div class="text-white">
                        <p class="text-white mb-0">TOTAL MENINGGAL</p>
                        <h2 class="mb-0 number-font"><?php echo $json[35]->attributes->Deaths ?></h2>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
            <iframe src="./indo.html" height="500" width="100%" frameborder="0" class="pt-4"></iframe>
            </div>
            </div>
            <div class="container">
            <label for="input">Cari provinsi</label>
            <input type='text' id='input' onkeyup='searchTable()' placeholder="Cari berdasarkan provinsi" class="form-control" width="10px">
            <br>
            <table class="table table-striped table-bordered" id="table" data-toggle="table">
              <thead>
                <tr>
                  <th data-order="desc" data-field="no" data-sortable="true">No</th>
                  <th data-order="desc" data-field="provinsi" data-sortable="true">Provinsi</th>
                  <th data-order="desc" data-field="positif" data-sortable="true">Positif</th>
                  <th data-order="desc" data-field="meninggal" data-sortable="true">Meninggal</th>
                  <th data-order="desc" data-field="pulih" data-sortable="true">Pulih</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $url="https://api.kawalcorona.com/indonesia/provinsi";
                    $req=file_get_contents($url);
                    $get_json=json_decode($req,true);
                    $nomer=1;
                    for($i=0;$i<count($get_json);$i++){
                      ?>
                      <?php
                      echo "<tr><td>".$nomer++."</td>";
                      echo "<td>".$get_json[$i]['attributes']['Provinsi']."</td>";
                      echo "<td>".$get_json[$i]['attributes']['Kasus_Posi']."</td>";
                      echo "<td>".$get_json[$i]['attributes']['Kasus_Meni']."</td>";
                      echo "<td>".$get_json[$i]['attributes']['Kasus_Semb']."</td></tr>";
                      ?>
  <?php
}
?>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Provinsi</th>
                  <th>Positif</th>
                  <th>Meninggal</th>
                  <th>Pulih</th>
                </tr>
              </tfoot>
            </table>
            <h6 align="center">Data from <a href="https://inacovid19.maps.arcgis.com/apps/opsdashboard/index.html#/4411f5e9c69d4ca4be31ac805a0267be">https://inacovid19.maps.arcgis.com/ </a></h6>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>