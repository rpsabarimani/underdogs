<?php

class UserModel {

    private $db = null;

    function __construct() {
        global $PDO;
        $this->db = $PDO;
    }

    public function login($email) {
        $sth = $this->db->prepare('SELECT * FROM tbl_user_master WHERE email = ?');
        $sth->execute(array($email));
        return $sth->fetchAll();
    }

    public function register($params) {
        $matchId = $params['matchId'];
        unset($params['matchId']);
        $ins = $this->db->prepare("INSERT INTO m_users (name, mobile, whatsapp_no,speciality)
                    VALUES(:name, :mobile, :whatsappNo, :speciality)");
        $res = $ins->execute($params);
        if ($res) {
            $uid = $this->db->lastInsertId();
            $matchIns = $this->db->prepare("INSERT INTO m_user_matching_mapping (userid, matchid)
                    VALUES(:uid, :matchId)");
            $matchIns->execute(array("uid" => $uid, "matchId" => $matchId));
            $error = array('errCode' => 0, 'errMsg' => 'User Registered successfully');
        } else {
            $error = array('errCode' => 1, 'errMsg' => 'Failed to add User');
        }
        return $results = array('results' => $uid, 'error' => $error);
    }

}
