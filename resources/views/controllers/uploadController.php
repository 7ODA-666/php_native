<?php


// store_file(request('file'), 'users/images');
// session('success', 'File uploaded successfully 😊');
// validation('email', 'email|required', trans('main.email'));
// validation('phone', 'integer|required', trans('main.phone'));

$data = validation([
    'email' => 'email|required',
    'phone' => 'integer|required',
    'address' => 'string|required'
], [
    'email' => trans('main.email'),
    'phone' => trans('main.phone'),
    'address' => trans('main.address')
]);

var_dump($data);