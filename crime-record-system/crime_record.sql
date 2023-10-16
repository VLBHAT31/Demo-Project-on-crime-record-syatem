SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `u_name` varchar(50) NOT NULL,
  `u_id` varchar(50) NOT NULL,
  `u_pass` varchar(50) NOT NULL,
  `u_addr` varchar(100) NOT NULL,
  `a_no` VARCHAR(12) NOT NULL, -- Match data type and length with 'aadhar_number' in 'complaint' table
  `gen` varchar(15) NOT NULL,
  `mob` bigint(10) NOT NULL,
  CONSTRAINT `uk_user_a_no` UNIQUE (`a_no`) -- Add unique constraint on 'a_no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `complaint` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `aadharNumber` VARCHAR(12) NOT NULL,
  `location` VARCHAR(255) NOT NULL,
  `date` DATE NOT NULL,
  `crime_type` VARCHAR(50) NOT NULL,
  `description` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE vote_counts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  location VARCHAR(255) NOT NULL,
  vote INT DEFAULT 0,
  UNIQUE KEY (location)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`u_name`, `u_id`, `u_pass`, `u_addr`, `a_no`, `gen`, `mob`) VALUES
('Satyansh Kumar', 'satyansh123@gmail.com', 'satyansh', 'Pumpwell', 123214521452, 'Male', 9854123654);

INSERT INTO `complaint` (`aadharNumber`, `location`, `date`, `crime_type`, `description`)
VALUES ('123214521452', 'City Center', '2023-08-20', 'Robbery', 'I witnessed a robbery at the City Center mall. The suspect was wearing a black hoodie and fled the scene on foot.');

INSERT INTO vote_counts (location, vote)
VALUES ('City Center', 5);

INSERT INTO vote_counts (location, vote)
VALUES ('Mangalore', 3);

ALTER TABLE `user`
  ADD UNIQUE KEY `u_id` (`u_id`),
  ADD UNIQUE KEY `mob` (`mob`);

COMMIT;
