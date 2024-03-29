@extends('layout.app')

@section('title', 'Siswa')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="main-panel">
    <div class="content">
        
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Siswa</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah Siswa</a>
                            <form action="{{ url('/import_siswa/import')  }}" method="POST" enctype="multipart/form-data">
                            @csrf
		                    <input type="file" name="file" required>
		                    <button type="submit" class="btn btn-success">Upload</button>
	                        </form>
                        </div>
                      <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th class="text-center">NISN</th>
                                        <th class="text-center">NIS</th>
                                        <th class="text-center">Tahun Masuk</th>
                                        <th>Alamat</th>
                                        <th>Nomor Handphone</th>
                                        <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @forelse($siswa as $data)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td class="text-center">{{ $data->nisn }}</td>
                                            <td class="text-center">{{ $data->nis }}</td>
                                            <td class="text-center">{{ $data->tahun_masuk }}</td>
                                           
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->no_hp }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('siswa.edit', $data->id) }}" class="btn btn-warning d-inline"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('siswa.destroy', $data->id) }}" method="POST" class="d-inline" onclick="return confirm('Apa yakin ingin menghapus data ini? Data yang terkait juga akan ikut terhapus')" .>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-id="{{ $data->id }}" class="btn btn-danger d-inline"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Data Kosong. Klik "Tambahkan Siswa" untuk tambah data</td>
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
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable();
    });
</script>
@endpush