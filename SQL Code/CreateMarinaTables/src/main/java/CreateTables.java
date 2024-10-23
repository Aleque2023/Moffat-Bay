import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;

public class CreateTables {
    private Connection conn;
    private Statement stmt;

    public void initializeTables() {
        try {
            // Connect to the database
            Class.forName("com.mysql.cj.jdbc.Driver");
            String dbName = "jdbc:mysql://localhost:3306/marina";
            String dbUser = "student1";
            String dbPass = "pass";
            conn = DriverManager.getConnection(dbName, dbUser, dbPass);
            stmt = conn.createStatement();
            System.out.println("Connection Established");

            // Drop all tables if they exist
            String[] dropStatements = {
                "DROP TABLE IF EXISTS waitlist",
                "DROP TABLE IF EXISTS payments",
                "DROP TABLE IF EXISTS reservations",
                "DROP TABLE IF EXISTS paymentmethod",
                "DROP TABLE IF EXISTS slips",
                "DROP TABLE IF EXISTS users",
                "DROP TABLE IF EXISTS roles"
            };

            for (String dropStatement : dropStatements) {
                stmt.executeUpdate(dropStatement);
            }
            System.out.println("All tables have been deleted...");

            // Create Roles table
            stmt.executeUpdate("CREATE TABLE roles(" +
                    "roleid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                    "rolename VARCHAR(25), editreservation BOOL, createreservation BOOL, " +
                    "createadmin BOOL, modifyslips BOOL, modifywaitlist BOOL)");
            System.out.println("The Roles table has been created.");

            // Create Users table
            stmt.executeUpdate("CREATE TABLE users(" +
                    "userid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                    "firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) NOT NULL, " +
                    "username VARCHAR(50) UNIQUE NOT NULL, password VARCHAR(25) NOT NULL, " +
                    "email VARCHAR(50) UNIQUE NOT NULL, address VARCHAR(50), city VARCHAR(50), " +
                    "state VARCHAR(25), zipcode INT, phonenumber BIGINT, regdate DATE NOT NULL, " +
                    "role INT NOT NULL, FOREIGN KEY (role) REFERENCES roles(roleid))");
            System.out.println("The Users table has been created.");

            // Create PaymentMethod table
            stmt.executeUpdate("CREATE TABLE paymentmethod(" +
                    "methodid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                    "methodname VARCHAR(10) NOT NULL)");
            System.out.println("The PaymentMethod table has been created.");

            // Create Slips table
            stmt.executeUpdate("CREATE TABLE slips(" +
                    "slipid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                    "slipnumber INT UNIQUE NOT NULL, slipsize INT NOT NULL, " +
                    "sliplocation VARCHAR(20) NOT NULL, availability BOOL NOT NULL)");
            System.out.println("The Slips table has been created.");

            // Create Waitlist table
            stmt.executeUpdate("CREATE TABLE waitlist(" +
                    "waitlistid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                    "userid INT, slipid INT, startdate DATE, enddate DATE, " +
                    "FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE ON UPDATE CASCADE, " +
                    "FOREIGN KEY (slipid) REFERENCES slips(slipid) ON DELETE SET NULL ON UPDATE CASCADE)");
            System.out.println("The Waitlist table has been created.");

            // Create Reservations table
            stmt.executeUpdate("CREATE TABLE reservations(" +
                    "reservationid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                    "userid INT, slipid INT, reservationdate DATE NOT NULL, " +
                    "startdate DATE NOT NULL, enddate DATE NOT NULL, paystatus VARCHAR(9) NOT NULL, " +
                    "FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE ON UPDATE CASCADE, " +
                    "FOREIGN KEY (slipid) REFERENCES slips(slipid) ON DELETE SET NULL ON UPDATE CASCADE)");
            System.out.println("The Reservations table has been created.");

            // Create Payments table
            stmt.executeUpdate("CREATE TABLE payments(" +
                    "paymentid INT PRIMARY KEY AUTO_INCREMENT NOT NULL, " +
                    "reservationid INT, paymentdate DATE NOT NULL, " +
                    "total DECIMAL(12,2) NOT NULL CHECK (total >= 0), " +
                    "paymentmethod INT NOT NULL, " +
                    "FOREIGN KEY (reservationid) REFERENCES reservations(reservationid) ON DELETE CASCADE ON UPDATE CASCADE, " +
                    "FOREIGN KEY (paymentmethod) REFERENCES paymentmethod(methodid))");
            System.out.println("The Payments table has been created.");

        } catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
            System.out.println("An error occurred while setting up the database tables.");
        } finally {
            // Close resources
            try {
                if (stmt != null) stmt.close();
                if (conn != null) conn.close();
                System.out.println("Connection Closed");
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public static void main(String[] args) {
        CreateTables createTables = new CreateTables();
        createTables.initializeTables();
    }
}

