CREATE TABLE `todo` (
  `id` bigint(20) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `start_date` varchar(30) NOT NULL,
  `end_date` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `todo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;