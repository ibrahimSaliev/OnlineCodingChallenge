package com.maksimovic.dbsProject;
//import java.sql.*;

public class JavaSqlExample {
  public static void main(String args[]) {
    try {
          
    	DatabaseConnection dc = new DatabaseConnection();
    	dc.connect();
    	
    	Inserter insert = new Inserter(dc);
    	insert.insertIntoPerson();
    	insert.insertIntoPosterAndParticipator();
    	insert.insertIntoChallenge();
    	insert.insertIntoAward();
    	insert.insertIntoContest();
    	insert.insertIntoChallengeComments();
    	insert.closeResultSet();
        dc.disconnect();
        
    } catch (Exception e) {
      System.err.println(e.getMessage());
    }
  }
  
}
