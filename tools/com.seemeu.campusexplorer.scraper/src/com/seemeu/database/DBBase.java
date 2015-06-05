package com.seemeu.database;

import java.sql.*;

public class DBBase
	extends DataControlBase
{
	private Connection connection = null;
	private PreparedStatement preparedStatement = null;
	private ResultSet resultSet = null;
	private int rowsImpactedbyCUD = 0;
	private Result result = null;
	private boolean isTrxnGood = false;

	private Connection getConnection()
	{
		if(this.connection == null)
			this.connection = JDBCMySQLConnection.getConnection();
		return this.connection;
	}
	
	public void setPreparedStatement(String sql)
	{
		try {
			if(this.preparedStatement == null)
				this.preparedStatement = this.getConnection().prepareStatement(sql);
		} catch (SQLException e) {
			this.outErr(e.getMessage());
		}
	}
	
	private PreparedStatement getPreparedStatement()
	{
		this.isTrxnGood = false;
		return this.preparedStatement;
	}
	
	public void bind(int position,
					Object object)
	{
		try {
			if(object.getClass().equals(Integer.class))
				this.getPreparedStatement().setInt(position, (int)object);
			else if(object.getClass().equals(String.class))
				this.getPreparedStatement().setString(position, (String)object);
		} catch (SQLException e) {
			this.outErr("bind [" + e.getMessage() + "]");
		}
	}
	
	private void setResult(ResultSet resultset)
	{
		this.result = new Result();
		this.result.build(resultSet);
	}
	
	public Result getResult()
	{
		return this.result;
	}
	
	public boolean getIsTrxnGood()
	{
		return this.isTrxnGood;
	}
	
	public void create(String key)
	{
	    try {           
	    	this.rowsImpactedbyCUD = this.getPreparedStatement().executeUpdate();
			this.out("create  [" + key + ":GOOD TRANSACTION]");
			this.isTrxnGood = true;
	    } catch (SQLException e) {
	    	this.outErr("create  [" + key + ":" + e.getMessage() + "]");
			this.isTrxnGood = false;
	    } finally {
	    	this.close();
	    }
	}
	
	public void retrieve(String key)
	{
	    try {
	    	this.resultSet = this.getPreparedStatement().executeQuery();
	    	this.setResult(resultSet);
	    	this.out("retrieve[" + key + ":GOOD TRANSACTION]");
			this.isTrxnGood = true;
	    } catch (SQLException e) {
	    	this.outErr("retrieve[" + key + ":" + e.getMessage() + "]");
			this.isTrxnGood = false;
	    } finally {
	    	this.close();
	    }
	}

	public void update(String key)
	{
	    try {           
	    	this.rowsImpactedbyCUD = this.getPreparedStatement().executeUpdate();
	    	this.out("update  [" + key + ":GOOD TRANSACTION]");
			this.isTrxnGood = true;
	    } catch (SQLException e) {
	    	this.outErr("update  [" + key + ":" + e.getMessage() + "]");
			this.isTrxnGood = false;
	    } finally {
	    	this.close();
	    }
	}

	public void delete(String key)
	{
	    try {           
	    	this.rowsImpactedbyCUD = this.getPreparedStatement().executeUpdate();
	    	this.out("delete  [" + key + ":GOOD TRANSACTION]");
			this.isTrxnGood = true;
	    } catch (SQLException e) {
	    	this.outErr("delete  [" + key + ":" + e.getMessage() + "]");
			this.isTrxnGood = false;
	    } finally {
	    	this.close();
	    }
	}
	
	private void close()
	{
		try {
			if(this.resultSet != null)
				this.resultSet.close();
			this.resultSet = null;
		} catch (SQLException e) {
			this.outErr("ResultSet [" + e.getMessage() + "]");
		}
		finally {
			try {
				if(this.preparedStatement != null)
					this.preparedStatement.close();
				this.preparedStatement = null;
			} catch (SQLException e) {
				this.outErr("PreparedStatement [" + e.getMessage() + "]");
			}
			finally {
				try {
					if(this.connection != null)
						this.connection.close();
					this.connection = null;
				} catch (SQLException e) {
					this.outErr("Connection [" + e.getMessage() + "]");
				}
			}
		}
	}

}
