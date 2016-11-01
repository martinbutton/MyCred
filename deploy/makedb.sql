/* MyCred Database Configuration.
 * Example File: Please edit to suite your requirements.
 * Please see "README.md" for further information and installation instructions
 */

/* Create Database and required accounts table */
create database MyCred;
use MyCred;
create table accounts(email varchar(255) primary key,
	password varchar(255),
	name varchar(255));

/* Uncomment below if user account also needs creating */

/*
create user 'MyCredApp'@'localhost' identified by 'password';

grant select,insert,update,delete
	on MyCred.*
	to 'MyCredApp'@'localhost';

alter user 'MyCredApp'@'localhost' password expire never;
*/
