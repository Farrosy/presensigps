<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page {
    size: A4 
  }

  #title {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    font-weight: bold;
  }

  .tabeldatakaryawan tr td {
    margin-top: 40px;
  }
  
  .tabeldatakaryawan td {
    padding: 5px;
  }

  .tabelpresensi{
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse
  }

  .tabelpresensi tr th{
    border: 1px solid #131212;
    padding: 8px;
    background-color:rgb(192, 188, 188);
    font-size: 10px;
  }

  .tabelpresensi tr td{
    border: 1px solid #131212;
    padding: 5px;
    font-size: 12px;
  }

  .foto{
    width: 40px;
    height: 30px;
  }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">
  <?php
   function selisih($jam_masuk, $jam_keluar)
    {
        list($h, $m, $s) = explode(":", $jam_masuk);
        $dtAwal = mktime($h, $m, $s, 1, 1, 1);
        list($h2, $m2, $s2) = explode(":", $jam_keluar);
        $dtAkhir = mktime($h2, $m2, $s2, 1, 1, 1);

        $dtSelisih = $dtAkhir - $dtAwal;

        $jam = floor($dtSelisih / 3600);
        $menit = floor(($dtSelisih % 3600) / 60);
        $detik = $dtSelisih % 60;

        return sprintf("%02d:%02d:%02d", $jam, $menit, $detik);
    }
  ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <table style="width:100%;">
        <tr>
            <td style="width:15%;">
                <img src="{{ asset('assets/img/fath_logo.png') }}" width="100" height="100" alt="">
            </td>
            <td>
                <span id="title">
                    REKAP PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                    PT. FARROS FATH KOM <br>
                </span>
                <small><i>Jl. Kp. Tengah, RT.06/RW.03, Cipeucang, Kec. Cileungsi, Kabupaten Bogor, Jawa Barat 16820</i></small>
            </td>
        </tr>
    </table>

    <table class="tabelpresensi">
      <tr>
        <th rowspan="2">Nik</th>
        <th rowspan="2">Nama Karyawan</th>
        <th colspan="31">Tanggal</th>
        <th rowspan="2">TH</th> {{-- Total Hadir --}}
        <th rowspan="2">TT</th> {{-- Total Terlambat --}}
      </tr>
      <tr>
        @for ($i = 1; $i <= 31; $i++)
          <th>{{ $i }}</th>
        @endfor
      </tr>
      @foreach ($rekap as $d)
        <tr>
          <td>{{ $d->nik }}</td>
          <td>{{ $d->nama_lengkap }}</td>
          @php $totalhadir = 0; $totalterlambat = 0; @endphp
          @for ($i = 1; $i <= 31; $i++)
            @php
              $field = 'tgl_' . $i;
              $hadir = ['', ''];
              if (!empty($d->$field)) {
                  $hadir = explode("-", $d->$field);
                  $totalhadir++;
                  if($hadir[0] > "07:00:00"){
                  $totalterlambat++;
                  }
              }
            @endphp
            <td>
              <span style="color:{{ $hadir[0] > "07:00:00" ? "red" : "" }}">{{ $hadir[0] }}</span><br>
              <span style="color:{{ $hadir[1] < "16:00:00" ? "red" : "" }}">{{ $hadir[1] }}</span>
            </td>
          @endfor
          <td>{{ $totalhadir }}</td>
          <td>{{ $totalterlambat }}</td>
        </tr>
      @endforeach
    </table>


    <table style="width: 100%; margin-top: 100px;">
      <tr>
        <td></td>
        <td style="text-align: center;">Cileungsi, {{ date("d-m-Y") }}</td>
      </tr>
      <tr>
        <td style="text-align: center; vertical-align: bottom;" height="100px">
          <u>Aditya Firmansyah</u><br>
          <i><b>HRD Manager</b></i>
        </td>
        <td style="text-align: center; vertical-align: bottom;">
          <u>Daffa Maulana</u><br>
          <i><b>Direktur</b></i>
        </td>


      </tr>
    </table>
  </section>

</body>

</html>