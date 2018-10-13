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
                <h2>Blog categories</h2>
            </header>
            <div class="panel-body" id="pageDocument">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-md">
                            <a href="/blogcats/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Category title</th>
                        <th>Author</th>
                        <th>Created On</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($blogcats as $item)
                        <tr id="{{$item->id}}">
                            <td>{{$item->title}}</td>
                            <td>{{$item->createdBy->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td class="actions">
                                <a href="/blogcats/{{$item->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row" onclick="remove({{$item->id}})"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $blogcats->links() }}
            </div>
        </section>
    <script>
        function ViewPage(id)
        {
            if (id){
              url = "{{ Config::get('FRONT_URL') }}/" + id;
              console.log(url);
              window.open(url);
            }
        }

        function remove(id) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/blogcats/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$blogcats->url($blogcats->currentPage())}}"
            }, function(err){
                console.log(err);
            })
          }
        }
    </script>

@endsection
