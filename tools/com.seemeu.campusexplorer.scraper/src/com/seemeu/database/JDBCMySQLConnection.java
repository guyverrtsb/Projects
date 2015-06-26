package com.seemeu.database;

//Step 1: Use interfaces from java.sql package 
import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;
 
public class JDBCMySQLConnection {
    //static reference to itself
    private static JDBCMySQLConnection instance = new JDBCMySQLConnection();

    public static final String DRIVER_CLASS = "com.mysql.jdbc.Driver";
    public static final String PROJECT_PATH = "/usr/SeeMeU";

    //private constructor
    private JDBCMySQLConnection() {
        try {
            //Step 2: Load MySQL Java driver
            Class.forName(DRIVER_CLASS);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }
    }
     
    private Connection createConnection() {
 
        Connection connection = null;
        try {
            //Step 3: Establish Java MySQL connection
            connection = DriverManager.getConnection("jdbc:mysql://" + getKey("hostname") + "/" + getKey("database")
            		, getKey("username")
            		, getKey("password"));
        } catch (SQLException e) {
            System.out.println("ERROR: Unable to Connect to Database.[" + e.getMessage() + "]");
        }
        return connection;
    }
    
    private String getKey(String key)
    {
    	String value = "";
    	try
    	{
			File fXmlFile = new File(JDBCMySQLConnection.PROJECT_PATH + "/ZDBCONNECTIONS.xml");
			DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
			DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
			Document doc = dBuilder.parse(fXmlFile);
			 
			//optional, but recommended
			//read this - http://stackoverflow.com/questions/13786607/normalization-in-dom-parsing-with-java-how-does-it-work
			doc.getDocumentElement().normalize();
			
			NodeList nList = doc.getElementsByTagName(key);
			for (int idx = 0; idx < nList.getLength(); idx++)
			{
				Node nNode = nList.item(idx);
				if (nNode.getNodeType() == Node.ELEMENT_NODE)
				{
					Element eElement = (Element) nNode;
					if(eElement.getParentNode().getNodeName().equalsIgnoreCase("application"))
					{
						value = eElement.getTextContent();
					}
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	return value;
    }
    
    public static Connection getConnection()
    {
        return instance.createConnection();
    }
}
