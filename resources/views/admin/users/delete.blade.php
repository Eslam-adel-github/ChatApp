@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete {{$user->name}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('delete_user',["id"=>$user->id]) }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12">
                                <h2>Are You Sure To Delete This User {{ $user->name }}?</h2>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Delete User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
