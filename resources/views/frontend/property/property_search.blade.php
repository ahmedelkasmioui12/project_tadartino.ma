@extends('frontend.frontend_dashboard')
@section('main')

 <!--Page Title-->
        <section class="page-title-two bg-color-1 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
                <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1 id="page-title">Property Search</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html" id="home-link">Home</a></li>
                        <li id="property-search">Property Search</li>
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
                        <div class="default-sidebar property-sidebar">
                            <div class="filter-widget sidebar-widget">
                                <div class="widget-title">
                                    <h5 id="property-filter-title">Property</h5>
                                </div>
                                <div class="widget-content">
                                    <div class="select-box">
                                        <select class="wide">
                                           <option data-display="All Type" >All Type</option>
                                           <option value="1" id="villa">Villa</option>
                                           <option value="2" id="commercial">Commercial</option>
                                           <option value="3" id="residential">Residential</option>
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide" >
                                           <option data-display="Select Location">Select Location</option>
                                           <option value="1" id="new-york">New York</option>
                                           <option value="2" id="california">California</option>
                                           <option value="3" id="london">London</option>
                                           <option value="4" id="mexico">Mexico</option>
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide">
                                           <option data-display="This Area Only" >This Area Only</option>
                                           <option value="1" id="new-york">New York</option>
                                           <option value="2" id="california">California</option>
                                           <option value="3" id="london">London</option>
                                           <option value="4" id="mexico">Mexico</option>
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide" >
                                           <option data-display="Max Rooms" >Max Rooms</option>
                                           <option value="1" id="2-rooms">2+ Rooms</option>
                                           <option value="2" id="3-rooms">3+ Rooms</option>
                                           <option value="3" id="4-rooms">4+ Rooms</option>
                                           <option value="4" id="5-rooms">5+ Rooms</option>
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide">
                                           <option data-display="Most Popular">Most Popular</option>
                                           <option value="1" id="villa">Villa</option>
                                           <option value="2" id="commercial">Commercial</option>
                                           <option value="3" id="residential">Residential</option>
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide">
                                           <option data-display="Select Floor">Select Floor</option>
                                           <option value="1" id="2x-floor">2x Floor</option>
                                           <option value="2" id="3x-floor">3x Floor</option>
                                           <option value="3" id="4x-floor">4x Floor</option>
                                        </select>
                                    </div>
                                    <div class="filter-btn">
                                        <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;<span id="filter-btn">Filter</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="price-filter sidebar-widget">
                                <div class="widget-title">
                                    <h5 id="select-price-range">Select Price Range</h5>
                                </div>
                                <div class="range-slider clearfix">
                                    <div class="clearfix">
                                        <div class="input">
                                            <input type="text" class="property-amount" name="field-name" readonly="">
                                        </div>
                                    </div>
                                    <div class="price-range-slider"></div>
                                </div>
                            </div>
                            <div class="category-widget sidebar-widget">
                                <div class="widget-title">
                                    <h5 id="status-of-property">Status Of Property</h5>
                                </div>
                                <ul class="category-list clearfix">
    <li><a href="{{ route('rent.property') }}"> <span  id="for-rent"> For Rent</span> <span>(200)</span></a></li>
   <li><a href="{{ route('buy.property') }}"><span  id="for-buy" >For Buy </span><span>(700)</span></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-content-side">
                            <div class="item-shorting clearfix">
                                <div class="left-column pull-left">
            <h5 ><span id="search-results" >Search Results:</span> <span > <span id="showing-listings">Showing</span>  {{ count($property) }} Listings</span></h5>
                                </div>
                                <div class="right-column pull-right clearfix">


                                </div>
                            </div>
                            <div class="wrapper list">
                                <div class="deals-list-content list-item">

     @foreach($property as $item)
            <div class="deals-block-one">
                <div class="inner-box">
                    <div class="image-box">
                        <figure class="image"><img src="{{ asset($item->property_thambnail) }}" alt=""  style="width:300px; height:350px;"></figure>
                        <div class="batch"><i class="icon-11"></i></div>
                       @if($item->featured == 1)
                        <span class="category" id="featured">Featured</span>
                       @else
                        <span class="category" id="new">New</span>
                       @endif


                        <div class="buy-btn"><a href="property-details.html">For {{ $item->property_status }}</a></div>
                    </div>
                    <div class="lower-content">
         <div class="title-text"><h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" id="property-name">{{ $item->property_name }}</a></h4></div>
                        <div class="price-box clearfix">
                            <div class="price-info pull-left">
                                <h6 id="start-from">Start From</h6>
                                @if($item->lowest_price == 0)
                                <h4 id="negotiable-price">Prix négociable</h4>
                            @else
                                <h4 >DH{{ $item->lowest_price }}</h4>
                            @endif
                                                        </div>

  @if($item->agent_id == Null)
<div class="author-box pull-right">
        <figure class="author-thumb"> 
            <img src="{{ url('upload/ariyan.jpg') }}" alt="">
            <span id="admin">Admin</span>
        </figure>
    </div>
  @else 

   <div class="author-box pull-right">
        <figure class="author-thumb"> 
            <img src="{{ (!empty($item->user->photo)) ? url('upload/agent_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
            <span id="agent-name">{{ $item->user->name }}</span>
        </figure>
    </div>

  @endif 
                        </div>
                        <p id="short-descp">{{ $item->short_descp }}</p>
                        <ul class="more-details clearfix">
         <li><i class="icon-14"></i><span id="beds">{{ $item->bedrooms }} Beds</span></li>
        <li><i class="icon-15"></i><span id="baths">{{ $item->bathrooms }} Baths</span></li>
        <li><i class="icon-16"></i><span id="property-size">{{ $item->property_size }} m²</span></li>
                        </ul>
                        <div class="other-info-box clearfix">
                            <div class="btn-box pull-left"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two" id="see-details">See Details</a></div>
                            <ul class="other-option pull-right clearfix">
             <li><a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>

        <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

                                </div>

                            </div>
                            <div class="pagination-wrapper">
                                <ul class="pagination clearfix">
                                    <li><a href="property-list.html" class="current" id="page-1">1</a></li>
                                    <li><a href="property-list.html" id="page-2">2</a></li>
                                    <li><a href="property-list.html" id="page-3">3</a></li>
                                    <li><a href="property-list.html" id="next-page"><i class="fas fa-angle-right"></i></a></li>
                                </ul>
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