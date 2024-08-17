@extends('frontend.frontend_dashboard')
@section('main')

 <!--Page Title-->
        <section id="j_pageTitle" class="page-title-two bg-color-1 centred">
            <div id="j_patternLayer" class="pattern-layer">
                <div id="j_pattern1" class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
                <div id="j_pattern2" class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
            </div>
            <div id="j_autoContainer" class="auto-container">
                <div id="j_contentBox" class="content-box clearfix">
                    <h1 id="j_pageHeading">Rent Property </h1>
                    <ul id="j_breadCrumb" class="bread-crumb clearfix">
                        <li id="j_homeLink"><a href="index.html">Home</a></li>
                        <li id="j_currentPage">Rent Property List</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- property-page-section -->
        <section id="j_propertyPageSection" class="property-page-section property-list">
            <div id="j_autoContainerProperty" class="auto-container">
                <div id="j_rowProperty" class="row clearfix">
                    <div id="j_sidebarSide" class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div id="j_propertySidebar" class="default-sidebar property-sidebar">
                            <div id="j_filterWidget" class="filter-widget sidebar-widget">
                              
                            </div>
                         
                            <div id="j_categoryWidget" class="category-widget sidebar-widget">
                                <div id="j_widgetTitle" class="widget-title">
                                    <h5 id="j_statusTitle">Status Of Property</h5>
                                </div>
                                <ul id="j_categoryList" class="category-list clearfix">
                                    <li><a href="{{ route('rent.property') }}"> <span  id="j_rentPropertyLink" >For Rent </span> <span>(200)</span></a></li>
                                    <li><a href="{{ route('buy.property') }}"> <span  id="j_buyPropertyLink" > For Buy</span> <span>(700)</span></a></li>                     
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div id="j_contentSide" class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div id="j_propertyContentSide" class="property-content-side">
                            <div id="j_itemShorting" class="item-shorting clearfix">
                                <div id="j_leftColumn" class="left-column pull-left">
                                    <h5> <span  id="j_searchResults">Search Results: </span><span>Showing {{ count($property) }} Listings</span></h5>
                                </div>
                                <div id="j_rightColumn" class="right-column pull-right clearfix">

                                </div>
                            </div>
                            <div id="j_wrapperList" class="wrapper list">
                                <div id="j_dealsListContent" class="deals-list-content list-item">

                                    @foreach($property as $item)
                                        <div id="j_dealsBlockOne" class="deals-block-one">
                                            <div id="j_innerBox" class="inner-box">
                                                <div id="j_imageBox" class="image-box">
                                                    <figure id="j_image" class="image"><img src="{{ asset($item->property_thambnail  ) }}" alt=""  style="width:300px; height:350px;"></figure>
                                                    <div id="j_batch" class="batch"><i class="icon-11"></i></div>
                                                    @if($item->featured == 1)
                                                        <span id="j_featured" class="category">Featured</span>
                                                    @else
                                                        <span id="j_new" class="category">New</span>
                                                    @endif

                                                    <div  class="buy-btn"><a href="property-details.html">For {{ $item->property_status }}</a></div>
                                                </div>
                                                <div  class="lower-content">
                                                    <div  class="title-text"><h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4></div>
                                                    <div class="price-box clearfix">
                                                        <div  class="price-info pull-left">
                                                            <h6 id="j_startFrom">Start From</h6>
                                                            @if($item->lowest_price == 0)
                                                                <h4 id="j_negotiable">Prix négociable</h4>
                                                            @else
                                                                <h4>DH{{ $item->lowest_price }}</h4>
                                                            @endif
                                                        </div>

                                                        @if($item->agent_id == Null)
                                                            <div  class="author-box pull-right">
                                                                <figure  class="author-thumb"> 
                                                                    <img src="{{ url('upload/ariyan.jpg') }}" alt="">
                                                                    <span id="j_admin">Admin</span>
                                                                </figure>
                                                            </div>
                                                        @else 
                                                            <div id="j_authorBoxAgent" class="author-box pull-right">
                                                                <figure class="author-thumb"> 
                                                                    <img src="{{ (!empty($item->user->photo)) ? url('upload/agent_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                                                    <span >{{ $item->user->name }}</span>
                                                                </figure>
                                                            </div>
                                                        @endif 
                                                    </div>
                                                    <p >{{ $item->short_descp }}</p>
                                                    <ul  class="more-details clearfix">
                                                        <li ><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                                        <li ><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                                        <li ><i class="icon-16"></i>{{ $item->property_size }} m²</li>
                                                    </ul>
                                                    <div  class="other-info-box clearfix">
                                                        <div  class="btn-box pull-left"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two">See Details</a></div>
                                                        <ul  class="other-option pull-right clearfix">
                                                            <li><a  aria-label="Compare" class="action-btn" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>
                                                            <li><a  aria-label="Add To Wishlist" class="action-btn" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="pagination-wrapper">
                             
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

<script  src="{{asset('js/traduction.js')}}"></script>