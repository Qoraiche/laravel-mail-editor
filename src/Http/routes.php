<?php

Route::get('/', 'MailablesController@toMailablesList');

Route::group(['prefix' => 'templates'], function () {
    Route::get('/', 'TemplatesController@index')->name('templateList');
    Route::get('new', 'TemplatesController@select')->name('selectNewTemplate');
    Route::get('new/{type}/{name}/{skeleton}', 'TemplatesController@new')->name('newTemplate');
    Route::get('edit/{templatename}', 'TemplatesController@view')->name('viewTemplate');
    Route::post('new', 'TemplatesController@create')->name('createNewTemplate');
    Route::post('delete', 'TemplatesController@delete')->name('deleteTemplate');
    Route::post('update', 'TemplatesController@update')->name('updateTemplate');
    Route::post('preview', 'TemplatesController@previewTemplateMarkdownView')->name('previewTemplateMarkdownView');
});

Route::group(['prefix' => 'mailables'], function () {
    Route::get('/', 'MailablesController@index')->name('mailableList');
    Route::get('view/{name}', 'MailablesController@viewMailable')->name('viewMailable');
    Route::get('edit/template/{name}', 'MailablesController@editMailable')->name('editMailable');
    Route::post('parse/template', 'MailablesController@parseTemplate')->name('parseTemplate');
    Route::post('preview/template', 'MailablesController@previewMarkdownView')->name('previewMarkdownView');
    Route::get('preview/template/previewerror', 'MailablesController@templatePreviewError')->name('templatePreviewError');
    Route::get('preview/{name}', 'MailablesController@previewMailable')->name('previewMailable');
    Route::post('new', 'MailablesController@generateMailable')->name('generateMailable');
    Route::post('delete', 'MailablesController@delete')->name('deleteMailable');
    Route::post('send-test', 'MailablesController@sendTest')->name('sendTestMail');
});
