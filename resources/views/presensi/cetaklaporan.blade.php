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
<body class="A4">
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
                    LAPORAN PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                    PT. FARROS FATH KOM <br>
                </span>
                <small><i>Jl. Kp. Tengah, RT.06/RW.03, Cipeucang, Kec. Cileungsi, Kabupaten Bogor, Jawa Barat 16820</i></small>
            </td>
        </tr>
    </table>

    <table class="tabeldatakaryawan">
      <tr>
        <td rowspan="6">
          @php
          $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
          @endphp
          <img src="{{ url($path) }}" alt="" width="150" height="150">
        </td>
      </tr>
      <tr>
          <td>NIK</td>
          <td>:</td>
          <td>{{ $karyawan->nik }}</td>
      </tr>
      <tr>
          <td>Nama Karyawan</td>
          <td>:</td>
          <td>{{ $karyawan->nama_lengkap }}</td></td>
      </tr>
      <tr>
          <td>Jabatan</td>
          <td>:</td>
          <td>{{ $karyawan->jabatan }}</td></td>
      </tr>
      <tr>
        <td>Departemen</td>
        <td>:</td>
        <td>{{ $karyawan->nama_dept }}</td></td>
      </tr>
      <tr>
        <td>No. HP</td>
        <td>:</td>
        <td>{{ $karyawan->no_hp }}</td></td>
      </tr>
    </table>

    <table class="tabelpresensi">
      <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Foto</th>
        <th>Jam Pulang</th>
        <th>Foto</th>
        <th>Keterangan</th>
        <th>Jumlah Jam</th>
      </tr>
      @foreach ($presensi as $d)
      @php
      $path_in = Storage::url('uploads/absensi/'.$d->foto_in);
      $path_out = Storage::url('uploads/absensi/'.$d->foto_out);
      $jamterlambat = selisih('07:00:00',$d->jam_in);
      @endphp
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</td>
          <td>{{ $d->jam_in  }}</td>
          <td><img src="{{ url($path_in) }}" alt="" class="foto"></td>
          <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen'  }}</td>
          <td>
            @if ($d->jam_out != null)
            <img src="{{ url($path_out) }}" alt="" class="foto">
            @else
            <img src="{{ asset('assets/img/guest-avatar.png') }}" alt="" class="foto">
            @endif
          </td>
          <td>
            @if ($d->jam_in > '07:00')
            Terlambat {{ $jamterlambat }}
            @else
            Tepat Waktu
            @endif
          </td>
          <td>
            @if ($d->jam_out != null)
              @php
                $jmljamkerja = selisih($d->jam_in,$d->jam_out);
              @endphp
              @else
              @php
              $jmljamkerja = 0;
              @endphp
            @endif
            {{ $jmljamkerja }}
          </td>
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