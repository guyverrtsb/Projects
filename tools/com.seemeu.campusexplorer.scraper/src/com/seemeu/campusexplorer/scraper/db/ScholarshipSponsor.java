package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class ScholarshipSponsor
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("CREATE_INIT_SCHOLARSHIP_SPONSOR"))
		{
			this.setPreparedStatement("INSERT INTO scholarshipsponsor " +
			"(`uid`,`createddt`,`changeddt`,`ldesc`,`name`) " +
			"VALUES " +
			"( UUID(), NOW(), NOW(), ?, ? )");
			this.bind(1, this.getDataPassString("ldesc"));
			this.bind(2, this.getDataPassString("name"));
			this.create(key);
		}
		else if(key.equalsIgnoreCase("GET_UID_FOR_SCHOLARSHIPSPONSOR_LDESC"))
		{
			this.setPreparedStatement("SELECT uid FROM scholarshipsponsor where ldesc = ?");
			this.bind(1, this.getDataPassString("ldesc"));
			this.retrieve(key);
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}
