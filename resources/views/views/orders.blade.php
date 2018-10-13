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
                <h2>Orders</h2>
            </header>
            <div class="panel-body" id="pageDocument">
				<form id="formChangeStatus" name="formChangeStatus"  role="form" action="/order/changestatus" method="post" encType="multipart/form-data">
				{{ csrf_field() }}
					<input id="order-id" name="order-id" type="hidden" value="0">
					<input id="currentstatus" name="currentstatus" type="hidden" value="0">
				</form>
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                </div>
                <table class="table mb-none" id="datatable-editable">
                    <thead>
                    <tr>
						<th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Price/Payment method</th>
                        <th>Change status to</th>
						<th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="table">

                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </section>
    <script>
		var html='';

		@foreach ($orders as $item)
			var state = "{{$item->order_state}}";

			if (state == "Pending")
			{
				html = html + '<tr id="{{$item->id}}" style="background-color:#dedede">';
			}
			else if (state == "Invoiced")
			{
				html = html + '<tr id="{{$item->id}}" style="background-color:#a7f59b">';
			}
			else if (state == "Failed")
			{
				html = html + '<tr id="{{$item->id}}" style="background-color:#fabebe">';
			}
			else
				html = html + '<tr id="{{$item->id}}">';

			html = html + '<td>{{$item->id}}</td>\
                            <td>{{$item->customer}}</td>\
                            <td>{{$item->order_date}}</td>\
							<td>{{number_format($item->price_total,2)}} @if ($shoppingcartsetting['currency'] == "USD") USD @else HUF @endif  /{{$item->payment_method}}</td>\
							<td>\
								<select style="padding:0px 10px 0px 10px;width:90%; height:30px;" id="status-{{$item->id}}" onchange="OnchangeStatus({{$item->id}})">				\
									<option value="Pending" @if ($item->order_state == "Pending") selected @endif>Pending</option>\
									<option value="Failed" @if ($item->order_state == "Failed") selected @endif>Failed</option>\
									<option value="Completed" @if ($item->order_state == "Completed") selected @endif>Completed</option>\
									<option value="Invoiced" @if ($item->order_state == "Invoiced") selected @endif>Invoiced</option>\
								</select>\
							</td>\
                            <td class="actions">\
                                <a href="/orders/{{$item->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>\
                                <a href="#" class="on-default remove-row" onclick="remove(event, {{$item->id}})"><i class="fa fa-trash-o"></i></a>\
                            </td>\
                        </tr>';
		@endforeach

		document.getElementById('table').innerHTML = html;

		function OnchangeStatus(id)
		{
			var status = document.getElementById('status-' + id).value;
			var tr = document.getElementById(id);


			document.getElementById('order-id').value = id;
			document.getElementById('currentstatus').value = status;
			$('#formChangeStatus').submit();

		}

        function remove(e, id) {
			e.preventDefault();
			e.stopPropagation();
            res = confirm("Do you really want to delete this item?");
            if (res){
            $.ajax({
              url:'/orders/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$orders->url($orders->currentPage())}}"
            }, function(err){
                console.log(err);
            })
            }
        }
	</script>

@endsection
