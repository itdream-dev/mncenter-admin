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
                <h2>Products</h2>
            </header>
            <div class="panel-body" id="pageDocument">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-md">
                            <a href="/products/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Created on</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $item)
                        <tr id="{{$item->id}}">
                            <td>{{$item->title}}</td>
                            <td>
								@if ($shoppingcartsetting['currency'] == "USD") 
									${{$item->regular_price}} 
								@else 
									{{$item->regular_price}} HUF								
								@endif
							</td>
                            <td>{{$item->created_at}}</td>
                            <td class="actions">
                                <a href="/products/{{$item->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row" onclick="remove(event, {{$item->id}})"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </section>
    <script>

        function remove(e, id) {
			e.preventDefault();
			e.stopPropagation();
            res = confirm("Do you really want to delete this item?");
            if (res){
            $.ajax({
              url:'/products/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$products->url($products->currentPage())}}"
            }, function(err){
                console.log(err);
            })
            }
        }
	</script>

@endsection
