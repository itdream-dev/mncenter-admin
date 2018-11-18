<?php
/******************************************************
 * IM - Vocabulary Builder
 * Version : 1.0.2
 * Copyright© 2016 Imprevo Ltd. All Rights Reversed.
 * This file may not be redistributed.
 * Author URL:http://imprevo.net
 ******************************************************/
?>
@extends('layouts.app')

@section('content')
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Sales management</h2>
                <span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
                <span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
            </header>
            <div class="panel-body" id="pageDocument">
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Coin</th>
                        <th>MasterNode ID</th>
                        <th>Seats Count</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($sales as $sale)
                        <tr id="{{$sale->id}}">
                            <td>{{$sale->id}}</td>
                            <td>@if (isset($sale->user)) {{$sale->user->name}} @endif</td>
                            <td>{{$sale->masternode->coin->coin_name}}</td>
                            <td>{{$sale->masternode->id}}</td>
                            <td>{{$sale->sales_amount}}</td>
                            <td>{{$sale->total_price}}</td>
                            <td>{{$sale->status}}</td>
                            <!-- <td class="actions">
                                <a href="/sales/{{$sale->id}}" class="on-default edit-row"><i class="fa fa-eye"></i></a>
                            </td> -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $sales->links() }}
            </div>
        </section>
    <script>
        function remove(id) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/sales/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$sales->url($sales->currentPage())}}"
            }, function(err){
                console.log(err);
            })
          }
        }

        $(document).ready(function(){
          jQuery.get('https://api.coinmarketcap.com/v1/ticker/ethereum/', function(data, status){
            $('.ether_unit').html('1ETH = $' + parseFloat(data[0].price_usd).toFixed(2));
          });
        });

        $(document).ready(function(){
          jQuery.get('https://api.coinmarketcap.com/v1/ticker/bitcoin/', function(data, status){
            $('.btc_unit').html('1BTC = $' + parseFloat(data[0].price_usd).toFixed(2));
          });
        });
    </script>
@endsection
