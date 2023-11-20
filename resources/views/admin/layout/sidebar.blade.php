<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg h-100">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Sidebar header -->
		<div class="sidebar-section">
			<div class="sidebar-section-body d-flex justify-content-center">
				<h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

				<div>
					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
						<i class="ph-arrows-left-right"></i>
					</button>

					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
						<i class="ph-x"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /sidebar header -->


		<!-- Main navigation -->
		<div class="sidebar-section">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header pt-0">
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<li class="nav-item">
					<a href="{{ route('homepage') }}" class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}">
						<i class="ph-activity"></i>
						<span>
							Dashboard
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('film.index') }}" class="nav-link @if (Request::is('admin/phim*')) active @endif">
						<i class="icon-film3"></i>
						<span>
							Danh sách phim
						</span>
					</a>
				</li>


				<li class="nav-item nav-item-submenu ">
					<a href="#" class="nav-link @if (Request::is('admin/category*') || Request::is('admin/post*')) active @endif">
						<i class="icon-book"></i>
						<span>Bài viết</span>
					</a>
					<ul class="nav-group-sub collapse @if (Request::is('admin/category*') || Request::is('admin/post*')) show @endif">
						<li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link @if (Request::is('admin/post*')) active @endif">Bài viết</a></li>
						<li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link @if (Request::is('admin/category*')) active @endif">Danh mục</a></li>

					</ul>
				</li>
				<li class="nav-item ">
					<a href="#" class="nav-link">
						<i class="ph-circles-three-plus"></i>
						<span>Thu thập dữ liệu</span>
					</a>
				</li>
				@if (Auth::check() && Auth::user()->role == '0')
					<li class="nav-item ">
						<a href="{{ route('user.index') }}" class="nav-link @if (Request::is('admin/user*') || Request::is('admin/users*')) active @endif">
							<i class="ph-users-three"></i>
							<span>Tài khoản</span>
						</a>
					</li>
				@endif
				{{-- <li class="nav-item">
					<a href="{{ route('user.index') }}" class="nav-link @if (Request::is('user*')) active @endif">
						<i class="ph-user"></i>
						<span>
							Tài khoản
						</span>
					</a>
				</li> --}}

				<!-- Page kits -->

				<!-- /page kits -->

			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>
<!-- /main sidebar -->
