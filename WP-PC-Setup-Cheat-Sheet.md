########

! CHECK THE READ ME BEFORE ANYTHING ELSE

### 1. Install Bower

bower install

### 2. Install Node Dependencies

npm install

### 3. Install Composer Dependencies

composer install	// if others needed, check and manually move into folder in wp-content

### 4. Copy Across WordPress Files

Locate the folder in finder, copy the files and paste them at the root of the project

### 5. Set MAMP to the correct folder

Create the Database in Sequel Pro

### 6. Create Database

Create the Database in Sequel Pro

### 7. Open the Localhost and begin the WP set up

! Ensure that the database is created in Sequel Pro

Set the database field to the database name
Set username and password to what is set for MAMP
Run the Install

### 8. Open the Localhost and begin the WP set up

### 9. Ensure that any other files/plugins required in the correct folder (in reference to 3)

### 10. gulp watch - ensure that the gulpfile.js is all sweet!

### 11. Ensure the correct plugins are active

### 12. Active the appropriate theme




// *************

OTHER FILES

/+++++++++++++++++/

acf-json files

- used to create the custom fields in WP admin!

/+++++++++++++++++/

CPT-UI (custom post types)

CPT UI controls the post types themselves.
Can be used to import the data.
- this will create the acf-json files


// *************

TROUBLESHOOTING

/+++++++++++++++++/

!ISSUE - check the correct plugins are installed.

Steps:

Check the wp_options under the Content tab
Alter the template and stylesheet to work with an earlier version

/+++++++++++++++++/

!ISSUE - admin password/database not showing

Steps:

Ensure the database has been set up
Ensure gulp watch has compiled the file
Ensure that the wp_config file is correctly set up for the wordpress admin stuff
