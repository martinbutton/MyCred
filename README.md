# MyCred
---

MyCred is a demo authentication program using Core PHP5 with PDO database drivers to access a MySQL database server.  The program is purely backend driven and no JavaScript is required.

# Requirements
- PHP 5.5 or above
- MySQL Server
- Apache Web Server

# Installation
To deploy MyCred, please first ensure MySQL, Apache and PHP5.5 or above is installed and working.  Then please use the following file and follow the steps below:

/MyCred/deploy/makedb.sql

1. Logged in as root to your SQL server, please run the commands under the following section:

```
/* Create Database and required accounts table */
create database MyCred;
use MyCred;
create table accounts(email varchar(255) primary key,
	password varchar(255),
	name varchar(255));
```

2. You should also create an applicaion user that MyCred can use to access your database.  The default username is "MyCredApp".  Please see the following commented section of the makedb.sql file:

```
/* Uncomment below if user account also needs creating */

/*
create user 'MyCredApp'@'localhost' identified by 'password';

grant select,insert,update,delete
	on MyCred.*
	to 'MyCredApp'@'localhost';
*/
```

Note: You should change the use password to a more secure password.  The example above just uses a password of "password".

3. Next configure MyCred to access your database by editing the following line near to the top of your "MyCred.php" file:
 
```
// CHANGE AS REQUIRED: DB Connection and Credentials
$dbConnect=array("host"=>"localhost","database"=>"MyCred","user"=>"MyCredApp","password"=>"password");
```
4. Change the 'host', 'user' and 'password' so that it matches the credentials configured above on the MySQL server.

5. The deploy directory can now be move outside of the MyCred directory as it is only used for deployment.

6. Copy the MyCred directory and all it's contents into a location on your webserver.

7. Navigate using a web browser to the chosen location of the MyCred directory on your webserver. ie. The example below would be the URL if the MyCred directory was placed in your webservers root:
http://host.domain.com/MyCred

Success: You should now see the login page and MyCred is now ready to accept user access!

---
**Free to use. Developed by Martin Button.**
