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
                Wordsets
            </h2>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Edit Wordset</h2>
                    </header>
                    <div class="panel-body">
                        <!-- Add New Words -->
                        @include('common.errors')
                        <form method="post" action="{{ Config::get('RELATIVE_URL') }}/wordsets/{{$wordset->id}}">
                            {{ csrf_field() }}
                            <div>
                                <input type="text" class="form-control" id="nameText" name="name" placeholder="Enter name.." style="width:300px;margin-bottom:20px;" value="{{$wordset->name}}">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                                <button class="btn btn-default" onclick="location.href='{{ Config::get('RELATIVE_URL') }}/wordsets';return false;">&nbsp;&nbsp;Back&nbsp;&nbsp;</button>
                            </div>
                        </form>
                        <!-- END Add New Words -->
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
