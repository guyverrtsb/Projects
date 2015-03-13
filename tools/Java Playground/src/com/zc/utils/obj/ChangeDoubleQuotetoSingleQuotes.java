package com.zc.utils.obj;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;

public class ChangeDoubleQuotetoSingleQuotes
{
    ArrayList filecontents = new ArrayList();
    String filepath = "";
    String orig_filename = "";
    String new_filename = "";
    String extension = "";
    
    public ChangeDoubleQuotetoSingleQuotes(String orig_filename, String new_filename, Boolean doTestoutput)
    {
    	File start = new File(orig_filename);
    	File file = new File(start.getAbsolutePath());

    	this.filepath = file.getParent();
    	this.orig_filename = file.getName();
    	this.new_filename = new_filename;
    	
    	if(doTestoutput)
			System.out.println(this.filepath + ":" + this.orig_filename + ":" + this.new_filename + ":");
    }
    
    public void readFile()
    {
    	this.filecontents = new ArrayList();
        BufferedReader reader;
		try {
			reader = new BufferedReader( new FileReader (this.orig_filename));
	        String         line = null;
	        String         ls = System.getProperty("line.separator");

	        while( ( line = reader.readLine() ) != null )
	        {
	        	this.filecontents.add( line );
	        	this.filecontents.add( ls );
	        }
	        
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			System.out.println(e.getMessage());

		} catch (IOException e) {
			// TODO Auto-generated catch block
			System.out.println(e.getMessage());
		}
    }
    
    public void writeFile()
    {
    	try
    	{
			FileWriter writer = new FileWriter(this.filepath + "\\" + this.new_filename + "." + this.extension); 
        	
        	for(int idx = 0; idx < this.filecontents.size(); idx++)
        	{
        		writer.write(this.filecontents.get(idx).toString().replace("\"\"\"","\""));
        	}
        	
        	writer.close();
		} catch (IOException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
    }
    
    public void readFileTest()
    {
      	
    	for(int idx = 0; idx < this.filecontents.size(); idx++)
    	{
    		System.out.println(this.filecontents.get(idx).toString());
    	}

    }
    
    public void writeFileTest()
    {
      	
    	for(int idx = 0; idx < this.filecontents.size(); idx++)
    	{
    		System.out.println(idx + ":new:" + this.filecontents.get(idx).toString().replace("\"\"\"","\""));
    	}

    }
}
