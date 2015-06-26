package com.seemeu.database;

import java.util.HashMap;

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
}
