@extends('frontend.frontend_dashboard')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- Include SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<div class="page-content">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
        });
    </script>
    @endif

    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property</h6>

                        <form method="post" action="{{ route('user.properties.store') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" id="Property Name">Property Name</label>
                                        <input type="text" name="property_name" class="form-control" required>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" id="Property Status">Property Status</label>
                                        <select name="property_status" class="form-select" required>
                                            <option selected="" disabled="">Select Status</option>
                                            <option value="rent">For Rent</option>
                                            <option value="buy">For Buy</option>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" id="Lowest Price">Lowest Price</label>
                                        <input type="text" name="lowest_price" class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" id="Max Price">Max Price</label>
                                        <input type="text" name="max_price" class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" id="Main Thumbnail">Main Thumbnail</label>
                                        <input type="file" name="property_thambnail" class="form-control" onChange="mainThamUrl(this)">
                                        <img src="" id="mainThmb">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" id="Multiple Images">Multiple Images</label>
                                        <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple>
                                        <div class="row" id="preview_img"></div>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" id="Bedrooms">Bedrooms</label>
                                        <input type="text" name="bedrooms" class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" id="Bathrooms">Bathrooms</label>
                                        <input type="text" name="bathrooms" class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" id="Garage">Garage</label>
                                        <input type="text" name="garage" class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label" id="Garage Size">Garage Size</label>
                                        <input type="text" name="garage_size" class="form-control">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label" id="Property Type">Property Type</label>
                                        <select name="ptype_id" class="form-select" required>
                                            <option selected="" disabled="">Select Type</option>
                                            @foreach ($propertytype as $ptype)
                                            <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" id="Property Video">Property Video</label>
                                        <input type="text" name="property_video" class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label" id="Property Amenities">Property Amenities</label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%"> 
                                            @foreach ($amenities as $ameni)
                                            <option value="{{ $ameni->amenitis_name }}">{{ $ameni->amenitis_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label" id="Agent">Agent</label>
                                        <select name="agent_id" class="form-select" >
                                            <option selected="">No</option>
                                            @foreach ($activeAgent as $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" id="Short Description">Short Description</label>
                                    <textarea name="short_descp" class="form-control" rows="3"></textarea>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" id="Long Description">Long Description</label>
                                    <textarea name="long_descp" class="form-control" rows="10"></textarea>
                                </div>
                            </div><!-- Col -->

                            <hr>

                            <!-- Facilities Option -->
                            <div class="row add_item">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="facility_name" class="form-label" id="Facilities">Facilities</label>
                                        <select name="facility_name[]" id="facility_name" class="form-control">
                                            <option value="">Select Facility</option>
                                            <option value="Hospital">Hospital</option>
                                            <option value="SuperMarket">Super Market</option>
                                            <option value="School">School</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Pharmacy">Pharmacy</option>
                                            <option value="Airport">Airport</option>
                                            <option value="Railways">Railways</option>
                                            <option value="Bus Stop">Bus Stop</option>
                                            <option value="Beach">Beach</option>
                                            <option value="Mall">Mall</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="distance" class="form-label" id="Distance">Distance</label>
                                        <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                    </div>
                                </div><!-- Col -->

                                <div class="form-group col-md-4" style="padding-top: 30px;">
                                    <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                                </div>
                            </div><!-- Row -->

                            <!-- Latitude and Longitude -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" id="Latitude">Latitude</label>
                                        <input type="text" name="latitude" class="form-control">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Latitude from address</a>

                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" id="Longitude">Longitude</label>
                                        <input type="text" name="longitude" class="form-control">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Longitude from address</a>

                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- jQuery Scripts for Image Preview -->
<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $('#multiImg').on('change', function() { // select multiple images
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var data = $(this)[0].files; // file data
                $.each(data, function(index, file) { // loop through each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                        var fRead = new FileReader(); // instance of the FileReader
                        fRead.onload = (function(file) { // closure function
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                    .height(80); // create image element 
                                $('#preview_img').append(img); // append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); // URL representing the file's data.
                    }
                });
            } else {
                Swal.fire("Your browser doesn't support File API!"); // if File API is absent
            }
        });
    });
</script>

@endsection
<script src="{{asset('js/traduction.js')}}" ></script>