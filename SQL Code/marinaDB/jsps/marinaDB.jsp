<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Table Creation</title>
</head>
<body>
<%
    // Database connection parameters
    String dbName = "jdbc:mysql://localhost:3306/marina";
    String dbUser = "student1";
    String dbPass = "pass";
    try {
        // Load MySQL JDBC driver
        Class.forName("com.mysql.cj.jdbc.Driver");
        // Establish a connection
        try (Connection conn = DriverManager.getConnection(dbName, dbUser, dbPass); 
             Statement stmt = conn.createStatement()) {
            
            out.println("<h2>Connection Established</h2>");
            
            // Drop all tables if they exist
            String[] tables = {"waitlist", "roles", "payments", "reservations", "paymentmethod", "slips", "users"};
            for (String table : tables) {
                stmt.executeUpdate("DROP TABLE IF EXISTS " + table);
            }
            out.println("<p>All tables have been deleted...</p>");
            
            // Users table
            stmt.executeUpdate("CREATE TABLE users (" +
                "userid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                "firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) NOT NULL, " +
                "username VARCHAR(50) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL, " +
                "email VARCHAR(50) UNIQUE NOT NULL, address VARCHAR(100), city VARCHAR(50), " +
                "state VARCHAR(25), zipcode VARCHAR(10), phonenumber VARCHAR(15), " +
                "regdate DATE NOT NULL, role INT NOT NULL)");
            out.println("<p>The Users table has been created.</p>");

            // PaymentMethod table
            stmt.executeUpdate("CREATE TABLE paymentmethod (" +
                "methodid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                "methodname VARCHAR(10) NOT NULL)");
            out.println("<p>The PaymentMethod table has been created.</p>");

            // Slips table
            stmt.executeUpdate("CREATE TABLE slips (" +
                "slipid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                "slipnumber INT UNIQUE NOT NULL, slipsize INT NOT NULL, " +
                "sliplocation VARCHAR(20) NOT NULL, availability BOOL NOT NULL)");
            out.println("<p>The Slips table has been created.</p>");

            // Waitlist table
            stmt.executeUpdate("CREATE TABLE waitlist (" +
                "waitlistid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                "userid INT, slipid INT, " +
                "FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE ON UPDATE CASCADE, " +
                "FOREIGN KEY (slipid) REFERENCES slips(slipid) ON DELETE SET NULL ON UPDATE CASCADE)");
            out.println("<p>The Waitlist table has been created.</p>");

            // Roles table
            stmt.executeUpdate("CREATE TABLE roles (" +
                "roleid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                "rolename VARCHAR(25), editreservation BOOL, createreservation BOOL, " +
                "createadmin BOOL, modifyslips BOOL)");
            out.println("<p>The Roles table has been created.</p>");

            // Reservations table
            stmt.executeUpdate("CREATE TABLE reservations (" +
                "reservationid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                "userid INT, slipid INT, " +
                "FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE ON UPDATE CASCADE, " +
                "FOREIGN KEY (slipid) REFERENCES slips(slipid) ON DELETE SET NULL ON UPDATE CASCADE, " +
                "reservationdate DATE NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, " +
                "paystatus VARCHAR(9) NOT NULL)");
            out.println("<p>The Reservations table has been created.</p>");

            // Payments table
            stmt.executeUpdate("CREATE TABLE payments (" +
                "paymentid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                "reservationid INT, " +
                "FOREIGN KEY (reservationid) REFERENCES reservations(reservationid) ON DELETE CASCADE ON UPDATE CASCADE, " +
                "paymentdate DATE NOT NULL, total DECIMAL(12,2) NOT NULL CHECK (total >= 0), " +
                "paymentmethod INT NOT NULL)");
            out.println("<p>The Payments table has been created.</p>");

        } // end of try-with-resources
        out.println("<h2>Connection Closed</h2>");

    } catch (ClassNotFoundException e) {
        out.println("<p>Database driver not found.</p>");
        e.printStackTrace();
    } catch (SQLException e) {
        out.println("<p>SQL Error: " + e.getMessage() + "</p>");
        e.printStackTrace();
    }
%>
</body>
</html>