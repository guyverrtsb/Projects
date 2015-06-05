package com.seemeu.database;

import java.util.HashMap;

public class DataControlBase
	extends LoggingBase
{
	private HashMap dataPass = new HashMap();
	
	public String getMissing() { return "MISSING"; }
	public void setDataPass(HashMap dataPass) { this.dataPass = dataPass; }	
	public void setDataPassNV(String name, Object object)
	{
		if(this.dataPass.containsKey(name.toUpperCase()))
			this.dataPass.remove(name.toUpperCase());
		
		if(object.getClass().toString().equalsIgnoreCase("class java.lang.String"))
			this.dataPass.put(name.toUpperCase(), (String)object);
		else if(object.getClass().toString().equalsIgnoreCase("class java.lang.Integer"))
			this.dataPass.put(name.toUpperCase(), (int)object);
	}
	public HashMap getDataPass() { return this.dataPass; }
	
	public int getDataPassInt(String name)
	{
		if(this.getDataPass().containsKey(name.toUpperCase()))
			return (int)this.getDataPass().get(name.toUpperCase());
		return 0;
	}

	public String getDataPassString(String name)
	{
		if(this.getDataPass().containsKey(name.toUpperCase()))
			return (String)this.getDataPass().get(name.toUpperCase());
		return "";
	}
	
	public String DESC_Formatter(String in)
	{
		in = in.trim();
		in = in.toUpperCase();
		in = in.replaceAll("-", "_");
		in = in.replaceAll("[^\\w\\s]+", "");
		in = in.replaceAll("  ", " ");
		in = in.replaceAll(" ", "_");
		in = in.replaceAll("_____", "_");
		in = in.replaceAll("____", "_");
		in = in.replaceAll("___", "_");
		in = in.replaceAll("__", "_");
		return in;
	}
	
	
	public void out(String msg)
	{
		if(this.getDataPass().get("ZZZZCOUNTER") != null)
			super.out("[" + (int)this.getDataPass().get("ZZZZCOUNTER") + "][" + msg + "]");
		else
			super.out("[" + msg + "]");

	}	
	public void outErr(String msg)
	{
		if(this.getDataPass().get("ZZZZCOUNTER") != null)
			super.out("ERR_ERR_ERR" + "[" + (int)this.getDataPass().get("ZZZZCOUNTER") + "][" + msg + "]");
		else
			super.out("ERR_ERR_ERR" + "[" + msg + "]");
	}
}
