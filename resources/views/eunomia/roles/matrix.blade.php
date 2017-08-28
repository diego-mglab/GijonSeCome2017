@extends('adminlte::page')

@section('content_header')
    <h1>
        Role Matrix
        <small>Permissions that are on each role</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permisos</li>
    </ol>
@stop

@section('content')

    <div class="visible-xs alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        This page might not be formatted properly for this screen due to the complexity of Role Based Access Control permissioning.
    </div>

    {!! Form::open( [ 'route' => ['roles.updateRoleMatrix' ], 'class' => 'form-horizontal'] ) !!}
    <div class="table" style="overflow:auto; border: 1px dashed;">
        <table class="table table-bordered table-striped table-hover" style=" margin-bottom:0">
            <thead>
            <tr class="alert-warning">
                <th class="text-center">
                    <span class="pull-left"><span class="sr-only">Permissions</span>
                      <i class="fa fa-arrow-down"></i>
                      <i class="fa fa-key fa-lg"></i>
                    </span>

                    <span class="pull-right"><span class="sr-only">Roles</span>
                    <i class="fa fa-users" title="Roles"></i>
                    <i class="fa fa-arrow-right"></i>
                    </span>
                </th>
                @foreach ($roles as $rol)
                    <th> {{ $rol->name }} <a href="{{ route( 'roles.edit',$rol->id) }}">
                            <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-link"></span></button></a>
                    </th>
                @endforeach
            </tr>
            </thead>

            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <th class="alert-warning">
                        <a href="{{ route('permisos.edit',$permission->id) }}">
                            <button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-link"></span></button></a>
                        {{ $permission->name }}
                    </th>
                    @for ($i=0; $i < $roles->count(); $i++ )
                        <td data-container="body" data-trigger="focus" data-toggle="popover" data-placement="left" data-content="Role: {{$roles[$i]->name}}, Permission: {{$permission->slug}}">
                            {!! Form::checkbox('perm_role[]', $roles[$i]->id.":".$permission->id, ( in_array( ($roles[$i]->id.":".$permission->id), $pivot ) ? true : false ) ) !!}
                        </td>
                    @endfor
                </tr>
            @endforeach

            <!-- table footer -->
            <tfoot>
            </tfoot>
            </tbody>
        </table>
    </div>

        <div class="form-group">
            <div class="col-sm-3">
                {!! Form::submit('Save Role Permission Changes', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

@endsection