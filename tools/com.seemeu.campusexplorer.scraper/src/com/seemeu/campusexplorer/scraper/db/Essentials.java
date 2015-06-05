package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class Essentials
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("DOES_WEB_EXIST"))
		{
			this.setPreparedStatement("SELECT * FROM universityaccount WHERE webaddress = ?");
			this.bind(1, this.getDataPassString("webaddress"));
			this.retrieve(key);
			this.getResult();
		}
		else if(key.equalsIgnoreCase("CREATE_UNIVERSITY_ACCOUNT_WEB"))
		{
			this.setPreparedStatement("INSERT INTO universityaccount " +
			"(`uid`,`createddt`,`changeddt`,`webaddress`) " +
			"VALUES " +
			"( UUID(), NOW(), NOW(), ? )");
			this.bind(1, this.getDataPassString("webaddress").toString().toLowerCase());
			this.create(key);
		}
		else if(key.equalsIgnoreCase("CREATE_MATCH_ACCOUNT_PROFILE_FROM_CXURL"))
		{
			this.setPreparedStatement("INSERT INTO match_universityaccount_to_universityprofile " +
			"(`uid`,`createddt`,`changeddt`,`universityaccount_uid`,`universityprofile_uid`) " +
			"VALUES " +
			"( UUID(), NOW(), NOW(), ?, ( " + 
			"SELECT universityprofile.uid AS universityprofile_uid FROM universitysource " +
			"JOIN universityprofile " +
			"ON universitysource.uid = universityprofile.universitysource_uid " +
			"WHERE universitysource.cxurl = ? " +
			") )");
			this.bind(1, this.getDataPassString("universityaccount_uid").toString());
			this.bind(2, this.getDataPassString("cxurl").toString());
			this.create(key);
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}
