package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class Scholarship
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("NEW_SCHOLARSHIP_SOURCE"))
		{
			this.setPreparedStatement("INSERT INTO scholarshipsource " +
			"(`uid`,`createddt`,`changeddt`,`cxurl`, idx) " +
			"VALUES " +
			"( UUID(), NOW(), NOW(), ?, ? )");
			this.bind(1, this.getDataPassString("cxurl"));
			this.bind(2, this.getDataPassInt("idx"));
			this.create(key);
		}
		else if(key.equalsIgnoreCase("SQL_ALL_SCHOLARSHIP_SOURCE"))
		{
			this.setPreparedStatement("SELECT * FROM scholarshipsource ");
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("GET_UID_FOR_CXURL"))
		{
			this.setPreparedStatement("SELECT uid FROM scholarshipsource where cxurl = ?");
			this.bind(1, this.getDataPassString("cxurl"));
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("UPDATE_PROFILE_VALID"))
		{
			this.setPreparedStatement("UPDATE scholarshipsource SET " +
					"`changeddt` = NOW(), " +
					"`profile` = ? " +
					"WHERE `uid` = ?");
			this.bind(1, "T");
			this.bind(2, this.getDataPassString("scholarshipsource_uid"));
			this.update(key);
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}
