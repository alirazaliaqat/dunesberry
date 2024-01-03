

@extends('layouts.master')

@section('content')
@php $locale = app()->getLocale() @endphp
@foreach(App\Models\Page::where('slug', '=', 'portfolio')->get() as $portfolio)
@foreach(App\Models\Page::select('title_en','title_ar','description_en','description_ar','video','id')->where('parent_page', $portfolio->id)->whereNull('parent_section')->where('display_order', 1)->get() as $banner)

<section class="banner-section">
    <div class="video-banner">
        <video autoplay loop muted>
            <source src="{{asset('storage/videos/'.$banner->video)}}" type="video/mp4">
            </video>
            <div class="video-overlay"></div>
        </div>
        <div class="container mt-5 px-lg-0">
            <div class="row pt-5 gx-0">
                <div class="col-lg-6 py-5">
                    
                    
                    <div class="banner-text-wrap py-5 my-5">
                        
                        <h2 class="banner-heading ">{!!$banner->{'title_'.$locale} !!}</h2>
                        <div>
                            {!!$banner->{'description_'.$locale} !!}
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    @endforeach
    
    @foreach(App\Models\Page::select('title_en','title_ar','description_en','description_ar','additional_en','additional_ar','image','id')->where('parent_page', $portfolio->id)->whereNull('parent_section')->where('display_order', 2)->get() as $story)
    
    <section class="our-story-section container">
        <div class="row gx-5 py-4 py-md-0 gy-4 gy-lg-0">
            <div class="col-lg-8">
                <h2 class="subheading text-start"> {!!$story->{'title_'.$locale} !!}</h2>
                <div class="row mt-4 gx-lg-5">
                    <div class="col-md-6 our-story-para">
                        {!!$story->{'description_'.$locale} !!}
                    </div>
                    <div class="col-md-6 our-story-para">
                        {!!$story->{'additional_'.$locale} !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-center text-lg-end ps-lg-5">
                <img src="{{asset('storage/images/'.$story->image)}}" class="img-fluid" />
            </div>
        </div>
    </div>
</section>

@endforeach

<!-- Our Works Section -->

@foreach(App\Models\Page::select('title_en','title_ar','id')->where('parent_page', $portfolio->id)->whereNull('parent_section')->where('display_order', 3)->get() as $work)

<section class="our-works-section py-5">
    <div class="container py-5" >
        <div class="row">
            <div class="col">
                <h2 class="subheading text-start text-white"> {!!$work->{'title_'.$locale} !!}</h2>
            </div>
        </div>
        <div class="accordion our-work-acc-wrap" id="accordionExample">
            <div class="row mt-5 gx-md-4 gx-2">
                
                @foreach (Cache::remember('work_data_' . $work->id, now()->addDay(), function () use ($work) {
                    return App\Models\Page::select('title_en','title_ar','id')->where('parent_section', $work->id)->where('content_level', '2')->orderBy('display_order', 'ASC')->get();
                }) as $inner)
                <div class="col-lg-2 col-md-3 col-4">
                    <button class="accordion-button @if($loop->iteration >1)collapsed @endif" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapsew{{$loop->iteration}}"
                        aria-expanded="@if($loop->iteration == 1) true @else false @endif"
                        aria-controls="collapsew{{$loop->iteration}}">
                        <div class="work-accordion h-100 w-100 position-relative">
                            <div class="berry-shap-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 233.4 226.7"
                                style="enable-background:new 0 0 233.4 226.7;" xml:space="preserve">
                                <path class="berry-shap"
                                d="M3.9,124L3.9,124c0-18.2,4.2-36.2,12.6-52.3C29.2,47.1,53.6,15.9,97.6,4.4c6.6-1.7,13.4-2.7,20.2-3l4.5-0.2  c22.7-1,45.1,6.7,62,22c14.3,13,28.7,33.3,38.3,65.3c0,0,9.2,22.5,6.6,62.7c-1.1,18-8.4,35.2-20.9,48.2  c-15.8,16.4-43.6,31.2-91.5,24.4c0,0-85.6-10.9-109.6-80.2C4.9,137.3,3.9,130.7,3.9,124z" />
                            </svg>
                        </div>
                        <h2 class="work-title">{{$inner->{'title_'.$locale} }}</h2>
                    </div>
                </button>
            </div>
            @endforeach
            
            <div class="col-12 work-acc-content">
                @foreach (Cache::remember('work_data_content_' . $work->id, now()->addDay(), function () use ($work) {
                    return App\Models\Page::select('id')->where('parent_section', $work->id)->where('content_level', '2')->orderBy('display_order', 'ASC')->get();
                }) as $inner)
                <div id="collapsew{{$loop->iteration}}"
                    class="accordion-collapse collapse @if($loop->iteration == 1) show @endif"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @if($loop->iteration == 1)
                        <div class="row equal-height-cols g-2">
                            @foreach (Cache::remember('work_data_content_inner_' . $inner->id, now()->addDay(), function () use ($inner) {
                                return App\Models\Page::select('id','image','title_en','title_ar','url')->where('parent_section', $inner->id)->where('content_level', '3')->orderBy('display_order', 'ASC')->get();
                            }) as $innerval)
                            <div class="col-lg-4 col-sm-6 ">
                                <div class="grid-img-wrap">
                                    <img src="{{asset('storage/images/'.$innerval->image)}}" alt=""
                                    class="img-fluid">
                                    <div class="grid-text-wrap">
                                        <h3>{{$innerval->{'title_'.$locale} }}</h3>
                                        <a href="{{$innerval->url}}" class="visit-web-btn" target="_blank">
                                            {{__('genral.VisitWebsite')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        @if($loop->iteration == 2)
                        <div class="row equal-height-cols g-2">
                            @foreach (Cache::remember('work_data_content_inner_' . $inner->id, now()->addDay(), function () use ($inner) {
                                return App\Models\Page::select('id','image','title_en','title_ar','description_en','description_ar','url')->where('parent_section', $inner->id)->where('content_level', '3')->orderBy('display_order', 'ASC')->get();
                            }) as $innerval)
                            <div class="col-sm-6 col-lg-4 ">
                                <div class="grid-img-wrap">
                                    <img src="{{ asset('storage/images/' . $innerval->image) }}" alt=""
                                    class="img-fluid">
                                    <div class="grid-text-wrap">
                                        <div>
                                            <div
                                            class="grid-inner-text">{!!$innerval->{'description_'.$locale} !!}</div>
                                        </div>
                                        <a href="{{$innerval->url}}" class="visit-web-btn"
                                            target="_blank">{{__('genral.View')}}</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            
                            @if($loop->iteration == 5)
                            <div class="row mas-grid g-2 branding-modal" >
                                @foreach (Cache::remember('work_data_content_inner_' . $inner->id, now()->addDay(), function () use ($inner) {
                                    return App\Models\Page::select('id','image','title_en','title_ar')->where('parent_section', $inner->id)->where('content_level', '3')->orderBy('display_order', 'ASC')->get();
                                }) as $innerval)
                                <div class="col-sm-6 col-lg-4">
                                    <button type="button" class="btn p-0 border-0" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{$innerval->id}}">
                                    <img src="{{asset('storage/images/'.$innerval->image)}}" alt=""
                                    class="img-fluid">
                                </button>
                                <div class="modal fade" id="staticBackdrop{{$innerval->id}}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                                <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach (Cache::remember('work_data_content_inner_images_' . $innerval->id, now()->addDay(), function () use ($innerval) {
                                                    return App\Models\Page::select('id','image')->where('parent_section', $innerval->id)->where('content_level', '4')->orderBy('display_order', 'ASC')->get();
                                                }) as $innerimages)
                                                @if($innerimages->image)
                                                <img src="{{asset('storage/images/'.$innerimages->image)}}" alt=""
                                                class="img-fluid">
                                                @else
                                                <h5 class="modal-title" id="staticBackdropLabel">No image Added</h5>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        @if($loop->iteration == 3)
                        <nav class="our-work-tabs">
                            <div class="nav nav-tabs mb-3 justify-content-center" id="nav-tab" role="tablist">
                                @foreach (Cache::remember('media_data_' . $inner->id, now()->addDay(), function () use ($inner) {
                                    return App\Models\Page::where('parent_section', $inner->id)->where('content_level', '3')->orderBy('display_order', 'ASC')->get();
                                }) as $media)
                                <button class="nav-link @if($loop->iteration == 1) active @endif " id="nav-ms{{$loop->iteration}}-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-ms{{$loop->iteration}}" type="button" role="tab"
                                    aria-controls="nav-ms{{$loop->iteration}}" aria-selected="@if($loop->iteration == 1)true @else false @endif">
                                    {!! $media->{'additional_'.$locale} !!} {{$media->{'title_'.$locale} }}</button>
                                    @endforeach
                                </div>
                            </nav>
                            
                            <div class="tab-content mt-5" id="nav-tabContent">
                                @foreach (Cache::remember('media_data_content_' . $inner->id, now()->addDay(), function () use ($inner) {
                                    return App\Models\Page::where('parent_section', $inner->id)->where('content_level', '3')->orderBy('display_order', 'ASC')->get();
                                }) as $pmedia)
                                <div class="tab-pane fade @if($loop->iteration == 1) active show @endif" id="nav-ms{{$loop->iteration}}"
                                    role="tabpanel" aria-labelledby="nav-ms{{$loop->iteration}}-tab">
                                    
                                    @if($loop->iteration == 1)
                                    <nav class="our-work-tabs">
                                        <div class="nav nav-tabs mb-3 design-portfolio no-line" id="nav-tab" role="tablist">
                                            @foreach (Cache::remember('media_data_inner_' . $pmedia->id, now()->addDay(), function () use ($pmedia) {
                                                return App\Models\Page::where('parent_section', $pmedia->id)->where('content_level', '4')->orderBy('display_order', 'ASC')->get();
                                            }) as $media)
                                            <button class="nav-link @if($loop->iteration == 1) active @endif "
                                                id="nav-msinner{{$loop->iteration}}-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-msinner{{$loop->iteration}}" type="button" role="tab"
                                                aria-controls="nav-msinner{{$loop->iteration}}" aria-selected="@if($loop->iteration == 1)true @else false @endif">
                                                <span></span>{{$media->{'title_'.$locale} }}</button>
                                                @endforeach
                                            </div>
                                        </nav>
                                        
                                        <div class="tab-content mt-2" id="nav-tabContent">
                                            @foreach (Cache::remember('media_data_inner_content_' . $pmedia->id, now()->addDay(), function () use ($pmedia) {
                                                return App\Models\Page::where('parent_section', $pmedia->id)->where('content_level', '4')->orderBy('display_order', 'ASC')->get();
                                            }) as $media)
                                            <div class="tab-pane fade @if($loop->iteration == 1) active show @endif"
                                                id="nav-msinner{{$loop->iteration}}" role="tabpanel"
                                                aria-labelledby="nav-msinner{{$loop->iteration}}-tab">
                                                <div class="row mas-grid g-2">
                                                    @foreach (Cache::remember('media_data_inner_content_inner_' . $media->id, now()->addDay(), function () use ($media) {
                                                        return App\Models\Page::where('parent_section', $media->id)->where('content_level', '5')->orderBy('display_order', 'ASC')->get();
                                                    }) as $mediaphoto)
                                                    <div class="col-sm-6 col-lg-3">
                                                        <a href="{{asset('storage/images/'.$mediaphoto->image)}}"
                                                            data-fslightbox="photos{{$media->id}}">
                                                            <img src="{{asset('storage/images/'.$mediaphoto->image)}}" alt=""
                                                            class="img-fluid" data-fslightbox="photos{{$media->id}}">
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                        
                                        @if($loop->iteration == 2)
                                        <nav class="our-work-tabs">
                                            <div class="nav nav-tabs mb-3 design-portfolio no-line" id="nav-tab" role="tablist">
                                                @foreach (Cache::remember('media_data_inner_vid_' . $pmedia->id, now()->addDay(), function () use ($pmedia) {
                                                    return App\Models\Page::where('parent_section', $pmedia->id)->where('content_level', '4')->orderBy('display_order', 'ASC')->get();
                                                }) as $media)
                                                <button class="nav-link @if($loop->iteration == 1) active @endif "
                                                    id="nav-msvid{{$loop->iteration}}-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-msvid{{$loop->iteration}}" type="button" role="tab"
                                                    aria-controls="nav-msvid{{$loop->iteration}}" aria-selected="@if($loop->iteration == 1)true @else false @endif">
                                                    <span></span> {{$media->{'title_'.$locale} }}</button>
                                                    @endforeach
                                                </div>
                                            </nav>
                                            
                                            <div class="tab-content mt-3" id="nav-tabContent">
                                                @foreach (Cache::remember('media_data_inner_vid_content_' . $pmedia->id, now()->addDay(), function () use ($pmedia) {
                                                    return App\Models\Page::where('parent_section', $pmedia->id)->where('content_level', '4')->orderBy('display_order', 'ASC')->get();
                                                }) as $media)
                                                <div class="tab-pane fade @if($loop->iteration == 1) active show @endif"
                                                    id="nav-msvid{{$loop->iteration}}" role="tabpanel"
                                                    aria-labelledby="nav-msvid{{$loop->iteration}}-tab">
                                                    <div class="row mas-grid g-2">
                                                        @foreach (Cache::remember('media_data_inner_vid_content_inner_' . $media->id, now()->addDay(), function () use ($media) {
                                                            return App\Models\Page::where('parent_section', $media->id)->where('content_level', '5')->orderBy('display_order', 'ASC')->get();
                                                        }) as $media)
                                                        <div class="col-sm-6 col-lg-4">
                                                            <div class="grid-img-wrap">
                                                                <a href="{{$media->url}}" class="trigger"
                                                                    data-fslightbox="{{ $media->id }}">
                                                                    <img src="{{ asset('storage/images/' . $media->image) }}" alt=""
                                                                    class="img-fluid">
                                                                </a>
                                                                <div class="grid-text-wrap">
                                                                    <div>
                                                                        <div class="grid-inner-text">{!! $media->{'description_'.$locale} !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    
                                    
                                    {{-- Design portfolio --}}
                                    
                                    @if($loop->iteration == 4)
                                    <nav class="our-work-tabs">
                                        <div class="nav nav-tabs mb-3 design-portfolio" id="nav-tab" role="tablist">
                                            @foreach (Cache::remember('media_data_'.$inner->id, now()->addDay(), function () use ($inner) {
                                                return App\Models\Page::select('id', 'title_en','title_ar')->where('parent_section', $inner->id)->where('content_level', '3')->orderBy('display_order', 'ASC')->get();
                                            }) as $media)
                                            <button class="nav-link @if($loop->iteration == 1) active @endif" id="nav-dp{{$loop->iteration}}-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-dp{{$loop->iteration}}" type="button" role="tab"
                                                aria-controls="nav-dp{{$loop->iteration}}" aria-selected="@if($loop->iteration == 1)true @else false @endif"><span></span>
                                                {{$media->{'title_'.$locale} }}</button>
                                                @endforeach
                                            </div>
                                        </nav>
                                        
                                        <div class="tab-content mt-5 designs-portfolio-grid" id="nav-tabContent">
                                            @foreach (Cache::remember('media_data_content_'.$inner->id, now()->addDay(), function () use ($inner) {
                                                return App\Models\Page::select('id', 'title_en','title_ar')->where('parent_section', $inner->id)->where('content_level', '3')->orderBy('display_order', 'ASC')->get();
                                            }) as $mediap)
                                            <div class="tab-pane fade @if($loop->iteration == 1) active show @endif"
                                                id="nav-dp{{$loop->iteration}}" role="tabpanel"
                                                aria-labelledby="nav-dp{{$loop->iteration}}-tab">
                                                <div class="row mas-grid g-2">
                                                    @if($loop->iteration == 1)
                                                    @foreach (Cache::remember('media_data_inner_'.$mediap->id, now()->addDay(), function () use ($mediap) {
                                                        return App\Models\Page::select('id', 'image', 'video', 'title_en','title_ar', 'description_en','description_ar')->where('parent_section', $mediap->id)->where('content_level', '4')->orderBy('display_order', 'ASC')->get();
                                                    }) as $media)
                                                    <div class="col-sm-6 col-lg-4 ">
                                                        <div class="grid-img-wrap">
                                                            <img src="{{ asset('storage/images/' . $media->image) }}" alt=""
                                                            class="img-fluid">
                                                            <div class="grid-text-wrap">
                                                                <div>
                                                                    <div class="grid-inner-text">{!!$media->{'description_'.$locale} !!}</div>
                                                                </div>
                                                                <a href="@if($media->video){{ asset('storage/videos/'.$media->video)}} @else # @endif"
                                                                    class="visit-web-btn" target="_blank">{{__('genral.ViewProfile')}}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        @foreach (Cache::remember('media_data_inner_'.$mediap->id, now()->addDay(), function () use ($mediap) {
                                                            return App\Models\Page::select('id', 'image')->where('parent_section', $mediap->id)->where('content_level', '4')->orderBy('display_order', 'ASC')->get();
                                                        }) as $media)
                                                        <div class="col-sm-6 col-lg-3">
                                                            <a href="{{ asset('storage/images/'.$media->image) }}" data-fslightbox="flowers{{$mediap->id}}">
                                                                <img src="{{ asset('storage/images/'.$media->image) }}" alt="" class="img-fluid"
                                                                data-fslightbox="flowers{{$mediap->id}}">
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                            
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                </div>
            </div>
        </section>
        @endforeach
        
        <section class="container-fluid px-0">
            <div class="row mx-0">
                @foreach (Cache::remember('our_team_data', now()->addDay(), function () use ($portfolio) {
                    return App\Models\Page::select('id', 'title_en','title_ar')->where('parent_page', $portfolio->id)->whereNull('parent_section')->where('display_order', 4)->get();
                }) as $ourteam)
                <div class="col-md-6 py-5 our-team-section">
                    <h2 class="subheading mt-4">{!!$ourteam->{'title_'.$locale} !!}</h2>
                    <div class="row mt-5">
                        @foreach (Cache::remember('our_team_images_'.$ourteam->id, now()->addDay(), function () use ($ourteam) {
                            return App\Models\Page::select('id', 'image', 'title_en','title_ar', 'description_en','description_ar')->where('parent_section', $ourteam->id)->where('content_level', 2)->orderBy('display_order', 'ASC')->get();
                        }) as $team)
                        <div class="col-6 col-lg-3 col-md-6 px-lg-3">
                            <div class="picture-container">
                                <img src="{{ Cache::remember('our_team_image_'.$team->id, now()->addDay(), function () use ($team) {
                                    return asset('storage/images/'.$team->image);
                                }) }}">
                            </div>
                            <div class="mt-2">
                                <h4 class="person-name">{!!$team->{'title_'.$locale} !!}</h4>
                                <h5 class="person-desig">{!!$team->{'description_'.$locale} !!}</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                
                @foreach (Cache::remember('success_story_data', now()->addDay(), function () use ($portfolio) {
                    return App\Models\Page::select('id', 'title_en','title_ar')->where('parent_page', $portfolio->id)->whereNull('parent_section')->where('display_order', 5)->get();
                }) as $sstory)
                <div class="col-md-6 py-5 mt-4">
                    <h2 class="subheading">{!!$sstory->{'title_'.$locale} !!}</h2>
                    
                    <div class="success-story-section">
                        @foreach (Cache::remember('success_story_inner_'.$sstory->id, now()->addDay(), function () use ($sstory) {
                            return App\Models\Page::select('id', 'title_en','title_ar', 'description_en','description_ar')->where('parent_section', $sstory->id)->where('content_level', 2)->orderBy('display_order', 'ASC')->get();
                        }) as $storyinner)
                        <div class="success-story mt-5">
                            <h3>{{$storyinner->{'title_'.$locale} }}</h3>
                            <div class="success-story-content">
                                {!!$storyinner->{'description_'.$locale} !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        
        
        
        
        
        
        @foreach (Cache::remember('client_data', now()->addDay(), function () use ($portfolio) {
            return App\Models\Page::select('id', 'title_en','title_ar')->where('parent_page', $portfolio->id)->whereNull('parent_section')->where('display_order', 6)->get();
        }) as $client)
        
        <section class="major-clients-section">
            <div class="container-fluid">
                
                <div class="accordion accordion-flush " id="accordionFlushExample">
                    
                    <div class="row gx-5">
                        <div class="col-lg-6 px-lg-5 py-lg-5">
                            <div class="h-100 px-4 py-5 mt-4">
                                <h2 class="subheading text-start">{!!$client->{'title_'.$locale} !!}</h2>
                                <div class="row g-2 slider-container mt-4 mb-3 mb-lg-0">
                                    @foreach (Cache::remember('client_images_'.$client->id, now()->addDay(), function () use ($client) {
                                        return App\Models\Page::select('id','image','title_en','title_ar')->where('parent_section', $client->id)->where('content_level', '2')->orderBy('display_order', 'ASC')->get();
                                    }) as $inner)
                                    <div class="col-xl-2 col-lg-3 col-md-2">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button @if($loop->iteration > 1) collapsed @endif" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseclient{{$inner->id}}" aria-expanded="@if($loop->iteration == 1)false @else true @endif" aria-controls="flush-collapseclient{{$inner->id}}">
                                                    <img src="{{ Cache::remember('image_'.$inner->id, now()->addDay(), function () use ($inner) {
                                                        return asset('storage/images/'.$inner->image);
                                                    }) }}" class="img-fluid d-block mx-auto" />
                                                </button>
                                            </h2>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-lg-6 db-bg-primary">
                            <div class="h-100 ">
                                <div class="row h-100">
                                    
                                    <div class="col-12 my-auto">
                                        @foreach (Cache::remember('client_inner_'.$client->id, now()->addDay(), function () use ($client) {
                                            return App\Models\Page::select('id')->where('parent_section', $client->id)->where('content_level', '2')->orderBy('display_order', 'ASC')->get();
                                        }) as $inner)
                                        
                                        <div id="flush-collapseclient{{$inner->id}}" class="accordion-collapse collapse @if($loop->iteration == 1) show @endif" data-bs-parent="#accordionFlushExample">
                                            @foreach (Cache::remember('client_details_'.$inner->id, now()->addDay(), function () use ($inner) {
                                                return App\Models\Page::select('id','image','title_en','title_ar','description_en','description_ar','additional_en','additional_ar')->where('parent_section', $inner->id)->orderBy('display_order', 'ASC')->get();
                                            }) as $inval)
                                            <div class="accordion-body">
                                                <div class="px-3 px-md-5 py-4">
                                                    <div class="d-flex">
                                                        <img src="{{ Cache::remember('image_'.$inval->id, now()->addDay(), function () use ($inval) {
                                                            return asset('storage/images/'.$inval->image);
                                                        }) }}" class="img-fluid d-block client-details-logo" />
                                                    </div>
                                                    <div class="mt-5 pt-2 column-item">
                                                        
                                                        <h4 class="client-heading small mb-3">@if($locale == 'en')<span>Client</span> Brief @else نبذة عن العميل:
                                                            @endif</h4>
                                                            
                                                            {!!$inval->{'description_'.$locale} !!}
                                                            
                                                        </div>
                                                        <div class="mt-4 pt-2 column-item">
                                                            
                                                            <h4 class="client-heading small mb-3">@if($locale == 'en') <span>Our</span> Scope @else الخدمات المقدمة للعميل
                                                                @endif</h4>
                                                                {!!$inval->{'additional_'.$locale} !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endforeach
            
            
            @foreach (Cache::remember('number_data', now()->addDay(), function () use ($portfolio) {
                return App\Models\Page::select('id','image')->where('parent_page', $portfolio->id)->whereNull('parent_section')->where('content_level', 1)->where('display_order', 7)->get();
            }) as $number)
            <section class="numbers-section" style="background-image: url('{{asset("storage/images/".$number->image)}}')">
                <div class="img-overlay"></div>
                <div class="container">
                    <div class="row d-flex justify-content-center gy-lg-0 gy-5">
                        
                        @foreach (Cache::remember('numbers_inner_'.$number->id, now()->addDay(), function () use ($number) {
                            return App\Models\Page::select('image','title_en','title_ar','description_en','description_ar')->where('parent_section', $number->id)->where('content_level', '2')->orderBy('display_order', 'ASC')->get();
                        }) as $inner)
                        
                        
                        <div class="col-lg-2 col-6 numbers-container">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 201.09 206.09">
                                {!! file_get_contents(public_path('storage/images/'.$inner->image)) !!}
                            </svg>
                            
                            
                            <h3> {!! $inner->description_en!!} </h3>
                            <p>
                                {{$inner->{'title_'.$locale} }}    
                            </p>
                            
                        </div>   
                        
                        
                        @endforeach
                        
                    </div>              
                </div>
            </section>
            
            @endforeach
            
            <section class="technical-expertise">
                <div class="container">
                    <h2 class="subheading text-start mb-5">@if($locale == 'en')<span>Our </span>Expertise @else خبراتنا  @endif</h2>
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/html5img.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/CSS3_logo.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Javascript_Logo.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/985px-Laravel.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/php-1-logo.svg?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Microsoft_.NET_logo.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/python.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/nodejs-logo-FBE122E377-seeklogo.com.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/React-icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Angular_full_color_logo.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/flutter.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Bootstrap_logo.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/mysql-logo.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/mongodb-logo.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/nextjs-logo.svg?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/drupal_logo.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/shopify-logo-png-transparent.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/WooCommerce_logo.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/bigcommerce-logo.avif?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/salla-logo-d.a826c075.svg?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/WordPress_blue_logo.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Tailwind-CSS1-900x0.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/google-ads-logo-B4A8680058-seeklogo.com.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/GAnalytics.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/webflow.svg?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/1667px-Figma-logo.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/magento-logo-7F3911AE9E-seeklogo.com.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/squarespace-logo-png-transparent.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/framer_logo_icon_145269.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Adobe_XD_CC_icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Adobe_Illustrator_CC_icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Adobe_Dreamweaver_CC_icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Adobe_InDesign_CC_icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Adobe_Photoshop_CC_icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Adobe_Premiere_Pro_CC_icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-3 mb-4">
                            <div class="logo-container">
                                <img src="{{asset('assets/images/Adobe_After_Effects_CC_icon.svg.png?v=1')}}" alt="Inner Image">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            
            @endforeach
            @endsection
            
            @section('scripts')
            
            <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"
            async></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.js"
            integrity="sha512-2VqLVM3WCyaqUgQb2hpoWHSus021RIN0Jq0wfrLqqLh+anm1kW/H4Yw7HVu3D5W4nbdUQmAA2mqQv2JEoy+kPA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            
            <script>
                $(document).ready(function() {
                    $('img, video').attr('loading', 'lazy');
                });
                
                document.addEventListener('DOMContentLoaded', function () {
                    // Function to initialize Masonry
                    function initMasonry() {
                        // Select all elements with the class '.mas-grid'
                        var grids = document.querySelectorAll('.mas-grid');
                        
                        grids.forEach(function (grid) {
                            var masonry = new Masonry(grid, {
                                itemSelector: '.col-sm-6',
                                percentPosition: true,
                                @if($locale == 'ar')isOriginLeft: false @endif
                                // Add any other Masonry options you need
                            });
                        });
                    }
                    
                    function updateMasonryLayout() {
                        // Layout Masonry again after tab switch
                        initMasonry();
                    }
                    
                    var tabLinks = document.querySelectorAll('.nav-link');
                    tabLinks.forEach(function (tabLink) {
                        tabLink.addEventListener('click', updateMasonryLayout);
                    });
                    var accLinks = document.querySelectorAll('.our-work-acc-wrap .accordion-button');
                    accLinks.forEach(function (accLinks) {
                        accLinks.addEventListener('click', updateMasonryLayout);
                    });
                    
                    var lastOpenAccordion = localStorage.getItem('lastOpenAccordion');
                    $('.our-work-acc-wrap.accordion').on('shown.bs.collapse', function (e) {
                        var openAccordionId = $(e.target).attr('id');
                        localStorage.setItem('lastOpenAccordion', openAccordionId);
                        $('.accordion-button[data-bs-target="#' + lastOpenAccordion + '"]').addClass('collapsed');
                        initMasonry();
                    });
                    
                    $('.our-work-acc-wrap.accordion .collapse').removeClass('show');
                    if (lastOpenAccordion) {
                        $('#' + lastOpenAccordion).addClass('show');
                        $('.accordion-button[data-bs-target="#collapsew1"]').addClass('collapsed');
                        $('.accordion-button[data-bs-target="#' + lastOpenAccordion + '"]').removeClass('collapsed');
                        initMasonry();
                    }
                    else
                    {
                        $('#collapsew1').addClass('show');
                        
                    }
                    
                });
                
                
                
            </script>
            @endsection 