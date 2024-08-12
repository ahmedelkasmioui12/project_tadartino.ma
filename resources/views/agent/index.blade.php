@extends('agent.agent_dashboard')
@section('agent')

@php
$id = Auth::user()->id;
$agentId = App\Models\User::find($id);
$status = $agentId->status;
@endphp

<div class="page-content text-center">


    @if($status === 'active')
    <h4>Agent Account Is <span class="text-success">Active </span> </h4>

    @else
 <h4>Agent Account Is <span class="text-danger">Inactive </span> </h4>
 <p class="text-danger"><b> Plz wait admin will check and approve your account</b></p>
    @endif


    <div class="d-flex justify-content-center align-items-center flex-wrap grid-margin mb-4">
      <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
         

      </div>
      <div>
        <img class="img-fluid" src="{{ asset('frontend/assets/images/logo2.png') }}" alt="profile" style="max-width: 700px;">
    </div>

    <br>    <br>
    <br>

@endsection