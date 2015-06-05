package com.seemeu.database;

//Step 1: Use interfaces from java.sql package 
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
 
public class JDBCMySQLConnection {
    //static reference to itself
    private static JDBCMySQLConnection instance = new JDBCMySQLConnection();

    public static final String URL = "jdbc:mysql://127.0.0.1:3306/seemeuapplication";
    public static final String USER = "root";
    public static final String PASSWORD = "GDHonkey_01";
    public static final String DRIVER_CLASS = "com.mysql.jdbc.Driver"; 
    /*
    public static final String URL = "jdbc:mysql://prtsemeuappli.db.6047355.hostedresource.com/prtsemeuappli";
    public static final String USER = "prtsemeuappli";
    public static final String PASSWORD = "GDProto@01";
	public static final String DRIVER_CLASS = "com.mysql.jdbc.Driver"; 
     */
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
            connection = DriverManager.getConnection(URL, USER, PASSWORD);
        } catch (SQLException e) {
            System.out.println("ERROR: Unable to Connect to Database.[" + e.getMessage() + "]");
        }
        return connection;
    }   
     
    public static Connection getConnection() {
        return instance.createConnection();
    }
}
