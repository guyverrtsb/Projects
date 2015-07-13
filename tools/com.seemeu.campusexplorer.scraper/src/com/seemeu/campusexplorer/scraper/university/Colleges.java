package com.seemeu.campusexplorer.scraper.university;

import java.util.HashMap;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
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
		this.setDataPassNV("url", this.getUrlPath());
		this.setDataPassNV("idx", this.getDataPass().get("ZZZZCOUNTER"));
		college.setDataPass(this.getDataPass());
		college.execute("CREATE_UNIVERSITYSOURCE");
		college.execute("CREATE_UNIVERSITYSOURCEDATA");
	}
}
