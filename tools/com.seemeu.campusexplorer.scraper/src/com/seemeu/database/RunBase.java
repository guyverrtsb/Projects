package com.seemeu.database;

import java.io.IOException;
import java.util.HashMap;

import org.jsoup.Jsoup;
import org.jsoup.nodes.*;

public class RunBase
	extends LoggingBase
{
	private HashMap record = new HashMap();
	public void set(String name, String value)
	{
		this.record.put(name.toUpperCase(), value);
	}
	
	public void set(String name, int value)
	{
		this.record.put(name.toUpperCase(), value);
	}
	
	public String getStr(String name)
	{
		if(this.record.containsKey(name.toUpperCase()))
			return (String)this.record.get(name.toUpperCase());
		this.out("************* [" + name.toUpperCase() + "] does not exists");
		return "";
	}
	
	public int getInt(String name)
	{
		if(this.record.containsKey(name.toUpperCase()))
			return (int)this.record.get(name.toUpperCase());
		this.out("************* [" + name.toUpperCase() + "] does not exists");
		return 0;
	}
	
	public HashMap getRecord()
	{
		return this.record;
	}
	
	int loadDocIdx = 0;
	public Document loadDoc(String url)
	{
		Document doc = null;
		try
		{
			doc = Jsoup.connect(url).timeout(1000 * 60 * 2).get();
		}
		catch (IOException e)
		{
			this.loadDocIdx++;
			if(this.loadDocIdx < 10)
			{
				this.out("[LOAD_FAILURE][" + e.getMessage() + "][" + url + "]");
				this.loadDoc(url);
			}
			else
			{
				this.out("[MAX_RELOAD_TRY][" + url + "]");
			}	
		}
		this.loadDocIdx = 0;
		return doc;
	}
}
