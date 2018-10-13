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
                <h2>Quiz settings</h2>
            </header>
            <div class="panel-body" id="pageDocument">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-md">
                            <a href="/quizsettings/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Term</th>
                        <th>Created at</th>                        
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($quizsettings as $item)
                        <tr id="{{$item->id}}">
                            <td>{{$item->id}}</td>
							<td>{{$item->term}}</td>
                            <td>{{$item->created_at}}</td>
                            <td class="actions">
                                <a href="/quizsettings/{{$item->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row" onclick="remove({{$item->id}})"><i class="fa fa-trash-o"></i></a>
                                <a href="#" class="on-default remove-row" onclick="duplicate({{$item->id}})"><i class="fa fa-copy"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $quizsettings->links() }}
            </div>
        </section>
    <script>

        function remove(id) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/quizsettings/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$quizsettings->url($quizsettings->currentPage())}}"
            }, function(err){
                console.log(err);
            })
          }
        }

    $(function() {
    });
</script>

@endsection
