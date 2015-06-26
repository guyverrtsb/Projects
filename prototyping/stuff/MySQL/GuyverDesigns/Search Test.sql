select documents_types.sdesc, search_objects.uid, search_objects.content
from search_objects 
join documents_types on documents_types.uid = search_objects.documents_types_uid
where match(search_objects.content) against ('Oracle');

-- INSERT INTO `gdcorpdb`.`search_objects`
-- (`uid`,
-- `createddt`,
-- `changeddt`,
-- `content`,
-- `object_uid`,
-- `documents_types_uid`)
-- VALUES
-- (
-- UUID(),NOW(),NOW(),
-- 'red',
-- UUID(),
-- (select uid from documents_types where sdesc = 'JOBS')
-- );
-- INSERT INTO `gdcorpdb`.`search_objects`
-- (`uid`,
-- `createddt`,
-- `changeddt`,
-- `content`,
-- `object_uid`,
-- `documents_types_uid`)
-- VALUES
-- (
-- UUID(),NOW(),NOW(),
-- 'The successful candidate will be working with a multinational agriculture biotechnology corporation. They will be a member of the TPS team within that organization to test enterprise-level Java, .Net, and Oracle applications. Each team is comprised of a project manager, business analysts, software developers and testers. These teams design, develop, and test Monsantos enterprise-class R&D software. The individual will be responsible for performing integration and system testing for each iteration of the development life cycle. They will also need to implement test scripts based on requirements created by the Business Analyst and will be responsible for logging the defects identified during testing ',
-- UUID(),
-- (select uid from documents_types where sdesc = 'JOBS')
-- );
-- INSERT INTO `gdcorpdb`.`search_objects`
-- (`uid`,
-- `createddt`,
-- `changeddt`,
-- `content`,
-- `object_uid`,
-- `documents_types_uid`)
-- VALUES
-- (
-- UUID(),NOW(),NOW(),
-- 'Manages all sales activities, from lead generation through close. Develops and implements agreed upon Marketing Plan(s) which will meet Zealcon’s business goals of expanding customer base in the Tulsa and Oklahoma City area. Works closely with support team for the achievement of customer satisfaction, revenue generation, and long‐term account goals in line with company vision and values',
-- UUID(),
-- (select uid from documents_types where sdesc = 'JOBS')
-- );

