<?php


include_once 'models/MatchModel.php';
class MatchController {

    var $MatchModel = null;
    function __construct() {
        $this->MatchModel = new MatchModel();
    }

    public function getMatches($params) {
        $email = isset($params['id']) ? $params['id'] : '';
        $res = $this->MatchModel->get($email);
        return $res;
    }
    
}

?>