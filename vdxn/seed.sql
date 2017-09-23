
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `details` varchar(2000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `expiry_timestamp` datetime NOT NULL,
  `task_timestamp` datetime NOT NULL,
  `min_bid` float NOT NULL,
  `max_bid` float NOT NULL,
  `tasker_id` int(11) NOT NULL,
  `assignee_id` int(11) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `completed_at` datetime NOT NULL,
  `tasker_rating` int(11) NOT NULL,
  `assignee_rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `task` (`id`, `title`, `details`, `created_at`, `updated_at`, `expiry_timestamp`, `task_timestamp`, `min_bid`, `max_bid`, `tasker_id`, `assignee_id`, `deleted_at`, `completed_at`, `tasker_rating`, `assignee_rating`) VALUES
(1, 'Feed my dog', 'I need my dog fed ', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', '2017-10-10 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(2, 'Feed my donkey', 'I need my donkey primed for selling', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', '2017-10-10 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);
