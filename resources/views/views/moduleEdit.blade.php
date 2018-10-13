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
                        <h2 class="panel-title">Edit module</h2>
                    </header>
                    <div class="panel-body">
                        <!-- Add New Words -->
                        @include('common.errors')
                        <form method="post" action="{{ Config::get('RELATIVE_URL') }}/modules/{{$module->id}}" encType="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <div class="col-md-3">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter module" style="width:300px;margin-bottom:20px;" value="{{$module->title}}">
                            </div>
                            </div>

                            <div class="form-group">
                              <div class="col-md-3">
                                @if($module['id'] && $module['icon'])
                                <img src="{{$module['icon']}}" style="max-height:200px;margin-bottom: 10px">
                                @endif
                                <input type="file" id="uploadPhoto" class="form-control" name="uploadPhoto" >
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;{!! trans('flashcard.save') !!}&nbsp;&nbsp;</button>
                                <button class="btn btn-default" onclick="location.href='{{ Config::get('RELATIVE_URL') }}/modules';return false;">&nbsp;&nbsp;{!! trans('flashcard.back') !!}&nbsp;&nbsp;</button>
                              </div>
                            </div>
                        </form>
                        <!-- END Add New Words -->
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
