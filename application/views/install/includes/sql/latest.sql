SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `ad-settings`;
CREATE TABLE `ad-settings` (
  `id` int(11) NOT NULL,
  `top_ad` text NOT NULL,
  `bottom_ad` text NOT NULL,
  `top_ad_status` tinyint(1) NOT NULL DEFAULT 1,
  `bottom_ad_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ad-settings` (`id`, `top_ad`, `bottom_ad`, `top_ad_status`, `bottom_ad_status`) VALUES
(1, 'https://via.placeholder.com/728x90?text=salon', 'https://via.placeholder.com/728x90?text=salon', 0, 0);

DROP TABLE IF EXISTS `agents`;
CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `agentName` varchar(255) NOT NULL,
  `agentImage` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `totalBookings` varchar(255) NOT NULL,
  `agentDetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `agents` (`id`, `agentName`, `agentImage`, `experience`, `totalBookings`, `agentDetail`) VALUES
(1, 'Michael', 'avatar1.jpg', '12', '1500', 'Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch this lieutenantgeneral I met he theory. Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch. '),
(2, 'Katelyn', 'avatar2.png', '5', '100', 'Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch this lieutenantgeneral I met he theory. Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch. '),
(3, 'Gloria', 'avatar3.png', '15', '150', 'Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch this lieutenantgeneral I met he theory. Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch. '),
(4, 'Ava', 'avatar4.png', '12', '12', 'Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch this lieutenantgeneral I met he theory. Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch. '),
(6, 'Emily', 'avatar5.png', '7', '15', 'Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch this lieutenantgeneral I met he theory. Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch. '),
(7, 'Amelia', 'avatar6.png', '3', '8', 'Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch this lieutenantgeneral I met he theory. Born the and he frequencies what spree. Select taking could neuter. Another, human the seven. Out to office into a to able moment. The that be watch. ');

DROP TABLE IF EXISTS `analytics-settings`;
CREATE TABLE `analytics-settings` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `analytics-settings` (`id`, `code`) VALUES
(1, 'UA-123456789-0');

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `permalink` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime_added` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime_updated` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1 COMMENT '1 = Active, 2 = In Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `blog` (`id`, `title`, `permalink`, `description`, `image`, `datetime_added`, `datetime_updated`, `status`) VALUES
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod rhoncus orci, ut lacinia enim. Etiam lectus nulla, ultrices in bibendum non, sollicitudin eleifend lacus. Quisque ultricies maximus nisl, sit amet condimentum risus dictum porttitor. Sed sed urna sit amet mauris malesuada facilisis nec at dolor. Pellentesque suscipit efficitur diam nec scelerisque. Quisque gravida nulla quis arcu venenatis accumsan. Nam ultricies, nisi sit amet vestibulum sollicitudin, justo mauris varius tortor, vitae elementum tellus lectus in massa. Nam erat nisi, pellentesque id feugiat vitae, fringilla at arcu. Ut lacinia ullamcorper nibh, sit amet condimentum lorem gravida eu. Nullam vel lectus viverra, hendrerit elit nec, fermentum orci. Morbi id lacus interdum, aliquam ex ac, tristique ipsum. In in sem felis. Ut vitae varius ante. Vivamus odio ipsum, vulputate a ullamcorper nec, viverra at enim. Nullam ac lectus sodales velit scelerisque finibus ac vitae purus.&lt;br&gt;&lt;br&gt;Etiam hendrerit faucibus placerat. Aenean pharetra tincidunt est sodales viverra. In faucibus sollicitudin iaculis. Integer magna neque, pulvinar ut pellentesque sit amet, ullamcorper quis tellus. Donec mattis euismod est, sed venenatis ex tincidunt a. Fusce nec ultricies justo, eget euismod augue. Nunc non tincidunt risus. Etiam pharetra suscipit lorem, quis gravida nulla ultrices sodales. Proin egestas ipsum purus, eu aliquam nisl mollis sit amet. Praesent nec arcu mollis, mattis dolor ac, imperdiet metus. Cras porttitor, neque id lobortis finibus, erat nisl dignissim urna, in vulputate metus libero sollicitudin augue. Nullam suscipit semper sapien, et facilisis felis ullamcorper et.&lt;br&gt;&lt;br&gt;In vestibulum, neque non viverra faucibus, tellus ante eleifend massa, nec tincidunt ligula nisl eget risus. Aenean volutpat vulputate nibh ut porttitor. Suspendisse porta ipsum sagittis augue aliquam, vel convallis nibh facilisis. Sed luctus mauris eget efficitur imperdiet. Maecenas non rutrum urna. Fusce pellentesque convallis ante, at vulputate felis ornare vel. Suspendisse nec euismod enim. Phasellus posuere odio sed lobortis fermentum. Donec mollis imperdiet mollis. Phasellus fringilla odio ut diam facilisis, eget convallis magna consectetur. Curabitur pretium iaculis vestibulum. Integer tincidunt nunc vitae risus interdum luctus. Vivamus et justo a eros ultricies ullamcorper at id leo. &lt;br&gt;', 'flt_1.jpg', '2020-08-08 21:41:21', '2020-08-09 08:21:04', 1),
(11, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod rhoncus orci, ut lacinia enim. Etiam lectus nulla, ultrices in bibendum non, sollicitudin eleifend lacus. Quisque ultricies maximus nisl, sit amet condimentum risus dictum porttitor. Sed sed urna sit amet mauris malesuada facilisis nec at dolor. Pellentesque suscipit efficitur diam nec scelerisque. Quisque gravida nulla quis arcu venenatis accumsan. Nam ultricies, nisi sit amet vestibulum sollicitudin, justo mauris varius tortor, vitae elementum tellus lectus in massa. Nam erat nisi, pellentesque id feugiat vitae, fringilla at arcu. Ut lacinia ullamcorper nibh, sit amet condimentum lorem gravida eu. Nullam vel lectus viverra, hendrerit elit nec, fermentum orci. Morbi id lacus interdum, aliquam ex ac, tristique ipsum. In in sem felis. Ut vitae varius ante. Vivamus odio ipsum, vulputate a ullamcorper nec, viverra at enim. Nullam ac lectus sodales velit scelerisque finibus ac vitae purus.&lt;br&gt;&lt;br&gt;Etiam hendrerit faucibus placerat. Aenean pharetra tincidunt est sodales viverra. In faucibus sollicitudin iaculis. Integer magna neque, pulvinar ut pellentesque sit amet, ullamcorper quis tellus. Donec mattis euismod est, sed venenatis ex tincidunt a. Fusce nec ultricies justo, eget euismod augue. Nunc non tincidunt risus. Etiam pharetra suscipit lorem, quis gravida nulla ultrices sodales. Proin egestas ipsum purus, eu aliquam nisl mollis sit amet. Praesent nec arcu mollis, mattis dolor ac, imperdiet metus. Cras porttitor, neque id lobortis finibus, erat nisl dignissim urna, in vulputate metus libero sollicitudin augue. Nullam suscipit semper sapien, et facilisis felis ullamcorper et.&lt;br&gt;&lt;br&gt;In vestibulum, neque non viverra faucibus, tellus ante eleifend massa, nec tincidunt ligula nisl eget risus. Aenean volutpat vulputate nibh ut porttitor. Suspendisse porta ipsum sagittis augue aliquam, vel convallis nibh facilisis. Sed luctus mauris eget efficitur imperdiet. Maecenas non rutrum urna. Fusce pellentesque convallis ante, at vulputate felis ornare vel. Suspendisse nec euismod enim. Phasellus posuere odio sed lobortis fermentum. Donec mollis imperdiet mollis. Phasellus fringilla odio ut diam facilisis, eget convallis magna consectetur. Curabitur pretium iaculis vestibulum. Integer tincidunt nunc vitae risus interdum luctus. Vivamus et justo a eros ultricies ullamcorper at id leo. &lt;br&gt;&lt;/p&gt;', 'flt_1.jpg', '2020-08-09 08:40:28', '2020-08-09 08:43:52', 1),
(12, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet-1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod rhoncus orci, ut lacinia enim. Etiam lectus nulla, ultrices in bibendum non, sollicitudin eleifend lacus. Quisque ultricies maximus nisl, sit amet condimentum risus dictum porttitor. Sed sed urna sit amet mauris malesuada facilisis nec at dolor. Pellentesque suscipit efficitur diam nec scelerisque. Quisque gravida nulla quis arcu venenatis accumsan. Nam ultricies, nisi sit amet vestibulum sollicitudin, justo mauris varius tortor, vitae elementum tellus lectus in massa. Nam erat nisi, pellentesque id feugiat vitae, fringilla at arcu. Ut lacinia ullamcorper nibh, sit amet condimentum lorem gravida eu. Nullam vel lectus viverra, hendrerit elit nec, fermentum orci. Morbi id lacus interdum, aliquam ex ac, tristique ipsum. In in sem felis. Ut vitae varius ante. Vivamus odio ipsum, vulputate a ullamcorper nec, viverra at enim. Nullam ac lectus sodales velit scelerisque finibus ac vitae purus.&lt;br&gt;&lt;br&gt;Etiam hendrerit faucibus placerat. Aenean pharetra tincidunt est sodales viverra. In faucibus sollicitudin iaculis. Integer magna neque, pulvinar ut pellentesque sit amet, ullamcorper quis tellus. Donec mattis euismod est, sed venenatis ex tincidunt a. Fusce nec ultricies justo, eget euismod augue. Nunc non tincidunt risus. Etiam pharetra suscipit lorem, quis gravida nulla ultrices sodales. Proin egestas ipsum purus, eu aliquam nisl mollis sit amet. Praesent nec arcu mollis, mattis dolor ac, imperdiet metus. Cras porttitor, neque id lobortis finibus, erat nisl dignissim urna, in vulputate metus libero sollicitudin augue. Nullam suscipit semper sapien, et facilisis felis ullamcorper et.&lt;br&gt;&lt;br&gt;In vestibulum, neque non viverra faucibus, tellus ante eleifend massa, nec tincidunt ligula nisl eget risus. Aenean volutpat vulputate nibh ut porttitor. Suspendisse porta ipsum sagittis augue aliquam, vel convallis nibh facilisis. Sed luctus mauris eget efficitur imperdiet. Maecenas non rutrum urna. Fusce pellentesque convallis ante, at vulputate felis ornare vel. Suspendisse nec euismod enim. Phasellus posuere odio sed lobortis fermentum. Donec mollis imperdiet mollis. Phasellus fringilla odio ut diam facilisis, eget convallis magna consectetur. Curabitur pretium iaculis vestibulum. Integer tincidunt nunc vitae risus interdum luctus. Vivamus et justo a eros ultricies ullamcorper at id leo. &lt;br&gt;&lt;/p&gt;', 'flt_1.jpg', '2020-08-09 08:48:47', '2020-08-09 08:48:47', 1),
(13, 'Lorem ipsum dolor sit amet11', 'lorem-ipsum-dolor-sit-amet11', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod rhoncus orci, ut lacinia enim. Etiam lectus nulla, ultrices in bibendum non, sollicitudin eleifend lacus. Quisque ultricies maximus nisl, sit amet condimentum risus dictum porttitor. Sed sed urna sit amet mauris malesuada facilisis nec at dolor. Pellentesque suscipit efficitur diam nec scelerisque. Quisque gravida nulla quis arcu venenatis accumsan. Nam ultricies, nisi sit amet vestibulum sollicitudin, justo mauris varius tortor, vitae elementum tellus lectus in massa. Nam erat nisi, pellentesque id feugiat vitae, fringilla at arcu. Ut lacinia ullamcorper nibh, sit amet condimentum lorem gravida eu. Nullam vel lectus viverra, hendrerit elit nec, fermentum orci. Morbi id lacus interdum, aliquam ex ac, tristique ipsum. In in sem felis. Ut vitae varius ante. Vivamus odio ipsum, vulputate a ullamcorper nec, viverra at enim. Nullam ac lectus sodales velit scelerisque finibus ac vitae purus.&lt;br&gt;&lt;br&gt;Etiam hendrerit faucibus placerat. Aenean pharetra tincidunt est sodales viverra. In faucibus sollicitudin iaculis. Integer magna neque, pulvinar ut pellentesque sit amet, ullamcorper quis tellus. Donec mattis euismod est, sed venenatis ex tincidunt a. Fusce nec ultricies justo, eget euismod augue. Nunc non tincidunt risus. Etiam pharetra suscipit lorem, quis gravida nulla ultrices sodales. Proin egestas ipsum purus, eu aliquam nisl mollis sit amet. Praesent nec arcu mollis, mattis dolor ac, imperdiet metus. Cras porttitor, neque id lobortis finibus, erat nisl dignissim urna, in vulputate metus libero sollicitudin augue. Nullam suscipit semper sapien, et facilisis felis ullamcorper et.&lt;br&gt;&lt;br&gt;In vestibulum, neque non viverra faucibus, tellus ante eleifend massa, nec tincidunt ligula nisl eget risus. Aenean volutpat vulputate nibh ut porttitor. Suspendisse porta ipsum sagittis augue aliquam, vel convallis nibh facilisis. Sed luctus mauris eget efficitur imperdiet. Maecenas non rutrum urna. Fusce pellentesque convallis ante, at vulputate felis ornare vel. Suspendisse nec euismod enim. Phasellus posuere odio sed lobortis fermentum. Donec mollis imperdiet mollis. Phasellus fringilla odio ut diam facilisis, eget convallis magna consectetur. Curabitur pretium iaculis vestibulum. Integer tincidunt nunc vitae risus interdum luctus. Vivamus et justo a eros ultricies ullamcorper at id leo. &lt;br&gt;&lt;/p&gt;', 'flt_1.jpg', '2020-08-09 08:48:59', '2020-08-09 08:48:59', 1),
(14, 'Lorem ipsum dolor sit amet11', 'lorem-ipsum-dolor-sit-amet11-1', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod rhoncus orci, ut lacinia enim. Etiam lectus nulla, ultrices in bibendum non, sollicitudin eleifend lacus. Quisque ultricies maximus nisl, sit amet condimentum risus dictum porttitor. Sed sed urna sit amet mauris malesuada facilisis nec at dolor. Pellentesque suscipit efficitur diam nec scelerisque. Quisque gravida nulla quis arcu venenatis accumsan. Nam ultricies, nisi sit amet vestibulum sollicitudin, justo mauris varius tortor, vitae elementum tellus lectus in massa. Nam erat nisi, pellentesque id feugiat vitae, fringilla at arcu. Ut lacinia ullamcorper nibh, sit amet condimentum lorem gravida eu. Nullam vel lectus viverra, hendrerit elit nec, fermentum orci. Morbi id lacus interdum, aliquam ex ac, tristique ipsum. In in sem felis. Ut vitae varius ante. Vivamus odio ipsum, vulputate a ullamcorper nec, viverra at enim. Nullam ac lectus sodales velit scelerisque finibus ac vitae purus.&lt;br&gt;&lt;br&gt;Etiam hendrerit faucibus placerat. Aenean pharetra tincidunt est sodales viverra. In faucibus sollicitudin iaculis. Integer magna neque, pulvinar ut pellentesque sit amet, ullamcorper quis tellus. Donec mattis euismod est, sed venenatis ex tincidunt a. Fusce nec ultricies justo, eget euismod augue. Nunc non tincidunt risus. Etiam pharetra suscipit lorem, quis gravida nulla ultrices sodales. Proin egestas ipsum purus, eu aliquam nisl mollis sit amet. Praesent nec arcu mollis, mattis dolor ac, imperdiet metus. Cras porttitor, neque id lobortis finibus, erat nisl dignissim urna, in vulputate metus libero sollicitudin augue. Nullam suscipit semper sapien, et facilisis felis ullamcorper et.&lt;br&gt;&lt;br&gt;In vestibulum, neque non viverra faucibus, tellus ante eleifend massa, nec tincidunt ligula nisl eget risus. Aenean volutpat vulputate nibh ut porttitor. Suspendisse porta ipsum sagittis augue aliquam, vel convallis nibh facilisis. Sed luctus mauris eget efficitur imperdiet. Maecenas non rutrum urna. Fusce pellentesque convallis ante, at vulputate felis ornare vel. Suspendisse nec euismod enim. Phasellus posuere odio sed lobortis fermentum. Donec mollis imperdiet mollis. Phasellus fringilla odio ut diam facilisis, eget convallis magna consectetur. Curabitur pretium iaculis vestibulum. Integer tincidunt nunc vitae risus interdum luctus. Vivamus et justo a eros ultricies ullamcorper at id leo. &lt;br&gt;&lt;/p&gt;', 'flt_1.jpg', '2020-08-09 08:49:06', '2020-08-09 08:49:06', 1),
(15, 'Lorem ipsum dolor sit amet11', 'lorem-ipsum-dolor-sit-amet11-1-2-3', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod rhoncus orci, ut lacinia enim. Etiam lectus nulla, ultrices in bibendum non, sollicitudin eleifend lacus. Quisque ultricies maximus nisl, sit amet condimentum risus dictum porttitor. Sed sed urna sit amet mauris malesuada facilisis nec at dolor. Pellentesque suscipit efficitur diam nec scelerisque. Quisque gravida nulla quis arcu venenatis accumsan. Nam ultricies, nisi sit amet vestibulum sollicitudin, justo mauris varius tortor, vitae elementum tellus lectus in massa. Nam erat nisi, pellentesque id feugiat vitae, fringilla at arcu. Ut lacinia ullamcorper nibh, sit amet condimentum lorem gravida eu. Nullam vel lectus viverra, hendrerit elit nec, fermentum orci. Morbi id lacus interdum, aliquam ex ac, tristique ipsum. In in sem felis. Ut vitae varius ante. Vivamus odio ipsum, vulputate a ullamcorper nec, viverra at enim. Nullam ac lectus sodales velit scelerisque finibus ac vitae purus.&lt;br&gt;&lt;br&gt;Etiam hendrerit faucibus placerat. Aenean pharetra tincidunt est sodales viverra. In faucibus sollicitudin iaculis. Integer magna neque, pulvinar ut pellentesque sit amet, ullamcorper quis tellus. Donec mattis euismod est, sed venenatis ex tincidunt a. Fusce nec ultricies justo, eget euismod augue. Nunc non tincidunt risus. Etiam pharetra suscipit lorem, quis gravida nulla ultrices sodales. Proin egestas ipsum purus, eu aliquam nisl mollis sit amet. Praesent nec arcu mollis, mattis dolor ac, imperdiet metus. Cras porttitor, neque id lobortis finibus, erat nisl dignissim urna, in vulputate metus libero sollicitudin augue. Nullam suscipit semper sapien, et facilisis felis ullamcorper et.&lt;br&gt;&lt;br&gt;In vestibulum, neque non viverra faucibus, tellus ante eleifend massa, nec tincidunt ligula nisl eget risus. Aenean volutpat vulputate nibh ut porttitor. Suspendisse porta ipsum sagittis augue aliquam, vel convallis nibh facilisis. Sed luctus mauris eget efficitur imperdiet. Maecenas non rutrum urna. Fusce pellentesque convallis ante, at vulputate felis ornare vel. Suspendisse nec euismod enim. Phasellus posuere odio sed lobortis fermentum. Donec mollis imperdiet mollis. Phasellus fringilla odio ut diam facilisis, eget convallis magna consectetur. Curabitur pretium iaculis vestibulum. Integer tincidunt nunc vitae risus interdum luctus. Vivamus et justo a eros ultricies ullamcorper at id leo. &lt;br&gt;&lt;/p&gt;&quot;&gt;&lt;img&gt;', 'flt_1.jpg', '2020-08-09 08:49:15', '2020-08-16 07:56:04', 1);

DROP TABLE IF EXISTS `blogstatus`;
CREATE TABLE `blogstatus` (
  `id` int(11) NOT NULL,
  `bstatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `blogstatus` (`id`, `bstatus`) VALUES
(1, 1);

DROP TABLE IF EXISTS `bookingtbl`;
CREATE TABLE `bookingtbl` (
  `id` int(11) NOT NULL,
  `serviceId` int(255) DEFAULT NULL,
  `agentId` int(11) NOT NULL,
  `adults` int(11) DEFAULT NULL,
  `childrens` int(11) DEFAULT NULL,
  `date` varchar(255) CHARACTER SET latin1 NOT NULL,
  `timing` varchar(255) CHARACTER SET latin1 NOT NULL,
  `serviceBill` float NOT NULL,
  `paymentStatus` varchar(50) CHARACTER SET latin1 NOT NULL,
  `orderId` varchar(255) CHARACTER SET latin1 NOT NULL,
  `serviceStatus` varchar(50) CHARACTER SET latin1 NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `comments-settings`;
CREATE TABLE `comments-settings` (
  `id` int(11) NOT NULL,
  `active_plugin` int(11) DEFAULT 1 COMMENT '1 = Facebook, 2 = Disqus',
  `facebook_app_id` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `disqus_short_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comments-settings` (`id`, `active_plugin`, `facebook_app_id`, `disqus_short_name`) VALUES
(1, 2, '1645146312195843', 'local-site-1');

DROP TABLE IF EXISTS `contactdetails`;
CREATE TABLE `contactdetails` (
  `id` int(11) NOT NULL,
  `address` text CHARACTER SET latin1 NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `map_src` text CHARACTER SET latin1 NOT NULL,
  `map_wd` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `map_ht` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `urlFb` text CHARACTER SET latin1 NOT NULL,
  `urlTwt` text CHARACTER SET latin1 NOT NULL,
  `urlIn` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `contactdetails` (`id`, `address`, `phone`, `email`, `map_src`, `map_wd`, `map_ht`, `urlFb`, `urlTwt`, `urlIn`) VALUES
(1, 'Skippergata 33, 0154&lt;br&gt;\r\nOslo, Norway', '(123) 456 7892', 'desclix1@gmail.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d64033.28149209223!2d10.7247325!3d59.898285!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e61f267f039:0x7e92605fd3231e9a!2sOslo, Norway!5e0!3m2!1sen!2s!4v1595953265617!5m2!1sen!2s', '100%', '582', '#fb', '#twt', '#in');

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `imgName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `imgDetails` text CHARACTER SET latin1 NOT NULL,
  `imgPath` text CHARACTER SET latin1 NOT NULL,
  `catId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gallery` (`id`, `imgName`, `imgDetails`, `imgPath`, `catId`) VALUES
(17, 'Hair design 1', 'Hair design 1 Short Detail.&lt;br&gt;', 'hairdesign1.jpg', 7),
(18, 'Hair design 2', 'Hair design 2 Short Detail.&lt;br&gt;', 'hairdesign2.jpg', 7),
(19, 'Hair design 3', 'Hair design 3 Short Detail.&lt;br&gt;', 'hairdesign3.jpg', 7),
(20, 'Hair design 4', 'Hair design 4 Short Detail.&lt;br&gt;', 'hairdesign4.jpg', 7),
(22, 'Haircut 1', 'Haircut 1 Short Detail.&lt;br&gt;', 'haircut1.jpg', 8),
(23, 'Haircut 2', 'Haircut 2 Short Detail.&lt;br&gt;', 'haircut2.jpg', 8),
(24, 'Haircut 3', 'Haircut 3 Short Detail.&lt;br&gt;', 'haircut3.jpg', 8),
(28, 'Spa 1', 'Spa 1 Short Detail.&lt;br&gt;', 'spa1.jpg', 9),
(29, 'Spa 2', 'Spa 2 Short Detail.&lt;br&gt;', 'spa2.jpg', 9),
(30, 'Spa 3', 'Spa 3 Short Detail.&lt;br&gt;', 'spa3.jpg', 9),
(34, ' Nail Service 1', '&lt;p&gt;Nail service 1 Short Detail.&lt;/p&gt;', 'nail1.jpg', 10),
(35, ' Nail Service 2', '&lt;p&gt;Nail service 2 Short Detail.&lt;/p&gt;', 'nail2.jpg', 10),
(36, ' Nail Service 3', '&lt;p&gt;Nail service 3 Short Detail.&lt;/p&gt;', 'nail3.jpg', 10),
(37, 'Makeup 1', '&lt;p&gt;Makeup 1 Short Detail.&lt;/p&gt;', 'makeup1.jpg', 11),
(38, 'Makeup 2', '&lt;p&gt;Makeup 2 Short Detail.&lt;/p&gt;', 'makeup2.jpg', 11),
(39, 'Makeup 3', '&lt;p&gt;Makeup 3 Short Detail.&lt;/p&gt;', 'makeup3.jpg', 11);

DROP TABLE IF EXISTS `gcategory`;
CREATE TABLE `gcategory` (
  `id` int(11) NOT NULL,
  `cName` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gcategory` (`id`, `cName`) VALUES
(7, 'Hair Design'),
(8, 'Haircut'),
(9, 'Spa'),
(10, 'Nail Service'),
(11, 'Makeup');

DROP TABLE IF EXISTS `general-settings`;
CREATE TABLE `general-settings` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `keywords` text CHARACTER SET latin1 NOT NULL,
  `logo` text CHARACTER SET latin1 NOT NULL,
  `favicon` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `general-settings` (`id`, `title`, `description`, `keywords`, `logo`, `favicon`) VALUES
(1, 'Salon Booking', 'Salon booking system make easy to use to get appointment and you can easily manage your bookings.', 'beauty salon, salon booking, booking system, salon', 'logo2.png', 'favicon.png');

DROP TABLE IF EXISTS `logintbl`;
CREATE TABLE `logintbl` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `verifiedEmail` int(5) NOT NULL,
  `image` varchar(500) CHARACTER SET latin1 NOT NULL,
  `photoURL` varchar(500) CHARACTER SET latin1 NOT NULL,
  `role` int(5) NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 NOT NULL,
  `gender` varchar(10) CHARACTER SET latin1 NOT NULL,
  `bookingId` int(10) NOT NULL,
  `activated` int(11) NOT NULL,
  `activationCode` text CHARACTER SET latin1 NOT NULL,
  `google` tinyint(1) NOT NULL,
  `facebook` tinyint(1) NOT NULL,
  `privacy` tinyint(1) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `logintbl` (`id`, `fullName`, `email`, `password`, `verifiedEmail`, `image`, `photoURL`, `role`, `phone`, `gender`, `bookingId`, `activated`, `activationCode`, `google`, `facebook`, `privacy`, `register_date`) VALUES
(104, 'client1', 'client1@mail.com', '$2y$10$BUz2rDlMpqNRgnSFESJqMOBDNHL2b2k64bRza1s2TUBw7jIh6lbyq', 0, '', '', 0, '+923335754716', '', 0, 0, '60d99e7142530a930e74272e27069ecc', 0, 0, 0, '2020-07-29 15:35:24'),
(105, 'client2', 'client2@mail.com', '$2y$10$BkGbW/vgUUH27AF6NQelEODBW8rNdzMCLDasy9FYaaW1mRz7fkpk.', 0, '', '', 0, '+926548765320', '', 0, 0, '9c8ef6ff34ddb86f06231664558ea160', 0, 0, 0, '2020-07-29 15:36:41'),
(106, 'client3', 'client3@mail.com', '$2y$10$YnCp9ib20/kepaIiCNDpj.fuWqo9uYLfsuMNXb.lch3O3v6oHFgam', 0, '', '', 0, '00576654192048', '', 0, 0, '28dbf93f5d65e041000d1e47126419bf', 0, 0, 0, '2020-07-29 15:37:34'),
(140, 'admin1', 'admin@gmail.com', '$2y$10$HzBQtLU2cn1J7COxXHkHee7cOHLh32z4iVOLz018jPqGWrlJc.H72', 0, '', '', 1, '', '', 0, 0, '', 0, 0, 0, '2020-08-03 06:07:48');

DROP TABLE IF EXISTS `meta-tags-settings`;
CREATE TABLE `meta-tags-settings` (
  `id` int(11) NOT NULL,
  `meta_tags` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `meta-tags-settings` (`id`, `meta_tags`) VALUES
(1, '');

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderId` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  `transectionId` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `paid_currency` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receipt_url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `permalink` text NOT NULL,
  `content` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `page_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pages` (`id`, `title`, `permalink`, `content`, `position`, `status`, `page_order`) VALUES
(2, 'Privacy Policy', 'privacy-policy', '&lt;p&gt;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut neque eget velit sagittis viverra vitae ac nisi. Cras tincidunt, erat venenatis ornare hendrerit, lacus ante pulvinar enim, bibendum accumsan arcu eros sed orci. In tempor tincidunt auctor. Vestibulum placerat dignissim lacinia. Vestibulum imperdiet libero elit, sit amet vestibulum ex pellentesque at. Nam egestas erat nisi, quis sollicitudin quam sagittis sed. Phasellus elit urna, mollis sit amet lacus in, lobortis pellentesque leo. Pellentesque hendrerit maximus lacus a faucibus. Aliquam erat volutpat. Mauris eu augue placerat, congue urna sit amet, eleifend leo. Nullam id molestie est. Morbi rhoncus enim at libero ullamcorper, non pellentesque mi molestie. Nam commodo elementum diam, nec aliquam leo gravida vel. Maecenas et lacus metus. Integer lobortis nisi arcu, non elementum erat interdum eu.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut neque eget velit sagittis viverra vitae ac nisi. Cras tincidunt, erat venenatis ornare hendrerit, lacus ante pulvinar enim, bibendum accumsan arcu eros sed orci. In tempor tincidunt auctor. Vestibulum placerat dignissim lacinia. Vestibulum imperdiet libero elit, sit amet vestibulum ex pellentesque at. Nam egestas erat nisi, quis sollicitudin quam sagittis sed. Phasellus elit urna, mollis sit amet lacus in, lobortis pellentesque leo. Pellentesque hendrerit maximus lacus a faucibus. Aliquam erat volutpat. Mauris eu augue placerat, congue urna sit amet, eleifend leo. Nullam id molestie est. Morbi rhoncus enim at libero ullamcorper, non pellentesque mi molestie. Nam commodo elementum diam, nec aliquam leo gravida vel. Maecenas et lacus metus. Integer lobortis nisi arcu, non elementum erat interdum eu.\r\n&lt;/p&gt;\r\n&lt;h4&gt;Fusce vitae leo finibus, placerat ligula nec:&lt;/h4&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit.&lt;/li&gt;\r\n&lt;li&gt;Vestibulum consectetur ex in elementum pulvinar.&lt;/li&gt;\r\n&lt;li&gt;Quisque finibus lectus quis nulla ultrices, ac malesuada turpis consectetur.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut neque eget velit sagittis viverra vitae ac nisi. Cras tincidunt, erat venenatis ornare hendrerit, lacus ante pulvinar enim, bibendum accumsan arcu eros sed orci. In tempor tincidunt auctor. Vestibulum placerat dignissim lacinia. Vestibulum imperdiet libero elit, sit amet vestibulum ex pellentesque at. Nam egestas erat nisi, quis sollicitudin quam sagittis sed. Phasellus elit urna, mollis sit amet lacus in, lobortis pellentesque leo. Pellentesque hendrerit maximus lacus a faucibus. Aliquam erat volutpat. Mauris eu augue placerat, congue urna sit amet, eleifend leo. Nullam id molestie est. Morbi rhoncus enim at libero ullamcorper, non pellentesque mi molestie. Nam commodo elementum diam, nec aliquam leo gravida vel. Maecenas et lacus metus. Integer lobortis nisi arcu, non elementum erat interdum eu.\r\n&lt;/p&gt;', 2, 1, 1),
(4, 'Terms &amp; Conditions', 'terms-conditions', '&lt;p&gt;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut neque eget velit sagittis viverra vitae ac nisi. Cras tincidunt, erat venenatis ornare hendrerit, lacus ante pulvinar enim, bibendum accumsan arcu eros sed orci. In tempor tincidunt auctor. Vestibulum placerat dignissim lacinia. Vestibulum imperdiet libero elit, sit amet vestibulum ex pellentesque at. Nam egestas erat nisi, quis sollicitudin quam sagittis sed. Phasellus elit urna, mollis sit amet lacus in, lobortis pellentesque leo. Pellentesque hendrerit maximus lacus a faucibus. Aliquam erat volutpat. Mauris eu augue placerat, congue urna sit amet, eleifend leo. Nullam id molestie est. Morbi rhoncus enim at libero ullamcorper, non pellentesque mi molestie. Nam commodo elementum diam, nec aliquam leo gravida vel. Maecenas et lacus metus. Integer lobortis nisi arcu, non elementum erat interdum eu.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut neque eget velit sagittis viverra vitae ac nisi. Cras tincidunt, erat venenatis ornare hendrerit, lacus ante pulvinar enim, bibendum accumsan arcu eros sed orci. In tempor tincidunt auctor. Vestibulum placerat dignissim lacinia. Vestibulum imperdiet libero elit, sit amet vestibulum ex pellentesque at. Nam egestas erat nisi, quis sollicitudin quam sagittis sed. Phasellus elit urna, mollis sit amet lacus in, lobortis pellentesque leo. Pellentesque hendrerit maximus lacus a faucibus. Aliquam erat volutpat. Mauris eu augue placerat, congue urna sit amet, eleifend leo. Nullam id molestie est. Morbi rhoncus enim at libero ullamcorper, non pellentesque mi molestie. Nam commodo elementum diam, nec aliquam leo gravida vel. Maecenas et lacus metus. Integer lobortis nisi arcu, non elementum erat interdum eu.\r\n&lt;/p&gt;\r\n&lt;h4&gt;Fusce vitae leo finibus, placerat ligula nec:&lt;/h4&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit.&lt;/li&gt;\r\n&lt;li&gt;Vestibulum consectetur ex in elementum pulvinar.&lt;/li&gt;\r\n&lt;li&gt;Quisque finibus lectus quis nulla ultrices, ac malesuada turpis consectetur.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut neque eget velit sagittis viverra vitae ac nisi. Cras tincidunt, erat venenatis ornare hendrerit, lacus ante pulvinar enim, bibendum accumsan arcu eros sed orci. In tempor tincidunt auctor. Vestibulum placerat dignissim lacinia. Vestibulum imperdiet libero elit, sit amet vestibulum ex pellentesque at. Nam egestas erat nisi, quis sollicitudin quam sagittis sed. Phasellus elit urna, mollis sit amet lacus in, lobortis pellentesque leo. Pellentesque hendrerit maximus lacus a faucibus. Aliquam erat volutpat. Mauris eu augue placerat, congue urna sit amet, eleifend leo. Nullam id molestie est. Morbi rhoncus enim at libero ullamcorper, non pellentesque mi molestie. Nam commodo elementum diam, nec aliquam leo gravida vel. Maecenas et lacus metus. Integer lobortis nisi arcu, non elementum erat interdum eu.\r\n&lt;/p&gt;', 2, 1, 0);

DROP TABLE IF EXISTS `recaptcha-settings`;
CREATE TABLE `recaptcha-settings` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `site_key` text NOT NULL,
  `secret_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `recaptcha-settings` (`id`, `status`, `site_key`, `secret_key`) VALUES
(1, 0, '', '');

DROP TABLE IF EXISTS `servicetable`;
CREATE TABLE `servicetable` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `price` float NOT NULL,
  `servStart` varchar(20) CHARACTER SET latin1 NOT NULL,
  `servEnd` varchar(20) CHARACTER SET latin1 NOT NULL,
  `servDuration` varchar(20) CHARACTER SET latin1 NOT NULL,
  `servSpace` int(50) NOT NULL,
  `image` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `agentIds` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `servicetable` (`id`, `title`, `description`, `price`, `servStart`, `servEnd`, `servDuration`, `servSpace`, `image`, `agentIds`) VALUES
(19, 'Hair Design', '&lt;p&gt;You can book hair design service&lt;/p&gt;', 15.5, '09:00 AM', '05:00 PM', '02:30', 5, 'hairdesign41.jpg', '1,2,3,4'),
(20, 'Haircut', '&lt;p&gt;You can easily boot haircut service.&lt;br&gt;&lt;/p&gt;', 4, '10:00 AM', '05:00 PM', '01:00', 10, 'haircut51.jpg', '2,3'),
(21, 'Spa', '&lt;p&gt;You can book hair spa service.&lt;/p&gt;', 10.5, '08:00 AM', '04:00 PM', '01:00', 8, 'spa1.jpg', '7,4,1'),
(25, 'new Test Title', 'new Test Title', 22, '08:00 AM', '05:00 PM', '01:00', 2, 'Screenshot_3.png', '7,6,4,3'),
(26, 'New Test Service', '&lt;p&gt;New Content&lt;/p&gt;\r\n', 12, '08:00 AM', '05:05 PM', '02:00', 12, 'Screenshot_3.png', '6,2');

DROP TABLE IF EXISTS `smtp-settings`;
CREATE TABLE `smtp-settings` (
  `id` int(11) NOT NULL,
  `host` text NOT NULL,
  `port` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `smtp-settings` (`id`, `host`, `port`, `username`, `password`, `status`, `email`) VALUES
(1, '', '', '', '', 0, 'desclix1@gmail.com');

DROP TABLE IF EXISTS `social-keys-settings`;
CREATE TABLE `social-keys-settings` (
  `id` int(11) NOT NULL,
  `google_public` varchar(255) NOT NULL,
  `google_secret` varchar(255) NOT NULL,
  `facebook_public` varchar(255) NOT NULL,
  `facebook_secret` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `social-keys-settings` (`id`, `google_public`, `google_secret`, `facebook_public`, `facebook_secret`) VALUES
(1, '', '', '', '');

DROP TABLE IF EXISTS `stripe-settings`;
CREATE TABLE `stripe-settings` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `stripe_api_key` text NOT NULL,
  `stripe_publishable_key` text NOT NULL,
  `stripe_currency` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `stripe-settings` (`id`, `status`, `stripe_api_key`, `stripe_publishable_key`, `stripe_currency`) VALUES
(1, 0, '', '', 'USD');

DROP TABLE IF EXISTS `themesettings`;
CREATE TABLE `themesettings` (
  `id` int(11) NOT NULL,
  `theme` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `themesettings` (`id`, `theme`) VALUES
(1, 'redishtheme');


ALTER TABLE `ad-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `analytics-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `blogstatus`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bookingtbl`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comments-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contactdetails`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gcategory`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `general-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `logintbl`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `meta-tags-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `recaptcha-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `servicetable`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `smtp-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `social-keys-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stripe-settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `themesettings`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `ad-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `analytics-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `blogstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `bookingtbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `comments-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `contactdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `gcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `general-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `logintbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `meta-tags-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `recaptcha-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `servicetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `smtp-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `social-keys-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `stripe-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `themesettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;