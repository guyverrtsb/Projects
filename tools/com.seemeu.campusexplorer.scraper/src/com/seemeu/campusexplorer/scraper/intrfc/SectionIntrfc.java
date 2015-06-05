package com.seemeu.campusexplorer.scraper.intrfc;

import java.util.HashMap;

import org.jsoup.nodes.Element;

import com.seemeu.database.Result;


public interface SectionIntrfc
{
	public void setDataPass(HashMap dataPass);
	public void setDataPassNV(String name, Object object);
	public void setElement(Element element);
	public void execute(String key);
	public Result getResult();
	public boolean getIsTrxnGood();
	public void test();
}
