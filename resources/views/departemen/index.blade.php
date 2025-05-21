@extends('layouts.admin.tabler')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">Data Departemen</h2>
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
                                    <a href="#" class="btn btn-primary mb-2" id="btnTambahDepartemen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M12 5l0 14" /> <path d="M5 12l14 0" /></svg>
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <form action="/departemen" method="get">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <input type="text" name="nama_dept" id="nama_dept" class="form-control" placeholder="Cari Nama Departemen" value="{{ Request('nama_dept') }}">
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
                                                <th>Kode Departemen</th>
                                                <th>Nama Departemen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($departemen as $d )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->kode_dept }}</td>
                                                <td>{{ $d->nama_dept }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="edit btn btn-info btn-sm" kode_dept="{{ $d->kode_dept }}">
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                        </a>
                                                        <form action="/departemen/{{ $d->kode_dept }}/delete" method="post">
                                                            @csrf
                                                            <a class="btn btn-danger btn-sm delete-confirm">
                                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal modal-blur fade" id="modal-editDepartemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-3 modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Departemen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">

                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH DATA -->
    <div class="modal modal-blur fade" id="modal-inputdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-3 modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Departemen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="departemen/store" method="post" id="frmTambahDepartemen">
                    @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path     d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M7 17l0 .01" /> <path     d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M7 7l0 .01" /> <path     d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M17 7l0 .01" /> <path d="M14 14l3 0" /> <path d="M20 14l0 .01" /> <path d="M14 14l0 3" /> <path d="M14 20l3 0" /> <path d="M17 17l3 0" /> <path d="M20 17l0 3" /> </svg>
                                    </span>
                                    <input type="text" value="" class="form-control" id="kode_dept" name="kode_dept" placeholder="Kode Departemen">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /> <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg> 
                                    </span>
                                    <input type="text" value="" name="nama_dept" id="nama_dept" class="form-control" placeholder="Nama Departemen">
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
            $("#btnTambahDepartemen").click(function () {
                $("#modal-inputdepartemen").modal('show');
            });

            $(".edit").click(function ()
             {
                var kode_dept = $(this).attr('kode_dept');
                $.ajax({
                    type:'post',
                    url:'/departemen/edit',
                    cache:false,
                    data:{
                        _token:"{{ csrf_token() }}",
                        kode_dept: kode_dept
                    }    ,
                     success: function (response) {
                        if (response) {
                            $("#loadeditform").html(response);
                            $("#modal-editDepartemen").modal('show');
                        } else {
                            alert('Error: Tidak ada data yang diterima');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Terjadi kesalahan: " + error);
                        alert("Terjadi kesalahan dalam memuat data.");
                    }
                });
            });

            $(".delete-confirm").click(function(e){
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                  title: "Apakah Kamu Yakin?",
                  text: "Data Akan Dihapus Secara Permanen!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Yes, Hapus!"
                }).then((result) => {
                  if (result.isConfirmed) {
                    form.submit(); // Pastikan form dikirim setelah konfirmasi
                    Swal.fire({
                      title: "Berhasil!",
                      text: "Departemen Berhasil Dihapus!",
                      icon: "success"
                    });
                  }
                });
            });

            $("#frmTambahDepartemen").submit(function () {
                var nik = $("#nik").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var no_hp = $("#no_hp").val();
                var kode_dept = $("#frmTambahDepartemen").find("#kode_dept").val();

                if (kode_dept == "") {
                    showWarning('kode_dept', 'Kode Departemen Harus Diisi');
                    e.preventDefault();
                    return false;
                }
                if (nama_dept == "") {
                    showWarning('nama_dept', 'Nama Departemen Harus Diisi');
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endpush