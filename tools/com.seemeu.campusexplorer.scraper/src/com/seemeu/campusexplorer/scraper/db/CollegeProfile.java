package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class CollegeProfile
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("CREATE_INIT_UNIV_PROFILE"))
		{
			this.setPreparedStatement("INSERT INTO universityprofile " +
			"(`uid`,`createddt`,`changeddt`,`city`,`region`,`ldesc`,`name`,`phonenumber`,`universitysource_uid`, " +
			"`schooltype`,`latitude`,`longitude`) " +
			"VALUES " +
			"( UUID(), NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ? )");
			this.bind(1, this.getDataPassString("city"));
			this.bind(2, this.getDataPassString("region"));
			this.bind(3, this.getDataPassString("ldesc"));
			this.bind(4, this.getDataPassString("name"));
			this.bind(5, this.getDataPassString("phonenumber"));
			this.bind(6, this.getDataPassString("universitysource_uid"));
			this.bind(7, this.getDataPassString("schooltype"));
			this.bind(8, this.getDataPassString("latitude"));
			this.bind(9, this.getDataPassString("longitude"));
			this.create(key);
		}
		else if(key.equalsIgnoreCase("GET_UID_FOR_UNIVERSITYSOURCE_UID"))
		{
			this.setPreparedStatement("SELECT uid FROM universityprofile where universitysource_uid = ?");
			this.bind(1, this.getDataPassString("universitysource_uid"));
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("DOES_PROFILE_MATCH_TO_ACCOUNT_FOR_UNIVERSITYSOURCE_CXURL"))
		{
			this.setPreparedStatement("SELECT * FROM universitysource " +
					"JOIN universityprofile " +
					"ON universitysource.uid = universityprofile.universitysource_uid " +
					"JOIN match_universityaccount_to_universityprofile " +
					"ON universityprofile.uid = match_universityaccount_to_universityprofile.universityprofile_uid " +
					"JOIN universityaccount " +
					"ON match_universityaccount_to_universityprofile.universityaccount_uid = universityaccount.uid " +
					"WHERE universitysource.cxurl = ? AND universityaccount.uid = ?");
			this.bind(1, this.getDataPassString("cxurl"));
			this.bind(2, this.getDataPassString("universityaccount_uid"));
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("DOES_PROFILE_FOR_UNIVERSITYSOURCE_CXURL"))
		{
			this.setPreparedStatement("SELECT * FROM universitysource " +
					"JOIN universityprofile " +
					"ON universitysource.uid = universityprofile.universitysource_uid " +
					"JOIN match_universityaccount_to_universityprofile " +
					"ON universityprofile.uid = match_universityaccount_to_universityprofile.universityprofile_uid " +
					"WHERE universitysource.cxurl = ?");
			this.bind(1, this.getDataPassString("cxurl"));
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("GET_UNIVERSITYSOURCE_CXURL"))
		{
			this.setPreparedStatement("SELECT * FROM universitysource " +
					"WHERE cxurl = ?");
			this.bind(1, this.getDataPassString("cxurl"));
			this.retrieve(key);
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}