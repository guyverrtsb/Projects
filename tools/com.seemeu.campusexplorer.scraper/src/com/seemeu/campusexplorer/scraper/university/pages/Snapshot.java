package com.seemeu.campusexplorer.scraper.university.pages;

import java.util.HashMap;

import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.CollegeProfile;
import com.seemeu.campusexplorer.scraper.db.Essentials;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;
import com.seemeu.database.Result;

public class Snapshot
	extends UniversityPageBase
{
	public Snapshot(HashMap record)
	{
		super(record);
	}
	
	public void doExecute()
	{
		// Create Account
		if(this.getDataPassString("accountcreated").equalsIgnoreCase("F"))
		{
			boolean uaCreated = false;
			Elements essentials = this.getDocument().getElementsByClass("essentials-table");
			if(essentials.size() > 0)
			{
				Elements tr = essentials.get(0).getElementsByTag("tr");
				for(int idx = 0; idx < tr.size(); idx++)
				{
					Element th = tr.get(idx).getElementsByTag("th").get(0);
					String thtext = th.text().trim().substring(0, th.text().trim().indexOf(":"));
					if(thtext.equalsIgnoreCase("Website"))
					{
						Element td = tr.get(idx).getElementsByTag("td").get(0);
						String webaddress = td.text().trim();
						this.initializeUniversityAccountWebAddress(webaddress);
						uaCreated = true;
					}
				}
			}
			
			if(!uaCreated)
			{
				Elements website = this.getDocument().getElementsByClass("website");
				if(website.size() > 0)
				{
					Element a = website.get(0).getElementsByTag("a").get(0);
					String href = a.attr("href");
					href = href.substring("http://www.campusexplorer.com/track/go/?url=http%3A%2F%2F".length());
					href = href.substring(0, href.indexOf("%"));
					String webaddress = href;
					webaddress = webaddress.trim();
					this.initializeUniversityAccountWebAddress(webaddress);
					uaCreated = true;
				}
			}
			
			if(uaCreated)
				this.out("SUCCESSFUL_CREATE_ACCOUNT");
			else
				this.out("WEB ADDRESS NOT FOUND.");
		}
		else
		{
			this.out("Account has already been created");
		}
		
		// Build Essential Table
	}
	
	public void runThroughEssentials(Elements essentials)
	{
		Elements tr = essentials.get(0).getElementsByTag("tr");
		for(int idx = 0; idx < tr.size(); idx++)
		{
			Element th = tr.get(idx).getElementsByTag("th").get(0);
			String thtext = th.text().trim().substring(0, th.text().trim().indexOf(":"));
			if(thtext.equalsIgnoreCase("Website"))
			{
				Element td = tr.get(idx).getElementsByTag("td").get(0);
				String webaddress = td.text().trim();
				this.initializeUniversityAccountWebAddress(webaddress);
			}
		}
	}
	
	private void initializeUniversityAccountWebAddress(String webaddress)
	{
		this.setDataPassNV("webaddress", webaddress);
		SectionIntrfc ess = new Essentials();
		ess.setDataPass(this.getDataPass());
		ess.execute("DOES_WEB_EXIST");
		Result r = ess.getResult();
		if(r.getNumRows() < 1)
		{
			this.out(webaddress + ":NOT_FOUND");
			ess.execute("CREATE_UNIVERSITY_ACCOUNT_WEB");
		}
		
		ess.setDataPass(this.getDataPass());
		ess.execute("DOES_WEB_EXIST");
		Result uar = ess.getResult();
		if(uar.getNumRows() > 0)
		{
			this.setDataPassNV("url", this.getUrlPath());
			uar.setRow(0);
			this.setDataPassNV("universityaccount_uid", uar.getString("UID"));

			ess.setDataPass(this.getDataPass());
			ess.execute("CREATE_MATCH_ACCOUNT_PROFILE_FROM_URL");
			if(ess.getIsTrxnGood())
			{
				SectionIntrfc collegeProfile = new CollegeProfile();
				collegeProfile.setDataPass(this.getDataPass());
				collegeProfile.execute("GET_UNIVERSITYSOURCE_URL");
				Result usr = collegeProfile.getResult();
				usr.setRow(0);
				
				SectionIntrfc college = new College();
				this.setDataPassNV("universitysource_uid", usr.getString("UID"));
				college.setDataPass(this.getDataPass());
				college.execute("UPDATE_ACCOUNTCREATED_VALID");
				this.setProcessState("SUCCESS");
				
			}
		}
	}
}
