{\rtf1\ansi\ansicpg936\cocoartf1343\cocoasubrtf140
{\fonttbl\f0\fnil\fcharset0 Menlo-Regular;}
{\colortbl;\red255\green255\blue255;\red170\green13\blue145;\red28\green0\blue207;\red196\green26\blue22;
}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\deftab529
\pard\tx529\pardeftab529\pardirnatural

\f0\fs22 \cf2 \CocoaLigature0 <?php\cf0 \
\
\cf2 include_once\cf0 (\cf3 '../../database/db_config.php'\cf0 );\
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name);\
\
\
$table=\cf4 "CREATE TABLE if not exists lb_type_test(\
\cf0         exercise_type varchar(\cf3 20\cf0 ),                \
        screen_name  char(\cf3 20\cf0 ),\
\cf4         profile_image_url\cf0  varchar(\cf3 500\cf0 ),\
         tweet_num \cf2 int\cf0 (\cf3 40\cf0 )\
        ) \cf4 ";\
\cf0 \
\
mysqli_query($con, \cf4 "delete from lb_type_test\'93\cf0 );\
\
$exercise_type = \cf2 array\cf0 (\cf4 "running"\cf0 , \cf4 "cycling"\cf0 , \cf4 "swimming"\cf0 , \cf4 "basketball"\cf0 , \cf4 "volleyball"\cf0 , \cf4 "tennis"\cf0 , \cf4 "football"\cf0 );\
\
\cf2 for\cf0 ($i=\cf3 0\cf0 ; $i<count($exercise_type); $i++)\{\
    \
    $sql = \cf4 "SELECT COUNT(*) as num, screen_name, profile_image_url FROM tweets WHERE tweet_text LIKE '%"\cf2 .\cf0 $exercise_type[$i]\cf2 .\cf4 "%' GROUP BY screen_name ORDER BY num DESC LIMIT 15"\cf0 ;\
\
    $result= mysqli_query($con,$sql);\
\
    \cf2 echo\cf0  \cf4 "<br>"\cf2 .\cf0 $exercise_type[$i]\cf2 .\cf4 "<br>"\cf0 ;\
    \
    $m = \cf3 0\cf0 ;\
    \
    \cf2 while\cf0 ($array = mysqli_fetch_array($result))\{\
        $num = $array[\cf3 0\cf0 ];\
        $name =$array[\cf3 1\cf0 ];\
        $url = $array[\cf3 2\cf0 ];\
\
        \cf2 echo\cf0  $name\cf2 .\cf4 "   "\cf2 .\cf0 $num\cf2 .\cf4 "<br>"\cf0 ;\
\
        mysqli_query($con,\cf4 "INSERT INTO lb_type (exercise_type, screen_name, tweet_num, profile_image_url) VALUES ('"\cf2 .\cf0 $exercise_type[$i]\cf2 .\cf4 "','"\cf2 .\cf0 $name\cf2 .\cf4 "',"\cf2 .\cf0 $num\cf2 .\cf4 ",'"\cf2 .\cf0 $url\cf2 .\cf4 "')"\cf0 );\
        \
        $m++;\
\
    \}\
    \cf2 if\cf0 ($m < \cf3 15\cf0 )\{\
        \cf2 for\cf0 ($n=\cf3 0\cf0 ;$n<(\cf3 15\cf0 -$m);$n++) mysqli_query($con,\cf4 "INSERT INTO lb_type (exercise_type, screen_name, tweet_num, profile_image_url) VALUES ('"\cf2 .\cf0 $exercise_type[$i]\cf2 .\cf4 "','no data',0,'no data')"\cf0 );\
    \}\
    \
\}\
\
@mysqli_close($result);\
@mysqli_close($con);\
\
\cf2 ?>}