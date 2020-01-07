pipeline {
   agent any

    environment {
        MYSQL_HOST          = 'database'
        MYSQL_ROOT_PASSWORD = 'root'
        MYSQL_USER          = 'serectUser'
        MYSQL_PORT          = '3306'
        MYSQL_PASSWORD      = 'drowssap'
        MYSQL_DATABASE      = 'secretDb'
        APP_ENV             = 'dev'
        NGINX_PORT          = '80'
        ADMINER_PORT        = '9080'
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
            sh "docker-compose -f base.yml -f staging.yml build"
         }
      }

      stage('Test') {
         steps {
            sh "docker-compose -f base.yml -f staging.yml up --force-recreate"
            sh 'sleep 15'
            sh "docker-compose -f base.yml -f staging.yml exec application sh -c 'vendor/bin/behat'"
            sh "docker-compose -f base.yml -f staging.yml down -v --remove-orphans --volumes"
         }
      }
   }
}
