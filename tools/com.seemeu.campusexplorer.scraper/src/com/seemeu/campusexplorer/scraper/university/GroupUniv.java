package com.seemeu.campusexplorer.scraper.university;

import java.util.HashMap;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.Essentials;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class GroupUniv
	extends UniversityPageBase
{	
	public GroupUniv(HashMap record)
	{
		super(record);
	}

	public void doExecute()
	{
		this.doDefault();
	}
	
	private void doDefault()
	{
		this.setDataPassNV("ZZZZHOSTNAME", "http://dev.groupuniv.com");
		this.setDataPassNV("ZZZZPATH", "/index.php");
		this.setDataPassNV("ZZZZPATHEXTRA", "");
		this.setDataPassNV("webaddress".toUpperCase(), "dev.groupuniv.com");
		this.setDataPassNV("emaildomain".toUpperCase(), "groupuniv.com");
		this.setDataPassNV("city".toUpperCase(), "Raleigh");
		this.setDataPassNV("crossappl_configurations_sdesc_region".toUpperCase(), "REGION_NC");
		this.setDataPassNV("crossappl_configurations_sdesc_country".toUpperCase(), "COUNTRY_US");
		this.setDataPassNV("region".toUpperCase(), "NC");
		this.setDataPassNV("ldesc".toUpperCase(), "GROUP_UNIVERSITY");
		this.setDataPassNV("name".toUpperCase(), "Group University");
		this.setDataPassNV("phonenumber".toUpperCase(), "(918) 555-1234");
		this.setDataPassNV("configurations_sdesc_schooltype".toUpperCase(), "SCHOOL_TYPE-SEEMEU");
		this.setDataPassNV("schooltype".toUpperCase(), "SEEMEU");
		this.setDataPassNV("latitude".toUpperCase(), "36.152957");
		this.setDataPassNV("longitude".toUpperCase(), "-95.989346");
		this.setDataPassNV("url", (String)this.getDataPassString("ZZZZHOSTNAME") + (String)this.getDataPassString("ZZZZPATH") + (String)this.getDataPassString("ZZZZPATHEXTRA"));
		
		SectionIntrfc collegeStatusCheck = new College();
		collegeStatusCheck.setDataPass(this.getDataPass());
		collegeStatusCheck.execute("GET_UNIVERSITYSOURCE_FROM_URL");
		
		if(collegeStatusCheck.getResult().getNumRows() == 0)
		{
			SectionIntrfc college = new College();
			college.setDataPass(this.getDataPass());
			college.execute("CREATE_DEFAULT_UNIVERSITY");
		}
		else if(collegeStatusCheck.getResult().getNumRows() == 0)
		{
			this.out("**********************\nERR_ERR_ERR[SOURCE_NOT_CREATED\n**********************");
		}
		else if(collegeStatusCheck.getResult().getNumRows() > 1)
		{
			this.out("**********************\nERR_ERR_ERR[SOURCE_DUPLICATE_FOUND]\n**********************");
		}
	}
}
