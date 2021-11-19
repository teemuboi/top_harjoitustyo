CREATE TABLE `votes` (
  `voteid` int(11) NOT NULL,
  `messageid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `votes`
  ADD PRIMARY KEY (`voteid`),
  ADD KEY `messageid` (`messageid`),
  ADD KEY `userid` (`userid`);

ALTER TABLE `votes`
  MODIFY `voteid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
