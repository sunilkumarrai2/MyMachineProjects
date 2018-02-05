init_pwd.txt file is to reset the password for root useer like below.

mysqld --init-file=/Users/r630166/Downloads/Learn/mySQL_setup/init_pwd.txt &


 init.sql is for creating a new user 'test_user' with password 'testuser' and grant access to DB 'test'

**********************************************************
  To connect to mysql from command line as a user
**********************************************************
  mysql -u budget_app_user -p



**********************************************************
  To check where mysql.sock is
**********************************************************
  - mysqladmin variables | grep sock
  - netstat -ln | grep mysql
  - netstat -ln | grep -o -m 1 -E '\S*mysqld?\.sock'



