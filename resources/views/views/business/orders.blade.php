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
                <h2>Companies</h2>
            </header>
            <div class="panel-body" id="pageDocument">
				<form id="formChangeStatus" name="formChangeStatus"  role="form" action="/businessorder/changestatus" method="post" encType="multipart/form-data">
				{{ csrf_field() }}
					<input id="order-id" name="order-id" type="hidden" value="0">
					<input id="currentstatus" name="currentstatus" type="hidden" value="0">
				</form>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md">
                    <a href="/company_order/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
                <table class="table mb-none" id="datatable-editable">
                    <thead>
                    <tr>
						            <th>Company</th>
                        <th>Address</th>
                        <th>Email address</th>
                        <th># of purchased licenses</th>
                        <th>Total</th>
						            <th>Purchased date</th>
                        <th>Subscription expires</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="table">
                    @foreach ($orders as $item)
                      <tr id="{{$item->id}}">
                        <td>{{$item->company_name}}</td>
                        <td>{{$item->company_address}}</td>
                        <td>{{$item->company_email}}</td>
                        <td style="text-align:center">{{$item->licenses}}</td>
                        <td>{{number_format($item->price_licenses * $item->licenses)}} {{$businesssetting['currency']}}</td>
                        <td>{{date('Y/m/d', strtotime($item->created_at))}}</td>
                        <td>{{date('Y/m/d', strtotime($item->expiration_date))}}</td>
                        <td>
          								<select style="padding:0px 10px 0px 10px;width:90%; height:30px;" id="status-{{$item->id}}" onchange="OnchangeStatus({{$item->id}})">
          									<option value="Pending" @if ($item->status == "Pending") selected @endif>Pending</option>\
          									<option value="Failed" @if ($item->status == "Failed") selected @endif>Failed</option>\
          									<option value="Completed" @if ($item->status == "Completed") selected @endif>Completed</option>\
          									<option value="Invoiced" @if ($item->status == "Invoiced") selected @endif>Invoiced</option>\
          								</select>
          							</td>
                        <td class="actions">
                            <a href="/company_orders/{{$item->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-default remove-row" onclick="remove(event, {{$item->id}})"><i class="fa fa-trash-o"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </section>
    <script>

    $('document').ready(function(){
      @foreach ($orders as $item)
  			var state = "{{$item->status}}";
  			if (state == "Pending")
  			{
          $('#{{$item->id}}').css('background-color', '#dedede');
  			}
  			else if (state == "Invoiced")
  			{
          $('#{{$item->id}}').css('background-color', '#a7f59b');
  			}
  			else if (state == "Failed")
  			{
          $('#{{$item->id}}').css('background-color', '#fabebe');
  			}
  			else
  				$('#{{$item->id}}').css('background-color', '#fff');
  		@endforeach
    })

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
