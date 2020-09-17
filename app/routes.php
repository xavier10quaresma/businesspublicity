<?php
// =================== Routes ==================== //

$app->get('/old', 'HomeController:old');
$app->get('/create', 'HomeController:index');
$app->get('/get', 'HomeController:getall');