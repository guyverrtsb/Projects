package com.seemeu.campusexplorer.scraper;

import java.io.IOException;
import java.util.HashMap;
import java.util.List;

import org.jsoup.Jsoup;
import org.jsoup.nodes.*;
import org.jsoup.select.*;

import com.seemeu.campusexplorer.scraper.scholarship.Profile;
import com.seemeu.campusexplorer.scraper.scholarship.Scholarships;
import com.seemeu.database.LoggingBase;

public class LoadScholarshipsfromCampusExplorer
	extends LoggingBase
{
	private HashMap record = new HashMap();
	public static void main(String[] args)
	{
		LoadScholarshipsfromCampusExplorer init = new LoadScholarshipsfromCampusExplorer();
		init.createLogFile();
		init.run("http://www.campusexplorer.com/scholarships/");
	}
	
	public void run(String urlPath)
	{
		this.record.put("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		this.record.put("ZZZZPATHEXTRA", "");
		try
		{
			int counter = 1;
			Document docStates = Jsoup.connect(urlPath).get();
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
							this.record.put("ZZZZCOUNTER", counter);
							this.record.put("ZZZZPATH", href);
							this.load(this.record);
							
							if(counter == 100000)
							{
								idxTr = 10000000;
								idxPages = 10000000;
								idxStates = 10000000;
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

	public void load(HashMap record)
	{
		this.out("|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
		Scholarships scholarships = new Scholarships(record);
		scholarships.execute();
		if(scholarships.getProcessState().equalsIgnoreCase("SUCCESS"))
		{
			Profile profile = new Profile(record);
			profile.execute();
		}
		this.out("|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
}
