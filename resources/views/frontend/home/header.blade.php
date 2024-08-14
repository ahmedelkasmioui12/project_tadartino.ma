<header class="main-header">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            <!-- header-top -->
            <div class="header-top">
                <div class="top-inner clearfix">
                    <div class="left-column pull-left">
                        <ul class="info clearfix">
                            <ul class="info clearfix">
                                <li><i class="fas fa-map-marker-alt"></i>13 Rue alqadi Ayaad 62000 - Nador/Maroc</li>
                                <li><i class="fas fa-clock"></i>Mon - Sat  9.00 - 18.00</li>
                                <li><i class="fas fa-phone"></i><a href="tel:212808669557">+212 8 08 66 95 57</a></li>
                            </ul>
                        </ul>
                    </div>
                    <div class="right-column pull-right">
                        <ul class="social-links clearfix">
                            <li><a href="https://www.facebook.com/tadartino.ma"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/tadartino.ma?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://www.tiktok.com/@tadartino.ma" target="_blank" rel="noopener noreferrer"><i class="fab fa-tiktok"></i></a></li>
                        </ul>
         @auth
         <div class="sign-box">
                <a href="{{ route('dashboard') }}"><i class="fas fa-user"></i>Dashboard</a>
               <a href="{{ route('user.logout') }}"><i class="fas fa-user"></i>Logout</a>
        </div> 
         @else 
         <div class="sign-box">
         <a href="{{ route('login') }}"><i class="fas fa-user"></i>Sign In</a>
                        </div>
         @endauth               
                        
                    </div>
                </div>
            </div>
<!-- header-lower -->
<div class="header-lower">
<div class="outer-box">
<div class="main-box">
<div class="logo-box" >
    <figure class="logo"><a href="/"><img src="{{ asset('frontend/assets/images/logo.png') }}" style="width: 100%"  ></a></figure>
</div>
<div class="menu-area clearfix">
    <!--Mobile Navigation Toggler-->
    <div class="mobile-nav-toggler">
        <i class="icon-bar"></i>
        <i class="icon-bar"></i>
        <i class="icon-bar"></i>
    </div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">

     <li><a href="{{ url('/') }}"><span>Home</span></a> </li>
     <li><a href="#aboutus"><span>About Us </span></a> </li>


    
<li class="dropdown"><a href="#property"><span>Property</span></a>
    <ul>
        <li><a href="{{ route('rent.property') }}">Rent Property</a></li>
        <li><a href="{{ route('buy.property') }}">Buy Property </a></li>

    </ul>
</li>
         <li><a href="#news"><span>News </span></a> </li>       

         <li><a href="#teams"><span>Teams  </span></a> </li>
         <li><a href="#newletter"><span>Newsletter  </span></a> </li>


     <li><a href="{{ route('contact.index') }}"><span>Contact</span></a></li> 

     <li> 
</li> 


            </ul>
        </div>
    </nav>

    
          
            
        
    
  
</div>
<div class="btn-box">
    <a href="{{ route('user.properties.create') }}"  class="theme-btn btn-one"><span>+</span>Add Listing</a>
</div>
</div>
</div>
</div>
            <!--sticky Header-->
            <div class="sticky-header">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="/"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="btn-box">
                            <a href="index.html" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>