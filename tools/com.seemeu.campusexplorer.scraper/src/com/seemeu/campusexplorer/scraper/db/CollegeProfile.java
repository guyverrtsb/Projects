package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class CollegeProfile
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("GET_UNIVERSITYPROFILE_FROM_UNIVERSITYSOURCE_UID"))
		{
			this.setPreparedStatement("SELECT uid FROM universityprofile where universitysource_uid = ?");
			this.bind(1, this.getDataPassString("universitysource_uid"));
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("CREATE_UNIVERSITYPROFILE"))
		{
			this.setPreparedStatement("INSERT INTO universityprofile " +
			"(`lid`, `uid`,`createddt`,`changeddt`,`city`,`region`,`ldesc`,`name`,`phonenumber`,`universitysource_uid`, " +
			"`schooltype`,`latitude`,`longitude`) " +
			"VALUES " +
			"(?,  UUID(), NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ? )");
			this.bind(1, (int)this.getDataPass().get("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassString("city"));
			this.bind(3, this.getDataPassString("region"));
			this.bind(4, this.getDataPassString("ldesc"));
			this.bind(5, this.getDataPassString("name"));
			this.bind(6, this.getDataPassString("phonenumber"));
			this.bind(7, this.getDataPassString("universitysource_uid"));
			this.bind(8, this.getDataPassString("schooltype"));
			this.bind(9, this.getDataPassString("latitude"));
			this.bind(10, this.getDataPassString("longitude"));
			this.create(key);
		}
		else if(key.equalsIgnoreCase("GET_MATCH_FROM_UNIVERSITYACCOUNT_AND_UNIVERSITYPROFILE"))
		{
			this.setPreparedStatement("SELECT * FROM universitysource " +
					"JOIN universityprofile " +
					"ON universitysource.uid = universityprofile.universitysource_uid " +
					"JOIN match_universityaccount_to_universityprofile " +
					"ON universityprofile.uid = match_universityaccount_to_universityprofile.universityprofile_uid " +
					"JOIN universityaccount " +
					"ON match_universityaccount_to_universityprofile.universityaccount_uid = universityaccount.uid " +
					"WHERE universitysource.url = ? AND universityaccount.uid = ?");
			this.bind(1, this.getDataPassString("url"));
			this.bind(2, this.getDataPassString("universityaccount_uid"));
			this.retrieve(key);
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}