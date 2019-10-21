
## **Requirements:** ##
* docker ce
* linux

## **How to run:** ##

```bash
# Builds all of the dev containers.  After containers are built and ready go to http://localhost:80 to view webpage.
$ make build-dev

# Brings down all containers.
$ make destroy

# Use the following commands to run unit tests.  Successfull tests show up as green, errors are red and warnings are blue.
# The url http://localhost:80 should also be available.
$ make build-test

# Wait for a few seconds for because container dependencies may still be building.  Run make test again if command fails.
$ make test
```

## **Environment Variables:** ##

## **Docker Containers:** ##
Container   | Folder                 | Description
------------|------------------------|-----------------------------------------------------------------------
webserver   | [docker/webserver](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/webserver) | Nginx webserver.
database    | [docker/database](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/database) | MySql 8 database webserver.
application | [docker/application](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/database) | Php 7.2 backend application language.
adminer     | [docker/adminer](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/adminer) | Web based database administrator.  This container is only available locally.

*All containers in this project use alpine (Simplified Linux) to make the image size as small as possible.*

## **Composer Packages:** ##
Name         | Package                 | Description
-------------|-------------------------|-----------------------------------------------------------------------
api platform | [api-platform/core](https://api-platform.com/docs/core/) | Framework to simplify rest requests.
behat        | [behat/behat](http://behat.org/en/latest/) | Gerkin testing framework.

## **NPM Packages:** ##
Container   | Folder                 | Description
------------|------------------------|-----------------------------------------------------------------------
react       |N/A                     | Front end javascript framework.

## **Tutorials:** ##
* [Symfony 4 Docker Tutorial](https://knplabs.com/en/blog/how-to-dockerise-a-symfony-4-project) 
* [Api Platform in Symfony 4](https://symfonycasts.com/screencast/symfony-rest/test-database) 
* [Symfony 4 React Tutorial](https://auth0.com/blog/developing-modern-apps-with-symfony-and-react/#Running-your-React-and-Symfony-App) 
* [JWT in Symfony 4](https://symfonycasts.com/screencast/symfony-rest4)
* [Security in Symfony 4](https://symfonycasts.com/screencast/api-platform-security/test-reset-database#play)
* [Behat in Symfony 4](https://blog.rafalmuszynski.pl/how-to-configure-behat-with-symfony-4/)
