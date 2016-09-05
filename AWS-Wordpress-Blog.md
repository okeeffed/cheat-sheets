# AWS Hosting a WordPress Blog with Amazon Linux

__Prerequisites__

This tutorial assumes that you have launched an Amazon Linux instance with a functional web server with PHP and MySQL support by following all of the steps in Tutorial: [Installing a LAMP Web Server on Amazon Linux](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/install-LAMP.html).

This tutorial also has steps for configuring a security group to allow HTTP and HTTPS traffic, as well as several steps to ensure that file permissions are set properly for your web server.

For information about adding rules to your security group, see [Adding Rules to a Security Group](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/using-network-security.html#adding-security-group-rule).

## AWSWP-1: Install WordPress

This tutorial is a good introduction to using Amazon EC2 in that you have full control over a web server that hosts your WordPress blog, which is not typical with a traditional hosting service. Of course, that means that you are responsible for updating the software packages and maintaining security patches for your server as well. For a more automated WordPress installation that does not require direct interaction with the web server configuration, the AWS CloudFormation service provides a WordPress template that can also get you started quickly.

For more information, see Getting Started in the AWS CloudFormation User Guide.

## AWSWP-2: Download and unzip the WordPress installation package

1. Download the latest WordPress installation package with the wget command. The following command should always download the latest release.

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

2. Unzip and unarchive the installation package. The installation folder is unzipped to a folder called `wordpress`.

```
[ec2-user ~]$ tar -xzf latest.tar.gz
[ec2-user ~]$ ls
latest.tar.gz  wordpress
```

## AWS-3: Create a MySQL user and database for your WordPress installation

Your WordPress installation needs to store information, such as blog post entries and user comments, in a database. This procedure helps you create a database for your blog and a user that is authorized to read and save information to that database.

1. Start the MySQL server.

```
[ec2-user ~]$ sudo service mysqld start
```

2. Log in to the MySQL server as the root user. Enter your MySQL root password when prompted; this may be different than your root system password, or it may even be empty if you have not secured your MySQL server.

```
[ec2-user ~]$ mysql -u root -p
Enter password:
```

***

__! Important__

If you have no secured your MySQL server yet, it is very important that you do so.

Check [To secure the MySQL server](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/install-LAMP.html#SecuringMySQLProcedure)

***

3. Create a user and password for your MySQL database. Your WordPress installation uses these values to communicate with your MySQL database. Enter the following command, substituting a unique user name and password.

```
mysql> CREATE USER 'wordpress-user'@'localhost' IDENTIFIED BY 'your_strong_password';
Query OK, 0 rows affected (0.00 sec)
```

// You are up to number 4 
