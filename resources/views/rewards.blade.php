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
                <h2>Reward management</h2>
                <span class="ether_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:40%; margin-left:-75px"></span>
                <span class="btc_unit" style="width:200px; font-size:20px;color:#fff;line-height:50px;position:absolute;left:60%; margin-left:-75px"></span>
            </header>
            <div class="panel-body" id="pageDocument">

                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Reward ID</th>
                        <th>To</th>
                        <th>Reward Type</th>
                        <th>Reward Amount</th>
                        <th>Masternode ID</th>
                        <th>Status</th>
                        <th>Reward Date</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($rewards as $reward)
                        <tr id="{{$reward->id}}">
                            <td>{{$reward->id}}</td>
                            <td>
                              @if ($reward->type == 'to_platform')
                                Platfrom
                              @endif
                              @if ($reward->type == 'to_referral')
                                {{$reward->referred_by->name}} ({{$reward->referred_by->email}})
                              @endif
                              @if ($reward->type == 'to_user')
                                {{$reward->user->name}} {{$reward->user->email}}
                              @endif
                            </td>
                            <td>{{$reward->type}}</td>
                            <td>{{$reward->reward_amount}}</td>
                            <td>{{$reward->masternode->id}}</td>
                            <td>{{$reward->status}}</td>
                            <td>{{$reward->created_at}}</td>
                            <!-- <td class="actions">
                                <a href="/rewards/{{$reward->id}}" class="on-default edit-row"><i class="fa fa-eye"></i></a>
                            </td> -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $rewards->links() }}
            </div>
        </section>
    <script>
        function remove(id) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/rewards/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$rewards->url($rewards->currentPage())}}"
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
