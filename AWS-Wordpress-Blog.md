# AWS Hosting a WordPress Blog with Amazon Linux

<!-- TOC -->

*   [AWS Hosting a WordPress Blog with Amazon Linux](#aws-hosting-a-wordpress-blog-with-amazon-linux)
    *   [AWSWP-1: Install WordPress](#awswp-1-install-wordpress)
    *   [AWSWP-2: Download and unzip the WordPress installation package](#awswp-2-download-and-unzip-the-wordpress-installation-package)
    *   [AWS-3: Create a MySQL user and database for your WordPress installation](#aws-3-create-a-mysql-user-and-database-for-your-wordpress-installation)
    *   [AWS-4: To create and edit the wp-config.php file](#aws-4-to-create-and-edit-the-wp-configphp-file)
    *   [AWS-5: To move your WordPress installation to the Apache document root](#aws-5-to-move-your-wordpress-installation-to-the-apache-document-root)
    *   [AWS-6: To allow WordPress to use permalinks](#aws-6-to-allow-wordpress-to-use-permalinks)
    *   [AWS-7: To fix file persmissions for the Apache web server](#aws-7-to-fix-file-persmissions-for-the-apache-web-server)

<!-- /TOC -->

**Prerequisites**

Ensure that the system you are running has the correct set up in terms of apache2, nginx, mySQL etc.

This tutorial assumes that you have launched an Amazon Linux instance with a functional web server with PHP and MySQL support by following all of the steps in Tutorial: [Installing a LAMP Web Server on Amazon Linux](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/install-LAMP.html).

This tutorial also has steps for configuring a security group to allow HTTP and HTTPS traffic, as well as several steps to ensure that file permissions are set properly for your web server.

For information about adding rules to your security group, see [Adding Rules to a Security Group](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/using-network-security.html#adding-security-group-rule).

## AWSWP-1: Install WordPress

This tutorial is a good introduction to using Amazon EC2 in that you have full control over a web server that hosts your WordPress blog, which is not typical with a traditional hosting service. Of course, that means that you are responsible for updating the software packages and maintaining security patches for your server as well. For a more automated WordPress installation that does not require direct interaction with the web server configuration, the AWS CloudFormation service provides a WordPress template that can also get you started quickly.

For more information, see Getting Started in the AWS CloudFormation User Guide.

## AWSWP-2: Download and unzip the WordPress installation package

1.  Download the latest WordPress installation package with the wget command. The following command should always download the latest release.

```
[ec2-user ~]$ wget https://wordpress.org/latest.tar.gz
--2013-08-09 17:19:01--  https://wordpress.org/latest.tar.gz
Resolving wordpress.org (wordpress.org)... 66.155.40.249, 66.155.40.250
Connecting to wordpress.org (wordpress.org)|66.155.40.249|:443... connected.
HTTP request sent, awaiting response... 200 OK
Length: 4028740 (3.8M) [application/x-gzip]
Saving to: latest.tar.gz

100%[======================================>] 4,028,740   20.1MB/s   in 0.2s

2013-08-09 17:19:02 (20.1 MB/s) - latest.tar.gz saved [4028740/4028740]
```

2.  Unzip and unarchive the installation package. The installation folder is unzipped to a folder called `wordpress`.

```
[ec2-user ~]$ tar -xzf latest.tar.gz
[ec2-user ~]$ ls
latest.tar.gz  wordpress
```

## AWS-3: Create a MySQL user and database for your WordPress installation

Your WordPress installation needs to store information, such as blog post entries and user comments, in a database. This procedure helps you create a database for your blog and a user that is authorized to read and save information to that database.

1.  Start the MySQL server.

```
[ec2-user ~]$ sudo service mysqld start
```

2.  Log in to the MySQL server as the root user. Enter your MySQL root password when prompted; this may be different than your root system password, or it may even be empty if you have not secured your MySQL server.

```
[ec2-user ~]$ mysql -u root -p
Enter password:
```

---

**! Important**

If you have no secured your MySQL server yet, it is very important that you do so.

Check [To secure the MySQL server](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/install-LAMP.html#SecuringMySQLProcedure)

---

3.  Create a user and password for your MySQL database. Your WordPress installation uses these values to communicate with your MySQL database. Enter the following command, substituting a unique user name and password.

```
mysql> CREATE USER 'wordpress-user'@'localhost' IDENTIFIED BY 'your_strong_password';
Query OK, 0 rows affected (0.00 sec)
```

4.  Create your database. Give your database a descriptive, meaningful name, such as wordpress-db.

**Note**

The punctuation marks surrounding the database name in the command below are called backticks. The backtick (`) key is usually located above the Tab key on a standard keyboard. Backticks are not always required, but they allow you to use otherwise illegal characters, such as hyphens, in database names.

```
mysql> CREATE DATABASE 'wordpress-db';
Query OK, 1 row affected (0.01sec)
```

5.  Grant full privileges for your database to the WordPress user that you created earlier.

```
mysql> GRANT ALL PRIVILEGES ON `wordpress-db`.* TO "wordpress-user"@"localhost";
Query OK, 0 rows affected (0.00 sec)
```

6.  Flush the MySQL privileges to pick up all of your changes.

```
mysql> FLUSH PRIVILEGES;
Query OK, 0 rows affected (0.01 sec)
```

7.  Exit the mysql client.

```
mysql> exit
Bye
```

## AWS-4: To create and edit the wp-config.php file

The WordPress installation folder contains a sample configuration file called `wp-config-sample.php`. In this procedure, you copy this file and edit it to fit your specific configuration.

1.  Copy the wp-config-sample.php file to a file called wp-config.php. This creates a new configuration file and keeps the original sample file intact as a backup.

```
[ec2-user ~]$ cd wordpress/
[ec2-user wordpress]$ cp wp-config-sample.php wp-config.php
```

2.  Edit the wp-config.php file with your favorite text editor (such as nano or vim) and enter values for your installation. If you do not have a favorite text editor, nano is much easier for beginners to use.

```
[ec2-user wordpress]$ nano wp-config.php
```

    a. Find the line that defines DB_NAME and change database_name_here to the database name that you created in Step 4 of To create a MySQL user and database for your WordPress installation.

```
define('DB_NAME', 'wordpress-db');
```

    b. Find the line that defines DB_USER and change username_here to the database user that you created in Step 3 of To create a MySQL user and database for your WordPress installation.

```
define('DB_USER', 'wordpress-user');
```

    c. Find the line that defines DB_PASSWORD and change password_here to the strong password that you created in Step 3 of To create a MySQL user and database for your WordPress installation.

```
define('DB_PASSWORD', 'your_strong_password');
```

    d. Find the section called Authentication Unique Keys and Salts. These KEY and SALT values provide a layer of encryption to the browser cookies that WordPress users store on their local machines. Basically, adding long, random values here makes your site more secure. Visit https://api.wordpress.org/secret-key/1.1/salt/ to randomly generate a set of key values that you can copy and paste into your wp-config.php file. To paste text into a PuTTY terminal, place the cursor where you want to paste the text and right-click your mouse inside the PuTTY terminal.

For more information about security keys, go to [here](http://codex.wordpress.org/Editing_wp-config.php#Security_Keys).

**Note**

The values below are for example purposes only; do not use these values for your installation.

```
define('AUTH_KEY',         ' #U$$+[RXN8:b^-L 0(WU_+ c+WFkI~c]o]-bHw+)/Aj[wTwSiZ<Qb[mghEXcRh-');
define('SECURE_AUTH_KEY',  'Zsz._P=l/|y.Lq)XjlkwS1y5NJ76E6EJ.AV0pCKZZB,*~*r ?6OP$eJT@;+(ndLg');
define('LOGGED_IN_KEY',    'ju}qwre3V*+8f_zOWf?{LlGsQ]Ye@2Jh^,8x>)Y |;(^[Iw]Pi+LG#A4R?7N`YB3');
define('NONCE_KEY',        'P(g62HeZxEes|LnI^i=H,[XwK9I&[2s|:?0N}VJM%?;v2v]v+;+^9eXUahg@::Cj');
define('AUTH_SALT',        'C$DpB4Hj[JK:?{ql`sRVa:{:7yShy(9A@5wg+`JJVb1fk%_-Bx*M4(qc[Qg%JT!h');
define('SECURE_AUTH_SALT', 'd!uRu#}+q#{f$Z?Z9uFPG.${+S{n~1M&%@~gL>U>NV<zpD-@2-Es7Q1O-bp28EKv');
define('LOGGED_IN_SALT',   ';j{00P*owZf)kVD+FVLn-~ >.|Y%Ug4#I^*LVd9QeZ^&XmK|e(76miC+&W&+^0P/');
define('NONCE_SALT',       '-97r*V/cgxLmp?Zy4zUU4r99QQ_rGs2LTd%P;|_e1tS)8_B/,.6[=UK<J_y9?JWG');
```

    e. Save the file and exit your text editor.

---

## AWS-5: To move your WordPress installation to the Apache document root

Now that you've unzipped the installation folder, created a MySQL database and user, and customized the WordPress configuration file, you are ready to move your installation files to your web server document root so you can run the installation script that completes your installation. The location of these files depends on whether you want your WordPress blog to be available at the root of your web server (for example, `my.public.dns.amazonaws.com`) or in a subdirectory or folder (for example, `my.public.dns.amazonaws.com/blog`).

Choose the location where you want your blog to be available and only run the `mv` associated with that location.

**! Important**

If you run both sets of commands below, you will get an error message on the second `mv` command because the files you are trying to move are no longer there.

To make your blog available at `my.public.dns.amazonaws.com`, move the files in the `wordpress` folder (but not the folder itself) to the Apache document root (`/var/www/html` on Amazon Linux instances).

```
[ec2-user wordpress]$ mv * /var/www/html/
```

OR, to make your blog available at `my.public.dns.amazonaws.com/blog` instead, create a new folder called blog inside the Apache document root and move the files in the wordpress folder (but not the folder itself) to the new blog folder.

```
[ec2-user wordpress]$ mkdir /var/www/html/blog
[ec2-user wordpress]$ mv * /var/www/html/blog
```

**! Important**

For security purposes, if you are not moving on to the next procedure immediately, stop the Apache web server (httpd) now. After you move your installation to the Apache document root, the WordPress installation script is unprotected and an attacker could gain access to your blog if the Apache web server were running. To stop the Apache web server, enter the command `sudo service httpd stop`. If you are moving on to the next procedure, you do not need to stop the Apache web server.

---

## AWS-6: To allow WordPress to use permalinks

WordPress permalinks need to use Apache `.htaccess` files to work properly, but this is not enabled by default on Amazon Linux. Use this procedure to allow all overrides in the Apache document root.

1.  Open the httpd.conf file with your favorite text editor (such as nano or vim). If you do not have a favorite text editor, nano is much easier for beginners to use.

```
[ec2-user wordpress]$ sudo vim /etc/httpd/conf/httpd.conf
```

2.  Find the section that starts with `<Directory "/var/www/html">`.

```
<Directory "/var/www/html">
    #
    # Possible values for the Options directive are "None", "All",
    # or any combination of:
    #   Indexes Includes FollowSymLinks SymLinksifOwnerMatch ExecCGI MultiViews
    #
    # Note that "MultiViews" must be named *explicitly* --- "Options All"
    # doesn't give it to you.
    #
    # The Options directive is both complicated and important.  Please see
    # http://httpd.apache.org/docs/2.4/mod/core.html#options
    # for more information.
    #
    Options Indexes FollowSymLinks

    #
    # AllowOverride controls what directives may be placed in .htaccess files.
    # It can be "All", "None", or any combination of the keywords:
    #   Options FileInfo AuthConfig Limit
    #
    AllowOverride None

    #
    # Controls who can get stuff from this server.
    #
    Require all granted
</Directory>
```

3.  Change the AllowOverride None line in the above section to read AllowOverride All.

**Note**

There are multiple AllowOverride lines in this file; be sure you change the line in the <Directory "/var/www/html"> section.

```
AllowOverride All
```

4.  Save the file and exit your text editor.

## AWS-7: To fix file persmissions for the Apache web server
