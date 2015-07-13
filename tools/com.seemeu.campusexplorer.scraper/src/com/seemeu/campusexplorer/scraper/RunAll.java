package com.seemeu.campusexplorer.scraper;

import com.seemeu.database.JDBCMySQLConnection;
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
		String task = "CSDUDG";
		int startIdx = 1;
		int endIdx = 5;
		if(args.length > 0)
		{
			if(args.length >= 1)
			{
				task = args[0];
			}
			
			if(args.length >= 2)
			{
				startIdx = Integer.parseInt(args[1]);
			}
			
			if(args.length >= 3)
			{
				endIdx = Integer.parseInt(args[2]);
			}
		}

		runAll.run(task, startIdx, endIdx);
	}
	
	public void run(String command,
					int startIdx,
					int endIdx)
	{
		LoadCampusExplorerfromColleges colleges = null;
		LoadCampusExplorerfromScholarships scholarships = null;
		this.createLogFile();
		if(command.toUpperCase().indexOf("C") != -1 )
		{
			if(colleges == null)
				colleges = new LoadCampusExplorerfromColleges();
			colleges.run(startIdx, endIdx);
		}
		
		if(command.toUpperCase().indexOf("S") != -1 )
		{
			if(scholarships == null)
				scholarships = new LoadCampusExplorerfromScholarships();
			scholarships.run(startIdx, endIdx);
		}
		
		if(command.toUpperCase().indexOf("DU") != -1 )
		{
			if(colleges == null)
				colleges = new LoadCampusExplorerfromColleges();
			colleges.saveScreenData();
		}
		
		if(command.toUpperCase().indexOf("DG") != -1 )
		{
			if(scholarships == null)
				scholarships = new LoadCampusExplorerfromScholarships();
			scholarships.saveScreenData();
		}
	}
}
