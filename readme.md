
## **Description:** ##
Simple implementation of Symony 4 running in Docker. 


## **Linux Requirements:** ##
* [docker ce](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
* [docker-compose](https://docs.docker.com/compose/install/)
* [make](https://linuxconfig.org/how-to-install-gcc-the-c-compiler-on-ubuntu-18-04-bionic-beaver-linux)


## **How to run:** ##
Any of the following commands can be run in your terminal.

```bash
# Builds all of the dev containers and starts the server.  
# In your browser go to http://localhost to view webpage.
$ make build_dev

# Brings down all containers.
$ make destroy

# Builds all of the test containers and starts the server.    
# In your browser go to http://localhost to view webpage.
$ make build_test

# Runs functional tests.  Successfull tests show up as green, 
# errors are red and warnings are blue. This command requires 
# make build-test to be run first.  After building please wait 
# for a few seconds because composer may still be downloading
# dependencies may still be building.  Run make test again if command fails.
$ make test
```


## **Docker Containers:** ##
Container   | Folder                                     | Description                             |
------------|--------------------------------------------|-----------------------------------------|
webserver   | [docker/webserver](./docker/webserver)     | Nginx webserver.                        |
database    | [docker/database](./docker/database)       | MySql 8 database server.                |
application | [docker/application](./docker/application) | Php 7.2 backend application language.   |
adminer     | [docker/adminer](./docker/adminer)         | Web based database administrator. \*    |
composer    | N/A                                        | Installs application dependencies. \*\* |

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
      <td colspan="2">8080</td>
    </tr>
    <tr>
      <td>APP_ENV</td>
      <td>application</td>
      <td>dev</td>
      <td>test</td>
    </tr>
    <tr>
      <td>XDEBUG_CONFIG</td>
      <td>application</td>
      <td colspan="2">'idekey=VSCODE remote_host=172.17.0.1 remote_port=9090 remote_enable=1'</td>
    </tr>
    <tr>
      <td>NGINX_PORT</td>
      <td>webserver</td>
      <td colspan="2">80</td>
    </tr>
    <tr>
      <td>MYSQL_PORT</td>
      <td>database, application</td>
      <td colspan="2">3306</td>
    </tr>
    <tr>
      <td>MYSQL_USER</td>
      <td>database, application</td>
      <td colspan="2">secretUser</td>
    </tr>
    <tr>
      <td>MYSQL_HOST</td>
      <td>database, application</td>
      <td colspan="2">database</td>
    </tr>
    <tr>
      <td>MYSQL_ROOT_PASSWORD</td>
      <td>database, application</td>
      <td colspan="2">root</td>
    </tr>
    <tr>
      <td>MYSQL_PASSWORD</td>
      <td>database, application</td>
      <td colspan="2">drowssap</td>
    </tr>
    <tr>
      <td>MYSQL_DATABASE</td>
      <td>database, application</td>
      <td>secretDb</td>
      <td>secretDbTest</td>
    </tr>
  </tbody>
</table>


## **Major Composer Packages:** ##
Name         | Package                                                  | Description                          |
-------------|----------------------------------------------------------|--------------------------------------|
Symfony      | [symfony/symfony](https://symfony.com/)                  | Application framework.               |
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
