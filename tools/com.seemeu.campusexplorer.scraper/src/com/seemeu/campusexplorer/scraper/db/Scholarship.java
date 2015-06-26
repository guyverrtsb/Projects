package com.seemeu.campusexplorer.scraper.db;

import com.seemeu.campusexplorer.scraper.base.SectionBase;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class Scholarship
	extends SectionBase
	implements SectionIntrfc
{
	public void execute(String key)
	{
		if(key.equalsIgnoreCase("GET_ALL_SCHOLARSHIPSOURCE"))
		{
			this.setPreparedStatement("SELECT lid, uid, url, idx, profile, screendata_json FROM entity_scholarshipsource ");
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("GET_SCHOLARSHIPSOURCE_FROM_URL"))
		{
			this.setPreparedStatement("SELECT lid, uid, url, idx, profile, screendata FROM entity_scholarshipsource where url = ?");
			this.bind(1, this.getDataPassString("url"));
			this.retrieve(key);
		}
		else if(key.equalsIgnoreCase("CREATE_SCHOLARSHIPSOURCE"))
		{
			this.setPreparedStatement("INSERT INTO entity_scholarshipsource " +
			"(`lid`,`uid`,`createddt`,`changeddt`,`url`, idx) " +
			"VALUES " +
			"(?, UUID(), NOW(), NOW(), ?, ? )");
			this.bind(1, (int)this.getDataPass().get("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassString("url"));
			this.bind(3, this.getDataPassInt("idx"));
			this.create(key);
		}
		else if(key.equalsIgnoreCase("CREATE_SCHOLARSHIPSOURCEDATA"))
		{
			this.setPreparedStatement("INSERT INTO entity_scholarshipsourcedata " +
			"(`lid`,`uid`,`createddt`,`changeddt`, `idx`, `entity_scholarshipsource_uid`) " +
			"VALUES " +
			"(?, UUID(), NOW(), NOW(), ?, (select uid from `entity_scholarshipsource` where lid = ?))");
			this.bind(1, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(2, this.getDataPassInt("ZZZZCOUNTER"));
			this.bind(3, this.getDataPassInt("ZZZZCOUNTER"));
			this.create(key + " [idx=" + Integer.toString(this.getDataPassInt("ZZZZCOUNTER")) + "]");
		}
		else if(key.equalsIgnoreCase("UPDATE_SCHOLARSHIPSOURCE_STATUS"))
		{
			this.setPreparedStatement("UPDATE entity_scholarshipsource SET " +
					"`changeddt` = NOW(), " +
					"`" + this.getDataPassString("fieldname") + "` = ? " +
					"WHERE `uid` = ?");
			this.bind(1, this.getDataPassString("fieldvalue"));
			this.bind(2, this.getDataPassString("entity_scholarshipsource_uid"));
			this.create(key + " [uid=" + this.getDataPassString("entity_scholarshipsource_uid") + "]");
		}
		else if(key.equalsIgnoreCase("UPDATE_SCHOLARSHIPSOURCEDATA_JSON"))
		{
			this.setPreparedStatement("UPDATE entity_scholarshipsourcedata SET " +
					"`changeddt` = NOW(), " +
					"`" + this.getDataPassString("fieldname") + "_json` = ? " +
					"WHERE `uid` = ?");
			this.bind(1, this.getDataPassString("json"));
			this.bind(2, this.getDataPassString("entity_scholarshipsource_uid"));
			this.create(key + " [uid=" + this.getDataPassString("entity_scholarshipsource_uid") + "][json=" + this.getDataPassString("json").substring(0, 1000) + "]");
		}
		else
		{
			this.outErr(key + " NOT FOUND");
		}
	}
}
