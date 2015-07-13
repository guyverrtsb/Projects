package com.seemeu.campusexplorer.scraper.scholarship;

import java.util.HashMap;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.Scholarship;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;
import com.seemeu.campusexplorer.scraper.university.ScreenData;

public class Scholarships
	extends UniversityPageBase
{
	public Scholarships(HashMap record)
	{
		super(record);
	}
	
	public void doExecute()
	{
		
	}
	
	public void loadJSON()
	{
		// Check if URL Exists in Records
		SectionIntrfc scholarship = new Scholarship();
		this.setDataPassNV("url", this.getUrlPath());
		this.setDataPassNV("idx", this.getDataPass().get("ZZZZCOUNTER"));
		scholarship.setDataPass(this.getDataPass());
		scholarship.execute("GET_SCHOLARSHIPSOURCE_FROM_URL");
		if(scholarship.getResult().getNumRows() == 0)	// URL not Found
		{
			this.out("[" + this.getDataPass().get("ZZZZCOUNTER") + "][START_CREATE_NEW_SOURCE]");
			scholarship.execute("CREATE_SCHOLARSHIPSOURCE");
			scholarship.execute("CREATE_SCHOLARSHIPSOURCEDATA");
			ScreenData screenData = new ScreenData(this.getDataPass());
			screenData.execute();
			this.out("[" + this.getDataPass().get("ZZZZCOUNTER") + "][END_CREATE_NEW_SOURCE]");
		}
		else if(scholarship.getResult().getNumRows() == 1)	// URL Found
		{
			scholarship.getResult().setRow(0);
			if(scholarship.getResult().getString("screendata").equalsIgnoreCase("F"))
			{
				this.out("[" + this.getDataPass().get("ZZZZCOUNTER") + "][START_UPDATE_EXISTING_SOURCE]");
				this.setDataPassNV("JOB_KEY", "scholarship");
				this.setDataPassNV("entity_scholarshipsource_uid", scholarship.getResult().getString("uid"));
				ScreenData screenData = new ScreenData(this.getDataPass());
				screenData.execute();
				this.out("[" + this.getDataPass().get("ZZZZCOUNTER") + "][END_UPDATE_EXISTING_SOURCE]");
			}
			else
			{
				this.out("**********************\nSCREEN_DATA_ALREADY_ADDED\n**********************");
			}
		}
		else
		{
			this.out("**********************\nERR_ERR_ERR[SOURCE_DUPLICATE_FOUND]\n**********************");
		}
	}
}
