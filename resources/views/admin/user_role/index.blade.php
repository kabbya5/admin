@extends('layouts.admin.header')
@section('content')

<div class="all-user">
    <div class="container">
     
        <div class="table">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">All Verified User </h4>
                            
                        </div>
                    </div>
                    <!-- title -->
                </div>
                    <div class="table-responsive">
                        <table class="table v-middle">
                            <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0"> Images </th>
                                    <th class="border-top-0"> Name </th>
                                    <th class="border-top-0"> Email </th>
                                    <th class="border-top-0"> Phone </th>
                                    <th class="border-top-0"> User Type </th>
                                    <th class="border-top-0"> Make Role </th>
                                    <th class="border-top-0"> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user )
                                            
                                <tr>   
                                    <td>
                                        <a href="{{route('user.view',$user->id)}}">
                                            <div class="d-flex align-items-center">
                                                <div class="m-r-10">
                                                    @if ($user->profile_img)
                                                    <img src="{{asset($user->profile_img)}}" style="display: block; object-fit:cover; width:50px; height:50px; border-radius: 50%; border:2px solid #ff5c23;">
                                                    @else
                                                    <i class="fas fa-user fa-3x img pt-1 pl-2" ></i>
                                                    @endif
                                               
                                                </div>
                                                <div class="">
                                                    <h4 class="m-b-0 font-16">{{$user->username}}</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        @if ($user->role_id == 1)
                                            Admin
                                        @elseif ($user->role_id == 2)
                                            Seller
                                        @else
                                            User
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->role_id == 1)
                                            <a href="{{route('seller',$user->id)}}"> Seller </a> |
                                            <a href="{{route('user',$user->id)}}"> User </a>
                                        @elseif ($user->role_id == 2)
                                            <a href="{{route('admin',$user->id)}}" class="badge badge-danger"> Admin </a>|
                                            <a href="{{route('user',$user->id)}}"> User </a>
                                        @else
                                            <a href="{{route('admin',$user->id)}}" class="badge badge-danger"> Admin </a>|
                                            <a href="{{route('seller',$user->id)}}"> Seller </a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a href="{{route('user.view',$user->id)}}" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>        
                                @endforeach
                            </tbody>
                        </table>
                        </div> 
                        <div class="paginate mb-4">
                            {{ $users->links('layouts.paginationlinks') }}  
                        </div> 
                        
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection