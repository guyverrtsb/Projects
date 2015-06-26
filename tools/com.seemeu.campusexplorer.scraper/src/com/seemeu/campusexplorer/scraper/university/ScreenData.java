package com.seemeu.campusexplorer.scraper.university;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;

import org.jsoup.nodes.Attribute;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;
import org.w3c.dom.Node;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.Scholarship;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;


public class ScreenData
	extends UniversityPageBase
{
	public ScreenData(HashMap record)
	{
		super(record);
	}
	
	ArrayList screenDataJson = new ArrayList();
	
	public void doExecute()
	{
		this.build(this.getDocument().getAllElements());
		this.saveScreenData();
	}
	
	private void build(Elements elements)
	{
		for(int idxEle = 0; idxEle < elements.size(); idxEle++)
		{
			String jr = "{";
			Element ele = elements.get(idxEle);
			jr += "\"NODENAME\"" + " : \"" + ele.nodeName().toUpperCase() + "\"";
			
			List<Attribute> atrs = ele.attributes().asList();
			for(int idxAtr = 0; idxAtr < atrs.size(); idxAtr++)
			{
				Attribute atr = (Attribute)atrs.get(idxAtr);
				jr += ", ";
				jr += "\"" + atr.getKey() + "\" : \"" + atr.getValue() + "\"";
			}
			jr += ", \"CONTENT\" : \"" + ele.text().replaceAll("\"","'") + "\"";
			jr += "}";
			this.screenDataJson.add((this.screenDataJson.size()), jr);
		}
	}
	
	private void saveScreenData()
	{
		String jobkey = this.getDataPassString("JOB_KEY");
		if(jobkey.equalsIgnoreCase("SNAPSHOT"))
		{
			SectionIntrfc college = new College();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "snapshot_screendata");
			this.setDataPassNV("fieldvalue", "T");
			college.setDataPass(this.getDataPass());
			college.execute("UPDATE_UNIVERSITYSOURCEDATA_JSON");

			college.execute("UPDATE_UNIVERSITYSOURCE_STATUS");
		}
		else if(jobkey.equalsIgnoreCase("academics"))
		{
			SectionIntrfc college = new College();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "academics_screendata");
			this.setDataPassNV("fieldvalue", "T");
			college.setDataPass(this.getDataPass());
			college.execute("UPDATE_UNIVERSITYSOURCEDATA_JSON");

			this.setDataPassNV("fieldvalue", "T");
			college.execute("UPDATE_UNIVERSITYSOURCE_STATUS");
		}
		else if(jobkey.equalsIgnoreCase("tuition-financial-aid"))
		{
			SectionIntrfc college = new College();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "costs_screendata");
			this.setDataPassNV("fieldvalue", "T");
			college.setDataPass(this.getDataPass());
			college.execute("UPDATE_UNIVERSITYSOURCEDATA_JSON");

			this.setDataPassNV("fieldvalue", "T");
			college.execute("UPDATE_UNIVERSITYSOURCE_STATUS");
		}
		else if(jobkey.equalsIgnoreCase("admissions"))
		{
			SectionIntrfc college = new College();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "admissions_screendata");
			this.setDataPassNV("fieldvalue", "T");
			college.setDataPass(this.getDataPass());
			college.execute("UPDATE_UNIVERSITYSOURCEDATA_JSON");

			this.setDataPassNV("fieldvalue", "T");
			college.execute("UPDATE_UNIVERSITYSOURCE_STATUS");
		}
		else if(jobkey.equalsIgnoreCase("college-life"))
		{
			SectionIntrfc college = new College();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "collegelife_screendata");
			this.setDataPassNV("fieldvalue", "T");
			college.setDataPass(this.getDataPass());
			college.execute("UPDATE_UNIVERSITYSOURCEDATA_JSON");

			this.setDataPassNV("fieldvalue", "T");
			college.execute("UPDATE_UNIVERSITYSOURCE_STATUS");
		}
		else if(jobkey.equalsIgnoreCase("photos-videos"))
		{
			SectionIntrfc college = new College();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "photosvideos_screendata");
			this.setDataPassNV("fieldvalue", "T");
			college.setDataPass(this.getDataPass());
			college.execute("UPDATE_UNIVERSITYSOURCEDATA_JSON");

			this.setDataPassNV("fieldvalue", "T");
			college.execute("UPDATE_UNIVERSITYSOURCE_STATUS");
		}
		else if(jobkey.equalsIgnoreCase("reviews"))
		{
			SectionIntrfc college = new College();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "reviews_screendata");
			this.setDataPassNV("fieldvalue", "T");
			college.setDataPass(this.getDataPass());
			college.execute("UPDATE_UNIVERSITYSOURCEDATA_JSON");

			college.execute("UPDATE_UNIVERSITYSOURCE_STATUS");
		}
		else if(jobkey.equalsIgnoreCase("scholarship"))
		{
			SectionIntrfc scholarship = new Scholarship();
			this.setDataPassNV("json", this.screenDataJson.toString());
			this.setDataPassNV("fieldname", "screendata");
			this.setDataPassNV("fieldvalue", "T");
			scholarship.setDataPass(this.getDataPass());
			scholarship.execute("UPDATE_SCHOLARSHIPSOURCEDATA_JSON");

			scholarship.execute("UPDATE_SCHOLARSHIPSOURCE_STATUS");
		}
		else
		{
			this.out("**********************\nJOB_KEY[" + jobkey.toUpperCase() + "]_NOT_FOUND\n" + this.getClass().getName() + "\n**********************");
		}
	}
}
