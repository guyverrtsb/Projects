package com.seemeu.campusexplorer.scraper.university;

import java.util.ArrayList;
import java.util.HashMap;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.CollegeProfile;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class StoreSource
	extends UniversityPageBase
{
	public StoreSource(HashMap record)
	{
		super(record);
	}
	
	public void doExecute()
	{
		this.doProcessing();
	}
	
	private void doProcessing()
	{
		Elements tabs = this.getDocument().getElementsByClass("tabs");
		if(this.getDocument().getElementsByClass("tabs").size() > 0)
		{
			tabs = tabs.get(0).getElementsByTag("a");
		}
		else
		{
			this.out("[" + this.getDataPassString("ZZZZCOUNTER") + "][BROKEN : " + this.getUrlPath() + "]");
		}
		for(int idx = 0; idx < tabs.size(); idx++)
		{
			String href = tabs.get(idx).attr("href");
			String jobkey = href.split("/")[(href.split("/").length - 1)];
			this.setDataPassNV("ZZZZPATH", href);
			if(idx == 0)
			{
				this.out("[JOBKEY:snapshot]");
				this.saveScreenData("snapshot");
				//Snapshot parse = new Snapshot(this.getDataPass());
				//parse.execute();
			}
			else if(jobkey.equalsIgnoreCase("academics"))
			{
				this.out("[JOBKEY:" + jobkey + "]");
				this.saveScreenData(jobkey);
				//Academics parse = new Academics(this.getDataPass());
				//parse.execute();
			}
			else if(jobkey.equalsIgnoreCase("tuition-financial-aid"))
			{
				this.out("[JOBKEY:" + jobkey + "]");
				this.saveScreenData(jobkey);
				//TuitionFinancialAid parse = new TuitionFinancialAid(this.getDataPass());
				//parse.execute();
			}
			else if(jobkey.equalsIgnoreCase("admissions"))
			{
				this.out("[JOBKEY:" + jobkey + "]");
				this.saveScreenData(jobkey);
				//Admissions parse = new Admissions(this.getDataPass());
				//parse.execute();
			}
			else if(jobkey.equalsIgnoreCase("college-life"))
			{
				this.out("[JOBKEY:" + jobkey + "]");
				this.saveScreenData(jobkey);
				//CollegeLife parse = new CollegeLife(this.getDataPass());
				//parse.execute();
			}
			else if(jobkey.equalsIgnoreCase("photos-videos"))
			{
				this.out("[JOBKEY:" + jobkey + "]");
				this.saveScreenData(jobkey);
				//PhotosVideos parse = new PhotosVideos(this.getDataPass());
				//parse.execute();
			}
			else if(jobkey.equalsIgnoreCase("reviews"))
			{
				this.out("[JOBKEY:" + jobkey + "]");
				this.saveScreenData(jobkey);
				//Reviews parse = new Reviews(this.getDataPass());
				//parse.execute();
			}
			else
			{
				this.out("[JOBKEY:" + jobkey + "]");
			}
		}
	}
	
	private void saveScreenData(String jobKey)
	{
		this.setDataPassNV("JOB_KEY", jobKey);
		ScreenData screenData = new ScreenData(this.getDataPass());
		screenData.execute();
	}
}
