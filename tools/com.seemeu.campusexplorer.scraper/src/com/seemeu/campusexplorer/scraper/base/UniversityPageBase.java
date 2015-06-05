package com.seemeu.campusexplorer.scraper.base;

import java.io.IOException;
import java.util.HashMap;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;

import com.seemeu.campusexplorer.scraper.intrfc.SectionIntrfc;
import com.seemeu.database.DBBase;

public abstract class UniversityPageBase
	extends DBBase
{
	private String urlPath = "";
	private Document document = null;
	private String processState = null;

	public UniversityPageBase(HashMap record)
	{
		this.setDataPass(record);
		
		this.urlPath = (String)record.get("ZZZZHOSTNAME") + (String)record.get("ZZZZPATH") + (String)record.get("ZZZZPATHEXTRA");
		try {
			this.setDocument(Jsoup.connect(this.urlPath).timeout(60*1000).get());
			//this.out(this.urlPath);
		} catch (IOException e)	{
			this.outErr(e.getMessage() + ":" + this.getClass().getName());
		}
	}
	
	public String getUrlPath() { return this.urlPath; }
	
	public void setDocument(Document document) { this.document = document; }
	public Document getDocument() { return this.document; }
	
	public void setProcessState(String value) { this.processState = value.toUpperCase(); }
	public String getProcessState() { return this.processState; }
	
	/**
	 * Use this to Execute the Root Node.
	 * This is the starting point
	 */
	public void execute()
	{
		if(this.getDocument() != null)
		{
			this.doExecute();
		}
		else
		{
			this.outErr("ERROR Loading[" + this.getUrlPath() + "]");
		}
	}
	
	/**
	 * use this to run through the objects
	 * to gather section data
	 * @param node
	 */
	public abstract void doExecute();
}
