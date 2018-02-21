<?php

class MatchModel {

    private $db = null;

    function __construct() {
        global $PDO;
        $this->db = $PDO;
    }

    public function get($id = NULL, $type = NULL) {
        $sth = $this->db->prepare('SELECT 
                            id mid,
                            vanue_name venueNm,
                            match_format matchFormat,
                            address1,
                            address2,
                            city,
                            state,
                            cost,
                            slots_alotted slotsAlotted,
                            (SELECT COUNT(1) FROM m_user_matching_mapping WHERE matchid = mid AND active_flag = 1) slotsAvail,
                            match_date matchDt
                        FROM m_matches WHERE active_flag = 1 ' . ($id ? ' AND id = ' . $id : '') . '');
        $sth->execute();
        $arr = array();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $key => $row) {
//        $arr = array();
//            $row = $row[0];
//            $row['matchFormat'] = ($row['matchFormat'] == 1 ? "T20" : "");
            $row['slotsAvail'] = (string)($row['slotsAlotted'] - $row['slotsAvail']);
            $row['matchTm'] = date("h:i A", strtotime($row['matchDt']));
            $row['matchDt'] = date("d M, D", strtotime($row['matchDt']));
            if($id || $type)
                $row['usr'] = $this->matchUsers($id ? $id : $row['mid']);
            $arr[] = $row;
        }
		if($type) 
			return $arr;
        if($arr) {
            $error = array('errCode' => 0, 'errMsg' => 'Data fetched successfully');
        } else {
            $error = array('errCode' => 1, 'errMsg' => 'Failed to fetch data');
        }
        return $results = array('results' => $arr, 'error' => $error);
    }

    public function matchUsers($id = NULL) {
        $specialityArr = array("","Batsman","Bowler","Wicketkeeper Batsman","Batsman Allrounder","Bowler Allrounder ");
        $sth = $this->db->prepare("SELECT userid uid, NAME uname, speciality, mobile, whatsapp_no FROM `m_users` usr INNER JOIN m_user_matching_mapping mm ON mm.userid = usr.id WHERE mm.active_flag = 1 AND matchid = " . $id);
        $sth->execute();
        $arr = array();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $key => $row) {
            $row['speciality'] = $specialityArr[$row['speciality']];
            $arr[] = $row;
        } 
        
        return $arr;
    }

}