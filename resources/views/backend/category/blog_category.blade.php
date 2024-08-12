@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">

    <button type="button" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Category
</button>
					</ol>
				</nav>


    
          
            
    

    
          
            
    

  
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Blog Category All </h6>
               
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>Blog Category Name </th>
                        <th>Blog Category Slug </th>
                        <th>Action </th> 
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($category as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->category_slug }}</td>
                        <td>
       <a href="{{ route('edit.state',$item->id) }}" class="btn btn-inverse-warning"> Edit </a>
       <a href="{{ route('delete.state',$item->id) }}" class="btn btn-inverse-danger" id="delete"> Delete  </a>
                        </td> 
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>
			</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">

        <form method="POST" action="{{ route('store.blog.category') }}" class="forms-sample">
        @csrf


        <div class="form-group mb-3">
 <label for="exampleInputEmail1" class="form-label">Blog Category Name </label>
        <input type="text" name="category_name" class="form-control" >

        </div> 


      </div> 
      <div class="modal-footer">

    <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
   </form>

    </div>
  </div>
</div>




    
          
            
    

          
        
    
    
  
@endsection