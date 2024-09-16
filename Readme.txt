phpmyadmin Commands

create database next_book_store;
CREATE TABLE tmp_user (Name char(50),Email char(50),Password char(15),Pass_Key int,Expiary_Time time)
CREATE TABLE user_details(ID int auto_increment key,Email char(50),Name char(50),Password char(15))
CREATE TABLE admin_details (ID int auto_increment key,Name char(50),Email char(50),Password char(15))

CREATE TABLE upload_record (ID int auto_increment key,Email char(50),Book_Name char(30),Author char(30),Subject char(30),Price int,Description text(500),PDF_Name text(300),Image_Name text(300),
downloads int default 0,views int default 0,Upload_Date_Time datetime default NOW(),Priority_Points int default 0)

php.ini
session.auto_start=1
upload_max_filesize=50M

SMTP=smtp.gmail.com
sendmail_from = sandipanroy177@gmail.com
sendmail_path ="\"C:\xampp\sendmail\sendmail.exe\" -t"
smtp_port=587
extension=php_openssl.dll(Remove Semicolon From Begning)


sendmail.ini
smtp_port=587
auth_username=sandipanroy177@gmail.com
auth_password=


enable less secure app access in google account

create database next_book_store in phpmyadmin and import database next_book_store.sql, uncheck auto_increment for non zero element