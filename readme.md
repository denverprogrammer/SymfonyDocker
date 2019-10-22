
## **Description:** ##
Simple implementation of Symony 4 running in Docker. 

## **Linux Requirements:** ##
* [docker ce](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
* [docker-compose](https://docs.docker.com/compose/install/)

## **How to run:** ##

```bash
# Builds all of the dev containers and starts the server.  
# In your browser go to http://localhost to view webpage.
make build-dev;

# Brings down all containers.
make destroy;

# Builds all of the test containers and starts the server.    
# In your browser go to http://localhost to view webpage.
make build-test;

# Runs functional tests.  Successfull tests show up as green, 
# errors are red and warnings are blue. This command requires 
# make build-test to be run first.  After building please wait 
# for a few seconds because composer may still be downloading
# dependencies may still be building.  Run make test again if command fails.
make test;
```

## **Environment Variables:** ##

## **Docker Containers:** ##
Container   | Folder                 | Description
------------|------------------------|-----------------------------------------------------------------------
webserver   | [docker/webserver](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/webserver) | Nginx webserver.
database    | [docker/database](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/database) | MySql 8 database webserver.
application | [docker/application](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/database) | Php 7.2 backend application language.
adminer     | [docker/adminer](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/adminer) | Web based database administrator. \*

* All containers in this project use alpine (Simplified Linux) to make the image size as small as possible.*
* \*This container is only available locally.

## **Major Composer Packages:** ##
Name         | Package                 | Description
-------------|-------------------------|-----------------------------------------------------------------------
api platform | [api-platform/core](https://api-platform.com/docs/core/) | Framework to simplify rest requests.
behat        | [behat/behat](http://behat.org/en/latest/) | Gerkin testing framework.

## **Major NPM Packages:** ##
Container   | Folder                 | Description
------------|------------------------|-----------------------------------------------------------------------
react       |N/A                     | Front end javascript framework.

## **Tutorials:** ##
* [Symfony 4 Docker Tutorial](https://knplabs.com/en/blog/how-to-dockerise-a-symfony-4-project)
* [Code Review Videos](https://codereviewvideos.com/course/docker-tutorial-for-beginners/video/docker-compose-multiple-environments)
* [Api Platform in Symfony 4](https://symfonycasts.com/screencast/symfony-rest/test-database)
* [Symfony 4 React Tutorial](https://auth0.com/blog/developing-modern-apps-with-symfony-and-react/#Running-your-React-and-Symfony-App)
* [JWT in Symfony 4](https://symfonycasts.com/screencast/symfony-rest4)
* [Security in Symfony 4](https://symfonycasts.com/screencast/api-platform-security/test-reset-database#play)
* [Behat in Symfony 4](https://blog.rafalmuszynski.pl/how-to-configure-behat-with-symfony-4/)
