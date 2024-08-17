<section class="cta-section bg-color-2">
    <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }});"></div>
    <div class="auto-container">
        <div class="inner-box clearfix">
            <div class="text pull-left">
                <h2 id="b_cta_title">Looking to Buy a New Property or <br />Sell an Existing One?</h2>
            </div>
            <div class="btn-box pull-right">
                <a href="{{ route('rent.property') }}" class="theme-btn btn-three" id="b_cta_rent_btn">Rent Properties</a>
                <a href="{{ route('buy.property') }}" class="theme-btn btn-one" id="b_cta_buy_btn">Buy Properties</a>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('js/traduction.js')}}" ></script>