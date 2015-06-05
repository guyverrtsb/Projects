package com.seemeu.campusexplorer.scraper.scholarship;

import java.util.ArrayList;
import java.util.HashMap;

import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
import com.seemeu.campusexplorer.scraper.db.Essentials;
import com.seemeu.campusexplorer.scraper.db.CollegeProfile;
import com.seemeu.campusexplorer.scraper.db.Scholarship;
import com.seemeu.campusexplorer.scraper.db.ScholarshipProfile;
import com.seemeu.campusexplorer.scraper.db.ScholarshipSponsor;
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
			doProfile();
	}
	
	private void doProfile()
	{
		// Get the UID for the Scholarship Source
		SectionIntrfc scholarship = new Scholarship();
		this.setDataPassNV("cxurl", this.getUrlPath());
		scholarship.setDataPass(this.getDataPass());
		scholarship.execute("GET_UID_FOR_CXURL");
		int numrows = scholarship.getResult().getNumRows();
		if(numrows == 1)
		{
			scholarship.getResult().setRow(0);
			String scholarshipsource_uid = scholarship.getResult().getString("UID");
			this.setDataPassNV("scholarshipsource_uid", scholarshipsource_uid);

			// Check to make sure that the Scholarship has not been added already
			SectionIntrfc scholarshipProfile = new ScholarshipProfile();
			scholarshipProfile.setDataPass(this.getDataPass());
			scholarshipProfile.execute("GET_UID_FOR_SCHOLARSHIPSOURCE_UID");
			numrows = scholarshipProfile.getResult().getNumRows();
			if(numrows == 0)
			{
				// Create Data for new Record
				scholarshipProfile = new ScholarshipProfile();
				
				this.setSponsorUid();
				this.setName();
				this.setLdesc();
				this.setDataPassNV("scholarshipsource_uid", scholarshipsource_uid);
	
				scholarshipProfile.setDataPass(this.getDataPass());
				scholarshipProfile.execute("CREATE_INIT_SCHOLARSHIP_PROFILE");
				
				if(scholarshipProfile.getIsTrxnGood())
				{
					// Record that Scholarship Profile has been initialized
					scholarship = new Scholarship();
					this.setDataPassNV("scholarshipsource_uid", scholarshipsource_uid);
					scholarship.setDataPass(this.getDataPass());
					scholarship.execute("UPDATE_PROFILE_VALID");
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
	
	private void setName()
	{
		String val = this.getDocument().getElementsByTag("h1").text();
		val.trim();
		this.setDataPassNV("name", val);
	}
	
	private void setSponsorUid()
	{
		String val = this.getDocument().getElementsByClass("sponsored-by").get(0).text();
		val = val.substring((val.indexOf(":") + 1));
		
		String name = val.trim();
		String ldesc = this.DESC_Formatter(name);
		this.setDataPassNV("name", (name + "_" + val.trim()));
		this.setDataPassNV("ldesc", ldesc);
		
		SectionIntrfc scholarshipSponsor = new ScholarshipSponsor();
		scholarshipSponsor.setDataPass(this.getDataPass());
		scholarshipSponsor.execute("GET_UID_FOR_SCHOLARSHIPSPONSOR_LDESC");
		int numrows = scholarshipSponsor.getResult().getNumRows();
		if(numrows == 0)
		{
			scholarshipSponsor.execute("CREATE_INIT_SCHOLARSHIP_SPONSOR");
			if(scholarshipSponsor.getIsTrxnGood())
			{
				scholarshipSponsor.execute("GET_UID_FOR_SCHOLARSHIPSPONSOR_LDESC");
				numrows = scholarshipSponsor.getResult().getNumRows();
				if(numrows > 0)
				{
					scholarshipSponsor.getResult().setRow(0);
					String scholarshipsponsor_uid = scholarshipSponsor.getResult().getString("UID");
					this.setDataPassNV("scholarshipsponsor_uid", scholarshipsponsor_uid);
				}
			}
			else
			{
				this.outErr(": Issue Tracked : " + this.getClass().getName());
			}
		}
		else
		{
			scholarshipSponsor.getResult().setRow(0);
			String scholarshipsponsor_uid = scholarshipSponsor.getResult().getString("UID");
			this.setDataPassNV("scholarshipsponsor_uid", scholarshipsponsor_uid);
		}
		this.setDataPassNV("ldesc_sponsor", ldesc);
	}
	
	private void setLdesc()
	{
		String name = this.getDataPassString("name"); 
		String sponsor = this.getDataPassString("ldesc_sponsor");
		
		name = this.DESC_Formatter(name);
				
		this.setDataPassNV("ldesc", (name + "_" + sponsor));
	}
}
