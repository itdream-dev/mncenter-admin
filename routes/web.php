<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//Users
Route::get('/users/new', ['as' => 'admin.user.new', 'uses' => 'UserController@newUser']);
Route::get('/users', ['as' => 'admin.users', 'uses' => 'UserController@users']);
Route::get('/users/{id}', ['as' => 'admin.userEdit', 'uses' => 'UserController@editUser']);
Route::delete('/users/{id}', ['uses' => 'UserController@destroy']);
Route::post('/user', ['as' => 'admin.users', 'uses' => 'UserController@postEdit']);

Route::get('/masternodes/new', ['as' => 'admin.masternode.new', 'uses' => 'MasternodeController@newMasternode']);
Route::get('/masternodes', ['as' => 'admin.masternodes', 'uses' => 'MasternodeController@masternodes']);
Route::get('/masternodes/{id}', ['as' => 'admin.masternodeEdit', 'uses' => 'MasternodeController@editMasternode']);
Route::delete('/masternodes/{id}', ['uses' => 'MasternodeController@destroy']);
Route::post('/masternode', ['as' => 'admin.masternode', 'uses' => 'MasternodeController@postEdit']);

Route::get('/rewards/new', ['as' => 'admin.reward.new', 'uses' => 'RewardController@newReward']);
Route::get('/rewards', ['as' => 'admin.rewards', 'uses' => 'RewardController@rewards']);
Route::get('/rewards/{id}', ['as' => 'admin.rewardEdit', 'uses' => 'RewardController@editReward']);
Route::delete('/rewards/{id}', ['uses' => 'RewardController@destroy']);
Route::post('/reward', ['as' => 'admin.reward', 'uses' => 'RewardController@postEdit']);

Route::get('/sales/new', ['as' => 'admin.sale.new', 'uses' => 'SaleController@newSale']);
Route::get('/sales', ['as' => 'admin.sales', 'uses' => 'SaleController@sales']);
Route::get('/sales/{id}', ['as' => 'admin.saleEdit', 'uses' => 'SaleController@editSale']);
Route::delete('/sales/{id}', ['uses' => 'SaleController@destroy']);
Route::post('/sale', ['as' => 'admin.sale', 'uses' => 'SaleController@postEdit']);

Route::get('/coins/new', ['as' => 'admin.coin.new', 'uses' => 'CoinController@newCoin']);
Route::get('/coins', ['as' => 'admin.coins', 'uses' => 'CoinController@coins']);
Route::get('/coins/{id}', ['as' => 'admin.coinEdit', 'uses' => 'CoinController@editCoin']);
Route::delete('/coins/{id}', ['uses' => 'CoinController@destroy']);
Route::post('/coin', ['as' => 'admin.coin', 'uses' => 'CoinController@postEdit']);


Route::get('/transactions', ['as' => 'admin.transactions', 'uses' => 'TransactionController@transactions']);

Route::get('/videos/new', ['as' => 'admin.video.new', 'uses' => 'VideoController@newVideo']);
Route::get('/videos', ['as' => 'admin.videos', 'uses' => 'VideoController@videos']);
Route::get('/videos/{id}', ['as' => 'admin.videoEdit', 'uses' => 'VideoController@editVideo']);
Route::delete('/videos/{id}', ['uses' => 'VideoController@destroy']);
Route::post('/video', ['as' => 'admin.video', 'uses' => 'VideoController@postEdit']);

Route::get('/general_settings', 'SettingController@general_settings')->name('general_settings');
Route::post('/general_setting', ['as' => 'admin.general_setting.post', 'uses' => 'SettingController@postGeneralSetting']);

Route::get('/payment_settings', 'SettingController@payment_settings')->name('payment_settings');
Route::post('/payment_settings', ['as' => 'admin.general_setting.post', 'uses' => 'SettingController@postPaymentSetting']);

Route::get('/smart_contract', 'ContractController@contract')->name('contract');

Route::get('/referrals', 'ReferralController@referrals')->name('referrals');
Route::delete('/referrals/{id}', ['uses' => 'ReferralController@destroy']);
