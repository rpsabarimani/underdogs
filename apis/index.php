<?php

    include 'config.php';
    include_once 'common/class.common.php';
    $comm = new Common();

    $action = (!empty($_GET['action'])) ? trim(urldecode($_GET['action'])) : '';
    $func = (!empty($_GET['func'])) ? trim(urldecode($_GET['func'])) : '';

    if (empty($action)) {

        $res = array();
        $error = array('errCode' => 1, 'errMsg' => 'Invaild URL');
        $result = array('results' => $res, 'error' => $error);
        echo json_encode($result);
        http_response_code(404);
        exit;
    }

    $actionArr = explode("/", $action);
    $controller = $actionArr[0];
    $func = $actionArr[1];

    if (!$comm->validateRequest()) {

        $res = array();
        $error = array('errCode' => 1, 'errMsg' => 'Invaild URL');
        $result = array('results' => $res, 'error' => $error);
        echo json_encode($result);
        http_response_code(404);
        exit;
    }


    if (empty($controller) || empty($func)) {
        $res = array();
        $error = array('errCode' => 1, 'errMsg' => 'Invaild URL');
        $result = array('results' => $res, 'error' => $error);
        echo json_encode($result);
        http_response_code(404);
        exit;
    }


    unset($_GET['action'], $_GET['func']);

    $params = array_merge($_GET, $_POST, $_FILES);

    $controller = $controller . 'Controller';
    include "controllers/" . $controller . '.php';
    $obj = new $controller($PDO);
    $result = $obj->$func($params);


    echo json_encode($result);
    header("Content-Type:application/json");
    exit;
?>