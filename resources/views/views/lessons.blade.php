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
            <header class="page-header">
                <h2>Lesson management</h2>
            </header>
            <div class="panel-body" id="pageDocument">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-md">
                            <a href="/lessons/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Trial lesson?</th>
                        <th>Course</th>
                        <th>Level</th>
                        <th>Public lesson?</th>
                        <th>Free Lesson?</th>
                        <th>Exercises #</th>
                        <th>Action</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($lessons as $item)
                        <tr id="{{$item->id}}">
                            <td>{{$item->title}}</td>
                            <td>{{$item->is_trial==1?'Yes':'No'}}</td>
                            <td>@if ($item->course) {{$item->course->title}} @endif</td>
                            <td>{{$item->level->title}}</td>
                            <td>{{$item->is_public==1?'Yes':'No'}}</td>
                            <td>{{$item->is_free==1?'Yes':'No'}}</td>
                            <td>{{count($item->exercises)}}</td>
                            <td class="actions">
                                <a href="/lessons/{{$item->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row" onclick="remove(event, {{$item->id}})"><i class="fa fa-trash-o"></i></a>
                            </td>
                            <td class="try url">
                               <a href="#" class="on-default edit-row" onClick="playExercise({{$item->exercises}})">Go to first Exercise!</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $lessons->links() }}
            </div>
        </section>
    <script>

        function remove(e, id) {
			e.preventDefault();
			e.stopPropagation();
            res = confirm("Do you really want to delete this item?");
            if (res){
            $.ajax({
              url:'/lessons/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$lessons->url($lessons->currentPage())}}"
            }, function(err){
                console.log(err);
            })
            }
        }

        function playExercise(exes)
        {
          exe_id = exes[0].id;
          url = "{{ Config::get('FRONT_URL') }}/exercise/" + exe_id
          console.log('-------------------');
          console.log(url);
          window.open(url);
        }

        function GetSiteRoot()
        {
          var rootPath = window.location.protocol + "//" + window.location.host + "/";
          if (window.location.hostname == "localhost")
          {
            var path = window.location.pathname;
            if (path.indexOf("/") == 0)
            {
              path = path.substring(1);
            }
            path = path.split("/", 1);
            if (path != "")
            {
              rootPath = rootPath + path + "/";
            }
          }
          return rootPath;
        }
    $(function() {
    });
</script>

@endsection
