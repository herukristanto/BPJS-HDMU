<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>RSPIK</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <!-- <div class="span12"> -->

        <br>
        <button type="button" class="btn btn-default" name="button">Save Form</button>
        <button type="button" class="btn btn-default" name="button">Print</button>
        <button type="button" class="btn btn-default" name="button">Back</button>

        <br>
        <br>

          <div class="widget">
            <div class="widget-header">
              <h3>Form</h3>
            </div>
            <div class="widget-content">
              <!-- <img src="Image/testrspik.jpg" alt="" width="300px" height="100px" align="reight"> -->
              <br>
              <br>
              <br>
              <br>
              <form class="" action="F_HD03_save.php" method="post">

              <h3 style="text-align: center;"><u>DATA PASIEN DIALISIS UNTUK RUJUKAN</u></h3>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span6">
                    <div class="widget-content">
                      <label for="">
                        <p style="text-align: center;">Diagnosa</p>
                      </label>
                      <input type="text" name="diagnosa" value="" style="width: 100%">
                    </div>
                  </div>
                  <div class="span6">
                    <div class="widget-content">
                      <label for="">
                        <p style="text-align: center;">Label Identitas Pasien</p>
                      </label>
                      <input type="text" name="idpasien" value="" style="width: 100%">
                    </div>
                  </div>
                </div>
              </div>

              <br>
              <div class="container">
                <div class="row">
                  <div class="span12">

                    <table>
                      <tr>
                        <td>
                          Alergi
                        </td>
                        <td> : </td>
                        <td>
                          &nbsp;&nbsp;
                          <input type="radio" name="rdoalergi" id="rdoalergi_disable" value="No"> Tidak
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" name="rdoalergi" id="rdoalergi_enable" value="Yes"> Ya
                          &nbsp;&nbsp;&nbsp;
                          <input type="text" name="rdoalergi" id="rdoalergi" value="" >
                        </td>
                      </tr>
                    </table>

                  </div>
                </div>
              </div>

              <br>
              <div class="container">
                <div class="row">
                  <div class="span12">
                    <h5>Pengobatan</h5>

                  </div>
                </div>
              </div>
              <div class="container">
                <div class="row">
                  <div class="span6">
                    <table class="table table-striped table-bordered" id="tabel_obat">
                      <tr>
                        <td>No</td>
                        <td>Nama Obat</td>
                        <td>Dosis</td>
                      </tr>

                      <tr>
                        <td>
                          1
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Nama Obat" id="keyobat">
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Dosis" id="keydosis">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          2
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Nama Obat" id="keyobat">
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Dosis" id="keydosis">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          3
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Nama Obat" id="keyobat">
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Dosis" id="keydosis">
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="span6">
                    <table class="table table-striped table-bordered">
                      <tr>
                        <td>No</td>
                        <td>Nama Obat</td>
                        <td>Dosis</td>
                      </tr>
                      <tr>
                        <td>
                          4
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Nama Obat" id="keyobat">
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Dosis" id="keydosis">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          5
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Nama Obat" id="keyobat">
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Dosis" id="keydosis">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          6
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Nama Obat" id="keyobat">
                        </td>
                        <td>
                          <input type="text" name="" value="" placeholder="Dosis" id="keydosis">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>

              <div class="container">
                <div class="row">
                  <div class="span6">
                    <table>
                      <tr>
                        <td>Berat Badan Standar</td>
                        <td> : </td>
                        <td>
                          <div class="input-prepend input-append">
                            <input class="span2" id="appendedPrependedInput" type="text">
                            <span class="add-on">kg</span>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>

                  <div class="span6">
                    <table>
                      <tr>
                        <td>Gol.darah / Rh</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value=""> /
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span12">
                    <table>
                      <tr style="width: 100%">
                        <td>Sarana hubungan sirkulasi</td>
                        <td>:</td>
                        <td style="width: 150%">
                          <input type="text" name="" value="" style="width: 150%">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <br>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 20%">Dialiser dan Cairan Dialisat</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 80%">
                          <input type="text" name="" value="" style="width: 150%">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span6">
                    <table>
                      <tr>
                        <td>Lamanya Dialisis</td>
                        <td>:</td>
                        <td>
                          <div class="input-prepend input-append">
                            <input class="span2" id="appendedPrependedInput" type="text">
                            <span class="add-on">jam</span>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="span6">
                    <table>
                      <tr>
                        <td>Kecepatan aliran darah</td>
                        <td>:</td>
                        <td>
                          <div class="input-prepend input-append">
                            <input class="span2" id="appendedPrependedInput" type="text">
                            <span class="add-on">Rpm</span>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span4">
                    <table>
                      <tr>
                        <td>Heparinisasi</td>
                        <td>:</td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="span4">
                    <table>
                      <tr>
                        <td>Dosis awal</td>
                        <td>:</td>
                        <td>
                          <div class="input-prepend input-append">
                            <input class="span2" id="appendedPrependedInput" type="text">
                            <span class="add-on">U'</span>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="span4">
                    <table>
                      <tr>
                        <td>Lanjutan</td>
                        <td>:</td>
                        <td>
                          <div class="input-prepend input-append">
                            <input class="span2" id="appendedPrependedInput" type="text">
                            <span class="add-on">U'/jam</span>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span6">
                    <table>
                      <tr>
                        <td>Transfusi </td>
                        <td> : </td>
                        <td>
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" name="rdotransfusi" id="rdotransfusi_disable" value=""> Tidak
                        </td>
                        <td>
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" name="rdotransfusi" id="rdotransfusi_enable" value=""> Ya
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="span6">
                    <table>
                      <tr>
                        <td>Tgl / Bln /Thn</td>
                        <td> : </td>
                        <td>
                          <input type="date" name="rdotransfusi" id="rdotransfusi" value="" >
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span6">
                    <table>
                      <tr>
                        <td>Reaksi Transfusi </td>
                        <td> : </td>
                        <td>
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" name="rdortrans" value=""> Tidak
                        </td>
                        <td>
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" name="rdortrans" value=""> Ya
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span6">
                    <table>
                      <tr>
                        <td>Hasil laboratorium terakhir</td>
                        <td> : </td>
                        <td>Tanggal</td>
                        <td> : </td>
                        <td>
                          <input type="date" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Hb / Ht</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Ureum</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Albumin</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Serologi</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>HbsAg</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>HCV</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="span6">
                    <table>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>

                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>GDS</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Creatinin</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Kalium</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Calcium</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Anti HBs</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>HIV</td>
                        <td> : </td>
                        <td>
                          <input type="text" name="" value="">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="span12">
                    <table>
                      <tr style="width: 100%">
                        <td>Diet</td>
                        <td>:</td>
                        <td style="width: 98%">
                          <input type="text" name="" value="" style="width: 98%">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <br>
                        </td>
                      </tr>
                      <tr>
                        <td>Komplikasi</td>
                        <td>:</td>
                        <td>
                          <input type="text" name="" value="" style="width: 98%">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <br>
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                          <input type="text" name="" value="" style="width: 98%">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>

            </div>
            </form>
          </div>
        <!-- /span6 -->
        </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<!-- /main -->


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->




<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>

<script src="js/base.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  // alergi
  $("#rdoalergi_enable").click(function(){
    $("#rdoalergi").prop("disabled", false);
  });
  $("#rdoalergi_disable").click(function(){
    $("#rdoalergi").prop("disabled", true);
  });

  // transfusi
  $("#rdotransfusi_enable").click(function(){
    $("#rdotransfusi").prop("disabled", false);
  });
  $("#rdotransfusi_disable").click(function(){
    $("#rdotransfusi").prop("disabled", true);
  });
});

  // $(document).ready(function() {
  //   $('#keydosis').keypress(function(event){
  //   var keycode = (event.keyCode ? event.keyCode : event.which);
  //   if(keycode == '13'){
  //
  //     var obat = $("#keyobat").val();
  //     var dosis = $("#keydosis").val();
  //     var list_obat = "<tr><td>"+no+"</td><td>"+obat+"</td><td>"+dosis+"</td></tr>";
  //     $("#tabel_obat").append(list_obat);
  //         // alert('You pressed a "enter" key in somewhere');
  //       }
  //   });
  //
  //
  // });
</script>

</body>
</html>
