package com.seemeu.campusexplorer.scraper;

import java.io.IOException;
import java.util.List;

import org.jsoup.Jsoup;
import org.jsoup.nodes.*;
import org.jsoup.select.*;

import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.Scholarship;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;
import com.seemeu.campusexplorer.scraper.scholarship.Profile;
import com.seemeu.campusexplorer.scraper.scholarship.Scholarships;
import com.seemeu.campusexplorer.scraper.university.Colleges;
import com.seemeu.campusexplorer.scraper.university.ScreenData;
import com.seemeu.campusexplorer.scraper.university.StoreSource;
import com.seemeu.database.RunBase;

public class LoadCampusExplorerfromScholarships
	extends RunBase
{
	public LoadCampusExplorerfromScholarships()
	{
		this.set("ZZZZHOSTNAME", "http://www.campusexplorer.com");
		this.set("ZZZZPATH", "");
		this.set("ZZZZPATHEXTRA", "");
	}
	
	public void run(int startIdx, int endIdx)
	{
		int counter = 1;
		
		this.set("ZZZZPATH", "/colleges/search/");
		Document docStates = this.loadDoc("http://www.campusexplorer.com/scholarships/");
		Elements anchorStates = docStates.getElementsByTag("a");
		for(int idxStates = 40; idxStates <= 90; idxStates++)
		{
			Document docState = this.loadDoc("http://www.campusexplorer.com" + anchorStates.get(idxStates).attr("href"));
			Elements anchorsScholarships = docState.getElementsByTag("a");
			
			// get the number of pages per state
			int numOfPages = this.getNumberofPages(anchorsScholarships);
			for(int idxPages = 0; idxPages <= numOfPages; idxPages++)
			{
				if(idxPages > 0)
				{
					docState = this.loadDoc("http://www.campusexplorer.com" + anchorStates.get(idxStates).attr("href") + "?page=" + Integer.toString(numOfPages));
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

		this.set("url", (String)this.getStr("ZZZZHOSTNAME") + (String)this.getStr("ZZZZPATH") + (String)this.getStr("ZZZZPATHEXTRA"));
		this.out("[" + this.getInt("ZZZZCOUNTER") + "][START_CREATE_NEW_SOURCE]");
		SectionIntrfc scholarship = new Scholarship();
		scholarship.setDataPass(this.getRecord());
		scholarship.execute("CREATE_SCHOLARSHIPSOURCE");
		scholarship.execute("CREATE_SCHOLARSHIPSOURCEDATA");
		this.out("[" + this.getInt("ZZZZCOUNTER") + "][END_CREATE_NEW_SOURCE]");
		
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
	
	public void saveScreenData()
	{
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");

		SectionIntrfc scholarships = new Scholarship();
		scholarships.execute("GET_ALL_SCHOLARSHIPSOURCE");
		int numRecs = scholarships.getResult().getNumRows();
		for(int ridx = 0; ridx < numRecs; ridx++)
		{
			scholarships.getResult().setRow(ridx);
			this.setScholarshipData(scholarships);
			String url = scholarships.getResult().getString("url");
			this.set("ZZZZPATH", url.substring(this.getStr("ZZZZHOSTNAME").length()));
			this.set("ZZZZCOUNTER", this.getInt("entity_scholarshipsource_idx"));

			this.out("ZZZZPATH [" + this.getStr("ZZZZPATH") + "]");
			
			this.set("JOB_KEY", "scholarship");
			
			ScreenData screenData = new ScreenData(this.getRecord());
			screenData.execute();
		}
		
		this.out("[" + this.getInt("ZZZZCOUNTER") + "]|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
	}
	
	private void setScholarshipData(SectionIntrfc scholarship)
	{
		this.set("entity_scholarshipsource_uid", scholarship.getResult().getString("uid"));			
		this.set("entity_scholarshipsource_idx", scholarship.getResult().getInt("idx"));			
		this.set("idx", scholarship.getResult().getInt("idx"));			
		this.set("profile", scholarship.getResult().getString("profile"));			
		this.set("screendata", scholarship.getResult().getString("screendata"));
	}
}
