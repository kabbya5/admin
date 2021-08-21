@extends('layouts.admin.header');
@section('content')
<div class="content">
    <div class=" container-fluid">
        <div class="card">
            <div class="card-header text-center">
              Message  List <span class="badge badge-pill badge-danger">{{count($new_message)}} </span>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
  
                      <tr>
                        <th scope="col">Sl.No</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col"> Email Address</th>
                        <th scope="col"> Message </th>
                        <th> Status </th>
                        <th scope="col"> Action  </th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($all_contact as $key => $message)
                      <tr>
                        <th scope="row">{{$key +1}}</th>
                        <td> {{$message->name}}</td>
                        <td> 
                            {{$message->phone}}
                        </td>
                        <td> 
                            {{$message->email}}
                        </td>
                        <td> 
                            {!!Str::limit($message->message, 12, '.....')!!}
                        </td>
                        <td> 
                          @if ($message->status == 0)
                          <a href="{{route('view.message',$message->id)}}">
                            <span class="badge badge-pill badge-danger"> New </span>
                          </a>
                              
                          @else
                          <a href="{{route('view.message',$message->id)}}">
                            <span class="badge badge-pill badge-success">
                              Viewed
                            </span>
                          </a>
                          @endif
                      </td>
                        <td>
                            <a class="btn btn-info" href="{{route('view.message',$message->id)}}/">
                              <i class="fas fa-eye"></i>
                            </a>
                         
              
                          <a href="{{route('delete.message', $message->id)}}" class="btn btn-warning" id='delete'> <i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    
                </table>
            </div> 
            <div class="paginate mb-4 d-flex justify-content-center">
              {{ $all_contact->links('layouts.paginationlinks') }}  
          </div>  
                   
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
