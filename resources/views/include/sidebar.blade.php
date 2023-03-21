<!-- Sidebar -->
<div class="sidebar">
	<div class="sidebar-background"></div>
	<div class="sidebar-wrapper scrollbar-inner">
		<div class="sidebar-content">

			<ul class="nav">
				<li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
					<a href="/">
						<i class="fas fa-home text-info"></i>
						<p>Dashboard</p>
					</a>
				</li>
				@if((auth()->user()->level == 'admin') )
				<li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
					<a href="/admin">
						<i class="fas fa-user-shield text-secondary"></i>
						<p>Admin</p>
						<span class="badge badge-count badge-danger">{{ \App\Models\Admin::count() }}</span>
					</a>
				</li>

				<li class="nav-item {{ Request::is('siswa') ? 'active' : '' }}">
					<a href="/siswa">
						<i class="fas fa-chalkboard-teacher text-danger"></i>
						<p>Siswa</p>
						<span class="badge badge-count badge-danger">{{ \App\Models\Siswa::count() }}</span>
					</a>
				</li>



				<li class="nav-item {{ Request::is('laporan-absensi') ? 'active' : '' }}">
					<a href="/laporan-absensi">
						<i class="fas fa-table text-primary"></i>
						<p>Laporan Absensi</p>
					</a>
				</li>

				<li class="nav-item {{ Request::is('lokasi-sekolah') ? 'active' : '' }}">
					<a href="/lokasi-sekolah">
						<i class="fas fa-map-marker-alt text-success"></i>
						<p>Lokasi Sekolah</p>
					</a>
				</li>

				@endif
				@if (auth()->user()->level == 'siswa')
				<li class="nav-item {{ Request::is('absen-siswa') ? 'active' : '' }}">
					<a href="/absen-siswa">
						<i class="fas fa-clipboard-list text-warning"></i>
						<p>Absensi Siswa</p>
					</a>
				</li>
				<li class="nav-item {{ Request::is('lokasi-anda') ? 'active' : '' }}">
					<a href="/lokasi-anda">
						<i class="fas fa-map-marker-alt text-success"></i>
						<p>Lokasi Anda</p>
					</a>
				</li>
				@endif


			</ul>
		</div>
	</div>
</div>
<!-- End Sidebar -->