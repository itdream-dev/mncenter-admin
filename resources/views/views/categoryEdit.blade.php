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
                        <h2 class="panel-title">{!! trans('flashcard.editCategory') !!}</h2>
                    </header>
                    <div class="panel-body">
                        <!-- Add New Words -->
                        @include('common.errors')
                        <form method="post" action="{{ Config::get('RELATIVE_URL') }}/cats/{{$cat->id}}">
                            {{ csrf_field() }}
                            <div>
                                <input type="text" class="form-control" id="categoryText" name="category" placeholder="Enter category" style="width:300px;margin-bottom:20px;" value="{{$cat->category}}">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;{!! trans('flashcard.save') !!}&nbsp;&nbsp;</button>
                                <button class="btn btn-default" onclick="location.href='{{ Config::get('RELATIVE_URL') }}/cats';return false;">&nbsp;&nbsp;{!! trans('flashcard.back') !!}&nbsp;&nbsp;</button>
                            </div>
                        </form>
                        <!-- END Add New Words -->
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
