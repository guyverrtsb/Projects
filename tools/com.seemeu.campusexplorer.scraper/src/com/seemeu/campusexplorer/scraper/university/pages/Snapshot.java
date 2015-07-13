package com.seemeu.campusexplorer.scraper.university.pages;

import java.util.HashMap;

import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import com.seemeu.campusexplorer.scraper.base.UniversityPageBase;
import com.seemeu.campusexplorer.scraper.db.College;
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

	}
}
