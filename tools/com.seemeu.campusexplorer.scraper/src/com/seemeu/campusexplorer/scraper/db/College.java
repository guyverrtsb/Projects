package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class College
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("CREATE_DEFAULT_UNIVERSITY"))
		{
			// ENTITY
			this.setPreparedStatement("INSERT INTO `entityaccount` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`configurations_sdesc_entitytype`,`configurations_sdesc_entityaccept`,`sdesc`,`ldesc`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",'ENTITY_TYPE-UNIVERSITY','ENTITY_ACCEPT-AUTO_ACCEPT','GROUPUNIV_UNIVERSITY','Group University Entity'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_ENTITYACCOUNT");

			this.setPreparedStatement("INSERT INTO `entityprofile` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`ldesc`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",'Group University representing the Corporate solution from SeeMeU'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_ENTITYPROFILE");
			
			this.setPreparedStatement("INSERT INTO `match_entity` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`entityaccount_uid`,`entityprofile_uid`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",(SELECT uid FROM `entityaccount` WHERE `lid` = ?), (SELECT uid FROM `entityprofile` WHERE `lid` = ?)" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_MATCH_ENTITYACCOUNT_TO_ENTITYPROFILE");			
			
			// UNIVERSITY
			this.setPreparedStatement("INSERT INTO `entity_universitysource` " +
					"(`lid`, `uid`,`createddt`,`changeddt`,`url`,`idx`," +
					"`profilecreated`,`accountcreated`,`snapshot_essentials`,`snapshot_about`," +
					"`snapshot_overallratings`,`snapshot_studentratings`,`snapshot_location`,`snapshot_gettingaround`," +
					"`snapshot_walkability`,`snapshot_transit`,`snapshot_weather`,`snapshot_students`," +
					"`snapshot_similar`,`snapshot_otherschoolsnear`) " +
					"VALUES " +
					"(?, UUID(),NOW(),NOW(),?,?," +
					"'T','T','F','F'," +
					"'F','F','F','F'," +
					"'F','F','F','F'," +
					"'F','F'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassString("url"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_SOURCE [" + this.getDataPassString("url") + "]");
			
			this.setPreparedStatement("INSERT INTO `entity_universitysourcedata` " +
					"(`lid`, `uid`,`createddt`,`changeddt`,`idx`,`entity_universitysource_uid`) " +
					"VALUES (?, UUID(),NOW(),NOW(),?,(select uid from `entity_universitysource` where lid = ?))");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_SOURCE [" + this.getDataPassString("url") + "]");
			
			this.setPreparedStatement("INSERT INTO `entity_universityaccount` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`emaildomain`,`isactive`,`islive`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",?,'T','T'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassString("emaildomain"));
			this.create("CREATE_DEFAULT_UNIV_ACCOUNT [" + this.getDataPassString("emaildomain") + "]");
			
			this.setPreparedStatement("INSERT INTO `entity_universityprofile` " +
					"(`lid`,`uid`,`createddt`,`changeddt`" +
					",`city`,`crossappl_configurations_sdesc_region`,`crossappl_configurations_sdesc_country`,`region`" +
					",`ldesc`,`name`,`phonenumber`,`configurations_sdesc_schooltype`" +
					",`schooltype`,`latitude`,`longitude`,`entity_universitysource_uid`" +
					",`webaddress`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",?,?,?,?" +
					",?,?,?,?" +
					",?,?,?,(select uid from `entity_universitysource` where lid = ?)" +
					",?" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassString("city"));
			this.bind(3, this.getDataPassString("crossappl_configurations_sdesc_region"));
			this.bind(4, this.getDataPassString("crossappl_configurations_sdesc_country"));
			this.bind(5, this.getDataPassString("region"));
			this.bind(6, this.getDataPassString("ldesc"));
			this.bind(7, this.getDataPassString("name"));
			this.bind(8, this.getDataPassString("phonenumber"));
			this.bind(9, this.getDataPassString("configurations_sdesc_schooltype"));
			this.bind(10, this.getDataPassString("schooltype"));
			this.bind(11, this.getDataPassString("latitude"));
			this.bind(12, this.getDataPassString("longitude"));
			this.bind(13, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(14, this.getDataPassString("webaddress"));
			this.create("CREATE_DEFAULT_UNIV_PROFILE [" + this.getDataPassString("webaddress") + "]");
			
			this.setPreparedStatement("INSERT INTO `match_entity_university` " +
					"(`lid`,`uid`,`createddt`,`changeddt`" +
					",`entity_universityaccount_uid`,`entity_universityprofile_uid`,`match_entity_uid`,`match_usersafety_user_uid`" +
					",`configurations_sdesc_usertype`,`configurations_sdesc_entityrole`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",(select uid from `entity_universityaccount` where lid = ?)" +
					",(select uid from `entity_universityprofile` where entity_universitysource_uid = (select uid from `entity_universitysource` where lid = ?))" +
					",(select uid from `match_entity` where lid = ?)" +
					",'SEEMEU_MASTER_USER'" +
					",'USER_TYPE-SEEMEU'" +
					",'ENTITY_ROLE-OWNER'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(4, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_MATCH");
			
			// GROUP
			this.setPreparedStatement("INSERT INTO `groupaccount` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`configurations_sdesc_grouptype`,`configurations_sdesc_groupvisibility`,`configurations_sdesc_groupaccept`" +
					",`sdesc`,`ldesc`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",'GROUP_TYPE-ENTITY','GROUP_ACCEPT-OWNER_ACCEPT','GROUP_VISIBILITY-PUBLIC'" +
					",'GROUPUNIVCOM_PUBLIC','Group University Channel for the Public'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_GROUPACCOUNT");
			
			this.setPreparedStatement("INSERT INTO `groupaccount` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`configurations_sdesc_grouptype`,`configurations_sdesc_groupvisibility`,`configurations_sdesc_groupaccept`" +
					",`sdesc`,`ldesc`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",'GROUP_TYPE-ENTITY','GROUP_ACCEPT-AUTO_ACCEPT','GROUP_VISIBILITY-ENTITY_PRIVATE'" +
					",'GROUPUNIVCOM_ENTITYPRIVATE','Group University Channel for University Members'" +
					")");
			this.bind(1, (this.getDataPassInt("ZZZZCOUNTER") + 1));
			this.create("CREATE_DEFAULT_UNIV_GROUPACCOUNT");

			this.setPreparedStatement("INSERT INTO `groupprofile` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`ldesc`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",'Group University representing the Corporate solution from SeeMeU'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_GROUPPROFILE");

			this.setPreparedStatement("INSERT INTO `groupprofile` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`ldesc`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",'Group University representing the Corporate solution from SeeMeU for University Members')");
			this.bind(1, (this.getDataPassInt("ZZZZCOUNTER") + 1));
			this.create("CREATE_DEFAULT_UNIV_GROUPPROFILE");
			
			this.setPreparedStatement("INSERT INTO `match_group` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`groupaccount_uid`,`groupprofile_uid`" +
					",`match_entity_uid`,`match_usersafety_user_uid`,`configurations_sdesc_grouprole`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",(SELECT uid FROM `groupaccount` WHERE `lid` = ?)" +
					",(SELECT uid FROM `groupprofile` WHERE `lid` = ?)" +
					",(select uid from `match_entity` where lid = ?)" +
					",'SEEMEU_MASTER_USER','GROUP_ROLE-OWNER'" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(4, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_MATCH_GROUPACCOUNT_TO_GROUPPROFILE");
			
			this.setPreparedStatement("INSERT INTO `match_group` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`groupaccount_uid`,`groupprofile_uid`" +
					",`match_entity_uid`,`match_usersafety_user_uid`,`configurations_sdesc_grouprole`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",(SELECT uid FROM `groupaccount` WHERE `lid` = ?)" +
					",(SELECT uid FROM `groupprofile` WHERE `lid` = ?)" +
					",(select uid from `match_entity` where lid = ?)" +
					",'SEEMEU_MASTER_USER','GROUP_ROLE-OWNER'" +
					")");
			this.bind(1, (this.getDataPassInt("ZZZZCOUNTER") + 1));
			this.bind(2, (this.getDataPassInt("ZZZZCOUNTER") + 1));
			this.bind(3, (this.getDataPassInt("ZZZZCOUNTER") + 1));
			this.bind(4, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_DEFAULT_UNIV_MATCH_GROUPACCOUNT_TO_GROUPPROFILE");
			
			this.setPreparedStatement("INSERT INTO `search_entities` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`match_entity_uid`,`record_uid`" +
					",`configurations_sdesc_entitytype`,`text`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",(SELECT uid FROM `match_entity` WHERE `lid` = ?)" +
					",(SELECT uid FROM `entity_universityaccount` WHERE `lid` = ?)" +
					",'ENTITY_TYPE-UNIVERSITY',(SELECT webaddress FROM `entity_universityprofile` WHERE `lid` = ?)" +
					")");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(4, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_ENTITY_SEARCH_WEBADDRESS");
			
			this.setPreparedStatement("INSERT INTO `search_entities` (`lid`,`uid`,`createddt`,`changeddt`" +
					",`match_entity_uid`,`record_uid`" +
					",`configurations_sdesc_entitytype`,`text`) " +
					"VALUES (?,UUID(),NOW(),NOW()" +
					",(SELECT uid FROM `match_entity` WHERE `lid` = ?)" +
					",(SELECT uid FROM `entity_universityaccount` WHERE `lid` = ?)" +
					",'ENTITY_TYPE-UNIVERSITY',(SELECT emaildomain FROM `entity_universityaccount` WHERE `lid` = ?)" +
					")");
			this.bind(1, (this.getDataPassInt("ZZZZCOUNTER") + 1));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(4, this.getDataPassInt("ZZZZCOUNTER"));
			this.create("CREATE_ENTITY_SEARCH_EMAILDOMAIN");
			
		}
		else if(key.equalsIgnoreCase("GET_ALL_UNIVERSITYSOURCE"))
		{
			this.setPreparedStatement("SELECT lid, uid, url, idx, profilecreated, accountcreated, snapshot_essentials, snapshot_about, " +
					"snapshot_overallratings, snapshot_studentratings, snapshot_location, snapshot_gettingaround, snapshot_walkability, " +
					"snapshot_transit, snapshot_weather, snapshot_students, snapshot_similar, snapshot_otherschoolsnear, " +
					"snapshot_screendata, academics_screendata, costs_screendata, admissions_screendata, collegelife_screendata, " +
					"photosvideos_screendata, reviews_screendata " +
					"FROM entity_universitysource");
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("GET_UNIVERSITYSOURCE_FROM_URL"))
		{
			this.setPreparedStatement("SELECT lid, uid, url, idx, profilecreated, accountcreated, snapshot_essentials, snapshot_about, " +
					"snapshot_overallratings, snapshot_studentratings, snapshot_location, snapshot_gettingaround, snapshot_walkability, " +
					"snapshot_transit, snapshot_weather, snapshot_students, snapshot_similar, snapshot_otherschoolsnear, " +
					"snapshot_screendata, academics_screendata, costs_screendata, admissions_screendata, collegelife_screendata, " +
					"photosvideos_screendata, reviews_screendata " +
					"FROM entity_universitysource WHERE url = ?");
			this.bind(1, this.getDataPassString("url"));
			this.retrieve(key + " [url=" + this.getDataPassString("url") + "]");
		}
		else if(key.equalsIgnoreCase("GET_UNIVERSITYSOURCE_FROM_UID"))
		{
			this.setPreparedStatement("SELECT lid, uid, url, idx, profilecreated, accountcreated, snapshot_essentials, snapshot_about, " +
					"snapshot_overallratings, snapshot_studentratings, snapshot_location, snapshot_gettingaround, snapshot_walkability, " +
					"snapshot_transit, snapshot_weather, snapshot_students, snapshot_similar, snapshot_otherschoolsnear, " +
					"snapshot_screendata, academics_screendata, costs_screendata, admissions_screendata, collegelife_screendata, " +
					"photosvideos_screendata, reviews_screendata " +
					"FROM entity_universitysource WHERE uid = ?");
			this.bind(1, this.getDataPassString("uid"));
			this.retrieve(key + " [url=" + this.getDataPassString("uid") + "]");
		}
		else if(key.equalsIgnoreCase("CREATE_UNIVERSITYSOURCE"))
		{
			this.setPreparedStatement("INSERT INTO entity_universitysource " +
			"(`lid`,`uid`,`createddt`,`changeddt`,`url`, idx) " +
			"VALUES " +
			"(?, UUID(), NOW(), NOW(), ?, ?)");
			this.bind(1, (int)this.getDataPass().get("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassString("url"));
			this.bind(3, this.getDataPassInt("idx"));
			this.create(key + " [url=" + this.getDataPassString("url") + "]");
		}
		else if(key.equalsIgnoreCase("CREATE_UNIVERSITYSOURCEDATA"))
		{
			this.setPreparedStatement("INSERT INTO entity_universitysourcedata " +
			"(`lid`,`uid`,`createddt`,`changeddt`, `idx`, `entity_universitysource_uid`) " +
			"VALUES " +
			"(?, UUID(), NOW(), NOW(), ?, (select uid from `entity_universitysource` where lid = ?))");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.create(key + " [idx=" + Integer.toString(this.getDataPassInt("ZZZZCOUNTER")) + "]");
		}
		else if(key.equalsIgnoreCase("UPDATE_UNIVERSITYSOURCE_STATUS"))
		{
			this.setPreparedStatement("UPDATE entity_universitysource SET " +
					"`changeddt` = NOW(), " +
					"`" + this.getDataPassString("fieldname") + "` = ? " +
					"WHERE `uid` = ?");
			this.bind(1, this.getDataPassString("fieldvalue"));
			this.bind(2, this.getDataPassString("entity_universitysource_uid"));
			this.create(key + " [uid=" + this.getDataPassString("universitysource_uid") + "]");
		}
		else if(key.equalsIgnoreCase("UPDATE_UNIVERSITYSOURCEDATA_JSON"))
		{
			this.setPreparedStatement("UPDATE entity_universitysourcedata SET " +
					"`changeddt` = NOW(), " +
					"`" + this.getDataPassString("fieldname") + "_json` = ? " +
					"WHERE `uid` = ?");
			this.bind(1, this.getDataPassString("json"));
			this.bind(2, this.getDataPassString("entity_universitysource_uid"));
			this.create(key + " [uid=" + this.getDataPassString("entity_universitysource_uid") + "][json=" + this.getDataPassString("json").substring(0, 1000) + "]");
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}
