@extends('layout.app')

@section('title', 'Transaksi Siswa')

@push('addon-style')
@endpush

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Transaksi Kelas</h4>
                <div class="btn-group btn-group-page-header ml-auto">
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-10 pl-md-0">
                    <div class="card card-round">
                        <div class="card-header bg-success">
                            <div class="card-title text-white">
                                Pindahkan Kelas & Tahun Ajar
                            </div>
                        </div>
                        <div class="card-body">
                           
                            <form action="{{ route('transaksi.store') }}" method="POST">
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li class="mb-1">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif                                
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_kelas">Kelas Target</label>
                                            <select name="id_kelas" id="id_kelas" class="form-control">
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($kelas as $k)
                                                    <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_tahunajar">Tahun Ajar Target</label>
                                            <select name="id_tahunajar" id="id_tahunajar" class="form-control">
                                                <option value="">Tahun Ajar</option>
                                                @foreach ($tahunajar as $k)
                                                    <option value="{{ $k->id }}">{{ $k->tahunajar }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="form-group">
                                    <table id="basic-datatables" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Check</td>
                                                <td>Nama Siswa</td>
                                                <td>Kelas</td>
                                                <td>Tahun Ajaran</td>
                                                <td>Riwayat-Riwayat Kelas</td>
                                                <td>Riwayat-Riwayat Tahun Ajar</td>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transaksi as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><input type="checkbox" id="id_transaksi[]" name="id_transaksi[]" value="{{ $data->id }}"></td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->kelas }}</td>
                                                    <td>{{ $data->tahunajar }}</td>
                                                
                                                   <td>
                                                        @if(isset($riwayatKelasString[$data->id_siswa]))
                                                            {{ $riwayatKelasString[$data->id_siswa] }}
                                                        @else
                                                            No riwayat kelas found
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($riwayatTahunAjaranString[$data->id_siswa]))
                                                            {{ $riwayatTahunAjaranString[$data->id_siswa] }}
                                                        @else
                                                            No riwayat tahun ajaran found
                                                        @endif
                                                    </td>
                                                    </tr>
                                                 @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Data Kosong</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="col-md-12 mt-2">
                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </div>
                                </div>
                            
                            </form>
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
<script src="{{ asset('/assets/js/plugin/bootstrap-datepicker/bootstrap-datepicker.id.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable();
    });
</script>
@endpush
