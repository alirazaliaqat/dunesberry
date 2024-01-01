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
                            <h2 class="text-white mb-0"><i class="la la-globe fs-2 pe-2 text-white"></i>{!!$page->title_en!!} Inner Sections</h2>
                        </div>
                        <div class="card card-flush h-xl-100 rounded-0">
                            
                            <!--begin::Card body-->
                            <div class="card-body pt-2">
                                
                                
                                <div class="card card-p-0 card-flush">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <div class="card-title">
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <span class="svg-icon svg-icon-1 position-absolute ms-4"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                </svg></span>
                                                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Page">
                                            </div>
                                           
                                           
                                        </div>
                                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                            <a href="{{ route('pages.create') }}" class="btn btn-primary">
                                                Add Section
                                            </a>
                                            
                                        </div>
                                    </div>
                                    @if(count($subpages)>0)
                                        <div class="card-body">
                                            <div id="kt_datatable_example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="table-responsive">
                                                <table class="table align-middle table-striped table-row-bordered border gy-3 gs-7" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th>Sr. No</th>
                                                              <th style="width:70px;">Image</th>
                                                            <th>Title</th>
                                                           
                                                            <th>Display Order</th>
                                                            <th>Content level</th>
                                                            <th>Parent Page</th>
                                                            <th>Inner Sections</th>
                                                           
                                                            <th class="w-150px text-center">Action</th>
                                                        </tr>
                                                        <!--end::Table row-->
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach ($subpages as $page)
                                                        <tr class="odd" style="margin-left: {{ ($page->content_level - 1) * 20 }}px;">
                                                            <td>{{ $loop->iteration }}</td>
                                                            
                                                             <td>@if($page->image) <img src="{{asset('storage/images/'.$page->image)}}" class="img-fluid"> @else none @endif</td>
                                                           <td>{!! $page->title_en !!}</td>
                                                            <td>{{ $page->display_order }}</td>
                                                            <td>{{ $page->content_level }}</td>
                                                            <td>
                                                                @if ($page->parent_page)
                                                                    {{ $page->parent_page }}
                                                                @else
                                                                    None
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($page->parent_section)
                                                                    <a href="{{url('admin/pages/sections/'.$page->id)}}">View</a>
                                                                @else
                                                                    None
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <a href="/admin/pages/{{ $page->id }}/edit" class="btn btn-warning me-2">Edit</a>
                                                                    <form method="POST" action="{{ route('pages.destroy', $page->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger show_confirm">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr >
                                                           <td>
                                                            <h4 class="text-center">
                                                                No Inner Sections
                                                               </h4>
                                                            </td>
                                                        </tr>
    
                                                        @endif
                                                        
                                                    </tbody>
                                                </table>
                                            </div></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Table Widget 4-->
                        </div>
                        <!--end::Invoice 2 main-->
                        <!--end::Table Widget 4-->
                    </div>
                
              
    @endsection
    
    
    @section('scripts')
    
    <script src="{{ asset('assets/js/custom/widget-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>
    @endsection