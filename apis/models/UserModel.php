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
      	//if(!$this->checkSlots($matchId)){
            //$error = array('errCode' => 1, 'errMsg' => 'Slots full for this match');
          
        //}
        unset($params['matchId']);
        $ins = $this->db->prepare("INSERT INTO m_users (name, mobile, whatsapp_no,speciality)
                    VALUES(:name, :mobile, :whatsappNo, :speciality)");
        $res = $ins->execute($params);
        if ($res) {
            $uid = $this->db->lastInsertId();
            $matchIns = $this->db->prepare("INSERT INTO m_user_matching_mapping (userid, matchid)
                    VALUES(:uid, :matchId)");
            $matchIns->execute(array("uid" => $uid, "matchId" => $matchId));
            $error = array('errCode' => 0, 'errMsg' => 'Registration Successful! Confirm your slot by paying Rs. cost via payTm/Tez to Abhi @ 9972083064');
        } else {
            $error = array('errCode' => 1, 'errMsg' => 'Failed to add User');
        }
        return $results = array('results' => $uid, 'error' => $error);
    }

  
    public function checkSlots($mid) {
        $sth = $this->db->prepare('SELECT slots_alotted slotAlotted, (SELECT count(1) from m_user_matching_mapping where matchid = $mid) slotBooked FROM m_matches WHERE id = $mid');
        $sth->execute();
        $row = $sth->fetchAll();
      	$slotAvail = $row['slotAlotted'] - $row['slotBooked'];
      if($slotAvail > 0)
        return TRUE;
      else 
        return FALSE;
    }

    public function checkMobile($mobile) {
        try {
            $sth = $this->db->prepare('SELECT COUNT(1) cnt FROM tbl_user_master WHERE mobile = ?');
            $sth->execute(array($mobile));
            $row = $sth->fetchAll();
            return $row['cnt'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
