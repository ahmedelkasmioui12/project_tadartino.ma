@extends('frontend.frontend_dashboard')
@section('main')


<script>
    function copyToClipboard() {
        // Créez un élément textarea pour copier le texte
        var tempInput = document.createElement('textarea');
        // Ajoutez l'URL actuelle au textarea
        tempInput.value = window.location.href;
        document.body.appendChild(tempInput);
        // Sélectionnez le texte du textarea
        tempInput.select();
        // Copiez le texte dans le presse-papiers
        document.execCommand('copy');
        // Supprimez l'élément textarea
        document.body.removeChild(tempInput);
        // Affichez une alerte avec SweetAlert
        Swal.fire({
            title: 'Copié!',
            text: 'L\'URL a été copiée dans le presse-papiers.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
</script>
    <!--Page Title-->
    <section class="page-title-two bg-color-1 centred" id="s_pageTitle">
        <div class="pattern-layer" id="s_patternLayer">
            <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
            </div>
            <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
            </div>
        </div>
        <div class="auto-container" id="s_autoContainer">
            <div class="content-box clearfix" id="s_contentBox">
                <h1>{{ $bstate->state_name }} <span  id="s_propertyTitle">Property</span> </h1>
                <ul class="bread-crumb clearfix" id="s_breadCrumb">
                    <li><a href="index.html" id="s_homeLink">Home</a></li>
                    <li >{{ $bstate->state_name }} <span id="s_propertyList" >Property List</span> </li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    
    <!-- property-page-section -->
    <section class="property-page-section property-list">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="default-sidebar property-sidebar" >
                        <div class="category-widget sidebar-widget" >
                            <ul class="category-list clearfix" id="s_categoryList">
                                <li><a href="{{ route('rent.property') }}"> <span  id="s_rent"> For Rent </span><span>(200)</span></a></li>
                                <li ><a href="{{ route('buy.property') }}"> <span id="s_buy">For Buy </span> <span>(700)</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side" id="s_contentSide">
                    <div class="property-content-side" id="s_propertyContentSide">
                        <div class="item-shorting clearfix" id="s_itemShorting">
                            <div class="left-column pull-left" id="s_leftColumn">
                                <h5 > <span id="s_searchResults">Search Results: </span> <span > <span id="s_showingResults">Showing</span> {{ count($property) }} Listings</span></h5>
                            </div>
                            <div class="right-column pull-right clearfix" >
                            </div>
                        </div>
                        <div class="wrapper list">
                            <div class="deals-list-content list-item" >
                                @foreach ($property as $item)
                                    <div class="deals-block-one" >
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset($item->property_thambnail) }}" alt="" style="width:300px; height:350px;"></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                @if ($item->featured == 1)
                                                    <span class="category" id="s_featured">Featured</span>
                                                @else
                                                    <span class="category" id="s_new">New</span>
                                                @endif
                                                <div class="buy-btn"><a href="property-details.html">For {{ $item->property_status }}</a></div>
                                            </div>
                                            <div class="lower-content" >
                                                <div class="title-text">
                                                    <h4 ><a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a></h4>
                                                </div>
                                                <div class="price-box clearfix" >
                                                    <div class="price-info pull-left">
                                                        <h6 id="s_startFrom">Start From</h6>
                                                        @if($item->lowest_price == 0)
                                                            <h4 id="s_negotiable">Prix négociable</h4>
                                                        @else
                                                            <h4 >DH{{ $item->lowest_price }}</h4>
                                                        @endif
                                                    </div>
                                                    @if ($item->agent_id == null)
                                                        <div class="author-box pull-right">
                                                            <figure class="author-thumb" >
                                                                <img src="{{ url('upload/ariyan.jpg') }}" alt="">
                                                                <span id="s_admin">Admin</span>
                                                            </figure>
                                                        </div>
                                                    @else
                                                        <div class="author-box pull-right" >
                                                            <figure class="author-thumb" >
                                                                <img src="{{ !empty($item->user->photo) ? url('upload/agent_images/' . $item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                                                <span>{{ $item->user->name }}</span>
                                                            </figure>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p id="s_shortDesc">{{ $item->short_descp }}</p>
                                                <ul class="more-details clearfix" id="s_moreDetails">
                                                    <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                                    <li ><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                                    <li ><i class="icon-16"></i>{{ $item->property_size }} m²</li>
                                                </ul>
                                                <div class="other-info-box clearfix" id="s_otherInfoBox">
                                                    <div class="btn-box pull-left" id="s_btnBox"><a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}" class="theme-btn btn-two" id="s_seeDetails">See Details</a></div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li ><a href="#" onclick="copyToClipboard(); return false;"><i class="icon-37"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pagination-wrapper" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- property-page-section end -->


    <!-- subscribe-section -->
    @include('frontend.home.subscribe')

    <!-- subscribe-section end -->

@endsection

<script src="{{asset('js/traduction.js')}}" ></script>