@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $findpermission->display_name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
           <div class="inner_iteam">

            <?php
                use Illuminate\Support\Facades\Auth;
                use App\Permission;


                $permission = Permission::where("super_parent", $findpermission->id)->get();

//            echo "<pre>";
//            print_r($permission);
//            echo "</pre>";

                foreach ($permission as $singleparent){
                    $children[$singleparent->name]=Permission::where("parent_id", $singleparent->id)->get();
                }

                $auth_user=Auth::user()->roles;
                $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$auth_user[0]->id)
                    ->pluck('permission_role.permission_id','permission_role.permission_id')->toArray();



                $checkvalue=false;
                foreach($permission as $value){

                $haspermission = Permission::where("parent_id", $value->parent_id)->get();
                foreach ($haspermission as $haspermission_single){
                    if(in_array($haspermission_single->id, $rolePermissions)){
                        $checkvalue=true;
                        break;
                    }
                }

                if($checkvalue){
                ?>
                      <div class="each_iteam">
                           <a href="{{Request::root()}}/dashboard/<?php echo $value->url; ?>">

                               <img class="sub_custom_nab_image" src="{{Request::root()}}/images/icon/subpage/<?php echo $value->description; ?>" >
                               <h5><?php echo $value->display_name; ?></h5>
                           </a>
                      </div>
                <?php
                }

                $checkvalue=false;
                }



            ?>

          </div>
        </div>
    </div>

@endsection


