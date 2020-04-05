@extends('layouts.app')
@section("content")
<div class="container">
    <div class="col-sm-12">
        <div class="row">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                @foreach($users as$user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{url('update_user/'.$user->id)}}"><i class="fa fa-edit"></i> Edit </a>
                            <a href="{{url('delete_user/'.$user->id)}}"><i class="fa fa-edit"></i> Delete </a>
                            @if($user->block==0)
                                <a href="{{url('block_user/'.$user->id)}}"><i class="fa fa-edit"></i> Block </a>
                            @else
                                <a href="{{url('block_user/'.$user->id)}}"><i class="fa fa-edit"></i>Un Block</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="col-sm-6 col-sm-offset-4">
        {{$users->links()}}
    </div>
</div>
@endsection

