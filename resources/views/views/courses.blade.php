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
                function getTitles($list) {
                    $ret = [];
                    foreach($list as $item) {
                        $ret[] = $item->title;
                    }

                    return join(',', $ret);
                }
            @endphp
            <header class="page-header">
                <h2>Course management</h2>
            </header>
            <div class="panel-body" id="pageDocument">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-md">
                            <a href="/courses/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Public course?</th>
                        <th>Free course?</th>
                        <th>Levels</th>
                        <th>Modules</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($courses as $course)
                        <tr id="{{$course['id']}}">
                            <td>{{$course->title}}</td>
                            <td>{{$course->is_public==1?'Yes':'No'}}</td>
                            <td>{{$course->is_free==1?'Yes':'No'}}</td>
                            <td>{{getTitles($course->levels)}}</td>
                            <td>{{getTitles($course->modules)}}</td>
                            <td class="actions">
                                <a href="/courses/{{$course->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row" onclick="removeCourse({{$course->id}}, {{count($course->lessons)}})"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
            </div>
        </section>
    <script>

        function removeCourse(id, lessonCnt) {
          if(lessonCnt > 0) {
              new PNotify({
                  text: 'This course includes some lessons yet. Please remove them first',
                  type: 'error',
                  icon: false,
                  addclass: 'ui-pnotify-no-icon',
              });
              return;
          }
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/courses/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$courses->url($courses->currentPage())}}"
            }, function(err){
                console.log(err);
            })
          }
        }

    $(function() {
    });
</script>

@endsection
