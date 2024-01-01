<div class="modal fade" id="site-setting{{ $settings->id }}" tabindex="-1" aria-labelledby="imagegalleryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagegalleryLabel">Site Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<form action="{{ route('site-setting.update',$settings->id) }}" method="POST" enctype="multipart/form-data"> 
    @csrf
<div class="modal-body">
                                
    <div class="my-5 text-center">
        <label for="subcategoryimage" class="form-label d-block mt-4 mb-5">Logo</label>
        <style>.image-input-placeholder { background-image: url('/assets/media/svg/files/blank-image.svg'); } 
            [data-theme="dark"] .image-input-placeholder { background-image: url('assets{{('assets/media/svg/files/blank-image-dark.svg')}}'); }</style>
            <!--end::Image input placeholder-->
            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true" style="&lt;br /&gt; &lt;b&gt;Warning&lt;/b&gt;: Undefined variable $imageBg in &lt;b&gt;C:\wamp64\www\keenthemes\core\html\dist\view\pages\apps\ecommerce\catalog\edit-product\_logo.php&lt;/b&gt; on line &lt;b&gt;30&lt;/b&gt;&lt;br /&gt;">
                <!--begin::Preview existing logo-->
                <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ asset('storage/images/'. $settings->logo) }}'); background-size: contain; background-color: #fff;"></div>
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
            <input type="text" name="site_title" value="{{$settings->site_title}}" class="form-control" id="site_title" placeholder="Enter Site Title">
        </div>

        <div class="mt-5">
            <label for="fornedescar" class="form-label">Description</label>
            <textarea class="ckeditor form-control" name="site_description" value="{{$settings->site_description}}" id="site-description">
                {{$settings->site_description}}
            </textarea>
        </div>
    
</div>
<div class="modal-footer justify-content-center">
    @method('PUT')
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">update</button>
</div>
</div>
</form>
    </div>
</div>
</div>