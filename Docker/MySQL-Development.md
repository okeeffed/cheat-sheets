# MySQL Development using Docker

Firstly, pull `docker pull mysql/mysql-server`.

## Updating the local Docker MySQL instance

Log into the container and first log into `mysql` using `mysql -u root -p`. This will prompt you for that password we created, so now type that in and enter the command line terminal. Run `GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;`.
