# Project Description
This project is an online cookbook built with PHP and mysql. It will be fully functional with search features, filters, and a page for browsing with no login required. It will also be able to be maintained by an admin user server-side, who will be able to add and delete recipies, after they log in with an admin username and a password. 
# How to Run Locally
Create your database and load cookbook_recipes.sql. Copy config.example.php, and fil in credentials. <br> 
Credentials are as follows: <br> <br>
Mac:
- $host = "localhost";
- $user = "root";
- $pass = "root";
- $db = "cookbook_recipes";
- $port = 8889;

Windows: 
- $host = "localhost";
- $user = "root";
- $pass = "";
- $db = "cookbook_recipes";
- $port = 3306;

If using Windows, make sure to leave the password blank. After that, put the project files inside your htdocs folder in either MAMP or XAMPP, start running MAMP or XAMPP, and start the server. For Windows users using XAMPP, enter localhost in your URL, and select the project from your directory. For Mac users running MAMP, type localhost:8888 into your URL, and select the project from the directory. 

## AI Use
Any and all AI Usage will be cited within the code in accordance with the course syllabus "AI Policy" section.
<br>
Tools used:
- ChatGPT used to reorganize CSS Stylesheet, and add responsiveness
- ChatGPT also used for questions regarding php, and debugging