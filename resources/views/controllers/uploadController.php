<?php


store_file(request('file'), 'users/images');
session('success', 'File uploaded successfully 😊');

redirect('/');