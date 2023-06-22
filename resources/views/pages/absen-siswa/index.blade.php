@extends('layout.app')

@section('title', 'Absensi Siswa')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Absensi Siswa</h4>
                <div class="btn-group btn-group-page-header ml-auto">
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 pl-md-0">
                    <div class="card card-secondary card-annoucement card-round">
                        <div class="card-body">
                            <div class="card-opening text-center">Untuk berhasil melakukan absensi:</div>
                            <div class="card-desc">
                                Saat pesan pop up peramban muncul, klik tombol "Allow Location Access" agar sistem bisa mengetahui posisi anda saat melakukan absensi
                            </div>
                            <div class="card-detail">
                                <p>Catatan:</p>
                                <ul>
                                    <li>Untuk bisa melakukan absensi, siswa harus berada dalam radius kurang dari 200m dari jarak sekolah</li>
                                    <li>Jika jarak siswa melebihi 200m, absensi tidak bisa dilakukan dan muncul pesan peringatan agar melakukan absensi dalam lingkungan sekolah</li>
                                    <li>Absen masuk dan absen keluar hanya bisa dilakukan sekali dalam sehari</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6 pl-md-0">
                        <div class="card card-warning card-annoucement card-round">
                            <div class="card-body text-center">
                                <div class="card-opening">Foto</div>
                                <div class="card-desc"  style="overflow: hidden;">
                                    <div id="my_camera" style="max-width: 100%;"></div>
                                </div>
                                <div class="card-desc" style="overflow: hidden;">
                                    <div id="results" style="max-width: 100%;">Your captured image will appear here...</div>
                                </div>
                                <div class="card-detail">
                                    <input type="button" value="Take Snapshot" onClick="take_snapshot()"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center align-items-center">
                <div class="col-md-3 pl-md-0">
                    <div class="card card-success card-annoucement card-round">
                        <div class="card-body text-center">
                            <div class="card-opening">Absen Masuk</div>
                            <div class="card-detail">
                                <form action="{{ route('absen-siswa.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="lat" name="lat">
                                    <input type="hidden" id="lng" name="lng">
                                    <input type="hidden" name="image" class="image-tag">
                                    <button type="submit" class="btn btn-light btn-rounded" id="absenMasuk" disabled>Absen Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 pl-md-0">
                    <div class="card card-danger card-annoucement card-round">
                        <div class="card-body text-center">
                            <div class="card-opening">Absen Keluar</div>
                            
                            <div class="card-detail">
                                <form action="{{ route('absen-siswa-keluar') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="lat1" name="lat">
                                    <input type="hidden" id="lng1" name="lng">
                                    <input type="hidden" name="image" class="image-tag">
                                    <button type="submit" class="btn btn-light btn-rounded" id="absenKeluar" disabled>Absen Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 pl-md-0">
                    <div class="card card-annoucement card-round">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 pl-md-0">
                    <div class="card card-annoucement card-round">
                        <div class="card-header text-center bg-primary">
                            <div class="card-title text-center text-white">Detail absen {{ auth()->user()->name }}</div>
                        </div>
                        <div class="card-body">
                            <table id="basic-datatables" class="table table-head-bg-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Keluar</th>
                                        <th scope="col">Total Jam Belajar</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_absen as $data)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($data->tgl)->locale('id')->isoFormat('LL') }}</td>
                                        <td>{{ $data->jam_masuk }}</td>
                                        <td>{{ $data->jam_keluar ?? '-' }}</td>
                                        <td>{{ $data->jam_kerja ?? '-' }}</td>
                                        {{-- <td>{{ $data->jam_masuk > strtotime('15:00:00') ? 'Terlambat' : 'Tepat Waktu' }}</td> --}}
                                        @if($data->jam_masuk > ('07:00:00'))
                                        <td class="text-danger">Terlambat</td>
                                        @else
                                        <td class="text-success">Tepat Waktu</td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data absen kosong. Silahkan lakukan absensi</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<!-- Datatables -->
<script src="{{ asset('/assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable();
    });

    window.setTimeout(function() {
        document.getElementById('absenMasuk').removeAttribute('disabled')
    }, 5000);
    window.setTimeout(function() {
        document.getElementById('absenKeluar').removeAttribute('disabled')
    }, 5000);

    getLocation();

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert('Geolocation tidak didukung oleh peramban ini');
        }
    }

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;

        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
        document.getElementById('lat1').value = lat;
        document.getElementById('lng1').value = lng;
        document.getElementById('latTest').value = lat;
        document.getElementById('lngTest').value = lng;
    }

   
</script>
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
@endpush
