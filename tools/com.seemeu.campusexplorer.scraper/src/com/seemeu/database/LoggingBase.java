package com.seemeu.database;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Calendar;

public class LoggingBase
{
	public void createLogFile()
	{
		File folder = new File("C:\\tmp\\logs\\seemeu\\");
		if(!folder.exists())
			folder.mkdirs();
		Calendar calendar = Calendar.getInstance();
		try(
			FileWriter fw = new FileWriter(folder.getAbsolutePath() + "\\" + calendar.getTimeInMillis() + ".txt", true);
			BufferedWriter bw = new BufferedWriter(fw);
			PrintWriter out = new PrintWriter(bw)
		)
		{
			out.println("[" + this.getClass().getName() + "]");
		}  
		catch( IOException e )
		{
		// File writing/opening failed at some stage.
		}
	}
	
	public void out(String msg)
	{
		System.out.println(msg);
		this.appendToLogFile(msg);
	}
	
	private void appendToLogFile(String msg)
	{
		Calendar calendar = Calendar.getInstance();
		
		File folder = new File("C:\\tmp\\logs\\seemeu\\");
		File[] fl = folder.listFiles();
		File f = fl[fl.length - 1];
		try	(
			FileWriter fw = new FileWriter(f.getAbsolutePath(), true);
			BufferedWriter bw = new BufferedWriter(fw);
			PrintWriter out = new PrintWriter(bw)
			)
		{
			out.println(msg);
		}  
		catch( IOException e )
		{
		// File writing/opening failed at some stage.
		}
	}
}
