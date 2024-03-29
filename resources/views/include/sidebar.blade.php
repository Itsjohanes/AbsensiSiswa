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
						<i class="fas fa-user-shield text-success"></i>
						<p>Admin</p>
						<span class="badge badge-count badge-danger">{{ \App\Models\Admin::count() }}</span>
					</a>
				</li>
				<li class="nav-item {{ Request::is('guru') ? 'active' : '' }}">
					<a href="/guru">
						<i class="fas fa-chalkboard-teacher text-secondary"></i>
						<p>Guru</p>
						<span class="badge badge-count badge-danger">{{ \App\Models\Guru::count() }}</span>
					</a>
				</li>

				<li class="nav-item {{ Request::is('siswa') ? 'active' : '' }}">
					<a href="/siswa">
						<i class="fas fa-user-graduate text-danger"></i>
						<p>Data Akun Siswa</p>
						<span class="badge badge-count badge-danger">{{ \App\Models\Siswa::count() }}</span>
					</a>
				</li>

				<li class="nav-item {{ Request::is('transaksi') ? 'active' : '' }}">
					<a href="/transaksi">
						<i class="fas fa-chalkboard-teacher text-success"></i>
						<p>Transaksi Kelas</p>
					</a>
				</li>

				

				<li class="nav-item {{ Request::is('kelas') ? 'active' : '' }}">
					<a href="/kelas">
						<i class="fas fa-home  text-warning]"></i>
						<p>Kelas</p>
						<span class="badge badge-count badge-danger">{{ \App\Models\Kelas::count() }}</span>
					</a>
				</li>
				<li class="nav-item {{ Request::is('tahunajar') ? 'active' : '' }}">
					<a href="/tahunajar">
						<i class="fas fa-calendar-check text-primary]"></i>
						<p>Tahun Ajar</p>
						<span class="badge badge-count badge-danger">{{ \App\Models\TahunAjar::count() }}</span>
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
				<li class="nav-item {{ Request::is('edit-profile-siswa') ? 'active' : '' }}">
					<a href="/edit-profile-siswa">
						<i class="fas fa-user text-warning"></i>
						<p>Edit Profile</p>
					</a>
				</li>


				@endif

				
				@if (auth()->user()->level == 'guru')
				<li class="nav-item {{ Request::is('edit-profile-guru') ? 'active' : '' }}">
					<a href="/edit-profile-guru">
						<i class="fas fa-user text-warning"></i>
						<p>Edit Profile</p>
					</a>
				</li>

				<li class="nav-item {{ Request::is('laporan-absensi-guru') ? 'active' : '' }}">
					<a href="/laporan-absensi">
						<i class="fas fa-table text-primary"></i>
						<p>Laporan Absensi</p>
					</a>
				</li>


				@endif


			</ul>
		</div>
	</div>
</div>
<!-- End Sidebar -->