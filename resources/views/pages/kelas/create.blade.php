@extends('layout.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kelas</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">Tambah Kelas</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kelas.store') }}" method="POST">
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

                                <h3>Data Kelas</h3>
                                <div class="form-group">
                                    <label for="name">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan kelas">
                                </div>

                                <a href="/kelas" class="btn btn-warning">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection