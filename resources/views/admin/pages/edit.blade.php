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
            <h2 class="text-white mb-0"><i class="la la-globe fs-2 pe-2 text-white"></i>Edit Page</h2>
        </div>
        <div class="card card-flush h-xl-100 rounded-0">
            
            <!--begin::Card body-->
            <div class="card-body pt-2">
                
                
                <div class="card card-p-0 card-flush mt-4">
                    <form action="{{ route('pages.update',$page->id) }}" method="POST" enctype="multipart/form-data"> 
                        @csrf
                        <div class="row mt-5">
                            <div class="col-3 ">
                                <div class="card card-flush p-5 add-course-sidebar me-4">
                                    
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        
                                        <div class="">
                                            <label class="form-label">Parent Page</label>
                                            
                                             <select name="parent_page" class="form-select">
                                            <option value="">None</option>
                                            @foreach ($allpages as $pg)
                                            <option value="{{ $pg->id }}" @if($pg->id == $page->parent_page) selected @endif>{!! $pg->title_en !!}</option> 
                                            @endforeach

                                        </select>
                                            
                                        </div>

                                        
                                        <div class="mt-5">
                                            <label class="form-label">Parent section</label>
                                            
                                             <select name="parent_section" class="form-select">
                                            <option value="">None</option>
                                            @foreach (App\Models\Page::whereNotNull('parent_page')->get() as $pg)
                                            <option value="{{ $pg->id }}" @if($pg->id == $page->parent_section) selected @endif>{!! $pg->title_en !!}</option> 
                                            @endforeach
                                    
                                        </select>
                                            
                                        </div>
                                       
                                        <div class="mt-5">
                                            <label  class="form-label">Content Level</label>
                                            <input type="number" name="content_level" value="{{$page->content_level}}" class="form-control" placeholder="Content level">
                                        </div>


                                        @error('content_level')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror

                                        <div class="mt-5">
                                            <label for="display_order" class="form-label">Display Order</label>
                                            <input type="number" name="display_order" value="{{ $page->display_order }}" class="form-control" id="display_order" placeholder="Order">
                                        </div>
                                        @error('display_order')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror


                                        <div class="mt-5">
                                            <label for="neurl" class="form-label">Button URL</label>
                                            <input type="text" name="url" value="{{ $page->url }}" class="form-control" id="url" placeholder="Enter url">
                                        </div>
                                       
                                        <div class="mt-5 text-center">
                                            <label for="locationsname" class="form-label d-block mt-4">Add Image</label>
                                            <style>.image-input-placeholder { background-image: url('/assets/media/svg/files/blank-image.svg'); } 
                                                [data-theme="dark"] .image-input-placeholder { background-image: url('assets{{('assets/media/svg/files/blank-image-dark.svg')}}'); }</style>
                                                <!--end::Image input placeholder-->
                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true" style="&lt;br /&gt; &lt;b&gt;Warning&lt;/b&gt;: Undefined variable $imageBg in &lt;b&gt;C:\wamp64\www\keenthemes\core\html\dist\view\pages\apps\ecommerce\catalog\edit-product\_thumbnail.php&lt;/b&gt; on line &lt;b&gt;30&lt;/b&gt;&lt;br /&gt;">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ asset('storage/images/'. $page->image) }}'); object-fit: contain;"></div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change thumbnail">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="image"  value="{{ $page->image }}" accept="image/*,.svg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel thumbnail">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove thumbnail">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->
                                                <!--begin::Description-->
                                                @error('image')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                                <div class="text-muted fs-7">Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                            </div>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <label for="formFile" class="form-label">OR Upload video</label>
                                            <input class="form-control" name="video" type="file" value="{{$page->video}}" id="formFile" accept="video/*,.pdf">


                                            @if($page->video)
                                            <div>
                                                <a  data-bs-toggle="modal" data-bs-target="#myModal" class="text-warning video-btn" data-src="{{asset('storage/videos/'.$page->video)}}">
                                                    <i class="las la-play-circle"></i>
                                                </a>


                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                           
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                                                            </button> 
                                                          </div>
                                                        
                                                        <div class="modal-body pt-0">
                                                             
                                                          <!-- 16:9 aspect ratio -->
                                                  <div class="ratio ratio-16x9">
                                                    <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                                                  </div>
                                                          
                                                          
                                                        </div>
                                                  
                                                      </div>
                                                    </div>
                                                  </div> 
                                            </div>
                                            @endif

                                          </div>
                                          @error('video')
                                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                                         @enderror
                                            <div class="text-muted fs-7 mt-2 text-center">
                                                 <b> max file size should be 10MB</b>
                                                            <br>
                                                            <br>
                                                
                                                
                                                </div>
                                        <!--end::Card body-->
                                    </div>
                                    
                                </div>
                                <div class="col-9 ps-5 gic-pages">
                                    <nav class="aboutus-tabs sp-services-tabs">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link fw-bold active" id="nav-english-tab" data-bs-toggle="tab" data-bs-target="#nav-english" 
                                            type="button" role="tab" aria-controls="nav-english" aria-selected="true">
                                            English
                                        </button>
                                        <button class="nav-link fw-bold" id="nav-arabic-tab" data-bs-toggle="tab" data-bs-target="#nav-arabic" 
                                        type="button" role="tab" aria-controls="nav-arabic" aria-selected="true">
                                        Arabic
                                    </button>
                                </div>
                            </nav>
                            
                            <div class="tab-content mt-8" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-english" role="tabpanel" aria-labelledby="nav-english-tab">

                                    <label for="title-en" class="form-label">Title </label>
                                    <input type="text" name="title_en" value="{{ $page->title_en }}" class="form-control" id="title-en" placeholder="Enter title">
                                    @error('title_en')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                    
                                    <div class="mt-5">
                                        <label for="description_en" class="form-label">Description</label>
                                        <textarea class="form-control" name="description_en"  value="{{ $page->description_en }}" id="description-en" rows="6"> {{ $page->description_en }}</textarea>
                                           
                                      
                                    </div>
                                    <div class="mt-5">
                                        <label for="additional_en" class="form-label">Additional</label>
                                        <textarea class="form-control" name="additional_en"  value="{{ $page->additional_en }}" id="additional-en" rows="6"> {{ $page->additional_en }}</textarea>
                                           
                        
                                    </div>
                                    
                                    <div class="mt-5">
                                        <label class="form-label">Button Text </label>
                                        <input type="text" name="btn_text_en" value="{{$page->btn_text_en }}" class="form-control" placeholder="Enter Button Text">
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="tab-pane fade" id="nav-arabic" role="tabpanel" aria-labelledby="nav-arabic-tab">
                                    <div class="">
                                        <label for="title-ar" class="form-label">Title </label>
                                        <input type="text" name="title_ar" value="{{ $page->title_ar }}" class="form-control" id="title-ar" placeholder="Enter title">
                                    </div>
                                    <div class="mt-5">
                                        <label for="fornedescar" class="form-label">Description</label>
                                        <textarea class="ckeditor form-control" name="description_ar"  value="{{ $page->description_ar }}" value="" id="description-ar" rows="6"> {{ $page->description_ar }} </textarea>
                                         
                                    </div>

                                    <div class="mt-5">
                                        <label for="additional_ar" class="form-label">Additional</label>
                                        <textarea class="form-control" name="additional_ar"  value="{{ $page->additional_ar }}" id="additional-en" rows="6"> {{ $page->additional_ar }}</textarea>
                                        
                                    </div>

                                    <div class="mt-5">
                                        <label class="form-label">Button Text </label>
                                        <input type="text" name="btn_text_ar" value="{{$page->btn_text_ar }}" class="form-control" placeholder="Enter Button Text">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-10">
                                @method('PUT')
                                <!--begin::Button-->
                                <div class="justify-content-end">
                                    <a href="{{url('admin/pages/'.$page->parent_page)}}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary ms-3">Update Page</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
        <!--end::Card body-->
    </div>
    <!--end::Table Widget 4-->
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

<script>
    
    


    $(document).ready(function() {

var $videoSrc;  
$('.video-btn').click(function() {
    $videoSrc = $(this).data( "src" );
});
console.log($videoSrc);
 
$('#myModal').on('shown.bs.modal', function (e) {
    
$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
})
 
$('#myModal').on('hide.bs.modal', function (e) {

    $("#video").attr('src',$videoSrc); 
}) 
    
});
</script>

@endsection