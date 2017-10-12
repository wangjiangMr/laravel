<?php

//-------------前台------------------------

//首页
Route::get('/', 'Web\IndexController@index');
//关于我们
Route::get('about_us', 'Web\IndexController@about_us');
//联系我们
Route::get('contact_us', 'Web\IndexController@contact_us');
Route::match(['get','post'],'contact_handle', 'Web\IndexController@msg_handle');
//404页面
Route::get('error', 'Web\IndexController@error');
//帮助中心
Route::get('help/{id?}', 'Web\IndexController@help');
//帮助中心搜索
Route::match(['post','get'],'help_search', 'Web\IndexController@help_search');

//登录
Route::get('sign_in', 'Web\IndexController@sign_in');
Route::post('user_log', 'Web\IndexController@user_log');

//注册
Route::get('sign_up', 'Web\IndexController@sign_up');
Route::post('reg_val', 'Web\IndexController@reg_val');
Route::post('mail_val', 'Web\IndexController@mail_val');
Route::post('reg', 'Web\IndexController@reg');

//图片
Route::get('pics/{cateid?}', 'Web\IndexController@pro');

//文章
Route::get('article/{id?}', 'Web\IndexController@article');
Route::get('art/detail/{id}', 'Web\IndexController@article_detail');
Route::match(['post'],'change_vote', 'Web\IndexController@change_vote');
Route::match(['post'],'add_comment', 'Web\IndexController@add_comment');
Route::get('art/search', 'Web\IndexController@art_search');
Route::get('company/{id}', 'Web\IndexController@company');


//个人中心
Route::get('center', 'Web\IndexController@person_center');
Route::get('sign_out', 'Web\IndexController@sign_out');
Route::post('user/modify', 'Web\IndexController@modify');
Route::post('change_headimg', 'Web\IndexController@change_headimg');

//品牌
Route::get('brand/{cateid?}', 'Web\IndexController@brand');

//问答
Route::get('question/{cateid?}', 'Web\IndexController@qustion');
Route::get('qus/detail/{id}', 'Web\IndexController@qus_detail');
Route::post('add_asw', 'Web\IndexController@add_asw');
Route::post('add_qus', 'Web\IndexController@add_qus');




//敬请期待
Route::get('coming_soon', 'Web\IndexController@coming_soon');



//-----------------后台-------------------


Route::group(['prefix'=>'admin','middleware'=>'log'],function(){
    //首页
    Route::get('/','Admin\IndexController@index');
    //登出
    Route::get('login_out','Admin\IndexController@login_out');
    //菜单管理
    Route::get('menu','Admin\IndexController@manage_menu');
    Route::get('menu/{type}/{id?}','Admin\IndexController@manage_menu');
    Route::match(['post','get','put'],'form_menu/{type}/{id?}','Admin\IndexController@change_menu');

    //图片管理
    Route::get('picture/{id?}','Admin\PictureController@index');
    Route::get('pic/{cateid?}','Admin\PictureController@lists');
    Route::match(['post','get','put'],'pic/add_pic','Admin\PictureController@add_pic');
    Route::match(['get'],'pic/handle','Admin\PictureController@handle');

    //文章管理
    Route::get('article','Admin\ArticleController@index');
    Route::get('edit_art/{id?}','Admin\ArticleController@edit_art');
    Route::match(['post','get'],'text_pic','Admin\ArticleController@text_pic');
    Route::match(['post','get'],'add_art','Admin\ArticleController@add_art');
    Route::match(['get'],'dele_art','Admin\ArticleController@dele_art');

    //分类管理
    Route::get('cate','Admin\CateController@index');
    Route::get('cate_handle','Admin\CateController@cate_handle');

    //导航管理
    Route::get('navigation','Admin\NavigationController@index');
    Route::get('edit_nav/{id?}','Admin\NavigationController@edit_nav');
    Route::match(['post','get'],'nav_handle','Admin\NavigationController@nav_handle');

    //品牌管理
    Route::get('brand','Admin\BrandController@index');
    Route::get('edit_brand/{id?}','Admin\BrandController@edit_brand');
    Route::match(['post','get'],'brand_handle','Admin\BrandController@brand_handle');

    //广告管理
    Route::get('adv','Admin\AdvController@index');
    Route::get('adv_pic/{id}','Admin\AdvController@adv_pic');
    Route::get('adv_edit/{id?}','Admin\AdvController@adv_edit');
    Route::get('adv_pic_edit/t{tid}/{id?}','Admin\AdvController@adv_pic_edit');
    Route::match(['post','get'],'adv_handle','Admin\AdvController@adv_handle');
    Route::match(['post','get'],'adv_pic_handle','Admin\AdvController@adv_pic_handle');

    //配置管理
    Route::get('cfg','Admin\CfgController@index');
    Route::get('cfg_edit/{id?}','Admin\CfgController@cfg_edit');
    Route::match(['post','get'],'cfg_handle','Admin\CfgController@cfg_handle');

    //问答管理
    Route::get('qus_list','Admin\QusController@index');
    Route::get('answer_list/{id}','Admin\QusController@answer_list');
    Route::get('qus_edit/{id?}','Admin\QusController@qus_edit');
    Route::get('answer_edit/q{qid}/{id?}','Admin\QusController@answer_edit');
    Route::match(['post','get'],'qus_handle','Admin\QusController@qus_handle');
    Route::match(['post','get'],'answer_handle','Admin\QusController@answer_handle');


    //用户管理
    Route::get('user','Admin\UserController@index');
    Route::get('user_edit/{id?}','Admin\UserController@user_edit');
    Route::match(['post','get'],'user_handle','Admin\UserController@user_handle');

    //我们的团队
    Route::get('team','Admin\TeamController@index');
    Route::get('team_edit/{id?}','Admin\TeamController@team_edit');
    Route::match(['post','get'],'team_handle','Admin\TeamController@team_handle');

    //留言管理
    Route::get('msg','Admin\MsgController@index');
    Route::match(['post','get'],'msg_handle','Admin\MsgController@msg_handle');

    //友情链接
    Route::get('frendlink','Admin\FrendlinkController@index');
    Route::get('frendlink_edit/{id?}','Admin\FrendlinkController@frendlink_edit');
    Route::match(['post','get'],'frendlink_handle','Admin\FrendlinkController@frendlink_handle');
});

//用户登录
Route::match(['post','put','get'],'backpage/login','Admin\IndexController@login');
