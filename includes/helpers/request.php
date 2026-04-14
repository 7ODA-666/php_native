<?php

function request(string $request) {
    return isset($_REQUEST[$request]) ? $_REQUEST[$request] : null;
}