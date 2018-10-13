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
                <h2>Referrals</h2>
                <span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
                <span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
            </header>
            <div class="panel-body" id="pageDocument">

                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Referred By</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($referrals as $referral)
                        <tr id="{{$referral->id}}">
                            <td>{{$referral->id}}</td>
                            <td>{{$referral->user->name}}</td>
                            <td>{{$referral->referred_by->name}}</td>
                            <td>{{$referral->created_at}}</td>
                            <td class="actions">
                               <a href="#" class="on-default remove-row" onclick="remove({{$referral->id}})"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $referrals->links() }}
            </div>
        </section>
    <script>
        function remove(id) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/referrals/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$referrals->url($referrals->currentPage())}}"
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
