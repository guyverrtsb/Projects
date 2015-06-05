package com.seemeu.database;

import java.sql.*;
import java.util.ArrayList;
import java.util.HashMap;

public class Result
{
	ArrayList table = null;
	private int numRows = 0;
	private int numCols = 0;
	private int currentRow = 0;
	public void build(ResultSet rs)
	{
		this.buildRows(rs);
	}
	
	public ArrayList getTable()
	{
		return this.table;
	}
	
	public int getNumRows()
	{
		return this.numRows;
	}
	
	public int getNumCols()
	{
		return this.numCols;
	}
	
	public void setRow(int idx)
	{
		this.currentRow = idx;
	}
	
	public HashMap getRow(int idx)
	{
		return (HashMap)this.table.get(idx);
	}
	
	public String getString(String name)
	{
		HashMap row = (HashMap)this.getRow(this.currentRow);
		return (String)row.get(name.toUpperCase());
	}
	
	private void buildRows(ResultSet rs)
	{
		this.table = new ArrayList();
		try {
			while(rs.next())	// Iterate through Rows
			{
				this.numRows++;
				HashMap colSet = this.buildColumns(rs);
				this.table.add(colSet);
			}
		} catch (SQLException e) {
			System.out.println(e.getMessage() + "here");
		}
	}
	
	private HashMap buildColumns(ResultSet rs)
	{
		HashMap colSet = new HashMap();
		try {
			ResultSetMetaData md = rs.getMetaData();
			for (int idx = 1; idx <= md.getColumnCount(); idx++)
			{
				this.numCols++;
				Object object = rs.getObject(idx);
				if(object == null)
					colSet.put(md.getColumnLabel(idx).toUpperCase(), "NULL");
				else if(object.getClass().toString().equalsIgnoreCase("class java.lang.String"))
					colSet.put(md.getColumnLabel(idx).toUpperCase(), rs.getString(idx));
				else if(object.getClass().toString().equalsIgnoreCase("class java.lang.Integer"))
					colSet.put(md.getColumnLabel(idx).toUpperCase(), rs.getInt(idx));
				else if(object.getClass().toString().equalsIgnoreCase("class java.sql.Timestamp"))
					colSet.put(md.getColumnLabel(idx).toUpperCase(), rs.getTimestamp(idx));
				else
					System.out.println(object.getClass().toString());
			}
		} catch (SQLException e) {
			System.out.println(e.getMessage() + "here01");
		}
		return colSet;
	}
}
