package com.maksimovic.dbsProject;

import java.sql.*;

public class DatabaseConnection {
    
    private String database = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
    private String user = "a01146675";
    private String pass = "DasSymbol992";
    private Connection con = null;
    private Statement stmt = null;
	
	DatabaseConnection(){
		
	}
	
	public Statement getStmt() {
		return stmt;
	}
	
	public Connection getConnection() {
		return con;
	}
	
	public void connect() {
		
		try {
			Class.forName("oracle.jdbc.driver.OracleDriver");
			
			con = DriverManager.getConnection(database, user, pass);
			stmt = con.createStatement();
		} catch (Exception e) {
			e.printStackTrace();
		}
		
	}
	
	public void disconnect() {
		
	    try {
	    	stmt.close();
			con.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

}
