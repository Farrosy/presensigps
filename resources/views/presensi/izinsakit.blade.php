@extends('layouts.admin.tabler')
@section('content')
<!-- BEGIN PAGE HEADER -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">Data izin / Sakit</h2>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE HEADER -->
<div class="page-body">
    <div class="container-xl">
      <div class="row">
        <div class="col-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nik</th>
                <th>Nama Karyawan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($izinsakit as $d)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ date('d-m-Y',strtotime($d->tgl_izin)) }}</td>
                  <td>{{ $d->nik }}</td>
                  <td>{{ $d->nama_lengkap }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection