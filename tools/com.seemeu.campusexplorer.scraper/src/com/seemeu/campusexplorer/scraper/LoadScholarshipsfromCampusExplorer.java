package com.seemeu.campusexplorer.scraper;

import java.io.IOException;
import java.util.List;

import org.jsoup.Jsoup;
import org.jsoup.nodes.*;
import org.jsoup.select.*;

import com.seemeu.campusexplorer.scraper.db.Scholarship;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;
import com.seemeu.campusexplorer.scraper.scholarship.Profile;
import com.seemeu.campusexplorer.scraper.scholarship.Scholarships;
import com.seemeu.campusexplorer.scraper.university.Colleges;
import com.seemeu.campusexplorer.scraper.university.ScreenData;
import com.seemeu.database.RunBase;

public class LoadScholarshipsfromCampusExplorer
	extends RunBase
{

	public void run(int startIdx, int endIdx)
	{
		this.set("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		this.set("ZZZZPATHEXTRA", "");
		try
		{
			int counter = 1;
			Document docStates = Jsoup.connect("http://www.campusexplorer.com/scholarships/").get();
			Elements anchorStates = docStates.getElementsByTag("a");
			for(int idxStates = 40; idxStates <= 90; idxStates++)
			{
				Document docState = Jsoup.connect("http://www.campusexplorer.com" + anchorStates.get(idxStates).attr("href")).get();
				Elements anchorsScholarships = docState.getElementsByTag("a");
				
				// get the number of pages per state
				int numOfPages = this.getNumberofPages(anchorsScholarships);
				for(int idxPages = 0; idxPages <= numOfPages; idxPages++)
				{
					if(idxPages > 0)
					{
						docState = Jsoup.connect("http://www.campusexplorer.com" + anchorStates.get(idxStates).attr("href") + "?page=" + Integer.toString(numOfPages)).get();
					}
					Element tableScholarshipList = docState.getElementById("scholarships-list");
					List<Node> tr = tableScholarshipList.childNodes().get(2).childNodes();	// TBODY
					for(int idxTr = 1; idxTr < tr.size(); idxTr++)
					{
						Node td = tr.get(idxTr).childNodes().get(1);
						String href = td.childNode(td.childNodeSize() - 1).attr("href");
						
						if(!href.equals("/scholarships/13E528F6/john-and-ruth-childe-scholarship/"))
						{
							this.out("[" + startIdx + "]:[" + counter + "]:[" + endIdx + "]");
							if(counter >= startIdx && counter <= endIdx)
							{
								this.set("ZZZZCOUNTER", counter);
								this.set("ZZZZPATH", href);
								this.load();
							}
							
							if(counter == endIdx)
							{
								idxTr = 10000000;
								idxPages = 10000000;
								idxStates = 10000000;
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
	
	private int getNumberofPages(Elements anchorsState)
	{
		String firstPageHref = null;
		String lastPageHref = null;
		for(int idxState = 0; idxState < anchorsState.size(); idxState++)
		{
			String href = anchorsState.get(idxState).attr("href");
			if(href.indexOf("/?page=") != -1)
			{
				if(firstPageHref == null)
				{
					firstPageHref = href;
				}
				else if(firstPageHref.equalsIgnoreCase(href))
				{
					String numOfPages = lastPageHref.substring(lastPageHref.length() - 1);
					return Integer.parseInt(numOfPages);
				}
				lastPageHref = href;
			}
		}
		
		return 0;
	}

	public void load()
	{
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
		this.set("URL", (String)this.getStr("ZZZZHOSTNAME") + (String)this.getStr("ZZZZPATH") + (String)this.getStr("ZZZZPATHEXTRA"));
		SectionIntrfc scholarshipStatusCheck = new Scholarship();
		scholarshipStatusCheck.setDataPass(this.getRecord());
		scholarshipStatusCheck.execute("GET_SCHOLARSHIPSOURCE_FROM_URL");
		if(scholarshipStatusCheck.getResult().getNumRows() == 0)
		{
			this.out("[" + this.getInt("ZZZZCOUNTER") + "][START_CREATE_NEW_SOURCE]");
			Scholarships scholarships = new Scholarships(this.getRecord());
			scholarships.execute();
			this.out("[" + this.getInt("ZZZZCOUNTER") + "][END_CREATE_NEW_SOURCE]");
		}
		
		scholarshipStatusCheck.execute("GET_SCHOLARSHIPSOURCE_FROM_URL");
		if(scholarshipStatusCheck.getResult().getNumRows() == 1)
		{
			scholarshipStatusCheck.getResult().setRow(0);
			this.set("scholarshipsource_uid", scholarshipStatusCheck.getResult().getString("uid"));	
			this.set("idx", scholarshipStatusCheck.getResult().getInt("idx"));			
			this.set("profile", scholarshipStatusCheck.getResult().getString("profile"));	
			this.set("screendata", scholarshipStatusCheck.getResult().getString("screendata"));	
			
			if(scholarshipStatusCheck.getResult().getString("screendata").equalsIgnoreCase("F"))
			{
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][START_ADD_SOURCE_DATA]");
				this.set("JOB_KEY", "scholarship");
				ScreenData screenData = new ScreenData(this.getRecord());
				screenData.execute();
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][END_ADD_SOURCE_DATA]");
			}
			else
			{
				this.out("**********************\nSCREEN_DATA_ALREADY_ADDED\n**********************");
			}
			/*
			if(scholarshipStatusCheck.getResult().getString("profile").equalsIgnoreCase("F"))
			{
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][START_PROFILE]");
				Profile profile = new Profile(this.getRecord());
				profile.execute();
				this.out("[" + this.getInt("ZZZZCOUNTER") + "][END_PROFILE]");
			}
			else
			{
				this.out("**********************\nPROFILE_DATA_ALREADY_ADDED\n**********************");
			}
			*/
		}
		else if(scholarshipStatusCheck.getResult().getNumRows() == 0)
		{
			this.out("**********************\nERR_ERR_ERR[SOURCE_NOT_CREATED]\n**********************");
		}
		else if(scholarshipStatusCheck.getResult().getNumRows() > 1)
		{
			this.out("**********************\nERR_ERR_ERR[SOURCE_DUPLICATE_FOUND]\n**********************");
		}
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
}
