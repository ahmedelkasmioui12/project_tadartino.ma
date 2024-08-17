@extends('frontend.frontend_dashboard')
@section('main')
@php
$property = App\Models\Property::where('status','1')->get();
@endphp
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
<section class="feature-section sec-pad bg-color-1" id="j_property">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5 id="j_features">Features</h5>
            <h2 id="j_featured_property">Featured Property</h2>
            <p id="j_feature_description">Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
        </div>
        <div class="row clearfix">
            @foreach($property as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset($item->property_thambnail  ) }}" alt=""></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category" id="q_featured_category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        @if($item->agent_id == Null)
                                            <figure class="author-thumb"><img src="{{ url('upload/ariyan.jpg') }}" alt=""></figure>
                                            <h6 id="q_author_name">Admin</h6>
                                        @else
                                            <figure class="author-thumb"><img src="{{ (!empty($item->user->photo)) ? url('upload/agent_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                                            <h6 id="q_author_name">{{ $item->user->name }}</h6>
                                        @endif
                                    </div>
                                    <div class="buy-btn pull-right"><a href="property-details.html" id="q_buy_btn">For {{ $item->property_status }}</a></div>
                                </div>
                                <div class="title-text"><h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" id="q_property_name">{{ $item->property_name }}</a></h4></div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6 id="j_start_from">Start From</h6>
                                        @if($item->lowest_price == 0)
                                            <h4 id="j_negotiable_price">Prix négociable</h4>
                                        @else
                                            <h4 >DH{{ $item->lowest_price }}</h4>
                                        @endif
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a href="#" onclick="copyToClipboard(); return false;" id="q_copy_btn"><i class="icon-37"></i></a></li>
                                    </ul>
                                </div>
                                <p id="q_short_descp">{{ $item->short_descp }}</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i >{{ $item->bedrooms }} Beds</li>
                                    <li><i class="icon-15"></i >{{ $item->bathrooms }} Baths</li>
                                    <li><i class="icon-16"></i >{{ $item->property_size }} m²</li>
                                </ul>
                                <div class="btn-box"><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two" id="q_see_details">See Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="more-btn centred">
            <br><br>
        </div>
    </div>
</section>

<script src="{{asset('js/traduction.js')}}" ></script>


