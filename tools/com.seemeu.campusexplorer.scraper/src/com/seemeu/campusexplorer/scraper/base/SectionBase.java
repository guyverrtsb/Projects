package com.seemeu.campusexplorer.scraper.base;

import java.util.ArrayList;

import org.jsoup.nodes.Element;

import com.seemeu.database.DBBase;

public class SectionBase
	extends DBBase
{
	private ArrayList elements = new ArrayList();
	
	public void setElement(Element element)
	{
		this.elements.add(element);
	}
	
	public Element getElement(int idx)
	{
		return (Element)this.getElements().get(idx);
	}
	
	public ArrayList getElements()
	{
		return this.elements;
	}
	
	public String getPassData(String name)
	{
		String[] ud = this.getDataPassString("url").toString().split("/");
		if(name.equalsIgnoreCase("name"))
			return (String)this.getDataPassString("name");
		else if(name.equalsIgnoreCase("sdesc"))
			return this.getDataPassString("name").toString()
					.toUpperCase().replace("-", "_")
					.replace(" ", "_")
					.replace(",", "")
					.replace("'", "")
					.replace(")", "")
					.replace("(", "")
					.replace("\\.", "")
					.replace("&AMP;", "&");
		else if(name.equalsIgnoreCase("phone"))
			return (String)this.getDataPassString("phone");
		else if(name.equalsIgnoreCase("city"))
			return ud[ud.length - 1];
		else if(name.equalsIgnoreCase("state"))
			return ud[ud.length - 2];
		else if(name.equalsIgnoreCase("unique"))
			return ud[ud.length - 3];
		return "";
	}
	
	public void test()
	{
		for(int idx = 0; idx < this.getElements().size(); idx++)
		{
			Element element = (Element)this.getElements().get(idx);
		}
	}
}
