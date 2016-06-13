This directory contains analysis files. Please run each php file in the command line or on the browser to fill each feature table in the database. If you find error to analyze the data, you need to check the relative directory or database configures in each php file.

Some explanations:

Exercise Time calculate

‘Etime_type_mean.php’ file can obtain the mean, max and std of time of certain exercise type involving run, cycling, swim, basketball, volleyer, tennis and football within the function. 

Before run the file ‘Etime_type_mean.php’ , ‘Etime_type.php’ file should be executed which will obtain exercise time for each tweets publishing contents about the required time information. 

(The table Etime_type should be constructed that including two names “exercise_type” and “exercise_time” which types are “varchar(20) and int(10). )

And then the file ‘Etime_type_mean.php’ can be operated the exact mean, max and std of time. 

(The table Etime_type_mean should be constructed that including four names “exercise_type, mean, max and std” which types are varchar(20), int(10), int(10) and int(10).)


Exercise Mood

‘Mood type time.php’ file can obtain mood rates of certain exercise in a given time within one day. Direct open the file will get the result. 

(The table Mood type time should be constructed that including three names “type, time and mood_value” which types are varchar(20), varchar(20) and float. )


EI_area_time

‘EI_area_time.php’ file can obtain the numbers of exercising person in distinct areas for each hours. Direct open the file will get the result. 

(The table EI_area_time should be constructed that including three name “time_node, state_name and state_count’ which types are varchar(20), varchar(20) and int(10).)

lb_type
‘lb_type.php’ file can rank who exercise the most in certain fields involving run, cycling, swim, basketball, volleyer, tennis and football within the function. 
(The table lb_type should be constructed that including four names “exercise_type, screen_name, tweet_num, profile_image_url”. )

demography.php - The “users” table in our database contains no information about their age and gender. Thus, we make use of the API form “textalytics.com” in this php script. It takes the values in  “screen_name”, “name”, “description” columns of the “users” table and uses the algorithm to make a guess on the user’s gender, age and the user type and then update these information into three new columns of the table, respectively named “gender”, “age”, “type”.
