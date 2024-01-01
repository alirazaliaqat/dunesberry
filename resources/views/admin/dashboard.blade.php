@extends('admin.master')

@section('content')

<div id="kt_app_content_container" class="container-fluid">
				
			
    <div class="gia-stats-wrapper">
    
    <!--begin::Row-->
    <div class="row g-5 g-xl-5 mb-5 mb-xl-10 mt-1">
        
        <div class="col-lg-3 mt-0">
            
            <div class="gia-dash-stat state-bg1">
                <div class="stat-content">
                    <span class="fs-3hx fw-bold">
                     @php $teamcount= App\Models\Page::where('parent_page', 2)->where('parent_section',221)->count(); @endphp
                           
                       
                        {{ $teamcount}}
                        </span>
                    
                    <div class="fw-bold fs-6">
                        <span class="d-block text-center">Our Team Members
                        </span>
                        
                    </div>
                </div>
            </div>
            
            
        </div>
        
        <!--begin::Col-->
        <div class="col-lg-3 mt-0">
            
            <div class="gia-dash-stat state-bg2">
                <div class="stat-content">
                    <span class="fs-3hx fw-bold">
                        
                        @php $clientscount= App\Models\Page::where('parent_page', 2)->where('parent_section',1)->count(); @endphp
                           
                       
                        {{ $clientscount}} 
                        
                        
                    </span>
                    
                    <div class="fw-bold fs-6">
                        <span class="d-block text-center">Major Clients
                        </span>
                        
                    </div>
                </div>
            </div>
            
            
        </div>
        <!--end::Col-->
        <div class="col-lg-3 mt-0">
            <div class="gia-dash-stat state-bg3">
                <div class="stat-content">
                    <span class="fs-3hx fw-bold">
                        @php
                        $currentYear = date('Y');
                        $startYear = 2010;
                        $yearsOfExperience = $currentYear - $startYear;
                    @endphp
                        {{$yearsOfExperience}}
                        </span>
                    
                    <div class="fw-bold fs-6">
                        <span class="d-block text-center">Years of Experience
                            
                        </span></div>
                    </div>
                </div>
                
            </div>
            <!--end::Col-->
            <div class="col-lg-3 mt-0">
                <div class="gia-dash-stat state-bg4">
                    <div class="stat-content">
                        <span class="fs-3hx fw-bold">
    
                                        8
                        </span>
                        
                        <div class="fw-bold fs-6">
                            <span class="d-block text-center">
                                Major Services
                            </span></div>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div> 
      
            
    
        

                               
                
                          
                
                          
                
                          
                
                          
                
                          
                
                          
            
    </div>

@endsection