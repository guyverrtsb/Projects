package com.seemeu.campusexplorer.scraper.university;

import java.util.ArrayList;
import java.util.HashMap;

import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.CollegeProfile;
import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;

public class Profile
	extends UniversityPageBase
{
	public Profile(HashMap record)
	{
		super(record);
	}
	
	public void doExecute()
	{
		this.doHeader();
	}
	
	private void doHeader()
	{
		// Check to make sure URL is valid and has been registered
		SectionIntrfc college = new College();
		this.setDataPassNV("cxurl", this.getUrlPath());
		college.setDataPass(this.getDataPass());
		college.execute("GET_UID_FOR_CXURL");
		int numrows = college.getResult().getNumRows();
		if(numrows == 1)
		{
			// Get UID from the results Table
			college.getResult().setRow(0);
			String universitysource_uid = college.getResult().getString("UID");
			
			// Check if University Profile has been created already.
			// Only one Profile to Source allowed
			SectionIntrfc collegeProfile = new CollegeProfile();
			this.setDataPassNV("universitysource_uid", universitysource_uid);
			collegeProfile.setDataPass(this.getDataPass());
			collegeProfile.execute("GET_UID_FOR_UNIVERSITYSOURCE_UID");
			numrows = collegeProfile.getResult().getNumRows();
			if(numrows == 0)
			{
				// Create Data for new Record
				collegeProfile = new CollegeProfile();
				
				this.setSchooltype();
				this.setLatLng();
				this.setName();
				this.setCity();
				this.setRegion();
				this.setPhoneNumber();
				this.setLdesc();
				
				collegeProfile.setDataPass(this.getDataPass());
				collegeProfile.execute("CREATE_INIT_UNIV_PROFILE");
				
				if(collegeProfile.getIsTrxnGood())
				{
					college = new College();
					this.setDataPassNV("universitysource_uid", universitysource_uid);
					college.setDataPass(this.getDataPass());
					college.execute("UPDATE_PROFILE_VALID");
					this.setProcessState("SUCCESS");
				}
				else
				{
					this.outErr(": Issue Tracked : " + this.getClass().getName());
					this.setProcessState("ISSUE");
				}
			}
			else
			{
				this.out("**************" + " : Record Already Added : " + this.getClass().getName());
				this.setProcessState("ALREADY_ADDED");
			}
		}
		else
		{
			this.out("**************" + " : Scholarship Source not Found : " + this.getClass().getName());
			this.setProcessState("FAILURE");
		}
	}
	
	private void setSchooltype()
	{
		String[] url = this.getUrlPath().split("/");
		if(url.length == 8)
			this.setDataPassNV("schooltype", "TRADITIONAL");
		else if(url.length == 7)
			this.setDataPassNV("schooltype", "ONLINE");
		else if(url.length == 6)
			this.setDataPassNV("schooltype", "TRADITIONAL");
		else
			this.setDataPassNV("schooltype", "OTHER");

	}
	
	private void setLdesc()
	{
		String[] url = this.getUrlPath().split("/");
		
		String ldesc = this.DESC_Formatter(url[(url.length - 1)]);
		ldesc += "_" + this.DESC_Formatter(this.getDataPassString("region"));
		ldesc += "_" + this.DESC_Formatter(this.getDataPassString("city"));

		this.setDataPassNV("ldesc", ldesc);
	}
	
	private void setLatLng()
	{
		// Set Default Lat Lng
		this.setDataPassNV("latitude", "36.152084");
		this.setDataPassNV("longitude", "-95.988768");
		
		Elements elements = this.getDocument().getElementsByTag("head").get(0).children();
		for(int idx = 0; idx < elements.size(); idx++)
		{
			Element element = elements.get(idx);
			if(element.hasAttr("name")
					&& element.attr("name").equalsIgnoreCase("geo.position"))
			{
				String[] latlng = element.attr("content").split(";");
				this.setDataPassNV("latitude", latlng[0]);
				this.setDataPassNV("longitude", latlng[1]);
				idx = (elements.size() + 1);
			}
		}
	}
	
	private void setName()
	{
		Element element = this.getDocument().getElementsByTag("h1").get(0);
		this.setDataPassNV("name", element.text());
	}
	
	private void setCity()
	{
		this.setDataPassNV("city", this.getMissing());

		Elements elements = this.getDocument().getElementsByTag("span");
		for(int idx = 0; idx < elements.size(); idx++)
		{
			Element element = elements.get(idx);
			if(element.hasAttr("itemprop")
				&& element.attr("itemprop").equalsIgnoreCase("addressLocality")
				&& !element.text().isEmpty())
			{
				this.setDataPassNV("city", element.text());
			}
		}
	}
	
	private void setRegion()
	{
		this.setDataPassNV("region", this.getMissing());
		
		Elements elements = this.getDocument().getElementsByTag("span");
		for(int idx = 0; idx < elements.size(); idx++)
		{
			Element element = elements.get(idx);
			if(element.hasAttr("itemprop")
				&& element.attr("itemprop").equalsIgnoreCase("addressRegion")
				&& !element.text().isEmpty())
			{
				this.setDataPassNV("region", element.text());
			}
		}
	}
	
	private void setPhoneNumber()
	{
		this.setDataPassNV("phonenumber", this.getMissing());

		Elements elements = this.getDocument().getElementsByTag("title");
		Element element = elements.get(0);
		String[] title = element.text().split("\\|");
		if(title.length > 1)	// Get Phone Number from Title
			this.setDataPassNV("phonenumber", title[1].trim());
		else	// Get Phone Number from Header Address
		{
			elements = this.getDocument().getElementsByTag("p");
			for(int idx = 0; idx < elements.size(); idx++)
			{
				element = elements.get(idx);
				if(element.hasAttr("class")
					&& element.attr("class").equalsIgnoreCase("school-phone"))
				{
					String pn = element.text();
					pn = element.text().substring(pn.indexOf("("));
					this.setDataPassNV("region", pn);
				}
			}
		}
	}
}
