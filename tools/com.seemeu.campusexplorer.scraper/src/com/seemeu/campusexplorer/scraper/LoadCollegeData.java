package com.seemeu.campusexplorer.scraper;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.OutputStreamWriter;
import java.io.PrintWriter;
import java.io.UnsupportedEncodingException;
import java.io.Writer;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;

import org.jsoup.Jsoup;
import org.jsoup.nodes.*;
import org.jsoup.select.*;

import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;
import com.seemeu.campusexplorer.scraper.scholarship.Profile;
import com.seemeu.campusexplorer.scraper.scholarship.Scholarships;
import com.seemeu.campusexplorer.scraper.university.Academics;
import com.seemeu.campusexplorer.scraper.university.Admissions;
import com.seemeu.campusexplorer.scraper.university.CollegeLife;
import com.seemeu.campusexplorer.scraper.university.PhotosVideos;
import com.seemeu.campusexplorer.scraper.university.Reviews;
import com.seemeu.campusexplorer.scraper.university.Snapshot;
import com.seemeu.campusexplorer.scraper.university.TuitionFinancialAid;
import com.seemeu.database.LoggingBase;
import com.seemeu.database.Result;

public class LoadCollegeData
	extends LoggingBase
{
	private HashMap record = new HashMap();
	public static void main(String[] args)
	{
		LoadCollegeData init = new LoadCollegeData();
		init.createLogFile();
		init.run();
	}
	
	public void run()
	{
		this.record.put("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		this.record.put("ZZZZPATHEXTRA", "");

		int counter = 1;
		SectionIntrfc college = new College();
		college.setDataPass(this.record);
		college.execute("SQL_ALL_UNIV_SOURCE");
		Result r = college.getResult();
		if(r.getNumRows() > 0)
		{
			for(int idx = 0; idx < r.getNumRows(); idx++ )
			{
				r.setRow(idx);
				String urlPath = r.getString("CXURL");
				this.record.put("ZZZZPATH", urlPath.substring(this.record.get("ZZZZHOSTNAME").toString().length()));
				this.record.put("ZZZZCOUNTER", counter);
				this.record.put("UNIVERSITYACCOUNTCREATED", r.getString("universityaccountcreated"));
				this.load();
				counter++;
			}
		}
	}
	
	/*
	 * This design has an assumption that all pages have the Tabs Strip for the links.
	 */
	public void load()
	{
		this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
		this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[" + this.record.get("ZZZZHOSTNAME").toString() + this.record.get("ZZZZPATH").toString() + "]");
		try
		{
			String urlPath = this.record.get("ZZZZHOSTNAME").toString() + this.record.get("ZZZZPATH").toString();
			Document doc = Jsoup.connect(urlPath).timeout(60*1000).get();
			Elements tabs = doc.getElementsByClass("tabs");
			if(doc.getElementsByClass("tabs").size() > 0)
			{
				tabs = tabs.get(0).getElementsByTag("a");
			}
			else
			{
				this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "][BROKEN : " + urlPath + "]");
			}
			for(int idx = 0; idx < tabs.size(); idx++)
			{
				String href = tabs.get(idx).attr("href");
				String jobkey = href.split("/")[(href.split("/").length - 1)];
				this.record.put("ZZZZPATH", href);
				if(idx == 0)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:snapshot]");

					Snapshot parse = new Snapshot(this.record);
					parse.execute();
				}
				else if(jobkey.equalsIgnoreCase("academics") && false)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:" + jobkey + "]");
					Academics parse = new Academics(this.record);
					parse.execute();
				}
				else if(jobkey.equalsIgnoreCase("tuition-financial-aid") && false)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:" + jobkey + "]");
					TuitionFinancialAid parse = new TuitionFinancialAid(this.record);
					parse.execute();
				}
				else if(jobkey.equalsIgnoreCase("admissions") && false)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:" + jobkey + "]");
					Admissions parse = new Admissions(this.record);
					parse.execute();
				}
				else if(jobkey.equalsIgnoreCase("college-life") && false)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:" + jobkey + "]");
					CollegeLife parse = new CollegeLife(this.record);
					parse.execute();
				}
				else if(jobkey.equalsIgnoreCase("photos-videos") && false)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:" + jobkey + "]");
					PhotosVideos parse = new PhotosVideos(this.record);
					parse.execute();
				}
				else if(jobkey.equalsIgnoreCase("reviews") && false)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:" + jobkey + "]");
					Reviews parse = new Reviews(this.record);
					parse.execute();
				}
				else if(false)
				{
					this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "[JOBKEY:" + jobkey + "]");
				}
			}
		}
		catch (Exception e)
		{
			this.out("run[" + this.getClass().getName() + "][" + e.getMessage() + "]");
		}
		this.out("[" + this.record.get("ZZZZCOUNTER").toString() + "]" + "|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
}
