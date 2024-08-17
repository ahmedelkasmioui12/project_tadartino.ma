@php
$property = App\Models\Property::where('status','1')->limit(3)->get();
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
<section class="feature-section sec-pad bg-color-1" id="property">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5 id="e_features">Features</h5>
            <h2 id="e_featured_property">Featured Property</h2>
            <p id="e_explore_properties">Explore our handpicked selection of premium properties that stand out in the market.</p>
        </div>
        <div class="row clearfix">
            @foreach($property as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image">
                                <img src="{{ asset($item->property_thambnail) }}" alt="">
                            </figure>
                            <div class="batch"><i class="icon-11"></i></div>
                            <span class="category" id="e_category_featured">Featured</span>
                        </div>
                        <div class="lower-content">
                            <div class="author-info clearfix">
                                <div class="author pull-left">
                                    @if($item->agent_id == Null)
                                    <figure class="author-thumb">
                                        <img src="{{ url('upload/ariyan.jpg') }}" alt="">
                                    </figure>
                                    <h6 id="e_admin">Admin</h6>
                                    @else
                                    <figure class="author-thumb">
                                        <img src="{{ (!empty($item->user->photo)) ? url('upload/agent_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                    </figure>
                                    <h6>{{ $item->user->name }}</h6>
                                    @endif
                                </div>
                                <div class="buy-btn pull-right">
                                    <a href="property-details.html"
                                    <a href="property-details.html" id="e_for_status">For {{ $item->property_status }}</a>
                                </div>
                            </div>
                            <div class="title-text">
                                <h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" id="e_property_name">{{ $item->property_name }}</a></h4>
                            </div>
                            <div class="price-box clearfix">
                                <div class="price-info pull-left">
                                    <h6 id="e_start_from">Start From</h6>
                                    @if($item->lowest_price == 0)
                                    <h4 id="e_price_negociable">Prix négociable</h4>
                                    @else
                                    <h4 id="e_price">{{ $item->lowest_price }} DH</h4>
                                    @endif
                                </div>
                                <ul class="other-option pull-right clearfix">
                                    <li><a href="#" onclick="copyToClipboard(); return false;"><i class="icon-37"></i></a></li>
                                    {{-- <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)"><i class="icon-13"></i></a></li> --}}
                                </ul>
                            </div>
                            <p id="e_short_descp">{{ $item->short_descp }}</p>
                            <ul class="more-details clearfix">
                                <li><i class="icon-14"></i><span id="e_beds">{{ $item->bedrooms }} Beds</span></li>
                                <li><i class="icon-15"></i><span id="e_baths">{{ $item->bathrooms }} Baths</span></li>
                                <li><i class="icon-16"></i><span id="e_property_size">{{ $item->property_size }} m²</span></li>
                            </ul>
                            <div class="btn-box">
                                <a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two" id="e_see_details">See Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="more-btn centred">
            <a href="{{ route('all.properties') }}" class="theme-btn btn-one" id="e_view_all_listings">View All Listings</a>
            <br><br>
        </div>
    </div>
</section>
 <script src="{{asset('js/traduction.js')}}" ></script>