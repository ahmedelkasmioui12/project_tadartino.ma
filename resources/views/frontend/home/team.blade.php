@php
    $agents = App\Models\User::where('status', 'active')
        ->where('role', 'agent')
        ->orderBy('id', 'DESC')
        ->get();
@endphp
<section class="team-section sec-pad centred bg-color-1" id="teams">
    <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-1.png') }});">
    </div>
    <div class="auto-container">
        <div class="sec-title">
            <h5 id="i_our_agents">Our Agents</h5>
            <h2 id="i_meet_our_agents">Meet Our Excellent Agents</h2>
        </div>
        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">

            @foreach ($agents as $item)
                <div class="team-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img
                                src="{{ !empty($item->photo) ? url('upload/agent_images/' . $item->photo) : url('upload/no_image.jpg') }}"
                                alt="" style="width:370px; height:370px;"></figure>
                        <div class="lower-content">
                            <div class="inner">
                                <h4><a href="{{ route('agent.details', $item->id) }}">{{ $item->name }}</a></h4>
                                <span class="designation"></span>
                                <ul class="social-links clearfix">
                                    <li><a href="mailto:{{ $item->email }}"><i class="fab fa-google-plus-g"></i></a></li>
                                    <li><a href="https://www.instagram.com/tadartino.ma?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.facebook.com/tadartino.ma"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="https://wa.me/{{ $item->phone }}"><i class="fab fa-whatsapp"></i></a></li>

                                    

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

<script src="{{asset('js/traduction.js')}}" ></script>
