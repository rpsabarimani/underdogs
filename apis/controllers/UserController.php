<?php

include_once 'models/UserModel.php';
class UserController {

    var $userModel = null;
    function __construct() {
        $this->userModel = new UserModel();
    }

    public function register($params) {
        $name = $params['name'];
        $mobile = $params['mobile'];
        $whatsappNo = $params['whatsappNo'];
        $speciality = $params['speciality'];
        $matchId = $params['matchId'];
        $res = $this->userModel->register($params);
        return $res;
    }

}

?>