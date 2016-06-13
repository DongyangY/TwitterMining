This directory contains database files for database setup and data collecting. 

First, you need to have a mysql database, phpmyadmin(GUI database manager), the php environment and an apache server. You can simply install xampp - a integrated development environment. Or you could install and configure them separately. 

Second, change the configures. In the db_config.php, you should insert your database name and password. But this may influence other files on linking the database, thus it is recommended to use the same database name and password. Then, in the 140dev_config.php, use your own twitter api account (create it by using your own twitter account on the official website), please do not use our account.

Third, create a database called hma2014 in your phpmyadmin, and import the hma2014.sql in the database_structure to resume the tables. Next, you need to run the ‘php get_tweet.php’ or ‘php get_tweet_refined_keyowrds.php’ in your command line in this directory, you will find data collected in your jsoncache table. Then run the parse_tweet.php in the command line to parse the jsoncache into several base tables. If you want demography information, please add gender, age and type column in the users table.
