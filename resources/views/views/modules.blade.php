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
                Modules
            </h2>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Create new module</h2>
                    </header>
                    <div class="panel-body">
                        <!-- Add New Words -->
                        @include('common.errors')
                        <form method="post" action="{{ Config::get('RELATIVE_URL') }}/module" encType="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <div class="col-md-3">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter module" style="width:300px;margin-bottom:20px;">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-3">
                                <input type="file" id="uploadPhoto" class="form-control" name="uploadPhoto" placeholder="Upload Module Icon">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;{!! trans('flashcard.save') !!}&nbsp;&nbsp;</button>
                              </div>
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
                        <h2 class="panel-title">Available modules</h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-none">
                            <thead><tr>
                                <th>Title</th>
                                <th>Courses count</th>
                                <th>Exercises count</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($modules as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ count($item->courses) }}</td>
                                    <td>{{ count($item->exercises) }}</td>

                                    <!-- Task Delete Button -->
                                    <td class="actions-hover actions-fade">
                                        <a href="{{ Config::get('RELATIVE_URL') }}/modules/{{ $item->id }}"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="delete-row" onclick="remove({{ $item->id }}, {{count($item->courses)}}, {{count($item->exercises)}}, event)"><i class="fa fa-trash-o"></i></a>
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

        function remove(id, courseCnt, lessonCnt, e) {
            if(courseCnt > 0 || lessonCnt > 0) {
                new PNotify({
                    text: 'This module includes some courses or exercises yet. Please remove them first',
                    type: 'error',
                    icon: false,
                    addclass: 'ui-pnotify-no-icon',
                });
                return;
            }
            res = confirm("Do you really want to delete this item?");
            if (res){
            $.ajax({
                url:'/modules/' + id,
                type:'delete'
            }).then(function(ret){
                console.log(ret);
                $(e.target).parents("tr").remove();
            }, function(err){
                console.log(err);
            })
            }
        }
    </script>
@endsection
