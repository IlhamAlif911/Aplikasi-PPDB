<aside class="sidebar sidebar-default sidebar-white sidebar-base sidebar-color navs-pill" data-toggle="main-sidebar" data-sidebar="responsive" style="background-color: #4D7C0F;">
	<div class="sidebar-header d-flex align-items-center justify-content-start" style="border-bottom-color: #FFFFFF ;">
		<a href="<?= site_url() ?>" class="navbar-brand">
			<!--Logo start-->
			<div class="logo-main">
				<div class="logo-normal">
					<img src="<?= base_url('assets/logo.png'); ?>" width="30px"  alt="Logo SMK WIDYA MANDALA TAMBAK" >
				</div>
			</div>
			<!--logo End-->

		</a>
		<div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
			<i class="icon">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					<path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			</i>
		</div>
	</div>
	<div class="sidebar-body pt-0 data-scrollbar">
		<div class="sidebar-list">
			<?php if (session()->get('role') == '1'): ?>
			<!-- Sidebar Menu Start Admin -->
			<ul class="navbar-nav iq-main-menu" id="sidebar-menu">
				<li class="nav-item static-item">
					<a class="nav-link static-item disabled text-start" href="#" tabindex="-1">
						<span class="default-icon">Beranda</span>
						<span class="mini-icon" data-bs-toggle="tooltip" title="Home" data-bs-placement="right">-</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'dashboard') echo 'active' ?>" aria-current="page" href="<?= site_url('dashboard') ?>">
						<i class="icon" data-bs-toggle="tooltip" title="Dashboard" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c.2 35.5-28.5 64.3-64 64.3H128.1c-35.3 0-64-28.7-64-64V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L416 100.7V64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V185l52.8 46.4c8 7 12 15 11 24zM248 192c-13.3 0-24 10.7-24 24v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V216c0-13.3-10.7-24-24-24H248z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Dashboard</span>
					</a>
				</li>
				<li><hr class="hr-horizontal"></li>
				<li class="nav-item static-item">
					<a class="nav-link static-item disabled" href="#" tabindex="-1">
						<span class="default-icon">Kelola PPDB</span>
						<span class="mini-icon">-</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#sidebar-special" role="button" aria-expanded="false" aria-controls="sidebar-special">
						<i class="icon" data-bs-toggle="tooltip" title="Tahapan PPDB" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M448 160H320V128H448v32zM48 64C21.5 64 0 85.5 0 112v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zM448 352v32H192V352H448zM48 288c-26.5 0-48 21.5-48 48v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48H48z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Tahapan PPDB</span>
						<i class="right-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" class="icon-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
							</svg>
						</i>
					</a>
					<ul class="sub-nav collapse" id="sidebar-special" data-bs-parent="#sidebar-menu">
						<li class="nav-item">
							<a class="nav-link <?php if ($activePage == 'periode') echo 'active' ?>" href="<?= site_url('data-periode') ?>">
								<i class="icon">
									<svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<g>
											<circle cx="12" cy="12" r="8" fill="currentColor"></circle>
										</g>
									</svg>
								</i>
								<i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Periode" data-bs-placement="right">P</i>
								<span class="item-name">Periode</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if ($activePage == 'tahap') echo 'active' ?>" href="<?= site_url('data-tahap') ?>">
								<i class="icon">
									<svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<g>
											<circle cx="12" cy="12" r="8" fill="currentColor"></circle>
										</g>
									</svg>
								</i>
								<i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Tahap" data-bs-placement="right">T</i>
								<span class="item-name">Tahap</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if ($activePage == 'jalur') echo 'active' ?>" href="<?= site_url('data-jalur')?>">
								<i class="icon">
									<svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<g>
											<circle cx="12" cy="12" r="8" fill="currentColor"></circle>
										</g>
									</svg>
								</i>
								<i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Jalur" data-bs-placement="right">J</i>
								<span class="item-name">Jalur</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'pendaftar') echo 'active' ?>" data-bs-toggle="collapse" href="#sidebar-tahap" role="button" aria-expanded="false" aria-controls="sidebar-special">
						<i class="icon" data-bs-toggle="tooltip" title="Data Pendaftar" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9v28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5V291.9c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Data Pendaftar</span>
						<i class="right-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" class="icon-18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
							</svg>
						</i>
					</a>
					<ul class="sub-nav collapse" id="sidebar-tahap" data-bs-parent="#sidebar-menu">

						<?php foreach ($tahapan as $key => $value): ?>
							<li class="nav-item">
								<a class="nav-link" href="<?= base_url(route_to('data-pendaftar',$value->id)) ?>">
									<i class="icon">
										<svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<g>
												<circle cx="12" cy="12" r="8" fill="currentColor"></circle>
											</g>
										</svg>
									</i>
									<i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Periode" data-bs-placement="right">T</i>
									<span class="item-name"><?= $value->nama_tahap?></span>
								</a>
							</li>
						<?php endforeach ?>						
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'jurusan') echo 'active' ?>" href="<?= site_url('data-jurusan') ?>">
						<i class="icon" data-bs-toggle="tooltip" title="Jurusan" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Jurusan</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'pembayaran') echo 'active' ?>" href="<?= site_url('data-pembayaran') ?>">

						<i class="icon" data-bs-toggle="tooltip" title="Pembayaran" data-bs-placement="right">
							<svg class="icon-20" width="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M112 112c0 35.3-28.7 64-64 64V336c35.3 0 64 28.7 64 64H464c0-35.3 28.7-64 64-64V176c-35.3 0-64-28.7-64-64H112zM0 128C0 92.7 28.7 64 64 64H512c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM176 256a112 112 0 1 1 224 0 112 112 0 1 1 -224 0zm80-48c0 8.8 7.2 16 16 16v64h-8c-8.8 0-16 7.2-16 16s7.2 16 16 16h24 24c8.8 0 16-7.2 16-16s-7.2-16-16-16h-8V208c0-8.8-7.2-16-16-16H272c-8.8 0-16 7.2-16 16z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Pembayaran</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'agenda') echo 'active' ?>" href="<?= site_url('data-agenda') ?>">
						<i class="icon" data-bs-toggle="tooltip" title="Agenda" data-bs-placement="right">
							<svg class="icon-20" width="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Agenda</span>
					</a>
				</li>
				<li><hr class="hr-horizontal"></li>
				<li class="nav-item static-item">
					<a class="nav-link static-item disabled" href="#" tabindex="-1">
						<span class="default-icon">Kelola Aplikasi</span>
						<span class="mini-icon">-</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'sekolah') echo 'active' ?>" href="<?= site_url('data-sekolah') ?>">
						<i class="icon" data-bs-toggle="tooltip" title="List Data Sekolah" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96H48C21.5 96 0 117.5 0 144V464c0 26.5 21.5 48 48 48H256V416c0-35.3 28.7-64 64-64s64 28.7 64 64v96H592c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48H473.7L337.8 5.4zM96 192h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V208c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H512c-8.8 0-16-7.2-16-16V208zM96 320h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V336c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H512c-8.8 0-16-7.2-16-16V336zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H336V144c0-8.8-7.2-16-16-16z" fill="currentColor"/></svg>                      
						</i>
						<span class="item-name">List Data Sekolah</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'kategori') echo 'active' ?>" href="<?= site_url('kategori-kode') ?>">
						<i class="icon" data-bs-toggle="tooltip" title="Kode Opsi" data-bs-placement="right">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon-20" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M392.8 1.2c-17-4.9-34.7 5-39.6 22l-128 448c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l128-448c4.9-17-5-34.7-22-39.6zm80.6 120.1c-12.5 12.5-12.5 32.8 0 45.3L562.7 256l-89.4 89.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l112-112c12.5-12.5 12.5-32.8 0-45.3l-112-112c-12.5-12.5-32.8-12.5-45.3 0zm-306.7 0c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3l112 112c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256l89.4-89.4c12.5-12.5 12.5-32.8 0-45.3z" fill="currentColor" /></svg>
						</i>
						<span class="item-name">Kode Opsi</span>
					</a>
				</li>
				<li><hr class="hr-horizontal"></li>
				<li class="nav-item static-item">
					<a class="nav-link static-item disabled" href="#" tabindex="-1">
						<span class="default-icon">Kelola Akun</span>
						<span class="mini-icon" data-bs-toggle="tooltip" title="Elements" data-bs-placement="right">-</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'akun') echo 'active' ?>" href="<?= site_url('data-akun') ?>">
						<i class="icon" data-bs-toggle="tooltip" title="Akun" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" fill="currentColor"/></svg>                                                   
						</i>
						<span class="item-name">Akun</span>
					</a>
				</li>
				<li class="nav-item mb-5">
					<a class="nav-link" data-bs-toggle="modal" href="#Logout" role="button" data-bs-target="#logoutModal">
						<i class="icon" data-bs-toggle="tooltip" title="Logout" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" fill="currentColor"/></svg>                      
						</i>
						<span class="item-name">Logout</span>
					</a>
				</li>
			</ul>
		<?php else: ?>
			<!-- Sidebar Menu Start -->
			<ul class="navbar-nav iq-main-menu" id="sidebar-menu">
				<li class="nav-item static-item">
					<a class="nav-link static-item disabled text-start" href="#" tabindex="-1">
						<span class="default-icon">Beranda</span>
						<span class="mini-icon" data-bs-toggle="tooltip" title="Home" data-bs-placement="right">-</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'dashboard-siswa') echo 'active' ?>" aria-current="page" href="<?= site_url('dashboard-siswa') ?>">
						<i class="icon" data-bs-toggle="tooltip" title="Dashboard" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c.2 35.5-28.5 64.3-64 64.3H128.1c-35.3 0-64-28.7-64-64V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L416 100.7V64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V185l52.8 46.4c8 7 12 15 11 24zM248 192c-13.3 0-24 10.7-24 24v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V216c0-13.3-10.7-24-24-24H248z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Dashboard</span>
					</a>
				</li>
				<li><hr class="hr-horizontal"></li>
				<li class="nav-item static-item">
					<a class="nav-link static-item disabled" href="#" tabindex="-1">
						<span class="default-icon">Kelola Pendaftaran</span>
						<span class="mini-icon">-</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'daftar-ulang') echo 'active' ?>" href="<?= site_url('registrasi-ulang/'.session()->get('id_ref')) ?>">
						<i class="icon" data-bs-toggle="tooltip" title="Jurusan" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V299.6l-94.7 94.7c-8.2 8.2-14 18.5-16.8 29.7l-15 60.1c-2.3 9.4-1.8 19 1.4 27.8H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Daftar Ulang</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ($activePage == 'pembayaran') echo 'active' ?>" href="<?= site_url('konfirmasi-pembayaran/'.session()->get('id_ref')) ?>">

						<i class="icon" data-bs-toggle="tooltip" title="Pembayaran" data-bs-placement="right">
							<svg class="icon-20" width="20" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M112 112c0 35.3-28.7 64-64 64V336c35.3 0 64 28.7 64 64H464c0-35.3 28.7-64 64-64V176c-35.3 0-64-28.7-64-64H112zM0 128C0 92.7 28.7 64 64 64H512c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM176 256a112 112 0 1 1 224 0 112 112 0 1 1 -224 0zm80-48c0 8.8 7.2 16 16 16v64h-8c-8.8 0-16 7.2-16 16s7.2 16 16 16h24 24c8.8 0 16-7.2 16-16s-7.2-16-16-16h-8V208c0-8.8-7.2-16-16-16H272c-8.8 0-16 7.2-16 16z" fill="currentColor"/></svg>
						</i>
						<span class="item-name">Pembayaran</span>
					</a>
				</li>

				<li><hr class="hr-horizontal"></li>

				<li class="nav-item mb-5">
					<a class="nav-link" data-bs-toggle="modal" href="#Logout" role="button" data-bs-target="#logoutModal">
						<i class="icon" data-bs-toggle="tooltip" title="Logout" data-bs-placement="right">
							<svg class="icon-20" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" fill="currentColor"/></svg>                      
						</i>
						<span class="item-name">Logout</span>
					</a>
				</li>
			</ul>
		<?php endif ?>

	</div>
	<!-- Sidebar Menu End -->
</div>
<div class="sidebar-footer"></div>
</aside>
