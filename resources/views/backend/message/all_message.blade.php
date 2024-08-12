@extends('admin.admin_dashboard')
@section('admin')
<style>/* General Styles */

  .message-section {
      background-color: #f9f9f9;
      padding: 50px 0;
  }
  
  .auto-container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
  }
  
  h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 24px;
      color: #333;
  }
  
  .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      color: #fff;
      font-size: 16px;
  }
  
  .alert-success {
      background-color: #28a745;
  }
  

  
  .form-group {
      margin-bottom: 20px;
  }
  
  .form-group label {
      display: block;
      font-size: 16px;
      color: #555;
      margin-bottom: 5px;
  }
  
  .form-group input[type="text"],
  .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
      box-sizing: border-box;
  }
  
  .form-group textarea {
      resize: vertical;
  }
  
  button[type="submit"] {
      background-color: #007bff;
      border: none;
      color: #fff;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
  }
  
  button[type="submit"]:hover {
      background-color: #0056b3;
  }
  </style>
<div class="page-content">

        <div class="row inbox-wrapper">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 border-end-lg">
                    <div class="d-flex align-items-center justify-content-between">
                      <button class="navbar-toggle btn btn-icon border d-block d-lg-none" data-bs-target=".email-aside-nav" data-bs-toggle="collapse" type="button">
                        <span class="icon"><i data-feather="chevron-down"></i></span>
                      </button>
                      <div class="order-first">
                        <h4>Mail Service</h4>
                        <p class="text-muted">Tadartino.ma@gmail.com</p>
                      </div>
                    </div>
                    <div class="d-grid my-3">
                      <a class="btn btn-primary">Compose Email</a>
                    </div>
                    <div class="email-aside-nav collapse">
                      <ul class="nav flex-column">
                        <li class="nav-item active">
                          <a class="nav-link d-flex align-items-center">
                            <i data-feather="inbox" class="icon-lg me-2"></i>
                            Inbox
                            <span class="badge bg-danger fw-bolder ms-auto">{{ count($usermsg) }}
                          </a>
                        </li>



                      </ul>
                     
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="p-3 border-bottom">
                      <div class="row align-items-center">
                        <div class="col-lg-6">
                          <div class="d-flex align-items-end mb-2 mb-md-0">
                            <i data-feather="inbox" class="text-muted me-2"></i>
                            <h4 class="me-1">Inbox</h4>
                            <span class="text-muted">({{ count($usermsg) }} new messages)</span>
                          </div>
                        </div>
                        <div class="col-lg-6">
                        
                        </div>
                      </div>
                    </div>

                    <div class="email-list">



      <!-- email list item -->
      @foreach($usermsg as $msg)
      <div class="email-list-item">

      <a href="{{ route('admin.message.details',$msg->id) }}" class="email-list-detail">
      <div class="content">
            <span class="from">{{ $msg['user']['name'] }}</span>
            <p class="msg"> {{ $msg->message }} </p>
          </div>
          <span class="date">
            <span class="icon"><i data-feather="paperclip"></i> </span>
           {{ $msg->created_at->format('l M d') }}
          </span>
        </a>
      </div>
    @endforeach



                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

			</div>







      <section class="message-section">
        <div class="auto-container">
            <h2>Create and Send Message to Subscribers</h2>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('send.message') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

@endsection