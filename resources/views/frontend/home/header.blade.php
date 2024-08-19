<head>
    <script defer src="{{ asset('js/traduction.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<style>
    /* Styles pour rendre la navbar fixe */
    .header-lower {
        position: fixed;
        top: 3;
        left: 0;
        width: 100%;
        z-index: 1000; /* Assurez-vous que la navbar reste au-dessus des autres éléments */
        background-color: #fff; /* Ajoutez un fond pour éviter la transparence lors du défilement */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optionnel : Ajoutez une ombre pour un effet visuel */
    }

    /* Ajoutez un décalage en haut de la page pour que la navbar ne cache pas le contenu */
    .main-header {

    }
</style>

<header class="main-header">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <ul class="info clearfix">
                        <li><i class="fas fa-map-marker-alt"></i>13 Rue alqadi Ayaad 62000 - Nador/Maroc</li>
                        <li><i class="fas fa-clock"></i>Mon - Sat 9.00 - 18.00</li>
                        <li><i class="fas fa-phone"></i><a href="tel:+212808669557">+212 8 08 66 95 57  </a></li>
                        <li><i class="fas fa-phone"></i>+212 6 37 65 42 06</li>
                    </ul>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li><a href="https://www.facebook.com/tadartino.ma"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a
                            href="https://www.instagram.com/tadartino.ma?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i
                                class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.tiktok.com/@tadartino.ma" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-tiktok"></i></a></li>
                </ul>
                @auth
                    <div class="sign-box">
                        <a href="{{ route('dashboard') }}" id="dashbord"><i class="fas fa-user"></i>Dashboard</a>
                        <a href="{{ route('user.logout') }}" id="logout"><i class="fas fa-user"></i>Logout</a>
                    </div>
                @else
                    <div class="sign-box">
                        <a href="{{ route('login') }}"><i class="fas fa-user" id="signin"></i>Sign In</a>
                    </div>
                @endauth

            </div>
        </div>
    </div>

    <!-- header-lower -->
    <div class="header-lower" >
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="/"><img src="{{ asset('frontend/assets/images/logo.png') }}"
                                style="width: 100%"></a></figure>
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

                                <li><a href="{{ url('/') }}"><span id="home"></span></a> </li>
                                <li><a href="#aboutus"><span id="about">About Us</span></a> </li>



                                <li class="dropdown"><a href="#property"><span id="property">Property</span></a>
                                    <ul>
                                        <li><a href="{{ route('rent.property') }}" id="rent_property">Rent Property</a>
                                        </li>
                                        <li><a href="{{ route('buy.property') }}" id="buy_property">Buy Property </a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="#news"><span id="news">News </span></a> </li>

                                <li><a href="#teams"><span id="teams">Teams </span></a> </li>
                                <li><a href="{{ route('contact.index') }}" id="g_contact"><span>Contact</span></a></li>

                                <li class="btn-box"> <a href="{{ route('user.properties.create') }}" id="add_listing"
                                        class="theme-btn btn-one">
                                        <span>+</span>Add Listing</a>
                                </li>
                                <li>
                                    <select name="language" id="language-dropdown"
                                        onchange="ChangeSelectLang(this.value)">
                                        <option value="en" data-icon="fa-flag-usa" class="theme-btn btn-one">English
                                        </option>
                                        <option value="ar" data-icon="fa-flag-om">العربية</option>
                                        <option value="es" data-icon="fa-flag-es">Español</option>
                                        <option value="fr" data-icon="fa-flag-fr">Français</option>
                                        <option value="de" data-icon="fa-flag-de">Deutsch</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </nav>







                </div>
                <div>
                </div>
            </div>
        </div>
    </div>



</header>

<script src="{{ asset('js/traduction.js') }}"></script>
