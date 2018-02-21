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
        
        $mobRes = $this->userModel->checkMobile($mobile);
        
        if (!$mobRes) {
            
        } else {
            $res = $this->userModel->register($params);
        }

        return $res;
    }

}

?>