@extends('layout.app')

@section('title', 'Edit Tahun Ajar')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tahun Ajar</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h4 class="card-title text-white">Edit Tahun Ajar</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tahunajar.update', $tahunajar->id) }}" method="POST">
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
                                <h3>Data Tahun Ajar</h3>
                                <div class="form-group">
                                    <label for="name">Tahun Ajar</label>
                                    <input type="text" class="form-control" id="tahunajar" name="tahunajar" value="{{ $tahunajar->tahunajar }}">
                                </div>

                                <a href="/tahunajar" class="btn btn-warning">Kembali</a>
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