<?php
/******************************************************
 * IM - Vocabulary Builder
 * Version : 1.0.2
 * Copyright© 2016 Imprevo Ltd. All Rights Reversed.
 * This file may not be redistributed.
 * Author URL:http://imprevo.net
 ******************************************************/
?>
@extends('layouts.back')

@section('content')
        <section role="main" class="content-body">
            @php
                function getUserGroupName($id, $userGroups) {
                    foreach($userGroups as $user) {
                        if($user->id == $id) {
                            return $user->name;
                        }
                    }

                    return "-";
                }
                function getCourseName($id, $courses) {
                    foreach($courses as $course) {
                        if($course->id == $id) {
                            return $course->title;
                        }
                    }

                    return "-";
                }

                function getTitles($id,$userdatas, $courses) {
					$list = [];
					foreach ($userdatas as $userdata){
						if ($userdata->id == $id)
						{
							$courseids = explode(',',$userdata->purchased_courses);
							foreach ($courseids as $courseid)
							{
								foreach ($courses as $course)
								{
									if ($course->id == $courseid)
									{
										array_push($list, $course);
									}
								}
							}
						}
					}

                    $ret = [];
                    foreach($list as $item) {
                        $ret[] = $item->title;
                    }

                    return join(', ', $ret);
                }
            @endphp
            <header class="page-header">
                <h2>User management</h2>
            </header>
            <div class="panel-body" id="pageDocument">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="mb-md">
                            <a href="/users/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <form id="search-form" method="GET" action="">
      								<div class="input-group input-search">
      									<input type="text" class="form-control" name="query" id="query" placeholder="Search..." value="{{$search}}">
      									<span class="input-group-btn">
      										<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
      									</span>
      								</div>
                     </form>
      							</div>
                </div>
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email address</th>
                        <th>Usergroup</th>
                        <th>Purchased courses</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr id="{{$user->id}}">
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{getUserGroupName($user->permission, $userGroups)}}</td>
                            <td>{{getTitles($user->id, $userdatas, $courses)}}</td>
                            <td class="actions">
                                <a href="/users/{{$user->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row" onclick="removeUser({{$user->id}})"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </section>
    <script>

        function removeUser(id) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/users/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$users->url($users->currentPage())}}"
            }, function(err){
                console.log(err);
            })
          }
        }

    $(function() {
    });
</script>

@endsection
