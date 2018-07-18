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

Route::get('/mailable', function () {
    $invoice = \Seasonofjubilee\Models\Post::find(1);
    return new \Seasonofjubilee\Mail\PostNewsLetter($invoice);
});
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
 Route::get('/', '\Seasonofjubilee\Http\Controllers\HomeController@index')->name('home');
 Route::get('/events', '\Seasonofjubilee\Http\Controllers\EventsController@index')->name('events.index');
 Route::get('/events/past', '\Seasonofjubilee\Http\Controllers\EventsController@pastEvents')->name('events.past');
 Route::get('/events/{slug}', '\Seasonofjubilee\Http\Controllers\EventsController@show')->name('events.show');
 Route::get('/events/tag/{slug}', '\Seasonofjubilee\Http\Controllers\EventsController@tagEvents')->name('events.tags');
 Route::post('/events/register', '\Seasonofjubilee\Http\Controllers\EventsController@storeRegister')->name('events.register.store');

Route::post('/sermons/comments', '\Seasonofjubilee\Http\Controllers\SermonController@comment')->name('comments.sermons.store');
Route::get('/sermons', '\Seasonofjubilee\Http\Controllers\SermonController@index')->name('sermons.index');
Route::get('/sermons/{slug}', '\Seasonofjubilee\Http\Controllers\SermonController@show')->name('sermons.show');
Route::get('/sermons/tag/{slug}', '\Seasonofjubilee\Http\Controllers\SermonController@sermonTag')->name('sermons.tags');
Route::get('/sermons/pdf/download/{file}', '\Seasonofjubilee\Http\Controllers\SermonController@pdfDownload')->name('sermons.download');
Route::get('/sermons/pdf/view/{file}', '\Seasonofjubilee\Http\Controllers\SermonController@viewPDF')->name('sermons.viewPDF');
Route::get('/sermons/tag/{slug}', '\Seasonofjubilee\Http\Controllers\SermonController@tagSermons')->name('sermons.tags');

Route::post('/testimonies/comments', '\Seasonofjubilee\Http\Controllers\TestimonyController@comment')->name('comments.testimonies.store');
Route::get('/testimonies', '\Seasonofjubilee\Http\Controllers\TestimonyController@index')->name('testimony.index');
Route::get('/testimonies/{slug}', '\Seasonofjubilee\Http\Controllers\TestimonyController@show')->name('testimony.show');
Route::get('/testimonies/tag/{slug}', '\Seasonofjubilee\Http\Controllers\TestimonyController@testimonyTag')->name('testimony.tag');

Route::get('/staffs/{slug}', '\Seasonofjubilee\Http\Controllers\StaffController@show')->name('staffs.show');
Route::get('/staffs', '\Seasonofjubilee\Http\Controllers\StaffController@index')->name('staffs.index');


Route::post('/posts/comments', '\Seasonofjubilee\Http\Controllers\PostController@comment')->name('comments.posts.store');
Route::get('/posts/{slug}', '\Seasonofjubilee\Http\Controllers\PostController@show')->name('posts.show');
Route::get('/posts', '\Seasonofjubilee\Http\Controllers\PostController@index')->name('posts.index');
Route::get('/posts/tag/{slug}', '\Seasonofjubilee\Http\Controllers\PostController@tag')->name('posts.tags');

Route::get('/galleries/photos', '\Seasonofjubilee\Http\Controllers\GalleryController@photo_index')->name('galleries.photos.index');
Route::get('/galleries/audios', '\Seasonofjubilee\Http\Controllers\GalleryController@audio_index')->name('galleries.audios.index');
Route::get('/galleries/videos', '\Seasonofjubilee\Http\Controllers\GalleryController@video_index')->name('galleries.videos.index');
Route::get('/galleries/videos/{slug}', '\Seasonofjubilee\Http\Controllers\GalleryController@video_show')->name('galleries.videos.show');
Route::get('/galleries/channels', '\Seasonofjubilee\Http\Controllers\GalleryController@embedded_index')->name('galleries.embedded.index');

Route::get('/galleries/download/{slug}', '\Seasonofjubilee\Http\Controllers\GalleryController@download')->name('galleries.download');

 Route::get('/parayer-requests', '\Seasonofjubilee\Http\Controllers\PrayerRequestController@create')->name('requests.create');
 Route::post('/parayer-requests', '\Seasonofjubilee\Http\Controllers\PrayerRequestController@store')->name('requests.store');

Route::get('/projects', '\Seasonofjubilee\Http\Controllers\ProjectController@index')->name('project.index');
Route::get('/projects/{slug}', '\Seasonofjubilee\Http\Controllers\ProjectController@show')->name('project.show');

 Route::get('/unsubscribe', '\Seasonofjubilee\Http\Controllers\HomeController@getUnsubscribe')->name('get-unsubscribe');
 Route::delete('/unsubscribe/delete', '\Seasonofjubilee\Http\Controllers\HomeController@unsubscribe')->name('unsubscribe');

 Route::get('/about', '\Seasonofjubilee\Http\Controllers\HomeController@about')->name('about');
 Route::get('/contact-us', '\Seasonofjubilee\Http\Controllers\HomeController@contact')->name('contact');
 Route::get('/give', '\Seasonofjubilee\Http\Controllers\HomeController@give')->name('give');
 Route::post('/contact', '\Seasonofjubilee\Http\Controllers\HomeController@postContact')->name('post-contact');
 Route::post('/subscribe', '\Seasonofjubilee\Http\Controllers\HomeController@subscribe')->name('subscriber');
 Route::get('/about', '\Seasonofjubilee\Http\Controllers\HomeController@about')->name('about');
 Route::get('/about', '\Seasonofjubilee\Http\Controllers\HomeController@about')->name('about');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['throttle']], function () {
    Route::get('/admin/login', '\Seasonofjubilee\Http\Controllers\Admin\Auth\LoginController@index')->name('admin.login');
    Route::post('/admin/login', '\Seasonofjubilee\Http\Controllers\Admin\Auth\LoginController@login')->name('admin.postLogin');
    Route::get('/admin/logout', '\Seasonofjubilee\Http\Controllers\Admin\Auth\LoginController@logout')->name('admin.logout');

    Route::get('/admin/password/reset', '\Seasonofjubilee\Http\Controllers\Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.forgotform');
    Route::post('/admin/password/email', '\Seasonofjubilee\Http\Controllers\Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.forgot');
    Route::get('/admin/password/reset/{token}', '\Seasonofjubilee\Http\Controllers\Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.restform');
    Route::post('/admin/password/reset', '\Seasonofjubilee\Http\Controllers\Admin\Auth\ResetPasswordController@reset')->name('admin.password.reset');
});

Route::group(['middleware' => ['admin-auth'],'as'     => 'admin.'], function () {
    Route::get('/admin/home', '\Seasonofjubilee\Http\Controllers\Admin\HomeController@index')->name('index');
    Route::get('/admin/subscribers', '\Seasonofjubilee\Http\Controllers\Admin\HomeController@subscriber')->name('subscribers');
    Route::delete('/admin/subscribers/{id}', '\Seasonofjubilee\Http\Controllers\Admin\HomeController@deleteSubscriber')->name('subscribers.delete');
    Route::get('/admin/settings', '\Seasonofjubilee\Http\Controllers\Admin\SettingsController@index')->name('settings.index');
    Route::put('/admin/settings', '\Seasonofjubilee\Http\Controllers\Admin\SettingsController@update')->name('settings.update');
    Route::post('/admin/settings/upload', '\Seasonofjubilee\Http\Controllers\Admin\SettingsController@upload')->name('settings.upload');
    Route::get('/admin/settings/{id}/delete', '\Seasonofjubilee\Http\Controllers\Admin\SettingsController@delete_value')->name('settings.delete_value');


    Route::get('/admin/events/registration', '\Seasonofjubilee\Http\Controllers\Admin\EventsController@registration')->name('events.reg.index');
    Route::get('/admin/events/registration/{registration}', '\Seasonofjubilee\Http\Controllers\Admin\EventsController@regDetails')->name('events.reg.read');
    Route::delete('/admin/events/registration/{slug}', '\Seasonofjubilee\Http\Controllers\Admin\EventsController@deleteEventReg')->name('events.reg.delete');
    Route::post('/admin/events/excel/export', '\Seasonofjubilee\Http\Controllers\Admin\EventsController@toExcel')->name('events.excel');

    Route::get('/admin/events/media/{slug}', '\Seasonofjubilee\Http\Controllers\Admin\EventsController@getMediaUpload')->name('events.get.media');
    Route::post('/admin/events/media/{slug}', '\Seasonofjubilee\Http\Controllers\Admin\EventsController@addMedia')->name('events.add.media');
    Route::resource('/admin/events', '\Seasonofjubilee\Http\Controllers\Admin\EventsController');

    Route::post('/admin/sermon/media/youtube-vimeo', '\Seasonofjubilee\Http\Controllers\Admin\SermonController@saveYVMedia')->name('sermon.media.yuv');
    Route::get('/admin/sermon/media/{slug}', '\Seasonofjubilee\Http\Controllers\Admin\SermonController@getMediaUpload')->name('sermon.get.media');
    Route::post('/admin/sermon/media/{slug}', '\Seasonofjubilee\Http\Controllers\Admin\SermonController@addMedia')->name('sermon.add.media');
    Route::post('/admin/sermon/media/delete/{id}', '\Seasonofjubilee\Http\Controllers\Admin\SermonController@DeleteUploadedMedia')->name('sermon.delete.uploadedImage');
    Route::get('/admin/sermon-comments', '\Seasonofjubilee\Http\Controllers\Admin\SermonController@comment')->name('sermon.comments');
    Route::put('/admin/sermon-comments-toggle', '\Seasonofjubilee\Http\Controllers\Admin\SermonController@toggleComment')->name('sermon.comments.toggle');
    Route::resource('/admin/sermon', '\Seasonofjubilee\Http\Controllers\Admin\SermonController');
    Route::resource('/admin/category', '\Seasonofjubilee\Http\Controllers\Admin\SermonCategoryController');
    Route::post('/admin/testimony/upload', '\Seasonofjubilee\Http\Controllers\Admin\TestimonyController@upload')->name('testimony.upload');
    Route::get('/admin/testimony-comments', '\Seasonofjubilee\Http\Controllers\Admin\TestimonyController@comment')->name('testimony.comments');
    Route::put('/admin/testimony-comments-toggle', '\Seasonofjubilee\Http\Controllers\Admin\TestimonyController@toggleComment')->name('testimony.comments.toggle');
    Route::resource('/admin/testimony', '\Seasonofjubilee\Http\Controllers\Admin\TestimonyController');

    Route::get('/admin/contact', '\Seasonofjubilee\Http\Controllers\Admin\ContactController@index')->name('contact.index');
    Route::get('/admin/{id}/contact', '\Seasonofjubilee\Http\Controllers\Admin\ContactController@show')->name('contact.show');
    Route::delete('/admin/contact/{id}', '\Seasonofjubilee\Http\Controllers\Admin\ContactController@destroy')->name('contact.destroy');

/*    Route::get('/admin/admins', '\Seasonofjubilee\Http\Controllers\Admin\AdminController@index')->name('admins.index');
    Route::get('/admin/{id}/admins/', '\Seasonofjubilee\Http\Controllers\Admin\AdminController@show')->name('admins.show');
    Route::get('/admin/admins/{id}/edit', '\Seasonofjubilee\Http\Controllers\Admin\AdminController@edit')->name('admins.edit');
    Route::put('/admin/admins/{id}', '\Seasonofjubilee\Http\Controllers\Admin\AdminController@update')->name('admins.update');
    Route::post('/admin/admins/upload', '\Seasonofjubilee\Http\Controllers\Admin\AdminController@upload')->name('admins.upload');
    Route::delete('/admin/admins/{id}', '\Seasonofjubilee\Http\Controllers\Admin\AdminController@destroy')->name('admins.destroy');*/
    Route::get('/admin/admins/register', '\Seasonofjubilee\Http\Controllers\Admin\Auth\RegisterController@index')->name('admins.add');
    Route::post('/admin/admins/register', '\Seasonofjubilee\Http\Controllers\Admin\Auth\RegisterController@register')->name('admins.register');
    Route::post('/admin/admins/upload', '\Seasonofjubilee\Http\Controllers\Admin\AdminController@upload')->name('admins.upload');
    Route::resource('/admin/admins', '\Seasonofjubilee\Http\Controllers\Admin\AdminController');

    Route::post('/admin/staffs/upload', '\Seasonofjubilee\Http\Controllers\Admin\StaffController@upload')->name('staffs.upload');
    Route::resource('/admin/staffs', '\Seasonofjubilee\Http\Controllers\Admin\StaffController');

    Route::resource('/admin/categories', '\Seasonofjubilee\Http\Controllers\Admin\PostCategoryController');
    Route::resource('/admin/gallery-categories', '\Seasonofjubilee\Http\Controllers\Admin\GalleryCategoryController');
    Route::post('/admin/posts/upload', '\Seasonofjubilee\Http\Controllers\Admin\PostController@upload')->name('posts.upload');
    Route::resource('/admin/galleries', '\Seasonofjubilee\Http\Controllers\Admin\GalleryController');

    Route::get('/admin/post-comments', '\Seasonofjubilee\Http\Controllers\Admin\PostController@comment')->name('posts.comments');
    Route::put('/admin/post-comments-toggle', '\Seasonofjubilee\Http\Controllers\Admin\PostController@toggleComment')->name('post.comments.toggle');
    Route::resource('/admin/posts', '\Seasonofjubilee\Http\Controllers\Admin\PostController');

    Route::resource('/admin/gallery-categories', '\Seasonofjubilee\Http\Controllers\Admin\GalleryCategoryController');
    Route::post('/admin/galleries/upload-photo', '\Seasonofjubilee\Http\Controllers\Admin\GalleryController@uploadPhoto')->name('galleries.upload-photo');
    Route::post('/admin/galleries/upload-video', '\Seasonofjubilee\Http\Controllers\Admin\GalleryController@uploadVideo')->name('galleries.upload-video');
    Route::post('/admin/galleries/upload-audio', '\Seasonofjubilee\Http\Controllers\Admin\GalleryController@uploadAudio')->name('galleries.upload-audio');
    Route::post('/admin/galleries/emded', '\Seasonofjubilee\Http\Controllers\Admin\GalleryController@embed')->name('galleries.emded');
    Route::resource('/admin/galleries', '\Seasonofjubilee\Http\Controllers\Admin\GalleryController');

    Route::resource('/admin/prayer-requests', '\Seasonofjubilee\Http\Controllers\Admin\PrayerRequestController');

    Route::resource('/admin/comments', '\Seasonofjubilee\Http\Controllers\Admin\CommentController');

    Route::post('/admin/projects/upload', '\Seasonofjubilee\Http\Controllers\Admin\ProjectController@upload')->name('projects.upload');
    Route::resource('/admin/projects', '\Seasonofjubilee\Http\Controllers\Admin\ProjectController');
});

