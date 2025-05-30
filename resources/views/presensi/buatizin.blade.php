@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-date-display{
        background-color: #0f3a7e !important;
    }
</style>
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Form Izin</div>
    <div class="right"></div>
</div>
<!-- * App Header  -->
@endsection
@section('content')
<div class="row" style="margin-top: 4rem;">
    <div class="col">
        <form action="/presensi/storeizin" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="tgl_izin" id="tgl_izin" class="form-control datepicker" placeholder="Tanggal" required>
            </div>
            <div class="form-group">
                <select name="status" id="status" class="form-control" required>
                    <option value="" selected disabled>Izin / Sakit</option>
                    <option value="i">Izin </option>
                    <option value="s">Sakit</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="keterangan" id="keterangan" cols="30" rows="5" placeholder="Keterangan" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $("#tgl_izin").change(function(e){
        var tgl_izin = $(this).val();
        $.ajax({
            type:'post',
            url:'/presensi/cekpengajuanizin',
            data : {
                _token: "{{ csrf_token() }}",
                tgl_izin: tgl_izin
            },
            cache: false,
            success: function(respond){
                console.log(respond); // Tambahkan ini untuk debugging
                if(respond==1){
                    Swal.fire({
                        title: 'Oops !',
                        text: 'Anda Sudah Melakukan Input Pengajuan Izin Pada Tanggal Tersebut!',
                        icon: 'warning'
                    }).then((result) => {
                        $("#tgl_izin").val("");
                    });
                }
            }
        });
    });

    $(document).ready(function() {
    $(".datepicker").datepicker({
    format: "yyyy-mm-dd"    
  });
});

</script>
@endpush