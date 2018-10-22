@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Role details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="single_show_top">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Name:</td>
                        <td> {{ $role->display_name }}</td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td> {{ $role->description }}</td>
                    </tr>
                    <tr>
                        <td>Permissions:</td>
                        <td> @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <label class="label label-success">{{ $v->display_name }}</label>
                                @endforeach
                            @endif
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>



        </div>


    </div>
@endsection