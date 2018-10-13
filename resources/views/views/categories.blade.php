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
                Categories
            </h2>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">{!! trans('flashcard.createNewCategory') !!}</h2>
                    </header>
                    <div class="panel-body">
                        <!-- Add New Words -->
                        @include('common.errors')
                        <form method="post" action="{{ Config::get('RELATIVE_URL') }}/cat">
                            {{ csrf_field() }}
                            <div>
                                <input type="text" class="form-control" id="categoryText" name="category" placeholder="{!! trans('flashcard.enterCategory') !!}" style="width:300px;margin-bottom:20px;">
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
                        <h2 class="panel-title">{!! trans('flashcard.availableCategories') !!}</h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-none">
                            <thead><tr>
                                <th>{!! trans('flashcard.categoryName') !!}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cats as $cat)
                                <tr>
                                    <td>{{ $cat->category }}</td>

                                    <!-- Task Delete Button -->
                                    <td class="actions-hover actions-fade">
                                        <a href="{{ Config::get('RELATIVE_URL') }}/cats/{{ $cat->id }}"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="delete-row" onclick="removeCategory({{ $cat->id }}, event)"><i class="fa fa-trash-o"></i></a>
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

        function removeCategory(id, e) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            console.log(e);
            $.ajax({
                url:'/cats/' + id,
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
