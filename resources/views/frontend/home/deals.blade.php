@php
$property = App\Models\Property::where('status','1')->where('hot','1')->limit(3)->get();
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
<section class="deals-section sec-pad">
    <div class="auto-container">
        <div class="sec-title">
            <h2 id="b_our_project_title">Our Own Project</h2>
            <p id="b_our_project_desc">
                Experience the innovation and dedication we bring to real estate with our own carefully developed projects, designed to exceed your expectations.
            </p>
        </div>

        <div class="row clearfix">
            @foreach($property as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box" style="height: 200px">
                                <figure class="image"><img src="{{ asset($item->property_thambnail) }}" height="80px" alt=""></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category" id="b_category_new">New</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        @if($item->agent_id == Null)
                                            <figure class="author-thumb"><img src="{{ url('upload/ariyan.jpg') }}" alt=""></figure>
                                            <h6 id="b_author_name">Admin</h6>
                                        @else
                                            <figure class="author-thumb"><img src="{{ (!empty($item->user->photo)) ? url('upload/agent_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                                            <h6>{{ $item->user->name }}</h6>
                                        @endif
                                    </div>
                                    <div class="buy-btn pull-right">
                                        <a href="property-details.html" id="b_for_sale">For {{ $item->property_status }}</a>
                                    </div>
                                </div>
                                <div class="title-text">
                                    <h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4>
                                </div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6 id="b_start_from">Start From</h6>
                                        @if($item->lowest_price == 0)
                                            <h4 id="b_negotiable_price">Prix négociable</h4>
                                        @else
                                            <h4>DH{{ $item->lowest_price }}</h4>
                                        @endif
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a href="#" onclick="copyToClipboard(); return false;"><i class="icon-37"></i></a></li>
                                    </ul>
                                </div>
                                <p>{{ $item->short_descp }}</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                    <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                    <li><i class="icon-16"></i>{{ $item->property_size }} m²</li>
                                </ul>
                                <div class="btn-box">
                                    <a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}" class="theme-btn btn-two" id="b_see_details">See Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script src="{{asset('js/traduction.js')}}" ></script>