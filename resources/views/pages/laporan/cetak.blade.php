<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <div class="text-center">
                <img src="{{ asset('/assets/img/tutwuri.png')}}" style="width:120px; height:120px;">
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="text-center">SMKN 1 Cimahi</h3>
            <h4 class="text-center">Rekayasa Perangkat Lunak</h4>
            <h5 class="text-center">Jl. Mahar Martanegara No.48, Utama, </h5>
        </div>
        <div class="col-md-2">
            <div class="text-center">
                <img src="{{ asset('/assets/img/tutwuri.png')}}" style="width:120px; height:120px;">
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <hr>
    <br>
    <h4 class="text-center">Laporan Absensi Siswa</h4>
    <h5 class="text-center">
        @if ($id_kelas == 0)
        Semua Kelas
        @else
        Kelas {{ $kelas->kelas }}
        @endif
    </h5>
    <h5 class="text-center">
        @if ($id_tahunajar == 0)
        Semua Tahun Ajar
        @else
        Tahun Ajar {{ $tahunajar->tahunajar }}
        @endif
    </h5>
    <p class="text-center"><span>Per </span>{{\Carbon\Carbon::parse($tglawal)->locale('id')->isoFormat('LL')}} - {{\Carbon\Carbon::parse($tglakhir)->locale('id')->isoFormat('LL')}}</p>
    <br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Nama Siswa</td>
                        <td>Jam Masuk</td>
                        <td>Gambar Masuk</td>
                        <td>Jam Keluar</td>
                        <td>Gambar Keluar</td>
                        <td>Jumlah Jam Belajar</td>
                        <td>Keterangan Masuk</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absen_siswa as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tgl)->locale('id')->isoFormat('LL') }}</td>
                        <td>{{ $data->siswa->user->name }}</td>
                        <td>{{ $data->jam_masuk }}</td>
                        <td>
                            @if($data->gambarmasuk)
                             <img src="{{ Storage::url('uploads/' . $data->gambarmasuk) }}" alt="Gambar Masuk" width="100" height="100">
                             @else
                             <span>Tidak ada gambar masuk</span>
                              @endif
                        </td>
                        <td>{{ $data->jam_keluar }}</td>
                        <td>
                             @if($data->gambarkeluar)
                                <img src="{{ Storage::url('uploads/' . $data->gambarkeluar) }}" alt="Gambar Keluar" width="100" height="100">
                             @else
                             <span>Tidak ada gambar keluar</span>
                              @endif
                         </td> 
                        <td>{{ $data->jam_kerja }}</td>
                        @if($data->jam_masuk > ('07:00:00'))
                        <td class="text-danger">Terlambat</td>
                        @else
                        <td class="text-success">Tepat Waktu</td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>

    <body>

</html>