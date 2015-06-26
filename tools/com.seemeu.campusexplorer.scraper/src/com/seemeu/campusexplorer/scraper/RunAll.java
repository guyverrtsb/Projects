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
		String task = "CS";
		int startIdx = 1;
		int endIdx = 10000;
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
		this.createLogFile();
		if(command.toUpperCase().indexOf("C") != -1 )
		{
			LoadCollegesfromCampusExplorer colleges = new LoadCollegesfromCampusExplorer();
			colleges.run(startIdx, endIdx);
		}
		
		if(command.toUpperCase().indexOf("S") != -1 )
		{
			LoadScholarshipsfromCampusExplorer scholarships = new LoadScholarshipsfromCampusExplorer();
			scholarships.run(startIdx, endIdx);
		}
	}
}
