
## **Requirements:** ##
* docker ce
* linux

## **How to run:** ##

Builds all of the dev containers.

```bash
$ make build-dev
```

Brings down all containers.

```bash
$ make destroy
```

In order to run tests you will have to build the test container using the following command.

```bash
$ make build-test
```

Runs functional tests using behat.  Successfull tests show up as green, errors are red and warnings are blue.  This command requires the *make build-test* make command to be run first.  After containers are built.  Wait a few seconds for the container internal processes (composer) to become available.

```bash
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

*All containers in this project use alpine to make the image size as small as possible.*

## **Composer Packages:** ##
Container    | Folder                 | Description
-------------|------------------------|-----------------------------------------------------------------------
api platform | [docker/webserver](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/webserver) | Framework to simplify rest requests.
behat        | [docker/database](https://github.com/denverprogrammer/SymfonyDocker/tree/master/docker/database) | Gerkin testing framework.

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
