
CREATE TABLE `m_user_matching_mapping` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `matchid` bigint(20) NOT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT 'active flag(0-Inactive | 1-Active | 2- Deleted)',
  `createdon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time of the creation',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date and time of the update',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;



CREATE TABLE `m_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `whatsapp_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `speciality` tinyint(2) DEFAULT NULL,
  `active_flag` tinyint(2) DEFAULT '1' COMMENT 'active flag(0-Inactive | 1-Active | 2- Deleted)',
  `createdon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'date and time of the creation',
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'date and time of the update',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
