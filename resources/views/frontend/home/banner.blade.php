@php
$states = App\Models\State::latest()->get();
$ptypes = App\Models\PropertyType::latest()->get();
@endphp

<section class="banner-section" style="background-image: url({{ asset('frontend/assets/images/banner/banner-1.jpg') }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="auto-container">
        <div class="inner-container">
            <div class="content-box centred">
                <h2 id="d_1">Tadartino.ma is a real estate platform.</h2>
                <p id="d_2">Your trusted destination to find the property of your dreams.</p>
            </div>
            <div class="search-field">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li id="d_3" class="tab-btn active-btn" data-tab="#tab-1">BUY</li>
                            <li id="d_4" class="tab-btn" data-tab="#tab-2">RENT</li>
                        </ul>
                    </div>
                    <div class="tabs-content info-group">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('buy.property.search') }}" method="post" class="search-form">
                                        @csrf 
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label id="d_5">Search Property</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input id="d_6" type="search" name="search" placeholder="Search by Property, Location or Landmark..." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label id="d_7">Location</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select id="d_8" name="state" class="wide">
                                                           <option id="" data-display="Input location">Input location</option>
                                                           @foreach($states as $state)
                                                           <option id="d_{{ $loop->index + 10 }}_dynamiq" value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label id="d_9">Property Type</label>
                                                    <div class="select-box">
                                                        <select id="d_{{ $states->count() + 11 }}" name="ptype_id" class="wide">
                                                           <option id="d_{{ $states->count() + 12 }}" data-display="All Type">All Type</option>
                                                            @foreach($ptypes as $type)
                                                           <option id="d_{{ $loop->index + $states->count() + 13 }}_dynamiq" value="{{ $type->type_name }}">{{ $type->type_name }}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button id="{{ $ptypes->count() + $states->count() + 14 }}" type="submit"><i class="fas fa-search"></i><span id="search">Search</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('rent.property.search') }}" method="post" class="search-form">
                                        @csrf 
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label id="d_{{ $ptypes->count() + $states->count() + 15 }}">Search Property</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input id="d_{{ $ptypes->count() + $states->count() + 16 }}" type="search" name="search" placeholder="Search by Property, Location or Landmark..." required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label id="d_{{ $ptypes->count() + $states->count() + 17 }}">Location</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select id="d_{{ $ptypes->count() + $states->count() + 18 }}" name="state" class="wide">
                                                           <option id="d_{{ $ptypes->count() + $states->count() + 19 }}" data-display="Input location">Input location</option>
                                                           @foreach($states as $state)
                                                           <option id="d_{{ $loop->index + $ptypes->count() + $states->count() + 20 }}_dynamiq" value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label id="d_ptype">Property Type</label>
                                                    <div class="select-box">
                                                        <select  name="ptype_id" class="wide">
                                                           <option  data-display="All Type">All Type</option>
                                                            @foreach($ptypes as $type)
                                                           <option  value="{{ $type->type_name }}">{{ $type->type_name }}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button id="d_{{ $ptypes->count() + $states->count() + 25 }}" type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
