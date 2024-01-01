@extends('admin.master')

@section('content')

<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-12">
        <!--begin::Table Widget 4-->
        <div class="px-4 py-4 table-main-title">
            <h2 class="text-white mb-0"><i class="la la-globe fs-2 pe-2 text-white"></i>Site Setting</h2>
        </div>
       
            <div class="card card-flush rounded-0">
                
                
                <div class="form-group px-5 border-bottom">
                    <div class="row"> 
                        
                        <div class="col-md-3 py-5 px-5 border-end">
                         <h4> Logo</h4>
                            
                        </div>
                        <div class="col-md-3  py-5 ps-5 border-end">
                            <h4> Site Title</h4>
                        </div>
                        <div class="col-md-3  py-5 ps-5 border-end">
                            <h4> Site Description</h4>
                        </div>
                        <div class="col-md-3  py-5 ps-5 text-center">
                            <h4> Action</h4>
                        </div>
                    </div>
                </div>
              
              @if ($settings)
                  
           
                <div class="form-group px-5 border-bottom">
                    <div class="row"> 
                        
                        <div class="col-md-3 py-5 px-5 border-end">
                            <img alt="Logo" src=" @if(isset($settings->site_title)){{ asset('storage/images/'.$settings->logo) }} @endif" class="h-60px app-sidebar-logo-default image-fluide" />
                            
                        </div>
                        <div class="col-md-3 py-5  ps-5 border-end">
                            @if(isset($settings->site_title))
                            {{ $settings->site_title }}
                        @else
                       Site Title
                        @endif
                        </div>
                        <div class="col-md-3 py-5  ps-5 border-end">
                            @if(isset($settings->site_description))
                            {!! $settings->site_description !!}
                        @else
                       Site Description
                        @endif
                        </div>
                        <div class="col-md-3 py-5  ps-5">
                           
                            <div class="d-flex justify-content-end">
                                    
                              
                                <a  type="button" data-bs-toggle="modal" data-bs-target="#site-setting{{ $settings->id }}" class="btn btn-warning me-2">Edit</a>
                                <form method="POST" action="{{ route('site-setting.destroy', $settings->id) }}" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger show_confirm">Delete</button>
                                </form>
                                </div>
                        </div>
                        @include('admin/site-setting.edit')
                        </div>
                    </div>

                </div>
              
                @else
                <div class="form-group px-5 border-bottom py-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#site-setting-add">Add Settings</button>
                    </div>
                </div>
            </div>
                @endif
                <div class="modal fade" id="site-setting-add" tabindex="-1" aria-labelledby="imagegalleryLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagegalleryLabel">Site Setting
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('site-setting.store') }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                            <div class="modal-body">
                                
                                    <div class=" text-center">
                                        <label for="subcategoryimage" class="form-label d-block mt-4 mb-5">Logo</label>
                                        <style>.image-input-placeholder { background-image: url('/assets/media/svg/files/blank-image.svg'); } 
                                            [data-theme="dark"] .image-input-placeholder { background-image: url('assets{{('assets/media/svg/files/blank-image-dark.svg')}}'); }</style>
                                            <!--end::Image input placeholder-->
                                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true" style="&lt;br /&gt; &lt;b&gt;Warning&lt;/b&gt;: Undefined variable $imageBg in &lt;b&gt;C:\wamp64\www\keenthemes\core\html\dist\view\pages\apps\ecommerce\catalog\edit-product\_logo.php&lt;/b&gt; on line &lt;b&gt;30&lt;/b&gt;&lt;br /&gt;">
                                                <!--begin::Preview existing logo-->
                                                <div class="image-input-wrapper w-150px h-150px"></div>
                                                <!--end::Preview existing logo-->
                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change logo">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="logo_remove" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel logo">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Cancel-->
                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove logo">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Remove-->
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                        </div>
                                        <div class="mt-5">
                                            <label for="site_title" class="form-label">Site Title</label>
                                            <input type="text" name="site_title" value="{{old('site_title')}}" class="form-control" id="site_title" placeholder="Enter Site Title">
                                        </div>

                                        <div class="mt-5">
                                            <label for="fornedescar" class="form-label">Description</label>
                                            <textarea class="ckeditor form-control" name="site_description" value="{{old('site_description')}}" id="site-description"></textarea>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    
                    
                </div>
                
                
            </div>
            
        </div>
 
    
</div>
<!--end::Col-->

@endsection


@section('scripts')
<script src="https://cdn.tiny.cloud/1/sedyj3jexien96kl0eg38lgsityk2akycmkecvs8og0l4la4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        branding: false,
        selector: 'textarea',
        plugins: ['link', 'lists'], // Include the 'link' plugin
        toolbar: 'undo redo | bold italic | link | numlist bullist', // Add the 'link' button to the toolbar
    });


</script>


@endsection