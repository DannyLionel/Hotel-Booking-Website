In order to install the website, place all the files in the folder hotel_booking into your web server.
Import the project.sql into mysql and change the database connection information inside of config.php





Navigate to /clearall.php to clear all the bookings in the database.

Navigate to /generate.php to generate a XML file of the hotel information stored in the database. This file is saved in the same directory where the generate.php is. This option is avalaible if the information needs to be shared with anyone outside.

This generated XML file can also be viewed in the browser if the user prefers. Navigate to /xmlview.php

The views created for Phase 2 can be seen by opening /views.php
