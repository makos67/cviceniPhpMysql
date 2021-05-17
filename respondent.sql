GRANT USAGE ON *.* TO `respondent`@`localhost` IDENTIFIED BY PASSWORD '*BA0BADCC0D40C202F14EBB20855B9A106276BB3C';

GRANT SELECT, INSERT, UPDATE ON `ankety`.* TO `respondent`@`localhost` WITH GRANT OPTION;

GRANT DELETE ON `ankety`.`otazky` TO `respondent`@`localhost`;