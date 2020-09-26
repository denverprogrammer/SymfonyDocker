
## **Description:** ##
Simple implementation of Symony 5.1 and PHP 7.4 running in Docker.  This project is intended to be 
built by [Jenkins Build Server](https://github.com/denverprogrammer/JenkinsBuildServer)

## **Linux Requirements:** ##
* [docker ce](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
* [docker-compose](https://docs.docker.com/compose/install/)
* [make](https://linuxconfig.org/how-to-install-gcc-the-c-compiler-on-ubuntu-18-04-bionic-beaver-linux)
* [php-mysql for local developement](https://www.howtoinstall.me/ubuntu/18-04/php-mysql/)
* [php-amqp for local developement](https://www.howtoinstall.me/ubuntu/18-04/php-amqp/)

create .env.dist file
add mailer and databaseto etc hosts
* Before running please create a new copy of the .env.dist.  This new copy needs to be called .env and should be in the same location as .env.dist.
* Please change any screts in the .env file like JWT_PASSPHRASE to a more secure value.

## **How to run:** ##
Any of the following commands can be run in your terminal.

```bash
# Do you need a way to cover up your mistakes?
# Does it need to be fast so that nobody will notice?
# Or do you need to just start from scratch ... a lot.
# If yes then this target is made for you.
$ make NUKE_IT_NUKE_IT

# Brings down all containers.
$ make destroy

# Displays container logs.  Areas match names defined in base.yml file
$ make logs

# Sets up and starts all of the dev containers for the first time.
# Go to http://localhost in your browser to view webpage.
$ make initial_start

# Runs functional tests against a the backend.
# Successfull tests show up as green, errors are red and warnings are blue.
$ make run_functional_tests
```

## **Docker Containers:** ##
Container   | Folder                                     | Description                            |
------------|--------------------------------------------|----------------------------------------|
webserver   | [docker/webserver](./docker/webserver)     | Nginx webserver.                       |
database    | N/A                                        | MySql 8 database server.               |
backend     | [docker/backend](./docker/backend)         | Php 7.4 backend backend language.      |
adminer     | N/A                                        | Web based database administrator.    \*|
composer    | N/A                                        | Installs backend dependencies. \*\*    |
mailer      | N/A                                        | Local mail server for testing only.  \*|
messenger   | N/A                                        | Local queue for processing messages. \*|

* All containers in this project use alpine (Simplified Linux) to make the image size as small as possible.
* \* This container is only available locally.
* \*\* Exits when finished.

## **Container Environment Variables:** ##
A .env file containing environment variables is located in the project root directory.  These can be changed when needed.
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Used In</th>
      <th>Dev Default</th>
      <th>Test Default</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>ADMINER_PORT</td>
      <td>adminer</td>
      <td>8080</td>
      <td>*</td>
    </tr>
    <tr>
      <td>APP_ENV</td>
      <td>backend</td>
      <td>dev</td>
      <td>test</td>
    </tr>
    <tr>
      <td>DEBUG_CODE</td>
      <td>backend</td>
      <td>VSCODE</td>
      <td>*</td>
    </tr>
    <tr>
      <td>DEBUG_HOST</td>
      <td>backend</td>
      <td>172.17.0.1</td>
      <td>*</td>
    </tr>
    <tr>
      <td>DEBUG_PORT</td>
      <td>backend</td>
      <td>9090</td>
      <td>*</td>
    </tr>
    <tr>
      <td>NGINX_PORT</td>
      <td>webserver</td>
      <td>80</td>
      <td>*</td>
    </tr>
    <tr>
      <td>MYSQL_PORT</td>
      <td>database, backend</td>
      <td>3306</td>
      <td>*</td>
    </tr>
    <tr>
      <td>MYSQL_USER</td>
      <td>database, backend</td>
      <td>secretUser</td>
      <td>*</td>
    </tr>
    <tr>
      <td>MYSQL_HOST</td>
      <td>database, backend</td>
      <td>database</td>
      <td>*</td>
    </tr>
    <tr>
      <td>MYSQL_ROOT_PASSWORD</td>
      <td>database, backend</td>
      <td>root</td>
      <td>*</td>
    </tr>
    <tr>
      <td>MYSQL_PASSWORD</td>
      <td>database, backend</td>
      <td>drowssap</td>
      <td>*</td>
    </tr>
    <tr>
      <td>MYSQL_DATABASE</td>
      <td>database, backend</td>
      <td>secretDb</td>
      <td>secretDbTest **</td>
    </tr>
    <tr>
      <td>MAILER_DSN</td>
      <td>mailer, messenger, backend</td>
      <td>smtp://mailer:1025</td>
      <td>*</td>
    </tr>
    <tr>
      <td>MESSENGER_TRANSPORT_DSN</td>
      <td>mailer, messenger, backend</td>
      <td>amqp://guest:guest@messenger:5672/%2f/messages</td>
      <td>*</td>
    </tr>
  </tbody>
</table>

* \* Same as dev env.
* \*\* This variable cannot be overriden.

## **Major Composer Packages:** ##
Name         | Package                                                  | Description                          |
-------------|----------------------------------------------------------|--------------------------------------|
Symfony      | [symfony/symfony](https://symfony.com/)                  | Backend framework.                   |
api platform | [api-platform/core](https://api-platform.com/docs/core/) | Framework to simplify rest requests. |
behat        | [behat/behat](http://behat.org/en/latest/)               | Gerkin testing framework.            |


## **Major NPM Packages:** ##
Container   | Folder                 | Description                       |
------------|------------------------|-----------------------------------|
react       |N/A                     | Front end javascript framework. \*|

\* At the moment I have not completed this because it's not a top priority

## **Tutorials:** ##
* [Symfony 4 Docker Tutorial](https://knplabs.com/en/blog/how-to-dockerise-a-symfony-4-project)
* [Code Review Videos](https://codereviewvideos.com/course/docker-tutorial-for-beginners/video/docker-compose-multiple-environments)
* [Api Platform in Symfony 4](https://symfonycasts.com/screencast/symfony-rest/test-database)
* [Symfony 4 React Tutorial](https://auth0.com/blog/developing-modern-apps-with-symfony-and-react/#Running-your-React-and-Symfony-App)
* [JWT in Symfony 4](https://symfonycasts.com/screencast/symfony-rest4)
* [Security in Symfony 4](https://symfonycasts.com/screencast/api-platform-security/test-reset-database#play)
* [Behat in Symfony 4](https://blog.rafalmuszynski.pl/how-to-configure-behat-with-symfony-4/)
* [Makefile setup](http://www.inanzzz.com/index.php/post/fr4t/creating-a-dockerised-symfony-application-and-a-makefile-based-build-script)
* [Jenkins build server](https://www.nielsvandermolen.com/continuous-integration-jenkins-docker/)
* [Docker environment setup](https://medium.com/caendra-tech/a-docker-development-environment-for-a-symfony-application-a301df340b58)
* [Docker + Jenkins + Behat example](https://code-maze.com/ci-jenkins-docker/)
* [React training site](https://reacttraining.com/react-router/web/example/basic)
* [Eslint & Prettier](https://www.robertcooper.me/using-eslint-and-prettier-in-a-typescript-project)
