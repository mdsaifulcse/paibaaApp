<?php

Route::get('/ads/{divisionLink}/{catLink}','Frontend\AdController@categoryWiseAds');

Route::get('ad/{adLink}','Frontend\AdController@singleAdDetails');
Route::get('edit-blog-ans/{ansEditId}','Frontend\AdController@loadBlogAnsById');

Route::get('price/{price}','Frontend\AdController@showAdsByAdPriceTitle');

Route::get('tag/{tag}','Frontend\AdController@showAdsByAdTags');

Route::get('profile/{userName}','Frontend\AdController@viewAuthorAllAds');

Route::get('social-login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('social-login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/page/{pageLink}','Frontend\PaibaController@singlePageDetail');



Route::resource('/register-client','Frontend\ClientRegistrationController');
Route::get('check-unique-user/{data}/{userID?}','Frontend\ClientRegistrationController@uniqueUserValidation');

Route::get('nav-sub-category-by-category','Frontend\AdController@getNavSubCategoryName');
Route::get('search-nav-sub-category/{category}','Frontend\AdController@getNavSubCategoryData');
Route::get('search-nav-location/{category}','Frontend\AdController@getNavLocationData');

Route::get('/load-comments-data/{adPostId}','Frontend\AdPostCommentController@index');

Route::get('/load-blog-replay-data/{ansId}','Frontend\AnswerReplayController@show');

Route::middleware(['auth','disablepreventback','client'])->group(function () {

    // blog answer & replay -----------------
    Route::resource('customer-order','Frontend\OrderController');


    // blog answer & replay -----------------
    Route::resource('blog-answer','Frontend\BlogAnswerController');
    Route::resource('blog-ans-replay','Frontend\AnswerReplayController');
    Route::get('blog-ans-replay-save','Frontend\AnswerReplayController@saveBlogAnsReplay');


    // Chat Message with ad post ----------------
    Route::get('/load-chat-data/{adPostId}/{offer}/{userId}','Frontend\PriceNegotiationController@index');
    Route::get('/send-chat-message','Frontend\PriceNegotiationController@saveChatMessage');

    Route::get('/load-chat-data-by-user/{adPostId}/{userId}','Frontend\PriceNegotiationController@getChatDataByPerson');
    Route::get('/get-chat-user-info/{userId}','Frontend\PriceNegotiationController@loadChatUserData');



    // save ad-post comment
    Route::resource('ad-public-comment','Frontend\AdPostCommentController');
    Route::get('/ad-public-comment-save','Frontend\AdPostCommentController@savePublicComment');


    Route::resource('price-negotiation','Frontend\PriceNegotiationController');

    Route::resource('ad-post','Frontend\AdPostController');
    Route::get('sub-category-by-category','Frontend\AdPostController@getSubCategoryData');

    Route::get('get-ad-location','Frontend\AdPostController@returnLocationData');

    Route::get('load-area-by-division-town-on-ad-post/{divisionTown}','Frontend\AdPostController@loadAreaByDivisionTown');

    Route::get('my-ads','Frontend\AdPostController@myAllPost');

    Route::get('load-sub-category-list/{categoryId}','Frontend\AdPostController@loadSubCategory');

    Route::get('/my-profile', 'Frontend\MyProfileController@myProfileSetting');
    Route::post('/my-profile', 'Frontend\MyProfileController@updateMyProfile');

    Route::post('/change-my-password', 'Frontend\MyProfileController@updateMyPassword')->name('change.my.password');
    Route::get('/change-my-username', 'Frontend\MyProfileController@showSetUserNameForm');
    Route::post('/change-my-username', 'Frontend\MyProfileController@updateMyNewUserName')->name('change.my.username');

    Route::get('/load-area-on-profile/{divisionTown}', 'Frontend\MyProfileController@loadAreaByDivisionTown');
    Route::get('/client-dashboard', 'Frontend\ClientRegistrationController@index');

});



//client