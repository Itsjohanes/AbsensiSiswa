@extends('layout.app')

@section('title', 'Edit Kelas')

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
                        <div class="card-header bg-warning">
                            <h4 class="card-title text-white">Edit Kelas</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li class="mb-1">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @method('PUT')
                                @csrf
                                <h3>Data Kelas</h3>
                                <div class="form-group">
                                    <label for="name">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $kelas->kelas }}">
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