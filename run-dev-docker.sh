docker network create prestashop-net
docker stop presta-mysql
docker rm presta-mysql
docker stop prestashop
docker rm prestashop
docker run --name presta-mysql --network=prestashop-net -e MYSQL_DATABASE=prestashop -e MYSQL_ROOT_PASSWORD=admin -e MYSQL_USER=prestashop -e MYSQL_PASSWORD=prestashop -d mysql
# docker run --name presta-mysql --network=prestashop-net -e MYSQL_DATABASE=prestashop -e MYSQL_ROOT_PASSWORD=admin -e MYSQL_USER=prestashop -e MYSQL_PASSWORD=prestashop -v $PWD/mysql-data:/var/lib/mysql -d mysql

docker run -ti --name prestashop --network prestashop-net -v $PWD/prestashop:/var/www/html  -v $PWD/ps_sovendus:/var/www/html/modules/ps_sovendus -e DB_SERVER=presta-mysql -p 8080:80 -d prestashop/prestashop:latest