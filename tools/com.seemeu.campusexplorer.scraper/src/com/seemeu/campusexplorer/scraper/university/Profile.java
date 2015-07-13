package com.seemeu.campusexplorer.scraper.university;

import java.util.ArrayList;
import java.util.HashMap;

import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
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
	}
}
