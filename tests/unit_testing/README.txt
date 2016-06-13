lb_type_test

‘lb_type_test’ file use to test if the rank result is correct. To start, you should constructed the tweet_text_test table that including the same fields as the tweet_text table.  Then you should make up five fake users and their information and fill the tweet_text_test table. Next you should run the ‘lb_type_test.php’ to see if the lb_type_test table contains the correct ranking information.

Mood_Value test

“test mood.php”file is used to verify the function of evaluating mood value of a given tweet.
 To test this feature, a test table should be constructed by using” testcode.php” file including ten test tweets about exercising and its time. Then run the first file, the result will show the mood value of each given tweet as well as that of the average of all these ten tweets. Though the test the feature works as expected.

Exercise_time test

“test_Etime.php” file is used to verify the function of extracting exercising time of a given tweet. To test this feature a test table should be constructed by using “testcode.php” file including ten test tweets about exercising and tis time. Then run the first file the result will show the exercising time of each given tweet. Though the test the feature works as expected.

demography_test.php - This is the testing php script for demography.php. It takes the user name, user screen name and user description of 10 famous people on Twitter, whose gender and age are known to us, and print out the result of its guessing. For the gender guess, 8 out 10 are correct. For the age guess, only 5 of them are nearly correct.
