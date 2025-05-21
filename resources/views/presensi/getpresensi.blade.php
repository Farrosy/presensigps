@php
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
@endphp

@foreach ($presensi as $d)
@php
    $foto_in = Storage::url('uploads/absensi/'.$d->foto_in);
    $foto_out = Storage::url('uploads/absensi/'.$d->foto_out);
@endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->nama_dept }}</td>
        <td>{{ $d->jam_in }}</td>
        <td>
            <img src="{{ url($foto_in) }}" class="avatar" alt="">
        </td>
        <td>
            @if ($d->jam_out)
                {{ $d->jam_out }}
            @else
                <span class="badge bg-danger text-white">Belum Absen</span>
            @endif
        </td>
        <td>
            @if ($d->jam_out != null )
            <img src="{{ url($foto_out) }}" class="avatar" alt="">
            @else
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-hourglass-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 18v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-2a6 6 0 0 1 6 -6" /><path d="M6 6a6 6 0 0 0 6 6m3.13 -.88a6 6 0 0 0 2.87 -5.12v-2a1 1 0 0 0 -1 -1h-10" /><path d="M3 3l18 18" /></svg>
            @endif
        </td>
        <td>
            @if ($d->jam_in >= '07:00')
            @php
                $jamterlambat = selisih('07:00:00',$d->jam_in);
            @endphp
            <span class="badge bg-danger text-white">Terlambat <br> {{ $jamterlambat }}</span>
            @else
            <span class="badge bg-success text-white">Tepat Waktu</span>            
            @endif
        </td>
        <td>
            <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $d->id }}"> 
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
            </a>
        </td>
    </tr>
@endforeach

<script>
    $(function(){
        $(".tampilkanpeta").click(function(e){
            var id = $(this).attr('id');
            $.ajax({
                type:'POST',
                url:'/tampilkanpeta',
                data:{
                    _token:'{{ csrf_token() }}',
                    id: id
                },
                cache:false,
                success:function(respond){
                    $("#Loadmap").html(respond);
                }
            });
            $("#modal-tampilkanpeta").modal("show");
        });
    });
</script>