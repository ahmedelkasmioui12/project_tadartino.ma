@php
    $skip_state_0 = App\Models\State::skip(0)->first();
    $property_0 = $skip_state_0 ? App\Models\Property::where('state', $skip_state_0->id)->get() : [];

    $skip_state_1 = App\Models\State::skip(1)->first();
    $property_1 = $skip_state_1 ? App\Models\Property::where('state', $skip_state_1->id)->get() : [];

    $skip_state_2 = App\Models\State::skip(2)->first();
    $property_2 = $skip_state_2 ? App\Models\Property::where('state', $skip_state_2->id)->get() : [];

    $skip_state_3 = App\Models\State::skip(3)->first();
    $property_3 = $skip_state_3 ? App\Models\Property::where('state', $skip_state_3->id)->get() : [];
@endphp

<section class="place-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5 id="h_top_places">Top Places</h5>
            <h2 id="h_most_popular_places">Most Popular Places</h2>
            <p id="h_discover_locations">Discover the most sought-after locations that offer the perfect blend of comfort and convenience.</p>
        </div>
        <div class="sortable-masonry">
            <div class="items-container row clearfix">

                @if($skip_state_0)
                    <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
                        <div class="place-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ asset($skip_state_0->state_image) }}" alt="" style="width:370px; height:580px;">
                                </figure>
                                <div class="text">
                                    <h4><a href="{{ route('state.details', $skip_state_0->id) }}">{{ $skip_state_0->state_name }}</a></h4>
                                    <p id="h_properties">{{ count($property_0) }} Properties</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($skip_state_1)
                    <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
                        <div class="place-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ asset($skip_state_1->state_image) }}" alt="" style="width:370px; height:580px;">
                                </figure>
                                <div class="text">
                                    <h4><a href="{{ route('state.details', $skip_state_1->id) }}">{{ $skip_state_1->state_name }}</a></h4>
                                    <p id="h_properties">{{ count($property_1) }} Properties</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($skip_state_2)
                    <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
                        <div class="place-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ asset($skip_state_2->state_image) }}" alt="" style="width:370px; height:580px;">
                                </figure>
                                <div class="text">
                                    <h4><a href="{{ route('state.details', $skip_state_2->id) }}">{{ $skip_state_2->state_name }}</a></h4>
                                    <p id="h_properties">{{ count($property_2) }} Properties</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($skip_state_3)
                    <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
                        <div class="place-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ asset($skip_state_3->state_image) }}" alt="" style="width:370px; height:580px;">
                                </figure>
                                <div class="text">
                                    <h4><a href="{{ route('state.details', $skip_state_3->id) }}">{{ $skip_state_3->state_name }}</a></h4>
                                    <p id="h_properties">{{ count($property_3) }} Properties</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>


<script src="{{asset('js/traduction.js')}}" ></script>
