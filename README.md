# RNK-Redesign

## Setup ##
For security reasons, I took out the *config.php* file from the *app* directory.
To get the site to connect to a MySQL Database make your own *config.php* and add these for lines:

define("DBHOST", "localhost");  
define("DBUSER", "root");  
define("DBPASS", "password");  
define("DBNAME", "database");  
