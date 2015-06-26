package com.seemeu.campusexplorer.scraper.scholarship;

import java.util.HashMap;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.Essentials;
import com.seemeu.campusexplorer.scraper.db.Scholarship;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class Scholarships
	extends UniversityPageBase
{
	public Scholarships(HashMap record)
	{
		super(record);
	}
	
	public void doExecute()
	{
		SectionIntrfc scholarship = new Scholarship();
		this.setDataPassNV("url", this.getUrlPath());
		this.setDataPassNV("idx", this.getDataPass().get("ZZZZCOUNTER"));
		scholarship.setDataPass(this.getDataPass());
		scholarship.execute("CREATE_SCHOLARSHIPSOURCE");
		scholarship.execute("CREATE_SCHOLARSHIPSOURCEDATA");
	}
}
