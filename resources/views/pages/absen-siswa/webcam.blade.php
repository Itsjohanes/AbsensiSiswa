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
    <form method="POST" action="{{ route('absen-siswa.capture') }}">
        @csrf
        <div class="row justify-content-center"> <!-- Tambahkan class "justify-content-center" -->
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type="button" value="Take Snapshot" onClick="takeSnapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Tambahkan class "justify-content-center" -->
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Tambahkan class "justify-content-center" -->
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
        
    </form>
</div>
</div>
</div>


@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <script>
        $(document).ready(function() {
            Webcam.set({
                width: 490,
                height: 350,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
        });

        function takeSnapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            });
        }
    </script>
@endpush
