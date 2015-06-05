package com.seemeu.campusexplorer.scraper.university;

import java.util.HashMap;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.Essentials;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class Colleges
	extends UniversityPageBase
{
	public Colleges(HashMap record)
	{
		super(record);
	}
	
	public void doExecute()
	{
		SectionIntrfc college = new College();
		this.setDataPassNV("cxurl", this.getUrlPath());
		this.setDataPassNV("idx", this.getDataPass().get("ZZZZCOUNTER"));
		college.setDataPass(this.getDataPass());
		
		college.execute("GET_UID_FOR_CXURL");
		int numrows = college.getResult().getNumRows();
		if(numrows == 0)
		{
			college.execute("NEW_UNIV_SOURCE");
		}
		else
		{
			this.out("**************" + " : Record Exists : " + this.getClass().getName());
		}
	}
}
