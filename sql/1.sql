
CREATE TABLE IF NOT EXISTS `event` (
  `all_members_count` int(10) unsigned NOT NULL,
  `attending_count` int(10) unsigned NOT NULL,
  `creator` int(11) NOT NULL,
  `declined_count` int(11) NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `eid` int(11) NOT NULL,
  `end_time` text COLLATE utf8_polish_ci NOT NULL,
  `has_profile_pic` int(11) NOT NULL,
  `host` text COLLATE utf8_polish_ci NOT NULL,
  `location` text COLLATE utf8_polish_ci NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `pic` text COLLATE utf8_polish_ci NOT NULL,
  `privacy` text COLLATE utf8_polish_ci NOT NULL,
  `start_time` text COLLATE utf8_polish_ci NOT NULL,
  `ticket_uri` text COLLATE utf8_polish_ci NOT NULL,
  `unsure_count` text COLLATE utf8_polish_ci NOT NULL,
  `update_time` text COLLATE utf8_polish_ci NOT NULL,
  `venue` int(11) NOT NULL,
  `version` int(10) unsigned NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


CREATE TABLE IF NOT EXISTS `venue` (
  `street` text COLLATE utf8_polish_ci NOT NULL,
  `city` text COLLATE utf8_polish_ci NOT NULL,
  `state` text COLLATE utf8_polish_ci NOT NULL,
  `country` text COLLATE utf8_polish_ci NOT NULL,
  `zip` text COLLATE utf8_polish_ci NOT NULL,
  `address` text COLLATE utf8_polish_ci NOT NULL,
  `latitude` text COLLATE utf8_polish_ci NOT NULL,
  `longitude` text COLLATE utf8_polish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `located_in` int(11) NOT NULL,
  `region` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
