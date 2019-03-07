<?php

Route::get('/', 'MailablesController@toMailablesList');
Route::get('/templates', 'TemplatesController@index')->name('templateList');
Route::get('/templates/new', 'TemplatesController@select')->name('selectNewTemplate');
Route::get('/templates/new/{type}/{name}/{skeleton}', 'TemplatesController@new')->name('newTemplate');
Route::get('/templates/edit/{templatename}', 'TemplatesController@view')->name('viewTemplate');
Route::post('/templates/new', 'TemplatesController@create')->name('createNewTemplate');
Route::post('/templates/delete', 'TemplatesController@delete')->name('deleteTemplate');
Route::post('/templates/update', 'TemplatesController@update')->name('updateTemplate');
Route::post('/templates/preview', 'TemplatesController@previewTemplateMarkdownView')->name('previewTemplateMarkdownView');

Route::get('/mailables', 'MailablesController@index')->name('mailableList');
Route::get('/mailables/view/{name}', 'MailablesController@viewMailable')->name('viewMailable');
Route::get('/mailables/edit/template/{name}', 'MailablesController@editMailable')->name('editMailable');
Route::post('/mailables/parse/template', 'MailablesController@parseTemplate')->name('parseTemplate');
Route::post('/mailables/preview/template', 'MailablesController@previewMarkdownView')->name('previewMarkdownView');

Route::get('/mailables/preview/template/previewerror', 'MailablesController@templatePreviewError')->name('templatePreviewError');
Route::get('/mailables/preview/{name}', 'MailablesController@previewMailable')->name('previewMailable');
Route::get('/mailables/new', 'MailablesController@createMailable')->name('createMailable');
Route::post('/mailables/new', 'MailablesController@generateMailable')->name('generateMailable');
Route::post('/mailables/delete', 'MailablesController@delete')->name('deleteMailable');