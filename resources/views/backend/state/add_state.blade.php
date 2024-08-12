@extends('admin.admin_dashboard')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add State</h6>
                        <form method="POST" action="{{ route('store.state') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="state_name" class="form-label">State Name</label>
                                <input type="text" name="state_name" class="form-control" id="state_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="state_image" class="form-label">State Photo</label>
                                <input class="form-control" name="state_image" type="file" id="state_image" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"></label>
                                <img id="showImage" class="wd-80 rounded-circle" src="{{ url('upload/no_image.jpg') }}" alt="profile">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#state_image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });
</script>

@endsection
