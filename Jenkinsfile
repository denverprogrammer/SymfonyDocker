// This project is intended to be built by Jenkins Build Server. 
// https://github.com/denverprogrammer/JenkinsBuildServer

pipeline {
   
   agent any
   
   environment {
      MYSQL_HOST          = 'database'
      MYSQL_ROOT_PASSWORD = 'root'
      MYSQL_USER          = 'serectUser'
      MYSQL_PORT          = '3306'
      MYSQL_PASSWORD      = 'drowssap'
      MYSQL_DATABASE      = 'secretDb'
      APP_ENV             = 'test'
      NGINX_PORT          = '80'
      ADMINER_PORT        = '9080'
      COMPOSE_ID          = 'symfony_docker' // '{env.BRANCH_NAME}'
      NETWORK_NAME        = 'symfony_docker'
      JWT_PASSPHRASE      = 'Test'
   }
   
   options {
      buildDiscarder logRotator(daysToKeepStr: '7')
      timeout(time: 10, unit: 'MINUTES')
      ansiColor('css')
   }

   stages {
      stage('Checkout') {
         steps {
            checkout scm
         }
      }

      stage('Build') {
         steps {
            sh "printenv"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml build"
         }
      }

      stage('Startup') {
         steps {
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml --no-ansi up -d --remove-orphans --force-recreate"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml exec -T application sh -c 'composer install --no-interaction --prefer-dist --no-suggest --no-progress --ansi'"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml exec -T application sh -c 'timeout 300s /usr/local/bin/DatabaseWait.sh'"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml exec -T application sh -c 'bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing'"
         }
      }

      stage('Testing') {
         steps {
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/behat --colors --format junit --out tests'"
            sleep 5
            junit 'tests/*.xml'
         }
      }
   }

   post { 
      always { 
         sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml --no-ansi down --remove-orphans --volumes"
         deleteDir() /* clean up our workspace */
      }
   }
}
