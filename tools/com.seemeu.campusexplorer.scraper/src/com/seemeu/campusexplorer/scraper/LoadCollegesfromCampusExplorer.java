package com.seemeu.campusexplorer.scraper;

import java.io.IOException;
import java.util.HashMap;

import org.jsoup.Jsoup;
import org.jsoup.nodes.*;
import org.jsoup.select.*;

import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;
import com.seemeu.campusexplorer.scraper.university.StoreSource;
import com.seemeu.campusexplorer.scraper.university.Colleges;
import com.seemeu.campusexplorer.scraper.university.GroupUniv;
import com.seemeu.campusexplorer.scraper.university.Profile;
import com.seemeu.database.LoggingBase;
import com.seemeu.database.Result;
import com.seemeu.database.RunBase;

public class LoadCollegesfromCampusExplorer
	extends RunBase
{
	public void run(int startIdx, int endIdx)
	{
		try
		{
			int counter = 1;

			this.set("ZZZZHOSTNAME", "http://www.campusexplorer.com");
			this.set("ZZZZPATH", "/colleges/search/");
			this.set("ZZZZPATHEXTRA", "");
			String urlPath = ((String)this.getStr("ZZZZHOSTNAME")) + ((String)this.getStr("ZZZZPATH")); //"http://www.campusexplorer.com/colleges/search/"
			for(int pidx = 1; pidx <= 585; pidx++)
			{
				Document doc = null;
				if(pidx == 1)
					doc = Jsoup.connect(urlPath).timeout(60*1000).get();
				else
					doc = Jsoup.connect(urlPath + "?page=" + Integer.toString(pidx)).get();
				Elements anchors = doc.getElementsByTag("a");
				
				for( int lidx = 0; lidx < anchors.size(); lidx++)
				{
					if(anchors.get(lidx).attr("href").startsWith("/myplanner/schools/save/"))
					{
						lidx++;
						Element anchor = anchors.get(lidx);
						String href = anchor.attr("href");
						
						if(!href.equals("/colleges/E4343FAD/Florida/Miami/Beauty-Schools-of-America-North-Miami-Beach/"))
						{
							this.out("[" + startIdx + "]:[" + counter + "]:[" + endIdx + "]");
							if(counter >= startIdx && counter <= endIdx)
							{
								if(counter == 1)
								{
									this.set("ZZZZCOUNTER", counter);
									this.groupUniversity();
									counter++;
									this.set("ZZZZHOSTNAME", "http://www.campusexplorer.com");
								}
								this.set("ZZZZCOUNTER", counter);
								this.set("ZZZZPATH", href);
								load();
							}
							
							if(counter == endIdx)
							{
								lidx = 10000000;
								pidx = 10000000;
							}
							
							if(counter == 1)
								counter++;
							counter++;
						}
					}
				}
			}
		}
		catch (IOException e)
		{
			this.out("run[" + this.getClass().getName() + "][" + e.getMessage() + "]");
		}
	}
	
	private void groupUniversity()
	{
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
		GroupUniv groupUniv = new GroupUniv(this.getRecord());
		groupUniv.execute();
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
	
	private void load()
	{
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
		this.set("url", (String)this.getStr("ZZZZHOSTNAME") + (String)this.getStr("ZZZZPATH") + (String)this.getStr("ZZZZPATHEXTRA"));
		SectionIntrfc collegeStatusCheck = new College();
		collegeStatusCheck.setDataPass(this.getRecord());
		collegeStatusCheck.execute("GET_UNIVERSITYSOURCE_FROM_URL");
		if(collegeStatusCheck.getResult().getNumRows() == 0)
		{
			this.out("[" + this.getInt("ZZZZCOUNTER") + "][START_CREATE_NEW_SOURCE]");
			Colleges colleges = new Colleges(this.getRecord());
			colleges.execute();
			this.out("[" + this.getInt("ZZZZCOUNTER") + "][END_CREATE_NEW_SOURCE]");
		}
		
		collegeStatusCheck.execute("GET_UNIVERSITYSOURCE_FROM_URL");
		if(collegeStatusCheck.getResult().getNumRows() == 1)
		{
			collegeStatusCheck.getResult().setRow(0);
			this.set("universitysource_uid", collegeStatusCheck.getResult().getString("uid"));			
			this.set("idx", collegeStatusCheck.getResult().getInt("idx"));			
			this.set("profilecreated", collegeStatusCheck.getResult().getString("profilecreated"));			
			this.set("accountcreated", collegeStatusCheck.getResult().getString("accountcreated"));			
			this.set("snapshot_essentials", collegeStatusCheck.getResult().getString("snapshot_essentials"));			
			this.set("snapshot_about", collegeStatusCheck.getResult().getString("snapshot_about"));			
			this.set("snapshot_overallratings", collegeStatusCheck.getResult().getString("snapshot_overallratings"));			
			this.set("snapshot_studentratings", collegeStatusCheck.getResult().getString("snapshot_studentratings"));			
			this.set("snapshot_location", collegeStatusCheck.getResult().getString("snapshot_location"));			
			this.set("snapshot_gettingaround", collegeStatusCheck.getResult().getString("snapshot_gettingaround"));			
			this.set("snapshot_walkability", collegeStatusCheck.getResult().getString("snapshot_walkability"));			
			this.set("snapshot_transit", collegeStatusCheck.getResult().getString("snapshot_transit"));			
			this.set("snapshot_weather", collegeStatusCheck.getResult().getString("snapshot_weather"));			
			this.set("snapshot_students", collegeStatusCheck.getResult().getString("snapshot_students"));			
			this.set("snapshot_similar", collegeStatusCheck.getResult().getString("snapshot_similar"));			
			this.set("snapshot_otherschoolsnear", collegeStatusCheck.getResult().getString("snapshot_otherschoolsnear"));			
			this.set("snapshot_screendata", collegeStatusCheck.getResult().getString("snapshot_screendata"));			
			this.set("academics_screendata", collegeStatusCheck.getResult().getString("academics_screendata"));			
			this.set("costs_screendata", collegeStatusCheck.getResult().getString("costs_screendata"));			
			this.set("admissions_screendata", collegeStatusCheck.getResult().getString("admissions_screendata"));			
			this.set("collegelife_screendata", collegeStatusCheck.getResult().getString("collegelife_screendata"));			
			this.set("photosvideos_screendata", collegeStatusCheck.getResult().getString("photosvideos_screendata"));
			
			if(collegeStatusCheck.getResult().getString("snapshot_screendata").equalsIgnoreCase("F"))
			{
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][START_ADD_SOURCE_DATA]");
				StoreSource storeSource = new StoreSource(this.getRecord());
				storeSource.execute();
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][END_ADD_SOURCE_DATA]");
			}
			else
			{
				this.out("**********************\nSNAPSHOT_DATA_ALREADY_ADDED\n**********************");
			}
			/*
			if(collegeStatusCheck.getResult().getString("profilecreated").equalsIgnoreCase("F"))
			{
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][START_CREATE_NEW_PROFILE]");
				Profile profile = new Profile(this.getRecord());
				profile.execute();
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][END_CREATE_NEW_PROFILE]");
			}
			else
			{
				this.out("**********************\n[PROFILE_ALREADY_CREATED]\n" + this.getClass().getName() + "\n**********************");
			}
			*/
		}
		else if(collegeStatusCheck.getResult().getNumRows() == 0)
		{
			this.out("**********************\nERR_ERR_ERR[SOURCE_NOT_CREATED]\n" + this.getClass().getName() + "\n**********************");
		}
		else if(collegeStatusCheck.getResult().getNumRows() > 1)
		{
			this.out("**********************\nERR_ERR_ERR[SOURCE_DUPLICATE_FOUND]\n" + this.getClass().getName() + "\n**********************");
		}
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
	
	
}
