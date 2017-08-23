# MySQL Development using Docker

Firstly, pull `docker pull mysql/mysql-server`.

Then `docker run --name sql-test -e MYSQL_ROOT_PASSWORD=password -p 6000:3306 -d mysql/mysql-server:latest`. If there a replacement or commited image, run that instead.

If you are running it on a network, first create the network `docker network create dev-env`.

## Updating the local Docker MySQL instance

Log into the container and first log into `mysql` using `mysql -u root -p`. This will prompt you for that password we created, so now type that in and enter the command line terminal. Run `GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;`.
