
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

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/




/*sslcommerce url start*/
    Route::get('/pay',  ['as'=>'pay.index','uses'=>'PublicSslCommerzPaymentController@index']);
    Route::POST('/success', 'PublicSslCommerzPaymentController@success');
    Route::POST('/fail', 'PublicSslCommerzPaymentController@fail');
    Route::POST('/cancel', 'PublicSslCommerzPaymentController@cancel');
    Route::POST('/ipn', 'PublicSslCommerzPaymentController@ipn');

/*sslcommerce url end*/





/*agentdashbord*/

 Route::get('/agentdashbord',  ['as'=>'agentdashbord.index','uses'=>'FrontController@agentdashbord']);

Route::get('/userdashboard',  ['as'=>'userdashboard.index','uses'=>'FrontController@userdashboard']);






Route::get('/user/create', ['as'=>'passenger.create','uses'=>'PassengerController@create']);
Route::get('/user/todaystransaction', ['as'=>'passenger.todaystransaction','uses'=>'PassengerController@todaystransaction']);
Route::get('/user/alltransaction', ['as'=>'passenger.alltransaction','uses'=>'PassengerController@alltransaction']);
Route::get('/user/history', ['as'=>'passenger.history','uses'=>'PassengerController@history']);

Route::post('/user/registration', ['as'=>'passenger.store','uses'=>'PassengerController@store']);
Route::post('/user/update', ['as'=>'passenger.update','uses'=>'PassengerController@update']);















/*
Route::get('/', function () {
   return view('welcome');

});*/
Route::get('/', ['as'=>'font_web.index','uses'=>'FrontController@index']);





Route::get('/bookingfront/{id}/{data_date}', ['as'=>'bookingfront.index','uses'=>'FrontController@bookingfrontfunction']);




Route::post('/bookingdata/reserve', ['as'=>'bookingdata.index','uses'=>'FrontController@bookingdatafunction']);


/*Route::get('/new-books', function () {
    return view('newbooks');
});*/

Route::get('/new-books', 'FrontController@newBooks');

/*Route::get('/top-books', function () {
    return view('topbooks');
});*/

Route::get('/top-books', 'FrontController@topBooks');

/*Route::get('/contact', function () {
    return view('contact');
});*/

Route::get('/top-journals', 'FrontController@topJournals');


//top seminar router
Route::get('/top-seminars', 'FrontController@topSeminars');


Route::get('/contact', 'FrontController@contact');



Route::get('single/{id}',['as'=>'single.show','uses'=>'FrontController@single']);








Route::resource('print', 'CartController');
Route::delete('emptyPrint', 'CartController@emptyCart');
Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist');





//Route::get('/', 'HomeController@index');

//Route::auth();
Route::get('logout', function(){
    Auth::logout(); // logout user
    //return Redirect::to('/login');



    //return redirect()->route('login');

});



Route::group(['middleware' => 'prevent-back-history'],function(){
    //Auth::routes();
    Route::auth();
   // Route::get('/', 'HomeController@index');
});



Route::group(['prefix' => 'dashboard','middleware' => ['auth','prevent-back-history']], function() {

    //Route::get('/home', 'HomeController@index');

    //Route::get('/', 'HomeController@index');
    //Route::get('/home', 'HomeController@index');

    Route::get('/', ['as'=>'home.index','uses'=>'HomeController@index']);
    
    Route::get('/home', ['as'=>'home.index','uses'=>'HomeController@index']);

    //Route::resource('users','UserController');

    Route::get('members',['as'=>'users.index','uses'=>'UserController@index','middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);

    Route::get('members/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => ['permission:user-create']]);

    Route::post('members/create',['as'=>'users.store','uses'=>'UserController@store','middleware' => ['permission:user-create']]);

    Route::get('members/{id}',['as'=>'users.show','uses'=>'UserController@show']);

    Route::get('members/{id}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => ['permission:user-edit']]);

    Route::patch('members/{id}',['as'=>'users.update','uses'=>'UserController@update','middleware' => ['permission:user-edit']]);

    Route::delete('members/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy','middleware' => ['permission:user-delete']]);




    Route::get('agents',['as'=>'agents.index','uses'=>'AgentsController@index','middleware' => ['permission:agents-list|agents-create|agents-edit|agents-delete']]);

    Route::get('agents/create',['as'=>'agents.create','uses'=>'AgentsController@create','middleware' => ['permission:agents-create']]);

    Route::post('agents/create',['as'=>'agents.store','uses'=>'AgentsController@store','middleware' => ['permission:agents-create']]);

    Route::get('agents/{id}',['as'=>'agents.show','uses'=>'AgentsController@show']);

    Route::get('agents/{id}/edit',['as'=>'agents.edit','uses'=>'AgentsController@edit','middleware' => ['permission:agents-edit']]);

    Route::patch('agents/{id}',['as'=>'agents.update','uses'=>'AgentsController@update','middleware' => ['permission:agents-edit']]);

    Route::delete('agents/{id}',['as'=>'agents.destroy','uses'=>'AgentsController@destroy','middleware' => ['permission:agents-delete']]);



      //location ticket system
    Route::get('location',['as'=>'location.index','uses'=>'LocationController@index','middleware' => ['permission:location-list|location-create|location-edit|location-delete']]);
    Route::get('location/create',['as'=>'location.create','uses'=>'LocationController@create','middleware' => ['permission:location-create']]);
    Route::post('location/create',['as'=>'location.store','uses'=>'LocationController@store','middleware' => ['permission:location-create']]);
    Route::get('location/{id}',['as'=>'location.show','uses'=>'LocationController@show']);
    Route::get('location/{id}/edit',['as'=>'location.edit','uses'=>'LocationController@edit','middleware' => ['permission:location-edit']]);
    Route::patch('location/{id}',['as'=>'location.update','uses'=>'LocationController@update','middleware' => ['permission:location-edit']]);
    Route::delete('location/{id}',['as'=>'location.destroy','uses'=>'LocationController@destroy','middleware' => ['permission:location-delete']]);



      //route ticket system
    Route::get('route',['as'=>'route.index','uses'=>'RouteController@index','middleware' => ['permission:route-list|route-create|route-edit|route-delete']]);
    Route::get('route/create',['as'=>'route.create','uses'=>'RouteController@create','middleware' => ['permission:route-create']]);
    Route::post('route/create',['as'=>'route.store','uses'=>'RouteController@store','middleware' => ['permission:route-create']]);
    Route::get('route/{id}',['as'=>'route.show','uses'=>'RouteController@show']);
    Route::get('route/{id}/edit',['as'=>'route.edit','uses'=>'RouteController@edit','middleware' => ['permission:route-edit']]);
    Route::patch('route/{id}',['as'=>'route.update','uses'=>'RouteController@update','middleware' => ['permission:route-edit']]);
    Route::delete('route/{id}',['as'=>'route.destroy','uses'=>'RouteController@destroy','middleware' => ['permission:route-delete']]);

       //AB News 
    Route::get('albarakanews',['as'=>'albarakanews.index','uses'=>'AlbarakanewsController@index','middleware' => ['permission:albarakanews-list|albarakanews-create|albarakanews-edit|albarakanews-delete']]);
    Route::get('albarakanews/create',['as'=>'albarakanews.create','uses'=>'AlbarakanewsController@create','middleware' => ['permission:albarakanews-create']]);
    Route::post('albarakanews/create',['as'=>'albarakanews.store','uses'=>'AlbarakanewsController@store','middleware' => ['permission:albarakanews-create']]);
    Route::get('albarakanews/{id}',['as'=>'albarakanews.show','uses'=>'AlbarakanewsController@show']);
    Route::get('albarakanews/{id}/edit',['as'=>'albarakanews.edit','uses'=>'AlbarakanewsController@edit','middleware' => ['permission:albarakanews-edit']]);
    Route::patch('albarakanews/{id}',['as'=>'albarakanews.update','uses'=>'AlbarakanewsController@update','middleware' => ['permission:albarakanews-edit']]);
    Route::delete('albarakanews/{id}',['as'=>'albarakanews.destroy','uses'=>'AlbarakanewsController@destroy','middleware' => ['permission:albarakanews-delete']]);




     //bus ticket system
    Route::get('bus',['as'=>'bus.index','uses'=>'BusController@index','middleware' => ['permission:bus-list|bus-create|bus-edit|bus-delete']]);
    Route::get('bus/create',['as'=>'bus.create','uses'=>'BusController@create','middleware' => ['permission:bus-create']]);
    Route::post('bus/create',['as'=>'bus.store','uses'=>'BusController@store','middleware' => ['permission:bus-create']]);
    Route::get('bus/{id}',['as'=>'bus.show','uses'=>'BusController@show']);
    Route::get('bus/{id}/edit',['as'=>'bus.edit','uses'=>'BusController@edit','middleware' => ['permission:bus-edit']]);
    Route::patch('bus/{id}',['as'=>'bus.update','uses'=>'BusController@update','middleware' => ['permission:bus-edit']]);
    Route::delete('bus/{id}',['as'=>'bus.destroy','uses'=>'BusController@destroy','middleware' => ['permission:bus-delete']]);


   //bus ticket system
    Route::get('assign',['as'=>'assign.index','uses'=>'AssignController@index','middleware' => ['permission:assign-list|assign-create|assign-edit|assign-delete']]);
    Route::get('assign/create',['as'=>'assign.create','uses'=>'AssignController@create','middleware' => ['permission:assign-create']]);
    Route::post('assign/create',['as'=>'assign.store','uses'=>'AssignController@store','middleware' => ['permission:assign-create']]);
    Route::get('assign/{id}',['as'=>'assign.show','uses'=>'AssignController@show']);
    Route::get('assign/{id}/edit',['as'=>'assign.edit','uses'=>'AssignController@edit','middleware' => ['permission:assign-edit']]);
    Route::patch('assign/{id}',['as'=>'assign.update','uses'=>'AssignController@update','middleware' => ['permission:assign-edit']]);
    Route::delete('assign/{id}',['as'=>'assign.destroy','uses'=>'AssignController@destroy','middleware' => ['permission:assign-delete']]);




   //price ticket system
    Route::get('price',['as'=>'price.index','uses'=>'PriceController@index','middleware' => ['permission:price-list|price-create|price-edit|price-delete']]);
    Route::get('price/create',['as'=>'price.create','uses'=>'PriceController@create','middleware' => ['permission:price-create']]);
    Route::post('price/create',['as'=>'price.store','uses'=>'PriceController@store','middleware' => ['permission:price-create']]);
    Route::get('price/{id}',['as'=>'price.show','uses'=>'PriceController@show']);
    Route::get('price/{id}/edit',['as'=>'price.edit','uses'=>'PriceController@edit','middleware' => ['permission:price-edit']]);
    Route::patch('price/{id}',['as'=>'price.update','uses'=>'PriceController@update','middleware' => ['permission:price-edit']]);
    Route::delete('price/{id}',['as'=>'price.destroy','uses'=>'PriceController@destroy','middleware' => ['permission:price-delete']]);



       //booking ticket system
    Route::get('booking',['as'=>'booking.index','uses'=>'BookingController@index','middleware' => ['permission:booking-list|booking-create|booking-edit|booking-delete']]);
    Route::get('booking/create',['as'=>'booking.create','uses'=>'BookingController@create','middleware' => ['permission:booking-create']]);
    Route::post('booking/create',['as'=>'booking.store','uses'=>'BookingController@store','middleware' => ['permission:booking-create']]);
    Route::get('booking/{id}',['as'=>'booking.show','uses'=>'BookingController@show']);
    Route::get('booking/{id}/edit',['as'=>'booking.edit','uses'=>'BookingController@edit','middleware' => ['permission:booking-edit']]);
    Route::patch('booking/{id}',['as'=>'booking.update','uses'=>'BookingController@update','middleware' => ['permission:booking-edit']]);
    Route::delete('booking/{id}',['as'=>'booking.destroy','uses'=>'BookingController@destroy','middleware' => ['permission:booking-delete']]);
    Route::get('booking/todaystransaction',['as'=>'booking.todaystransaction','uses'=>'BookingController@todaystransaction','middleware' => ['permission:booking-create']]);





        //book issue
    Route::get('chancestopes/stopes/{id}',array('as'=>'chancestopes.stopes','uses'=>'BookingController@chancestopes'));
    Route::get('checkbookingseat/bookingseat/{id}',array('as'=>'bookingseat.seat','uses'=>'BookingController@bookingseat'));




    //member
    Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
    Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
    Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
    Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
    Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
    Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
    Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

    //category
    Route::get('category',['as'=>'category.index','uses'=>'CategoryController@index','middleware' => ['permission:category-list|category-create|category-edit|category-delete']]);
    Route::get('category/create',['as'=>'category.create','uses'=>'CategoryController@create','middleware' => ['permission:category-create']]);
    Route::post('category/create',['as'=>'category.store','uses'=>'CategoryController@store','middleware' => ['permission:category-create']]);
    Route::get('category/{id}',['as'=>'category.show','uses'=>'CategoryController@show']);
    Route::get('category/{id}/edit',['as'=>'category.edit','uses'=>'CategoryController@edit','middleware' => ['permission:category-edit']]);
    Route::patch('category/{id}',['as'=>'category.update','uses'=>'CategoryController@update','middleware' => ['permission:category-edit']]);
    Route::delete('category/{id}',['as'=>'category.destroy','uses'=>'CategoryController@destroy','middleware' => ['permission:category-delete']]);

    //book
    Route::get('book',['as'=>'book.index','uses'=>'BookController@index','middleware' => ['permission:book-list|book-create|book-edit|book-delete']]);
    Route::get('book/create',['as'=>'book.create','uses'=>'BookController@create','middleware' => ['permission:book-create']]);
    Route::post('book/create',['as'=>'book.store','uses'=>'BookController@store','middleware' => ['permission:book-create']]);
    Route::get('book/{id}',['as'=>'book.show','uses'=>'BookController@show']);
    Route::get('book/{id}/edit',['as'=>'book.edit','uses'=>'BookController@edit','middleware' => ['permission:book-edit']]);
    Route::patch('book/{id}',['as'=>'book.update','uses'=>'BookController@update','middleware' => ['permission:book-edit']]);
    Route::delete('book/{id}',['as'=>'book.destroy','uses'=>'BookController@destroy','middleware' => ['permission:book-delete']]);

    //book issue
    Route::get('book_issue',['as'=>'book_issue.index','uses'=>'BookIssueController@index','middleware' => ['permission:book_issue|book-issues-list|book-issues-create|book-issues-edit|book-issues-delete']]);
    Route::get('book_issue/create/{idd?}',['as'=>'book_issue.create','uses'=>'BookIssueController@create','middleware' => ['permission:book-issues-create']]);
    Route::post('book_issue/create',['as'=>'book_issue.store','uses'=>'BookIssueController@store','middleware' => ['permission:book-issues-create']]);
    Route::get('book_issue/{id}',['as'=>'book_issue.show','uses'=>'BookIssueController@show']);
    Route::get('book_issue/{id}/edit',['as'=>'book_issue.edit','uses'=>'BookIssueController@edit','middleware' => ['permission:book-issues-edit']]);
    Route::patch('book_issue/{id}',['as'=>'book_issue.update','uses'=>'BookIssueController@update','middleware' => ['permission:book-issues-edit']]);
    Route::delete('book_issue/{id}',['as'=>'book_issue.destroy','uses'=>'BookIssueController@destroy','middleware' => ['permission:book-issues-delete']]);



    //book issue
    Route::get('changecopy/ajax/{id}',array('as'=>'mychangecopy.ajax','uses'=>'BookIssueController@mychangecopyAjax'));

    Route::get('get_data_by_qr_string/ajax/{id}',array('as'=>'get_data_by_qr_string.ajax','uses'=>'BookIssueController@getDataByQrString'));



    //issues expired list
    Route::get('book_issues/expired',['uses'=>'BookIssueController@expiredIndex','middleware' => ['permission:book_issue|book-issues-list|book-issues-create|book-issues-edit|book-issues-delete']]);
    // return of this week list
    Route::get('book_issues/return',['uses'=>'BookReturnController@returnWeekIndex','middleware' => ['permission:book_issue|book-issues-list|book-issues-create|book-issues-edit|book-issues-delete']]);


    //book return
    Route::get('book_return',['as'=>'book_return.index','uses'=>'BookReturnController@index','middleware' => ['permission:book_return|book-issues-list|book-issues-create|book-issues-edit|book-issues-delete']]);
    Route::get('book_return/create',['as'=>'book_return.create','uses'=>'BookReturnController@create','middleware' => ['permission:book-issues-create']]);
    Route::post('book_return/create',['as'=>'book_return.store','uses'=>'BookReturnController@store','middleware' => ['permission:book-issues-create']]);
    Route::get('book_return/{id}',['as'=>'book_return.show','uses'=>'BookReturnController@show']);
    Route::get('book_return/{id}/edit',['as'=>'book_return.edit','uses'=>'BookReturnController@edit','middleware' => ['permission:book-issues-edit']]);
    Route::patch('book_return/{id}',['as'=>'book_return.update','uses'=>'BookReturnController@update','middleware' => ['permission:book-issues-edit']]);
    Route::delete('book_return/{id}',['as'=>'book_return.destroy','uses'=>'BookReturnController@destroy','middleware' => ['permission:book-issues-delete']]);

    //book ret
    Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'BookReturnController@myformAjax'));
    Route::get('myformQr/ajax/{id}',array('as'=>'myformQr.ajax','uses'=>'BookReturnController@myformAjaxQr'));





    //banners
    Route::get('banners',['as'=>'banners.index','uses'=>'OptionController@index','middleware' => ['permission:banners|banner-list|banner-create|banner-edit|banner-delete']]);
    Route::get('banners/create',['as'=>'banners.create','uses'=>'OptionController@create','middleware' => ['permission:banner-create']]);
    Route::post('banners/create',['as'=>'banners.store','uses'=>'OptionController@store','middleware' => ['permission:banner-create']]);
    Route::get('banners/{id}',['as'=>'banners.show','uses'=>'BookController@show']);
    Route::get('banners/{id}/edit',['as'=>'banners.edit','uses'=>'OptionController@edit','middleware' => ['permission:book-edit']]);
    Route::patch('banners/{id}',['as'=>'banners.update','uses'=>'OptionController@update','middleware' => ['permission:book-edit']]);
    Route::delete('banners/{id}',['as'=>'banners.destroy','uses'=>'OptionController@destroy','middleware' => ['permission:book-delete']]);




    Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
    Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
    Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
    Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
    Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
    Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
    Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);


    Route::get('areainfo',['as'=>'areainfo.index','uses'=>'AreainfoController@index','middleware' => ['permission:areainfo-list|areainfo-create|areainfo-edit|areainfo-delete']]);
    Route::get('areainfo/create',['as'=>'areainfo.create','uses'=>'AreainfoController@create','middleware' => ['permission:areainfo-create']]);
    Route::post('areainfo/create',['as'=>'areainfo.store','uses'=>'AreainfoController@store','middleware' => ['permission:areainfo-create']]);
    Route::get('areainfo/{id}',['as'=>'areainfo.show','uses'=>'AreainfoController@show']);
    Route::get('areainfo/{id}/edit',['as'=>'areainfo.edit','uses'=>'AreainfoController@edit','middleware' => ['permission:areainfo-edit']]);
    Route::patch('areainfo/{id}',['as'=>'areainfo.update','uses'=>'AreainfoController@update','middleware' => ['permission:areainfo-edit']]);
    Route::delete('areainfo/{id}',['as'=>'areainfo.destroy','uses'=>'AreainfoController@destroy','middleware' => ['permission:areainfo-delete']]);

    Route::get('territoryinfo',['as'=>'territoryinfo.index','uses'=>'TerritoryinfoController@index','middleware' => ['permission:territoryinfo-list|territoryinfo-create|territoryinfo-edit|territoryinfo-delete']]);
    Route::get('territoryinfo/create',['as'=>'territoryinfo.create','uses'=>'TerritoryinfoController@create','middleware' => ['permission:territoryinfo-create']]);
    Route::post('territoryinfo/create',['as'=>'territoryinfo.store','uses'=>'TerritoryinfoController@store','middleware' => ['permission:territoryinfo-create']]);
    Route::get('territoryinfo/{id}',['as'=>'territoryinfo.show','uses'=>'TerritoryinfoController@show']);
    Route::get('territoryinfo/{id}/edit',['as'=>'territoryinfo.edit','uses'=>'TerritoryinfoController@edit','middleware' => ['permission:territoryinfo-edit']]);
    Route::patch('territoryinfo/{id}',['as'=>'territoryinfo.update','uses'=>'TerritoryinfoController@update','middleware' => ['permission:territoryinfo-edit']]);
    Route::delete('territoryinfo/{id}',['as'=>'territoryinfo.destroy','uses'=>'TerritoryinfoController@destroy','middleware' => ['permission:territoryinfo-delete']]);

    //institution
    Route::get('institutioninfo',['as'=>'institutioninfo.index','uses'=>'InstitutioninfoController@index','middleware' => ['permission:institutioninfo-list|institutioninfo-create|institutioninfo-edit|institutioninfo-delete']]);
    Route::get('institutioninfo/create',['as'=>'institutioninfo.create','uses'=>'InstitutioninfoController@create','middleware' => ['permission:institutioninfo-create']]);
    Route::post('institutioninfo/create',['as'=>'institutioninfo.store','uses'=>'InstitutioninfoController@store','middleware' => ['permission:institutioninfo-create']]);
    Route::get('institutioninfo/{id}',['as'=>'institutioninfo.show','uses'=>'InstitutioninfoController@show']);
    Route::get('institutioninfo/{id}/edit',['as'=>'institutioninfo.edit','uses'=>'InstitutioninfoController@edit','middleware' => ['permission:institutioninfo-edit']]);
    Route::patch('institutioninfo/{id}',['as'=>'institutioninfo.update','uses'=>'InstitutioninfoController@update','middleware' => ['permission:institutioninfo-edit']]);
    Route::delete('institutioninfo/{id}',['as'=>'institutioninfo.destroy','uses'=>'InstitutioninfoController@destroy','middleware' => ['permission:institutioninfo-delete']]);

    //institutioninfo-doctor
    Route::get('institutioninfo-doctor',['as'=>'institutioninfo-doctor.index','uses'=>'institutioninfoDoctorController@index','middleware' => ['permission:institutioninfo-doctor-list|institutioninfo-doctor-create|institutioninfo-doctor-edit|institutioninfo-doctor-delete']]);
    Route::get('institutioninfo-doctor/create',['as'=>'institutioninfo-doctor.create','uses'=>'institutioninfoDoctorController@create','middleware' => ['permission:institutioninfo-doctor-create']]);
    Route::post('institutioninfo-doctor/create',['as'=>'institutioninfo-doctor.store','uses'=>'institutioninfoDoctorController@store','middleware' => ['permission:institutioninfo-doctor-create']]);
    Route::get('institutioninfo-doctor/{id}',['as'=>'institutioninfo-doctor.show','uses'=>'institutioninfoDoctorController@show']);
    Route::get('institutioninfo-doctor/{id}/edit',['as'=>'institutioninfo-doctor.edit','uses'=>'institutioninfoDoctorController@edit','middleware' => ['permission:institutioninfo-doctor-edit']]);
    Route::patch('institutioninfo-doctor/{id}',['as'=>'institutioninfo-doctor.update','uses'=>'institutioninfoDoctorController@update','middleware' => ['permission:institutioninfo-doctor-edit']]);
    Route::delete('institutioninfo-doctor/{id}',['as'=>'institutioninfo-doctor.destroy','uses'=>'institutioninfoDoctorController@destroy','middleware' => ['permission:institutioninfo-doctor-delete']]);

    //institution sub
    Route::get('institutioninfo-sub',['as'=>'institutioninfo-sub.getSubInstitution','uses'=>'InstitutioninfoController@getSubInstitution','middleware' => ['permission:institution-sub-info|institutioninfo-sub-create|institutioninfo-sub-update|institutioninfo-sub-delete']]);
    Route::get('institutioninfo-sub/create',['as'=>'institutioninfo-sub.createSubInstitution','uses'=>'InstitutioninfoController@createSubInstitution','middleware' => ['permission:iinstitution-sub-info|institutioninfo-sub-createinstitutioninfo-sub-update|institutioninfo-sub-delete']]);
    Route::post('institutioninfo-sub/create',['as'=>'institutioninfo-sub.storeSubInstitution','uses'=>'InstitutioninfoController@storeSubInstitution','middleware' => ['permission:institution-sub-info|institutioninfo-sub-create|institutioninfo-sub-update|institutioninfo-sub-delete']]);
    Route::get('institutioninfo-sub/{id}',['as'=>'institutioninfo-sub.showSubInstitution','uses'=>'InstitutioninfoController@showSubInstitution','middleware' => ['permission:institution-sub-info|institutioninfo-sub-create|institutioninfo-sub-update|institutioninfo-sub-delete']]);
    Route::get('institutioninfo-sub/{id}/edit',['as'=>'institutioninfo-sub.editSubInstitution','uses'=>'InstitutioninfoController@editSubInstitution','middleware' => ['permission:institution-sub-info|institutioninfo-sub-create|institutioninfo-sub-update|institutioninfo-sub-delete']]);
    Route::patch('institutioninfo-sub/{id}',['as'=>'institutioninfo-sub.updateSubInstitution','uses'=>'InstitutioninfoController@updateSubInstitution','middleware' => ['permission:institution-sub-info|institutioninfo-sub-create|institutioninfo-sub-update|institutioninfo-sub-delete']]);
    Route::delete('institutioninfo-sub/{id}',['as'=>'institutioninfo-sub.destroySubInstitution','uses'=>'InstitutioninfoController@destroySubInstitution','middleware' => ['permission:institution-sub-info|institutioninfo-sub-create|institutioninfo-sub-update|institutioninfo-sub-delete']]);

    //Wholesaler
    Route::get('wholesaler',['as'=>'wholesaler.index','uses'=>'WholesalerController@index','middleware' => ['permission:wholesaler-list|wholesaler-create|wholesaler-edit|wholesaler-delete']]);
    Route::get('wholesaler/create',['as'=>'wholesaler.create','uses'=>'WholesalerController@create','middleware' => ['permission:wholesaler-list|wholesaler-create|wholesaler-edit|wholesaler-delete']]);
    Route::post('wholesaler/store',['as'=>'wholesaler.store','uses'=>'WholesalerController@store','middleware' => ['permission:wholesaler-list|wholesaler-create|wholesaler-edit|wholesaler-delete']]);
    Route::get('wholesaler/{id}',['as'=>'wholesaler.show','uses'=>'WholesalerController@show','middleware' => ['permission:wholesaler-list|wholesaler-create|wholesaler-edit|wholesaler-delete']]);
    Route::get('wholesaler/{id}/edit',['as'=>'wholesaler.edit','uses'=>'WholesalerController@edit','middleware' => ['permission:wholesaler-list|wholesaler-create|wholesaler-edit|wholesaler-delete']]);
    Route::patch('wholesaler/{id}',['as'=>'wholesaler.update','uses'=>'WholesalerController@update','middleware' => ['permission:wholesaler-list|wholesaler-create|wholesaler-edit|wholesaler-delete']]);
    Route::delete('wholesaler/{id}',['as'=>'wholesaler.destroy','uses'=>'WholesalerController@destroy','middleware' => ['permission:wholesaler-list|wholesaler-create|wholesaler-edit|wholesaler-delete']]);

    //sales
    Route::get('sales',['as'=>'sales.index','uses'=>'SalesController@index','middleware' => ['permission:sales-list|sales-create|sales-edit|sales-delete']]);
    Route::get('sales/create',['as'=>'sales.create','uses'=>'SalesController@create','middleware' => ['permission:sales-list|sales-create|sales-edit|sales-delete']]);
    Route::post('sales/store',['as'=>'sales.store','uses'=>'SalesController@store','middleware' => ['permission:sales-list|sales-create|sales-edit|sales-delete']]);
    Route::get('sales/{id}',['as'=>'sales.show','uses'=>'SalesController@show','middleware' => ['permission:sales-list|sales-create|sales-edit|sales-delete']]);
    Route::get('sales/{id}/edit',['as'=>'sales.edit','uses'=>'SalesController@edit','middleware' => ['permission:sales-list|sales-create|sales-edit|sales-delete']]);
    Route::patch('sales/{id}',['as'=>'sales.update','uses'=>'SalesController@update','middleware' => ['permission:sales-list|sales-create|sales-edit|sales-delete']]);
    Route::delete('sales/{id}',['as'=>'sales.destroy','uses'=>'SalesController@destroy','middleware' => ['permission:sales-list|sales-create|sales-edit|sales-delete']]);

    //EmployeeTargetDoctor
    Route::get('employee-target-doctor',['as'=>'employee-target-doctor.index','uses'=>'EmployeeTargetDoctorController@index','middleware' => ['permission:employee-target-doctor-call|employee-target-doctor-call-create|employee-target-doctor-call-update|employee-target-doctor-call-delete']]);
    Route::get('employee-target-doctor/create',['as'=>'employee-target-doctor.create','uses'=>'EmployeeTargetDoctorController@create','middleware' => ['permission:employee-target-doctor-call|employee-target-doctor-call-create|employee-target-doctor-call-update|employee-target-doctor-call-delete']]);
    Route::post('employee-target-doctor/store',['as'=>'employee-target-doctor.store','uses'=>'EmployeeTargetDoctorController@store','middleware' => ['permission:employee-target-doctor-call|employee-target-doctor-call-create|employee-target-doctor-call-update|employee-target-doctor-call-delete']]);
    Route::get('employee-target-doctor/{id}',['as'=>'employee-target-doctor.show','uses'=>'EmployeeTargetDoctorController@show','middleware' => ['permission:employee-target-doctor-call|employee-target-doctor-call-create|employee-target-doctor-call-update|employee-target-doctor-call-delete']]);
    Route::get('employee-target-doctor/{id}/edit',['as'=>'employee-target-doctor.edit','uses'=>'EmployeeTargetDoctorController@edit','middleware' => ['permission:employee-target-doctor-call|employee-target-doctor-call-create|employee-target-doctor-call-update|employee-target-doctor-call-delete']]);
    Route::patch('employee-target-doctor/{id}',['as'=>'employee-target-doctor.update','uses'=>'EmployeeTargetDoctorController@update','middleware' => ['permission:employee-target-doctor-call|employee-target-doctor-call-create|employee-target-doctor-call-update|employee-target-doctor-call-delete']]);
    Route::delete('employee-target-doctor/{id}',['as'=>'employee-target-doctor.destroy','uses'=>'EmployeeTargetDoctorController@destroy','middleware' => ['permission:employee-target-doctor-call|employee-target-doctor-call-create|employee-target-doctor-call-update|employee-target-doctor-call-delete']]);

    //EmployeeTargetInstitution
    Route::get('employee-target-institution',['as'=>'employee-target-institution.index','uses'=>'EmployeeTargetInstitutionController@index','middleware' => ['permission:employee-target-institution-call-list|employee-target-institution-call-create|employee-target-institution-call-update|employee-target-institution-call-delete']]);
    Route::get('employee-target-institution/create',['as'=>'employee-target-institution.create','uses'=>'EmployeeTargetInstitutionController@create','middleware' => ['permission:employee-target-institution-call-list|employee-target-institution-call-create|employee-target-institution-call-update|employee-target-institution-call-delete']]);
    Route::post('employee-target-institution/store',['as'=>'employee-target-institution.store','uses'=>'EmployeeTargetInstitutionController@store','middleware' => ['permission:employee-target-institution-call-list|employee-target-institution-call-create|employee-target-institution-call-update|employee-target-institution-call-delete']]);
    Route::get('employee-target-institution/{id}',['as'=>'employee-target-institution.show','uses'=>'EmployeeTargetInstitutionController@show','middleware' => ['permission:employee-target-institution-call-list|employee-target-institution-call-create|employee-target-institution-call-update|employee-target-institution-call-delete']]);
    Route::get('employee-target-institution/{id}/edit',['as'=>'employee-target-institution.edit','uses'=>'EmployeeTargetInstitutionController@edit','middleware' => ['permission:employee-target-institution-call-list|employee-target-institution-call-create|employee-target-institution-call-update|employee-target-institution-call-delete']]);
    Route::patch('employee-target-institution/{id}',['as'=>'employee-target-institution.update','uses'=>'EmployeeTargetInstitutionController@update','middleware' => ['permission:employee-target-institution-call-list|employee-target-institution-call-create|employee-target-institution-call-update|employee-target-institution-call-delete']]);
    Route::delete('employee-target-institution/{id}',['as'=>'employee-target-institution.destroy','uses'=>'EmployeeTargetInstitutionController@destroy','middleware' => ['permission:employee-target-institution-call-list|employee-target-institution-call-create|employee-target-institution-call-update|employee-target-institution-call-delete']]);

    //department
    Route::get('departmentinfo',['as'=>'departmentinfo.index','uses'=>'DepartmentinfoController@index','middleware' => ['permission:departmentinfo-list|departmentinfo-create|departmentinfo-edit|departmentinfo-delete']]);
    Route::get('departmentinfo/create',['as'=>'departmentinfo.create','uses'=>'DepartmentinfoController@create','middleware' => ['permission:departmentinfo-create']]);
    Route::post('departmentinfo/create',['as'=>'departmentinfo.store','uses'=>'DepartmentinfoController@store','middleware' => ['permission:departmentinfo-create']]);
    Route::get('departmentinfo/{id}',['as'=>'departmentinfo.show','uses'=>'DepartmentinfoController@show']);
    Route::get('departmentinfo/{id}/edit',['as'=>'departmentinfo.edit','uses'=>'DepartmentinfoController@edit','middleware' => ['permission:departmentinfo-edit']]);
    Route::patch('departmentinfo/{id}',['as'=>'departmentinfo.update','uses'=>'DepartmentinfoController@update','middleware' => ['permission:departmentinfo-edit']]);
    Route::delete('departmentinfo/{id}',['as'=>'departmentinfo.destroy','uses'=>'DepartmentinfoController@destroy','middleware' => ['permission:departmentinfo-delete']]);


    Route::get('clinicinfo',['as'=>'clinicinfo.index','uses'=>'ClinicinfoController@index','middleware' => ['permission:clinicinfo-list|clinicinfo-create|clinicinfo-edit|clinicinfo-delete']]);
    Route::get('clinicinfo/create',['as'=>'clinicinfo.create','uses'=>'ClinicinfoController@create','middleware' => ['permission:clinicinfo-create']]);
    Route::post('clinicinfo/create',['as'=>'clinicinfo.store','uses'=>'ClinicinfoController@store','middleware' => ['permission:clinicinfo-create']]);
    Route::get('clinicinfo/{id}',['as'=>'clinicinfo.show','uses'=>'ClinicinfoController@show']);
    Route::get('clinicinfo/{id}/edit',['as'=>'clinicinfo.edit','uses'=>'ClinicinfoController@edit','middleware' => ['permission:clinicinfo-edit']]);
    Route::patch('clinicinfo/{id}',['as'=>'clinicinfo.update','uses'=>'ClinicinfoController@update','middleware' => ['permission:clinicinfo-edit']]);
    Route::delete('clinicinfo/{id}',['as'=>'clinicinfo.destroy','uses'=>'ClinicinfoController@destroy','middleware' => ['permission:clinicinfo-delete']]);



    Route::get('hospitalinfo',['as'=>'hospitalinfo.index','uses'=>'HospitalinfoController@index','middleware' => ['permission:hospitalinfo-list|hospitalinfo-create|hospitalinfo-edit|hospitalinfo-delete']]);
    Route::get('hospitalinfo/create',['as'=>'hospitalinfo.create','uses'=>'HospitalinfoController@create','middleware' => ['permission:hospitalinfo-create']]);
    Route::post('hospitalinfo/create',['as'=>'hospitalinfo.store','uses'=>'HospitalinfoController@store','middleware' => ['permission:hospitalinfo-create']]);
    Route::get('hospitalinfo/{id}',['as'=>'hospitalinfo.show','uses'=>'HospitalinfoController@show']);
    Route::get('hospitalinfo/{id}/edit',['as'=>'hospitalinfo.edit','uses'=>'HospitalinfoController@edit','middleware' => ['permission:hospitalinfo-edit']]);
    Route::patch('hospitalinfo/{id}',['as'=>'hospitalinfo.update','uses'=>'HospitalinfoController@update','middleware' => ['permission:hospitalinfo-edit']]);
    Route::delete('hospitalinfo/{id}',['as'=>'hospitalinfo.destroy','uses'=>'HospitalinfoController@destroy','middleware' => ['permission:hospitalinfo-delete']]);


    Route::get('pharmacyinfo',['as'=>'pharmacyinfo.index','uses'=>'PharmacyinfoController@index','middleware' => ['permission:pharmacyinfo-list|pharmacyinfo-create|pharmacyinfo-edit|pharmacyinfo-delete']]);
    Route::get('pharmacyinfo/create',['as'=>'pharmacyinfo.create','uses'=>'PharmacyinfoController@create','middleware' => ['permission:pharmacyinfo-create']]);
    Route::post('pharmacyinfo/create',['as'=>'pharmacyinfo.store','uses'=>'PharmacyinfoController@store','middleware' => ['permission:pharmacyinfo-create']]);
    Route::get('pharmacyinfo/{id}',['as'=>'pharmacyinfo.show','uses'=>'PharmacyinfoController@show']);
    Route::get('pharmacyinfo/{id}/edit',['as'=>'pharmacyinfo.edit','uses'=>'PharmacyinfoController@edit','middleware' => ['permission:pharmacyinfo-edit']]);
    Route::patch('pharmacyinfo/{id}',['as'=>'pharmacyinfo.update','uses'=>'PharmacyinfoController@update','middleware' => ['permission:pharmacyinfo-edit']]);
    Route::delete('pharmacyinfo/{id}',['as'=>'pharmacyinfo.destroy','uses'=>'PharmacyinfoController@destroy','middleware' => ['permission:pharmacyinfo-delete']]);

    //notice
    Route::get('notice',['as'=>'notice.index','uses'=>'NoticeController@index','middleware' => ['permission:notice-list|notice-create|notice-edit|notice-delete']]);
    Route::get('notice/create',['as'=>'notice.create','uses'=>'NoticeController@create','middleware' => ['permission:notice-create']]);
    Route::post('notice/create',['as'=>'notice.store','uses'=>'NoticeController@store','middleware' => ['permission:notice-create']]);
    Route::get('notice/{id}',['as'=>'notice.show','uses'=>'NoticeController@show']);
    Route::get('notice/{id}/edit',['as'=>'notice.edit','uses'=>'NoticeController@edit','middleware' => ['permission:notice-edit']]);
    Route::patch('notice/{id}',['as'=>'notice.update','uses'=>'NoticeController@update','middleware' => ['permission:notice-edit']]);
    Route::delete('notice/{id}',['as'=>'notice.destroy','uses'=>'NoticeController@destroy','middleware' => ['permission:notice-delete']]);

    //employeeTarget
    Route::get('employeetarget',['as'=>'employeetarget.index','uses'=>'EmployeetargetController@index','middleware' => ['permission:employeetarget-list|employeetarget-create|employeetarget-edit|employeetarget-delete']]);
    Route::get('employeetarget/create',['as'=>'employeetarget.create','uses'=>'EmployeetargetController@create','middleware' => ['permission:employeetarget-create']]);
    Route::post('employeetarget/create',['as'=>'employeetarget.store','uses'=>'EmployeetargetController@store','middleware' => ['permission:employeetarget-create']]);
    Route::get('employeetarget/{id}',['as'=>'employeetarget.show','uses'=>'EmployeetargetController@show']);
    Route::get('employeetarget/{id}/edit',['as'=>'employeetarget.edit','uses'=>'EmployeetargetController@edit','middleware' => ['permission:employeetarget-edit']]);
    Route::patch('employeetarget/{id}',['as'=>'employeetarget.update','uses'=>'EmployeetargetController@update','middleware' => ['permission:employeetarget-edit']]);
    Route::delete('employeetarget/{id}',['as'=>'employeetarget.destroy','uses'=>'EmployeetargetController@destroy','middleware' => ['permission:employeetarget-delete']]);

    //employee
    Route::get('employee',['as'=>'employee.index','uses'=>'EmployeesController@index','middleware' => ['permission:employee-list|employee-create|employee-edit|employee-delete']]);
    Route::get('employee/create',['as'=>'employee.create','uses'=>'EmployeesController@create','middleware' => ['permission:employee-create']]);
    Route::post('employee/create',['as'=>'employee.store','uses'=>'EmployeesController@store','middleware' => ['permission:employee-create']]);
    Route::get('employee/{id}',['as'=>'employee.show','uses'=>'EmployeesController@show']);
    Route::get('employee/{id}/edit',['as'=>'employee.edit','uses'=>'EmployeesController@edit','middleware' => ['permission:employee-edit']]);
    Route::patch('employee/{id}',['as'=>'employee.update','uses'=>'EmployeesController@update','middleware' => ['permission:employee-edit']]);
    Route::delete('employee/{id}',['as'=>'employee.destroy','uses'=>'EmployeesController@destroy','middleware' => ['permission:employee-delete']]);

    //doctor
    Route::get('doctor',['as'=>'doctor.index','uses'=>'DoctorinfoController@index','middleware' => ['permission:doctor-list|doctor-create|doctor-edit|doctor-delete']]);
    Route::get('doctor/create',['as'=>'doctor.create','uses'=>'DoctorinfoController@create','middleware' => ['permission:doctor-create']]);
    Route::post('doctor/create',['as'=>'doctor.store','uses'=>'DoctorinfoController@store','middleware' => ['permission:doctor-create']]);
    Route::get('doctor/{id}',['as'=>'doctor.show','uses'=>'DoctorinfoController@show']);
    Route::get('doctor/{id}/edit',['as'=>'doctor.edit','uses'=>'DoctorinfoController@edit','middleware' => ['permission:doctor-edit']]);
    Route::patch('doctor/{id}',['as'=>'doctor.update','uses'=>'DoctorinfoController@update','middleware' => ['permission:doctor-edit']]);
    Route::delete('doctor/{id}',['as'=>'doctor.destroy','uses'=>'DoctorinfoController@destroy','middleware' => ['permission:doctor-delete']]);

    //assign to teritory
    Route::get('assigntoteritory',['as'=>'assigntoteritory.index','uses'=>'AssigntoteritoryController@index','middleware' => ['permission:assigntoteritory-list|assigntoteritory-create|assigntoteritory-edit|assigntoteritory-delete']]);
    Route::get('assigntoteritory/create',['as'=>'assigntoteritory.create','uses'=>'AssigntoteritoryController@create','middleware' => ['permission:assigntoteritory-create']]);
    Route::post('assigntoteritory/create',['as'=>'assigntoteritory.store','uses'=>'AssigntoteritoryController@store','middleware' => ['permission:assigntoteritory-create']]);
    Route::get('assigntoteritory/{id}',['as'=>'assigntoteritory.show','uses'=>'AssigntoteritoryController@show']);
    Route::get('assigntoteritory/{id}/edit',['as'=>'assigntoteritory.edit','uses'=>'AssigntoteritoryController@edit','middleware' => ['permission:assigntoteritory-edit']]);
    Route::patch('assigntoteritory/{id}',['as'=>'assigntoteritory.update','uses'=>'AssigntoteritoryController@update','middleware' => ['permission:assigntoteritory-edit']]);
    Route::delete('assigntoteritory/{id}',['as'=>'assigntoteritory.destroy','uses'=>'AssigntoteritoryController@destroy','middleware' => ['permission:assigntoteritory-delete']]);

    //prefixer
    Route::get('prefixer',['as'=>'prefixer.index','uses'=>'PrefixerController@index','middleware' => ['permission:prefixer-list|prefixer-create|prefixer-edit|prefixer-delete']]);
    Route::get('prefixer/create',['as'=>'prefixer.create','uses'=>'PrefixerController@create','middleware' => ['permission:prefixer-create']]);
    Route::post('prefixer/create',['as'=>'prefixer.store','uses'=>'PrefixerController@store','middleware' => ['permission:prefixer-create']]);
    Route::get('prefixer/{id}',['as'=>'prefixer.show','uses'=>'PrefixerController@show']);
    Route::get('prefixer/{id}/edit',['as'=>'prefixer.edit','uses'=>'PrefixerController@edit','middleware' => ['permission:prefixer-edit']]);
    Route::patch('prefixer/{id}',['as'=>'prefixer.update','uses'=>'PrefixerController@update','middleware' => ['permission:prefixer-edit']]);
    Route::delete('prefixer/{id}',['as'=>'prefixer.destroy','uses'=>'PrefixerController@destroy','middleware' => ['permission:prefixer-delete']]);

    //medicine
    Route::get('medicine',['as'=>'medicine.index','uses'=>'MedicineController@index','middleware' => ['permission:medicine-list|medicine-create|medicine-edit|medicine-delete']]);
    Route::get('medicine/create',['as'=>'medicine.create','uses'=>'MedicineController@create','middleware' => ['permission:medicine-create']]);
    Route::post('medicine/create',['as'=>'medicine.store','uses'=>'MedicineController@store','middleware' => ['permission:medicine-create']]);
    Route::get('medicine/{id}',['as'=>'medicine.show','uses'=>'MedicineController@show']);
    Route::get('medicine/{id}/edit',['as'=>'medicine.edit','uses'=>'MedicineController@edit','middleware' => ['permission:medicine-edit']]);
    Route::patch('medicine/{id}',['as'=>'medicine.update','uses'=>'MedicineController@update','middleware' => ['permission:medicine-edit']]);
    Route::delete('medicine/{id}',['as'=>'medicine.destroy','uses'=>'MedicineController@destroy','middleware' => ['permission:medicine-delete']]);

    //todoinfo
    Route::get('todoinfo',['as'=>'todoinfo.index','uses'=>'TodoinfoController@index','middleware' => ['permission:todoinfo-list|todoinfo-create|todoinfo-edit|todoinfo-delete']]);
    Route::get('todoinfo/create',['as'=>'todoinfo.create','uses'=>'TodoinfoController@create','middleware' => ['permission:todoinfo-create']]);
    Route::post('todoinfo/create',['as'=>'todoinfo.store','uses'=>'TodoinfoController@store','middleware' => ['permission:todoinfo-create']]);
    Route::get('todoinfo/{id}',['as'=>'todoinfo.show','uses'=>'TodoinfoController@show']);
    Route::get('todoinfo/{id}/edit',['as'=>'todoinfo.edit','uses'=>'TodoinfoController@edit','middleware' => ['permission:todoinfo-edit']]);
    Route::patch('todoinfo/{id}',['as'=>'todoinfo.update','uses'=>'TodoinfoController@update','middleware' => ['permission:todoinfo-edit']]);
    Route::delete('todoinfo/{id}',['as'=>'todoinfo.destroy','uses'=>'TodoinfoController@destroy','middleware' => ['permission:todoinfo-delete']]);

    //messageinfo
    Route::get('messageinfo',['as'=>'messageinfo.index','uses'=>'MessageinfoController@index','middleware' => ['permission:messageinfo-list|messageinfo-create|messageinfo-edit|messageinfo-delete']]);
    Route::get('messageinfo/create',['as'=>'messageinfo.create','uses'=>'MessageinfoController@create','middleware' => ['permission:messageinfo-create']]);
    Route::post('messageinfo/create',['as'=>'messageinfo.store','uses'=>'MessageinfoController@store','middleware' => ['permission:messageinfo-create']]);
    Route::get('messageinfo/{id}',['as'=>'messageinfo.show','uses'=>'MessageinfoController@show']);
    Route::get('messageinfo/{id}/edit',['as'=>'messageinfo.edit','uses'=>'MessageinfoController@edit','middleware' => ['permission:messageinfo-edit']]);
    Route::patch('messageinfo/{id}',['as'=>'messageinfo.update','uses'=>'MessageinfoController@update','middleware' => ['permission:messageinfo-edit']]);
    Route::delete('messageinfo/{id}',['as'=>'messageinfo.destroy','uses'=>'MessageinfoController@destroy','middleware' => ['permission:messageinfo-delete']]);

    //visit
    Route::get('visit',['as'=>'visit.index','uses'=>'VisitController@index','middleware' => ['permission:visit-list|visit-create|visit-edit|visit-delete']]);
    Route::get('visit/create',['as'=>'visit.create','uses'=>'VisitController@create','middleware' => ['permission:visit-create']]);
    Route::post('visit/create',['as'=>'visit.store','uses'=>'VisitController@store','middleware' => ['permission:visit-create']]);
    Route::get('visit/{id}',['as'=>'visit.show','uses'=>'VisitController@show']);
    Route::get('visit/{id}/edit',['as'=>'visit.edit','uses'=>'VisitController@edit','middleware' => ['permission:visit-edit']]);
    Route::patch('visit/{id}',['as'=>'visit.update','uses'=>'VisitController@update','middleware' => ['permission:visit-edit']]);
    Route::delete('visit/{id}',['as'=>'visit.destroy','uses'=>'VisitController@destroy','middleware' => ['permission:visit-delete']]);

    //call
    Route::get('call',['as'=>'call.index','uses'=>'CallController@index','middleware' => ['permission:call-list|call-create|call-edit|call-delete']]);
    Route::get('call/create',['as'=>'call.create','uses'=>'CallController@create','middleware' => ['permission:call-create']]);
    Route::post('call/create',['as'=>'call.store','uses'=>'CallController@store','middleware' => ['permission:call-create']]);
    Route::get('call/{id}',['as'=>'call.show','uses'=>'CallController@show']);
    Route::get('call/{id}/edit',['as'=>'call.edit','uses'=>'CallController@edit','middleware' => ['permission:call-edit']]);
    Route::patch('call/{id}',['as'=>'call.update','uses'=>'CallController@update','middleware' => ['permission:call-edit']]);
    Route::delete('call/{id}',['as'=>'call.destroy','uses'=>'CallController@destroy','middleware' => ['permission:call-delete']]);



    Route::get('/{slug}', 'SubmenupageController@index')->where('slug', '[\w\d\-\_]+');
});



