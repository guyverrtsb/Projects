package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class ScholarshipProfile
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("CREATE_INIT_SCHOLARSHIP_PROFILE"))
		{
			this.setPreparedStatement("INSERT INTO scholarshipprofile " +
			"(`lid`,`uid`,`createddt`,`changeddt`,`ldesc`,`name`,`scholarshipsponsor_uid`,`scholarshipsource_uid`) " +
			"VALUES " +
			"(?, UUID(), NOW(), NOW(), ?, ?, ?, ? )");
			this.bind(1, (int)this.getDataPass().get("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassString("ldesc"));
			this.bind(3, this.getDataPassString("name"));
			this.bind(4, this.getDataPassString("scholarshipsponsor_uid"));
			this.bind(5, this.getDataPassString("scholarshipsource_uid"));
			this.create(key);
		}
		else if(key.equalsIgnoreCase("GET_UID_FOR_SCHOLARSHIPSOURCE_UID"))
		{
			this.setPreparedStatement("SELECT uid FROM scholarshipprofile where scholarshipsource_uid = ?");
			this.bind(1, this.getDataPassString("scholarshipsource_uid"));
			this.retrieve(key);
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}
