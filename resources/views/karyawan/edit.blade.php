<form action="karyawan/{{ $karyawan->nik }}/update" method="post" id="frmKaryawan" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M7 17l0 .01" /> <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M7 7l0 .01" /> <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /> <path d="M17 7l0 .01" /> <path d="M14 14l3 0" /> <path d="M20 14l0 .01" /> <path d="M14 14l0 3" /> <path d="M14 20l3 0" /> <path d="M17 17l3 0" /> <path d="M20 17l0 3" /></svg>
                </span>
                <input type="text" readonly value="{{ $karyawan->nik }}" class="form-control" id="nik" name="nik" placeholder="NIK">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /> <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </span>
                <input type="text" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Karyawan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" /> <path d="M7 20l10 0" /> <path d="M9 16l0 4" /> <path d="M15 16l0 4" /> <path d="M8 12l3 -3l2 2l3 -3" /> </svg>
                </span>
                <input type="text" value="{{ $karyawan->jabatan }}" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-mobile"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z" /> <path d="M11 4h2" /> <path d="M12 17v.01" /> </svg>
                </span>
                <input type="text" value="{{ $karyawan->no_hp }}" name="no_hp" id="no_hp" class="form-control" placeholder="No. HP">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <select name="kode_dept" id="kode_dept" class="form-select">
                <option value="" disabled selected>Pilih Departemen</option>
                @foreach ($departemen as $d)
                    <option value="{{ $d->kode_dept }}" {{ $karyawan->kode_dept == $d->kode_dept ? 'selected' : '' }}>
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
                <input type="hidden" name="old_foto" value="{{ $karyawan->foto }}" id="">
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