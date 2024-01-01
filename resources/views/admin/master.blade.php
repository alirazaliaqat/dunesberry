<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head><base href="">
	<title>Dunesberry</title>
	<meta charset="utf-8" />
	<meta name="description" content="Dunesberry" />
	<meta name="keywords" content="Dunesberry" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:title" content="Dunesberry" />

	{{-- @vite(['resources/js/app.js']) --}}
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	
	<link href="{{ asset('assets/css/datatables.bundle.css ')}}" rel="stylesheet" type="text/css" />

	<link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

	@yield('styles')
	
   
</head>


<body data-kt-name="metronic" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">

	<script>if ( document.documentElement ) { const defaultThemeMode = "system"; const name = document.body.getAttribute("data-kt-name"); let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); }</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::App-->
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				
				<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
					<!--begin::Logo-->
					<div class="app-sidebar-logo px-6 text-center pt-3" id="kt_app_sidebar_logo">
						<!--begin::Logo image-->
						<h2><a href="/admin">
							@php
            $settings = App\Models\SiteSetting::first()
            @endphp
            @if (isset($settings->logo)) 
            <img alt="Logo"
                src="{{ asset('storage/images/' .$settings->logo) }} "
                class="h-125px" />
                @else 
                <h3 class="text-white">Dunesberry</h3>
                @endif
							
						</a>
					</h2>
					
				</div>
				<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
					<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">

						<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
							
							<ul class="ps-0">
								<li>
									<div class="menu-item menu-accordion {{ (request()->is('admin')) ? 'show' : '' }}">
										<!--begin:Menu link-->
										<a class="menu-link " href="/admin">
											<span class="menu-icon">
												<span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
														<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
													</svg>
												</span>
											</span>
											<span class="menu-title">Dashboards</span>
										</a>
										<!--end:Menu link-->
									</div>
									
								</li>
							
							
					
								


								<li>
									<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->is('admin/pages*')) ? 'show' : '' }}">
							
										<!--begin:Menu link-->
										<span class="menu-link">
											<span class="menu-icon">
											
												<span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z" fill="currentColor"></path>
														<path d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z" fill="currentColor"></path>
													</svg>
												</span>
											
											</span>
											<span class="menu-title">All Pages</span>
											<span class="menu-arrow"></span>
										</span>
										<!--end:Menu link-->
										<div class="menu-sub menu-sub-accordion">
											
											{{--<div class="menu-item">
												
												<a class="menu-link" href="/admin/pages">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
													<span class="menu-title">All Pages</span>
												</a>
												
											</div>--}}
                                      @foreach(App\Models\Page::whereNull('parent_page')->get() as $page)

											<!--begin:Menu sub-->
											<div class="menu-item">
												
												<a class="menu-link" href="/admin/pages/{{$page->id}}">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
													<span class="menu-title">{{$page->title_en}}</span>
												</a>
												
											</div>
											
										@endforeach

											
										
										</div>
										
									</div>
									
								</li>


						
								
								<?php /*
								<li>
									<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->is('admin/*gallery*')) ? 'show' : '' }}">
									
										<span class="menu-link">
											<span class="menu-icon">
											
												<span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M20 7H3C2.4 7 2 6.6 2 6V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V6C21 6.6 20.6 7 20 7ZM7 9H3C2.4 9 2 9.4 2 10V20C2 20.6 2.4 21 3 21H7C7.6 21 8 20.6 8 20V10C8 9.4 7.6 9 7 9Z" fill="currentColor"></path>
														<path opacity="0.3" d="M20 21H11C10.4 21 10 20.6 10 20V10C10 9.4 10.4 9 11 9H20C20.6 9 21 9.4 21 10V20C21 20.6 20.6 21 20 21Z" fill="currentColor"></path>
													</svg>
												</span>
												
											</span>
											<span class="menu-title">Media Gallery</span>
											<span class="menu-arrow"></span>
										</span>
										
										<div class="menu-sub menu-sub-accordion">
											
											
											<div class="menu-item">
												
												<a class="menu-link" href="/admin/gallery-filter">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
													<span class="menu-title">Gallery Filters</span>
												</a>
												
											</div>

											<div class="menu-item">
												
												<a class="menu-link" href="/admin/image-gallery">
													<span class="menu-bullet">
														<span class="bullet bullet-dot"></span>
													</span>
													<span class="menu-title">Gallery</span>
												</a>
												
											</div>
										
											
											
										</div>
										
									</div>
									
								</li>
								*/ ?>
						
								<li>
									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{ (request()->is('admin/site-setting')) ? 'active' : '' }}" href="/admin/site-setting">
											<span class="menu-icon">
											

												<span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
														<path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
													</svg>
												</span>
											</span>
											<span class="menu-title">Site Setting</span>
											
										</a>
										
										
									</div>
								</li>
								
								<li>
									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
											<span class="menu-icon">
												<span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
														<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
													</svg>
												</span>
											</span>
											<span class="menu-title">{{ __('Logout') }}</span>
											
										</a>
										
									
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
									</div>
									<!--end:Menu item-->
								</li>
							</ul>
						</div>
						<!--end::Menu-->
					</div>
					<!--end::Menu wrapper-->
				</div>
				<!--end::sidebar menu-->
				
			</div>
			<!--end::sidebar-->
			
			<!--end::sidebar-->
			<div class="px-5">
				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
		<!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid mt-10">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="container-fluid">
				@include('inc.messages')

			@yield('content')
		</div>
		</div>
	</div>
		</div>
	</div>
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Page-->
</div>

<!--begin::Javascript-->

<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/datatables.bundle.js')}}"></script>


@yield('scripts')


<script>
	$(document).ready(function() {
		
		$(".menu-accordion.show>.menu-link").removeClass("active");
		$(".menu-accordion.show>.menu-link").addClass("active");     
		
		
	});	
	$(document).ready(function() {
		
		$(".menu-accordion.show>.menu-link").removeClass("active");
		$(".menu-accordion.show>.menu-link").addClass("active");     
		
		
	});					
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
     <script type="text/javascript">
      
          $('.show_confirm').click(function(event) {
               var form =  $(this).closest("form");
               var name = $(this).data("name");
               event.preventDefault();
               swal({
                   title: `Are you sure you want to delete this record?`,
                   text: "If you delete this, it will be gone forever.",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
               })
               .then((willDelete) => {
                 if (willDelete) {
                   form.submit();
                 }
               });
           });

		  
       
     </script>
</body>

</html>