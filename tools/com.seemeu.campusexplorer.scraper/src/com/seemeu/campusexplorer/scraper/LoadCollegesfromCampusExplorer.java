package com.seemeu.campusexplorer.scraper;

import java.io.IOException;
import java.util.HashMap;

import org.jsoup.Jsoup;
import org.jsoup.nodes.*;
import org.jsoup.select.*;

import com.seemeu.campusexplorer.scraper.university.Colleges;
import com.seemeu.campusexplorer.scraper.university.Profile;
import com.seemeu.database.LoggingBase;

public class LoadCollegesfromCampusExplorer
	extends LoggingBase
{
	private HashMap record = new HashMap();
	public static void main(String[] args)
	{
		LoadCollegesfromCampusExplorer init = new LoadCollegesfromCampusExplorer();
		init.createLogFile();
		init.run("http://www.campusexplorer.com/colleges/search/");
		/*
		HashMap record = new HashMap();
		record.put("ZZZZCOUNTER", 1);
		record.put("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		record.put("ZZZZPATH", "/colleges/0544946D/online/Charter-College-Online-School-Anchorage/");
		record.put("ZZZZPATHEXTRA", "");
		init.load(record);
		record.put("ZZZZCOUNTER", 1);
		record.put("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		record.put("ZZZZPATH", "/colleges/6C8F3E68/Texas/Houston/National-American-University-Online-Houston-Support-Center-Available/");
		record.put("ZZZZPATHEXTRA", "");
		init.load(record);
		record.put("ZZZZCOUNTER", 1);
		record.put("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		record.put("ZZZZPATH", "/colleges/FEAEB87F/Florida/Miami/Beauty-Schools-of-America-North-Miami-Beach/");
		record.put("ZZZZPATHEXTRA", "");
		init.load(record);
		*/
	}
	
	public void run(String urlPath)
	{
		this.record.put("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		this.record.put("ZZZZPATHEXTRA", "");
		try
		{
			int counter = 1;
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
							this.record.put("ZZZZCOUNTER", counter);
							this.record.put("ZZZZPATH", href);
							load(this.record);

							if(counter == 100000)
							{
								lidx = 10000000;
								pidx = 10000000;
							}
							else if(counter == 3172)
							{
								String dothis = "Check Href";
							}
							
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
	
	public void load(HashMap record)
	{
		this.out("|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
		Colleges colleges = new Colleges(record);
		colleges.execute();
		Profile profile = new Profile(record);
		profile.execute();
		//record.put("PATHEXTRA", "academics/");
		//Academics academics = new Academics(record);
		//academics.execute();
		this.out("|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
}
