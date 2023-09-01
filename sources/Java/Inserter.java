package com.maksimovic.dbsProject;

import java.io.BufferedReader;
import java.net.URL;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.sql.*;
import java.util.ArrayList;
import java.util.Random;

public class Inserter {

	private ResultSet rs = null;
	private DatabaseConnection dc = null;
	
	public Inserter (DatabaseConnection dc) {
		this.dc = dc;
	}
	
	public void insertIntoPersonCSV() {
		
	try {
		    BufferedReader reader = csvReader("person.csv");
		    String line = reader.readLine();
		    line = reader.readLine();
		    
		    while(line != null) {
		    	String[] values = line.split(",");
		    	String insertSql = "INSERT INTO person VALUES ('"+ values[0]+"',"+ 
		    	Integer.valueOf(values[1])+",'" + values[2]+"',"+Integer.valueOf(values[3])+
		    	",'"+ values[4]+"')";           
		        
		    	 
		    	dc.getStmt().executeUpdate(insertSql); 
		    
		    	line = reader.readLine();
		    }
		    
		    getNumberOfDatasets("person");
		    
	    } catch (Exception e) {
	          System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
	    }

	  
	}
	
	public void insertIntoPerson() {
		
		for(int i = 0 ;i<1000; i++) {
			String username = getRandomUsername();
			int age  = getRandomAge();
			String gender = getRandomGender();
			int nrReviews = getRandomReviews();
			String country  = getRandomCountry();
			
			String insertSql = "INSERT INTO person VALUES ('"+ username+"',"+ age +","
					+ "'" + gender+"',"+nrReviews+
			    	",'"+ country+"')";
			
			try {
				dc.getStmt().executeUpdate(insertSql);
			} catch (SQLException e) {
				 e.getMessage();
			}
		}
		
		getNumberOfDatasets("person");
		
	}
	
	public String getRandomCountry() {
		String[] countries = {"Bosnia","Austria","Serbia","Bulgaria",
				"USA","UK","China","Argentina","Japan","Norway",
				"Canada","Egypt","Denmark","Germany","France",
				"Spain","Italy","Croatia","Poland","Greece","Portugal","Sweden","Switzerland"};
		String country = countries[new Random().nextInt(countries.length)];
		return country;
	}

	private int getRandomReviews() {
		
		int randomRev = new Random().nextInt(100);
		return randomRev;
	}

	public String getRandomGender() {
		
		String[] gender = {"M","F","Unknown"};
		String gen = gender[new Random().nextInt(3)];
		return gen;
	}

	public int getRandomAge() {
		
		int randomAge = new Random().nextInt(60);
		while(randomAge < 7) {
			randomAge = new Random().nextInt(60);
		}
		return randomAge;
	}

	public String getRandomUsername() {
		
		String alphabet = "abcdefghijklmnopqrstuvwxyzABCD";
	    StringBuilder sb = new StringBuilder();

	    for(int i = 0; i < 14; i++) {

	      int index = new Random().nextInt(alphabet.length());
	      char randomChar = alphabet.charAt(index);
	      sb.append(randomChar);
	    }
	    
        return sb.toString();
	}

	public void insertIntoPosterAndParticipator() {
		
		ArrayList<String> listOfUsernames = new ArrayList<String>();
		String query = "Select username from person";
		try {
			rs=dc.getStmt().executeQuery(query);
			if(rs.next()) {
				do{
                    listOfUsernames.add(rs.getString(1));
                }while(rs.next());
			}
		} catch (SQLException e) {
			e.getMessage();
		}
		
		for(int i = 0 ;i<250; i++) {
			String username = listOfUsernames.get(new Random().nextInt(1000));
			String insertSql = "INSERT INTO poster (username) VALUES ('"+ username +"')";
			
			try {
				dc.getStmt().executeUpdate(insertSql);
			} catch (SQLException e) {
				e.getMessage();
			}
			
		}
		
		for(int i = 0 ;i<350; i++) {
			String username = listOfUsernames.get(new Random().nextInt(1000));
			String insertSql = "INSERT INTO participator (username) VALUES ('"+ username +"')";
			
			try {
				dc.getStmt().executeUpdate(insertSql);
			} catch (SQLException e) {
				e.getMessage();
			}
			
		}
		
		getNumberOfDatasets("poster");
		getNumberOfDatasets("participator");
		
	}
	
	public void insertIntoChallenge() {
		
		ArrayList<String> listOfPosters = new ArrayList<String>();
		String query = "Select username from poster";
		try {
			rs=dc.getStmt().executeQuery(query);
			if(rs.next()) {
				do{
                    listOfPosters.add(rs.getString(1));
                }while(rs.next());
			}
		} catch (SQLException e) {
			e.getMessage();
		}
		
		for(int i = 0 ;i<1050; i++) {
			String poster = listOfPosters.get(new Random().nextInt(listOfPosters.size()-1));
			String title = getRandomTitle("challenge");
			String diff = getRandomDifficulty();
			String descript = getRandomDescript("challenge");
			int points = getRandomPoints();
			String insertSql = "INSERT INTO challenge (title,difficulty,descript,points,posted_by)"
					+ " VALUES ('"+ title +"','"+ diff +"','"+ descript +"'," + points + ",'"+ poster+"')";
			
			try {
				dc.getStmt().executeUpdate(insertSql);
			} catch (SQLException e) {
				e.getMessage();
			}
			
		}
		
		getNumberOfDatasets("challenge");
		
	}
	
	public void insertIntoAward() {
		
		for(int i = 0 ;i<50; i++) {
			String awardName = getRandomTitle("award");
			String descript = getRandomDescript("award");
			int points = getRandomAwardPoints();
			int solvedChallenges = getRandomSolvedChallenges();
			
			String insertSql = "INSERT INTO award "
					+ "(award_name,award_desc,required_points,required_solved_challenges)"
					+ " VALUES ('"+ awardName +
					"','"+ descript +"',"+ points +"," + solvedChallenges + ")";
			
			try {
				dc.getStmt().executeUpdate(insertSql);
			} catch (SQLException e) {
				 e.getMessage();
			}
		}
		
		getNumberOfDatasets("award");
	}
	
	public void insertIntoChallengeComments() {
		
		ArrayList<String> listOfUsernames = new ArrayList<String>();
		ArrayList<Integer> listOfChallenges = new ArrayList<Integer>();
		String query1 = "Select username from person";
		String query2 = "Select challenge_id from challenge";
		try {
			rs=dc.getStmt().executeQuery(query1);
			if(rs.next()) {
				do{
                    listOfUsernames.add(rs.getString(1));
                }while(rs.next());
			}
			rs=dc.getStmt().executeQuery(query2);
			if(rs.next()) {
				do{
                    listOfChallenges.add(rs.getInt(1));
                }while(rs.next());
			}
		} catch (SQLException e) {
			e.getMessage();
		}
		
		for(int i = 0; i<1100; i++) {
			int ch_id = listOfChallenges.get(new Random().nextInt(listOfChallenges.size()-1));
			String username = listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			String commentText = getRandomDescript("challenge");
			
			String insertSql = "INSERT INTO challenge_comments "
					+ "(challenge_id,username,comment_text)"
					+ " VALUES ("+ ch_id +
					",'"+ username +"','"+ commentText + "')";
			
			try {
				dc.getStmt().executeUpdate(insertSql);
			} catch (SQLException e) {
				 e.getMessage();
			}
		}
		
		getNumberOfDatasets("challenge_comments");
	}
	
	public void insertIntoContest() {
		
		ArrayList<String> listOfUsernames = new ArrayList<String>();
		ArrayList<Integer> listOfChallenges = new ArrayList<Integer>();
		String query1 = "Select username from participator";
		String query2 = "Select challenge_id from challenge";
		try {
			rs=dc.getStmt().executeQuery(query1);
			if(rs.next()) {
				do{
                    listOfUsernames.add(rs.getString(1));
                }while(rs.next());
			}
			rs=dc.getStmt().executeQuery(query2);
			if(rs.next()) {
				do{
                    listOfChallenges.add(rs.getInt(1));
                }while(rs.next());
			}
		} catch (SQLException e) {
			e.getMessage();
		}
		
		String insertSql;
		
		for(int i = 0; i<2000; i++) {
			int ch_id = listOfChallenges.get(new Random().nextInt(listOfChallenges.size()-1));
			int contestants = getContestants();
			String firstPlayer = listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			String secondPlayer = listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			while(secondPlayer.equalsIgnoreCase(firstPlayer)) {
				secondPlayer = listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			}
			String thirdPlayer = listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			while(thirdPlayer.equalsIgnoreCase(firstPlayer) || 
					thirdPlayer.equalsIgnoreCase(secondPlayer)) {
				thirdPlayer = listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			}
			if(contestants == 4) {
				//4 players
			String fourthPlayer =listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			while(fourthPlayer.equalsIgnoreCase(firstPlayer) ||
					fourthPlayer.equalsIgnoreCase(secondPlayer) || 
					fourthPlayer.equalsIgnoreCase(thirdPlayer)) {
				fourthPlayer =listOfUsernames.get(new Random().nextInt(listOfUsernames.size()-1));
			}
			String winner = firstPlayer;
		    insertSql = "INSERT INTO contest "
					+ "(challenge_id,winner,nr_contestants,end_time,first_player,second_player,"
					+ "third_player,fourth_player)"
					+ " VALUES ("+ ch_id +
					",'"+ winner +"',"+ contestants +",current_timestamp,'"+ firstPlayer + "'"
							+ ",'"+ secondPlayer + "','"+ thirdPlayer+ "','"+ fourthPlayer+ "')";
			}else {
				// here only 3 players
				String winner = secondPlayer;
				insertSql = "INSERT INTO contest "
						+ "(challenge_id,winner,nr_contestants,end_time,first_player,second_player,"
						+ "third_player)"
						+ " VALUES ("+ ch_id +
						",'"+ winner +"',"+ contestants +",current_timestamp,'"+ firstPlayer + "'"
								+ ",'"+ secondPlayer + "','"+ thirdPlayer+ "')";
			}
			
			try {
				dc.getStmt().executeUpdate(insertSql);
			} catch (SQLException e) {
				 System.out.println(e.getMessage());
			}
			
		}
		
		getNumberOfDatasets("contest");
		
	}
	
	public int getContestants() {
		
		int random = new Random().nextInt(2);
		if(random == 0) {
			return 3;
		}else {
			return 4;
		}
		
	}
	
	public String getRandomTitle(String type) {
	    
	    String alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    StringBuilder sb = new StringBuilder();
	    int length;
	    
        if(type.equalsIgnoreCase("award")) {
			alphabet = "ABCDEFGHIJK";
		    length = 5;
		}else {
			length = 12;
		}

	    for(int i = 0; i < length; i++) {

	      int index = new Random().nextInt(alphabet.length());
	      char randomChar = alphabet.charAt(index);
	      sb.append(randomChar);
	    }
	    
        return sb.toString();
	}
	
	public String getRandomDifficulty() {
		String[] difficulties = {"E","M","H"};
		String diff = difficulties[new Random().nextInt(3)];
		return diff;
	}
	
	public String getRandomDescript(String type) {
	    
	    String alphabet = "ABCDEFGHIJZabcdefghijklmnopqrstuvwxyz";
	    StringBuilder sb = new StringBuilder();
	    int length;
	    if(type.equalsIgnoreCase("challenge")) {
	    	length = 120;
	    }else {
	    	length = 40;
	    }

	    for(int i = 0; i < length; i++) {

	      int index = new Random().nextInt(alphabet.length());
	      char randomChar = alphabet.charAt(index);
	      sb.append(randomChar);
	    }
	    
        return sb.toString();
	}
	
	public int getRandomPoints() {
		
		int randomPoints = new Random().nextInt(16);
		while(randomPoints == 0) {
			randomPoints = new Random().nextInt(16);
		}
		return randomPoints;
	}
	
	public int getRandomAwardPoints() {
		
		int randomPoints = new Random().nextInt(101);
		while(randomPoints < 15) {
			randomPoints = new Random().nextInt(101);
		}
		return randomPoints;
	}
	
    public int getRandomSolvedChallenges() {
		
		int randomPoints = new Random().nextInt(20);
		while(randomPoints == 0) {
			randomPoints = new Random().nextInt(20);
		}
		return randomPoints;
	}
	
	public void getNumberOfDatasets(String table) {
		
		try {
	    rs = dc.getStmt().executeQuery("SELECT COUNT(*) FROM " + table); 
		if (rs.next()) { 
	        int count = rs.getInt(1); 
		    System.out.println("Number of datasets of  " + table  +" :"+ count); 
		 }
	  } catch(Exception e)  {
		    	System.out.println(e.getMessage());
		    } 
	}
	
	public BufferedReader csvReader(String filename) {
		
		URL url = Inserter.class.getClassLoader().getResource(filename);
		Path pathToFile = Paths.get(url.getPath());
		
		BufferedReader reader = null;
		try{
			reader = Files.newBufferedReader(pathToFile, StandardCharsets.US_ASCII);
		}catch(Exception e) {
			System.out.print(e.getMessage());
		}
		
		return reader;
	}
	
	public void closeResultSet() {
		try {
			rs.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

}
