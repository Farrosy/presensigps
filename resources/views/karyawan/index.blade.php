@extends('layouts.admin.tabler')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">Data Karyawan</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">    
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                                {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::get('warning'))
                                        <div class="alert alert-warning">
                                                {{ Session::get('warning') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-primary mb-2" id="btnTambahKaryawan">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M12 5l0 14" /> <path d="M5 12l14 0" /></svg>
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <form action="/karyawan" method="get">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" name="nama_karyawan" id="nama_karyawan"
                                                        class="form-control" placeholder="Cari Nama Karyawan"
                                                        value="{{ Request('nama_karyawan') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <select name="kode_dept" id="kode_dept" class="form-select">
                                                        <option value="" disabled selected>Pilih Departemen</option>
                                                        @foreach ($departemen as $d)
                                                            <option value="{{ $d->kode_dept }}" {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }}>
                                                                {{ $d->nama_dept }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /> <path d="M21 21l-6 -6" /></svg>
                                                        Cari
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table tabler-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>No. HP</th>
                                                <th>Foto</th>
                                                <th>Departemen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        @foreach ($karyawan as $d)
                                            <tbody>
                                                <tr>
                                                    @php
                                                        $path = Storage::url('uploads/karyawan/' . $d->foto);
                                                    @endphp
                                                    <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                                    <td>{{ $d->nik }}</td>
                                                    <td>{{ $d->nama_lengkap }}</td>
                                                    <td>{{ $d->jabatan }}</td>
                                                    <td>{{ $d->no_hp }}</td>
                                                    <td>
                                                        @if (empty($d->foto))
                                                            <img src="{{ asset('assets/img/guest-avatar.png') }}" alt=""
                                                                class="avatar">
                                                        @else
                                                            <img src="{{ url($path) }}" alt="" class="avatar">
                                                        @endif
                                                    </td>
                                                    <td>{{ $d->nama_dept }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" class="edit btn btn-info btn-sm" nik="{{ $d->nik }}">
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                            </a>
                                                            <form action="/karyawan/{{ $d->nik }}/delete" method="post">
                                                                @csrf
                                                                <a class="btn btn-danger btn-sm delete-confirm">
                                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                    {{ $karyawan->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal modal-blur fade" id="modal-editKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-3 modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">

                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH DATA -->
    <div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-3 modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="karyawan/store" method="post" id="frmKaryawan" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path     d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M7 17l0 .01" /> <path     d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M7 7l0 .01" /> <path     d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M17 7l0 .01" /> <path d="M14 14l3 0" /> <path d="M20 14l0 .01" /> <path d="M14 14l0 3" /> <path d="M14 20l3 0" /> <path d="M17 17l3 0" /> <path d="M20 17l0 3" /> </svg>
                                    </span>
                                    <input type="text" value="" class="form-control" id="nik" name="nik" placeholder="NIK">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /> <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg> 
                                    </span>
                                    <input type="text" value="" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Karyawan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path     d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" /> <path d="M7 20l10 0" /> <path d="M9 16l0 4" /> <path d="M15 16l0 4" /> <path d="M8 12l3 -3l2 2l3 -3" /></svg> 
                                    </span>
                                    <input type="text" value="" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-mobile"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path     d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z" /> <path d="M11 4h2" /> <path d="M12 17v.01" /></svg>
                                    </span>
                                    <input type="text" value="" name="no_hp" id="no_hp" class="form-control" placeholder="No. HP">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <select name="kode_dept" id="kode_dept" class="form-select">
                                    <option value="" disabled selected>Pilih Departemen</option>
                                    @foreach ($departemen as $d)
                                        <option value="{{ $d->kode_dept }}" {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }}>
                                            {{ $d->nama_dept }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-label">Masukan Foto Profil</div>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /> </svg>
                        Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function () {
            $("#btnTambahKaryawan").click(function () {
                $("#modal-inputkaryawan").modal('show');
            });

            $(".edit").click(function ()
             {
                var nik = $(this).attr('nik');
                $.ajax({
                    type:'post',
                    url:'/karyawan/edit',
                    cache:false,
                    data:{
                        _token:"{{ csrf_token() }}",
                        nik: nik
                    }    ,
                    success:function(respond){
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editKaryawan").modal('show');
            });

            $(".delete-confirm").click(function(e){
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda Yakin Menghapus Data Ini?",
                    text: "Data akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Pastikan form dikirim setelah konfirmasi
                    }
                });
            });

            $("#frmKaryawan").submit(function () {
                var nik = $("#nik").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var no_hp = $("#no_hp").val();
                var kode_dept = $("frmKaryawan").find("#kode_dept").val();

                if (nik == "") {
                    showWarning('nik', 'NIK Harus Diisi');
                    return false;
                }
                if (nama_lengkap == "") {
                    showWarning('nama_lengkap', 'Nama Lengkap Harus Diisi');
                    return false;
                }
                if (jabatan == "") {
                    showWarning('jabatan', 'Jabatan Harus Diisi');
                    return false;
                }
                if (no_hp == "") {
                    showWarning('no_hp', 'No HP Harus Diisi');
                    return false;
                }
                if (kode_dept == "") {
                    showWarning('kode_dept', 'Departemen Harus Dipilih');
                    return false;
                }
            });
        });
    </script>
@endpush