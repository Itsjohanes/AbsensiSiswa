@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Dashboard</h4>
                <div class="btn-group btn-group-page-header ml-auto">
                </div>
            </div>
            <div class="row">
                <span id="ct"></span>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Admin</p>
                                        <h4 class="card-title">{{ $admin }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Siswa</p>
                                        <h4 class="card-title">{{ $siswa }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Data Absensi Siswa hari ini ({{ \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('LL') }})</div>
                        </div>
                        <div class="card-body">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 mx-auto">
                                            <div id="persentase-siswa"></div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-danger bubble-shadow-small">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Jumlah absen Siswa hari ini</p>
                                                <h4 class="card-title">{{ $siswa_absen }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-head-bg-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Keluar</th>
                                        <th scope="col">Total Belajar</th>
                                        <th scope="col">Keterangan Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detail_siswa as $data)
                                    <tr>
                                        <td>{{ $data->siswa->user->name }}</td>
                                        <td>{{ $data->jam_masuk }}</td>
                                        <td>{{ $data->jam_keluar ?? '-' }}</td>
                                        <td>{{ $data->jam_kerja ?? '-' }}</td>
                                        @if($data->jam_masuk > ('07:00:00'))
                                        <td class="text-danger">Terlambat</td>
                                        @else
                                        <td class="text-success">Tepat Waktu</td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data absen kosong.</td>
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
<script src="{{ asset('/assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<script>
    Circles.create({
        id: 'persentase-siswa',
        radius: 75,
        value: JSON.parse('<?php echo json_encode($persen_siswa); ?>'),
        maxValue: 100,
        width: 7,
        text: function(value) {
            return value + '%';
        },
        colors: ['#eee', '#cc2121'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })
</script>
@endpush