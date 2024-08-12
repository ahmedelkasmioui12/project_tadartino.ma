@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content text-center">
    <div class="d-flex justify-content-center align-items-center flex-wrap grid-margin mb-4">
        <div>
            <h4 class="mb-3">Welcome to Dashboard</h4>
        </div>
    </div>
    <h1 class="mb-4">
        Hello  you are  Admin 
     </h1>
    <div>
        <img class="img-fluid" src="{{ asset('frontend/assets/images/logo2.png') }}" alt="profile" style="max-width: 700px;">
    </div>
</div>

@endsection
