@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">E-Presensi</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<style>
    .webcam-capture,
    .webcam-capture video{
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }

    #map { height: 200px; }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection
@section('content')
<div class="row" style="margin-top: 70px;">
    <div class="col">
        <input type="hidden" id="lokasi">
        <div class="webcam-capture"></div> 
    </div>   
</div>

<div class="row">
    <div class="col">
        @if ($cek > 0)
            <button id="takeabsen" class="btn btn-danger btn-block" >
                <ion-icon name="camera-outline"></ion-icon>
                Absen Pulang
            </button>
        @else
            <button id="takeabsen" class="btn btn-primary btn-block" >
                <ion-icon name="camera-outline"></ion-icon>
                Absen Masuk
            </button>
        @endif

    </div>
</div>


<div class="row mt-1">
    <div class="col">
        <div id="map"></div>
    </div>
</div>

<audio id="notifikasi_in">
    <source src="{{ asset('assets/sound/notifikasi_in.mp3') }}" type="audio/mpeg">
</audio>

<audio id="notifikasi_out">
    <source src="{{ asset('assets/sound/notifikasi_out.mp3') }}" type="audio/mpeg">
</audio>

<audio id="radius_sound">
    <source src="{{ asset('assets/sound/radius_sound.mp3') }}" type="audio/mpeg">
</audio>
@endsection

@push('myscript')
<script>
    var notifikasi_in = document.getElementById('notifikasi_in');
    var radius_sound = document.getElementById('radius_sound');
    Webcam.set({
        height: 480,
        width: 640,
        image_format: 'jpeg',
        jpeg_quality: 80
    });

    Webcam.attach('.webcam-capture')

    var lokasi = document.getElementById('lokasi');
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
        enableHighAccuracy: true,
        timeout: 1000,
        maximumAge: 0
    })};

    function successCallback(position) {
        // koordinat
        lokasi.value = position.coords.latitude + ',' + position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 16);
        var lokasi_kantor = "{{ $lok_kantor->lokasi_kantor }}"
        var lok = lokasi_kantor.split(",");
        var lat_kantor = lok[0];
        var long_kantor = lok[1];
        var radius = "{{ $lok_kantor->radius }}"

        // map
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // marker
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

        // circle
        var circle = L.circle([lat_kantor, long_kantor], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: radius
        }).addTo(map);
    }

    function errorCallback() {

    }

    $("#takeabsen").click(function(e) {
        Webcam.snap(function(uri) {
            image = uri;
        });

        var lokasi = $('#lokasi').val();
        $.ajax({
           type:'POST',
           url:'/presensi/store',
           data:{
            _token:"{{  csrf_token() }}",
            image:image,
            lokasi:lokasi
           },
           cache:false,
           success: function(respond){
            var status = respond.split("|");
            if(status[0] == "success") {
                if (status[2] == "in") {
                    notifikasi_in.play();
                } else {
                    notifikasi_out.play();
                }
            Swal.fire({
              title: 'Berhasil!',
              text: status[1],
              icon: 'success',
            })
            setTimeout("location.href='/dashboard'", 3000);
            } else {
                if (status[2] == "radius") {
                    radius_sound.play();
                }
            Swal.fire({
              title: 'Error!',
              text: status[1],
              icon: 'error',
            });
            }
           } 
        });
    });
</script>
@endpush