USE `seemeuapplication`;

INSERT INTO `search_entities` (`lid`,`uid`,`createddt`,`changeddt`
,`entityaccount_uid`,`recourd_uid`
,`configurations_sdesc_entitytype`,`text`)
VALUES (2,UUID(),NOW(),NOW()
,(SELECT uid FROM `entityaccount` WHERE `lid` = 1),(SELECT uid FROM `universityaccount` WHERE `lid` = 1)
,'ENTITY_TYPE-UNIVERSITY','www.mit.edu');
INSERT INTO `search_entities` (`lid`,`uid`,`createddt`,`changeddt`
,`entityaccount_uid`,`recourd_uid`
,`configurations_sdesc_entitytype`,`text`)
VALUES (3,UUID(),NOW(),NOW()
,(SELECT uid FROM `entityaccount` WHERE `lid` = 1),(SELECT uid FROM `universityaccount` WHERE `lid` = 1)
,'ENTITY_TYPE-UNIVERSITY','www.duke.edu');
INSERT INTO `search_entities` (`lid`,`uid`,`createddt`,`changeddt`
,`entityaccount_uid`,`recourd_uid`
,`configurations_sdesc_entitytype`,`text`)
VALUES (4,UUID(),NOW(),NOW()
,(SELECT uid FROM `entityaccount` WHERE `lid` = 1),(SELECT uid FROM `universityaccount` WHERE `lid` = 1)
,'ENTITY_TYPE-UNIVERSITY','www.harvard.edu');
INSERT INTO `search_entities` (`lid`,`uid`,`createddt`,`changeddt`
,`entityaccount_uid`,`recourd_uid`
,`configurations_sdesc_entitytype`,`text`)
VALUES (5,UUID(),NOW(),NOW()
,(SELECT uid FROM `entityaccount` WHERE `lid` = 1),(SELECT uid FROM `universityaccount` WHERE `lid` = 1)
,'ENTITY_TYPE-UNIVERSITY','www.seemeu.com');