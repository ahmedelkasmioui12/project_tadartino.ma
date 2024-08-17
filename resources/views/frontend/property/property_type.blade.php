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
            <h1 > {{ $pbread->type_name }} Type Property </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html" id="t_home">Home</a></li>
                <li >{{ $pbread->type_name }} </li>
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
                            <h5 id="t_property">Property</h5>
                        </div>
                        <div class="widget-content">
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="All Type">All Type</option>
                                    <option value="1">Villa</option>
                                    <option value="2">Commercial</option>
                                    <option value="3">Residential</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="Select Location">Select Location</option>
                                    <option value="1">New York</option>
                                    <option value="2">California</option>
                                    <option value="3">London</option>
                                    <option value="4">Maxico</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide" >
                                    <option data-display="This Area Only">This Area Only</option>
                                    <option value="1">New York</option>
                                    <option value="2">California</option>
                                    <option value="3">London</option>
                                    <option value="4">Maxico</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="Max Rooms">Max Rooms</option>
                                    <option value="1">2+ Rooms</option>
                                    <option value="2">3+ Rooms</option>
                                    <option value="3">4+ Rooms</option>
                                    <option value="4">5+ Rooms</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide" >
                                    <option data-display="Most Popular">Most Popular</option>
                                    <option value="1">Villa</option>
                                    <option value="2">Commercial</option>
                                    <option value="3">Residential</option>
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="Select Floor">Select Floor</option>
                                    <option value="1">2x Floor</option>
                                    <option value="2">3x Floor</option>
                                    <option value="3">4x Floor</option>
                                </select>
                            </div>
                            <div class="filter-btn">
                                <button type="submit" class="theme-btn btn-one" id="t_filter_btn"><i class="fas fa-filter"></i>&nbsp;Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="price-filter sidebar-widget">
                        <div class="widget-title">
                            <h5 id="t_select_price_range">Select Price Range</h5>
                        </div>
                        <div class="range-slider clearfix">
                            <div class="clearfix">
                                <div class="input">
                                    <input type="text" class="property-amount" name="field-name" readonly="" >
                                </div>
                            </div>
                            <div class="price-range-slider"></div>
                        </div>
                    </div>
                    <div class="category-widget sidebar-widget">
                        <div class="widget-title">
                            <h5 id="t_status_of_property">Status Of Property</h5>
                        </div>
                        <ul class="category-list clearfix">
                            <li><a href="{{ route('rent.property') }}" > <span id="t_for_rent"> For Rent</span> <span>(200)</span></a></li>
                            <li><a href="{{ route('buy.property') }}" ><span id="t_for_buy">For Buy</span> <span>(700)</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            <h5 ><span id="t_search_results" >Search Results:</span> <span > <span id="t_showing_listings">Showing</span>  {{ count($property) }} Listings</span></h5>
                        </div>
                        <div class="right-column pull-right clearfix"></div>
                    </div>
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            @foreach($property as $item)
                                <div class="deals-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><img src="{{ asset($item->property_thambnail) }}" alt="" style="width:300px; height:350px;"></figure>
                                            <div class="batch"><i class="icon-11"></i></div>
                                            @if($item->featured == 1)
                                                <span class="category" id="t_featured">Featured</span>
                                            @else
                                                <span class="category" id="t_new">New</span>
                                            @endif
                                            <div class="buy-btn"><a href="property-details.html">For {{ $item->property_status }}</a></div>
                                        </div>
                                        <div class="lower-content">
                                            <div class="title-text"><h4 ><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4></div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-left">
                                                    <h6 id="t_start_from">Start From</h6>
                                                    @if($item->lowest_price == 0)
                                                        <h4 id="t_negotiable">Prix négociable</h4>
                                                    @else
                                                        <h4>DH{{ $item->lowest_price }}</h4>
                                                    @endif
                                                </div>
                                                @if($item->agent_id == Null)
                                                    <div class="author-box pull-right">
                                                        <figure class="author-thumb"><img src="{{ url('upload/ariyan.jpg') }}" alt="" ><span id="t_admin">Admin</span></figure>
                                                    </div>
                                                @else
                                                    <div class="author-box pull-right">
                                                        <figure class="author-thumb"><img src="{{ (!empty($item->user->photo)) ? url('upload/agent_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="" id="t_agent_image"><span id="t_agent_name">{{ $item->user->name }}</span></figure>
                                                    </div>
                                                @endif
                                            </div>
                                            <p id="t_short_descp">{{ $item->short_descp }}</p>
                                            <ul class="more-details clearfix">
                                                <li><i class="icon-14"></i><span >{{ $item->bedrooms }}</span> Beds</li>
                                                <li><i class="icon-15"></i><span>{{ $item->bathrooms }}</span> Baths</li>
                                                <li><i class="icon-16"></i><span>{{ $item->property_size }}</span> m²</li>
                                            </ul>
                                            <div class="other-info-box clearfix">
                                                <div class="btn-box pull-left"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two">See Details</a></div>
                                                <ul class="other-option pull-right clearfix">
                                                    <li><a aria-label="Compare" class="action-btn"  onclick="addToCompare(this.id)" ><i class="icon-12"></i></a></li>
                                                    <li><a aria-label="Add To Wishlist" class="action-btn"  onclick="addToWishList(this.id)" ><i class="icon-13"></i></a></li>
                                                    <li><a aria-label="Share" class="action-btn"><i class="fas fa-share-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination-wrapper">
                                {{ $property->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->

@endsection


<script  src="{{asset('js/traduction.js')}}"></script>