package com.seemeu.database;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Calendar;
import java.util.HashMap;

public class LoggingBase
{
	public void createLogFile()
	{
		File folder = new File("seemeu/");
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
		if(msg.indexOf("ERR_ERR_ERR") != -1 || msg.indexOf("**********") != -1)
		{
			System.out.println(msg);
		}
		else if(msg.indexOf("SCREENDATA") == -1)
		{
			System.out.println(msg);
		}
		/*
		else if(msg.indexOf("||||||||||||||||") != -1)
			System.out.print("\r" + msg);
		else if(msg.indexOf("[INCREMENT]") != -1)
		{
			String number = msg.substring(1, msg.indexOf("]"));
			System.out.print("\r" + number);
		}
		*/
		this.appendToLogFile(msg);
	}
	

	private void appendToLogFile(String msg)
	{
		Calendar calendar = Calendar.getInstance();
		
		File folder = new File("seemeu/");
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
