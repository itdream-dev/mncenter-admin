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
            <h2>
                Levels
            </h2>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Create new level</h2>
                    </header>
                    <div class="panel-body">
                        <!-- Add New Words -->
                        @include('common.errors')
                        <form method="post" action="{{ Config::get('RELATIVE_URL') }}/level">
                            {{ csrf_field() }}
                            <div>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter level" style="width:300px;margin-bottom:20px;">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;{!! trans('flashcard.save') !!}&nbsp;&nbsp;</button>
                            </div>
                        </form>
                        <!-- END Add New Words -->
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Available levels</h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-none">
                            <thead><tr>
                                <th>Title</th>
                                <th>Courses count</th>
                                <th>Lessons count</th>
                                <th></th>
                                <th>Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($levels as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ count($item->courses) }}</td>
                                    <td>{{ count($item->lessons) }}</td>

                                    <!-- Task Delete Button -->
                                    <td class="actions-hover actions-fade">
                                        <a href="{{ Config::get('RELATIVE_URL') }}/levels/{{ $item->id }}"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="delete-row" onclick="remove({{ $item->id }}, {{count($item->courses)}}, {{count($item->lessons)}}, event)"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    <td class="try url">
                                       <a href="#" class="on-default edit-row" onClick="playExercise({{$item->id}})">Go to Level!</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody></table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <script>

        function playExercise(id)
        {
          if (id){
            url = "{{ Config::get('FRONT_URL') }}/lessons/" + id
            console.log(url);
            window.open(url);
          }
       }

        function remove(id, courseCnt, lessonCnt, e) {
            if(courseCnt > 0 || lessonCnt > 0) {
                new PNotify({
                    text: 'This level includes some courses or lessons yet. Please remove them first',
                    type: 'error',
                    icon: false,
                    addclass: 'ui-pnotify-no-icon',
                });
                return;
            }

            $.ajax({
                url:'/levels/' + id,
                type:'delete'
            }).then(function(ret){
                console.log(ret);
                $(e.target).parents("tr").remove();
            }, function(err){
                console.log(err);
            })
        }
    </script>
@endsection
