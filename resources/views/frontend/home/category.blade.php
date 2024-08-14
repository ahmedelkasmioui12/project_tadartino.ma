@php
    $ptype = App\Models\PropertyType::latest()->get();
@endphp
<section class="category-section centred" id="category">
    <div class="auto-container">
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">

                @foreach ($ptype as $item)
                    @php
                        $property = App\Models\Property::where('ptype_id', $item->id)->get();
                    @endphp

                    <li>
                        <div class="category-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="{{ $item->type_icon }}"></i></div>
                                <h5><a>{{ $item->type_name }}</a></h5>
                                <span>{{ count($property) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</section>
