<nav class="navbar  navbar-light fixed-top portfolio-navbar" style="background-color: transparent;">
  <div class="container px-lg-0"> <!-- Container added to center the menu content -->
    <a class="navbar-brand" href="https://www.dunesberry.com/">
      <img src="https://www.dunesberry.com/wp-content/uploads/2023/10/DB_Logo-01-225x176.png" class="image-fluid" alt="Dunesberry">
    </a>
    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> --}}
    <div class=" justify-content-end" id="navbarNav">
      <ul class="navbar-nav ml-auto"> <!-- ml-auto will align the menu links to the right -->
        <li class="nav-item">
          <a href="{{ request()->url() }}?language={{ $locale == 'ar' ? 'en' : 'ar' }}"
              class=" nav-link d-inline-block  arabic-lang">
                                
              {{ $locale == 'ar' ? 'ENGLISH' : ' العربية' }}
           </a>
      </li>
      <li class="nav-item active">
          <a class="nav-link" href="https://www.dunesberry.com/" target="_blank"><img class="me-2" src="{{asset('assets/images/www-01.png')}}" width="50"/>{{__('genral.VisitUs')}}</a>
          </li>

         
  
      </ul>
    </div>
  </div> <!-- Close the container -->
</nav>
