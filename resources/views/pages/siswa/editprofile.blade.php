@extends('layout.app')

@section('title', 'Edit Profile')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Profile</h4>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h4 class="card-title text-white">Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('edit-profile-siswa.update', $siswa->id) }}" method="POST">
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
                                <h3>Data Akun</h3>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $siswa->user->email }}">
                                    <small id="emailHelp2" class="form-text text-muted">Email tidak boleh sama dengan user lain</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{ $siswa->user->password }}">
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi_password">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" value="{{ $siswa->user->password }}"  >
                                    <small id="emailHelp2" class="form-text text-muted">Untuk menyetujui perubahan, harap masukkan ulang password</small>
                                </div>
                                <hr>
                                <h3>Data Profil</h3>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $siswa->user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">NISN</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $siswa->nisn }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis" value="{{ $siswa->nis }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Tahun Masuk</label>
                                    <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" value="{{ $siswa->tahun_masuk }}">
                                </div>

                                <div class="form-group">
                                    <label for="riwayattahunajar">Riwayat Tahun Ajar</label>
                                    <input type="text" class="form-control" id="riwayattahunajar" name="riwayattahunajar" value="{{ $riwayatTahunAjaranString }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="riwayatkelas">Riwayat Kelas</label>
                                    <input type="text" class="form-control" id="riwayatkelas" name="riwayatkelas" value="{{ $riwayatKelasString }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nomor Handphone</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $siswa->no_hp }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10">{{ $siswa->alamat }}</textarea>
                                </div>
                                <a href="/siswa" class="btn btn-warning">Kembali</a>
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