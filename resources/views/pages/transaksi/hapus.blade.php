@extends('layout.app')

@section('title', 'Transaksi Siswa')

@push('addon-style')
@endpush

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Hapus Data Transaksi Kelas</h4>
                <div class="btn-group btn-group-page-header ml-auto">
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-10 pl-md-0">
                    <div class="card card-round">
                        <div class="card-header bg-success">
                            <div class="card-title text-white">
                                Lihat dan Hapus Data
                            </div>
                        </div>
                        <div class="card-body">
                    
                                <div class="form-group">
                                    <table id="basic-datatables" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Nama Siswa</td>
                                                <td>Kelas</td>
                                                <td>Tahun Ajaran</td>
                                                 <td>Riwayat Kelas</td>
                                                <td>Riwayat Tahun Ajaran</td>
                                                <td>Hapus</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transaksi as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
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
                                                    <td>
                                                       <form action="{{ route('transaksi.destroy', $data->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Data Kosong</td>
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
