/*
 * Copyright (c) 1995, 2008, Oracle and/or its affiliates. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   - Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   - Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *
 *   - Neither the name of Oracle or the names of its
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
 
package com.zc.utils;
 
import java.io.*;
import java.util.ArrayList;
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.filechooser.*;

import com.zc.utils.obj.ChangeDoubleQuotetoSingleQuotes;

public class CleanQuotes {
    /**
	 * 
	 */
    ArrayList filecontents = new ArrayList();
    static String BEFORE_FILE_NAME = "BEFORE.txt";
    static String AFTER_FILE_NAME = "BEFORE.txt";
	static Boolean doTestoutput = false;

    public static void main(String[] args)
    {
    	ChangeDoubleQuotetoSingleQuotes cdqsq = null;
    	if(args.length == 0)
    	{
    		cdqsq = new ChangeDoubleQuotetoSingleQuotes(BEFORE_FILE_NAME, AFTER_FILE_NAME, doTestoutput);
    	}
    	else if(args.length == 1)
    	{
    		cdqsq = new ChangeDoubleQuotetoSingleQuotes(args[0], args[0], doTestoutput);
    	}
    	else if(args.length == 2)
    	{
    		cdqsq = new ChangeDoubleQuotetoSingleQuotes(args[0], args[1], doTestoutput);
    	}
    	else if(args.length == 3)
    	{
    		doTestoutput = true;
    		cdqsq = new ChangeDoubleQuotetoSingleQuotes(args[0], args[1], doTestoutput);
    	}
    	else
    	{
    		System.out.println("This utils only support two file names and test switch");
    	}
    	
    	cdqsq.readFile();
    	if(doTestoutput)
    	{
    		cdqsq.writeFileTest();
    		cdqsq.writeFileTest();
    	}
    	cdqsq.writeFile();
    	
    	// System.out.println(this.filepath + ":" + this.orig_filename + ":" + this.extension);
        // filecontents = readFile(file.getPath());
    	 
    	// File file = new File(this.filepath + "\\" + this.new_filename + "." + this.extension);

    }
    
    public void setFile(String fileName)
    {
        // filepath = file.getParent();
        // orig_filename = file.getName().split("\\.")[0];
        // extension = file.getName().split("\\.")[1];
    }
}
