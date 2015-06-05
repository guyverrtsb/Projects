package com.seemeu.campusexplorer.scraper;

import com.seemeu.database.LoggingBase;

public class RunAll
	extends LoggingBase
{
	/**
	 * @param args
	 */
	public static void main(String[] args)
	{
		RunAll runAll = new RunAll();
		runAll.run();
	}
	
	public void run()
	{
		this.createLogFile();
		LoadCollegesfromCampusExplorer colleges = new LoadCollegesfromCampusExplorer();
		colleges.run("http://www.campusexplorer.com/colleges/search/");

		LoadScholarshipsfromCampusExplorer scholarships = new LoadScholarshipsfromCampusExplorer();
		scholarships.run("http://www.campusexplorer.com/scholarships/");
		
		LoadCollegeData data = new LoadCollegeData();
		data.run();
	}
}
