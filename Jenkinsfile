pipeline {
   agent any
   
   environment {
      MYSQL_HOST          = 'database'
      MYSQL_ROOT_PASSWORD = 'root'
      MYSQL_USER          = 'serectUser'
      MYSQL_PORT          = '3307'
      MYSQL_PASSWORD      = 'drowssap'
      MYSQL_DATABASE      = 'secretDb'
      APP_ENV             = 'test'
      NGINX_PORT          = '80'
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
            sh "docker-compose -f base.yml -f staging.yml up -d --build --remove-orphans --force-recreate"
            sh 'sleep 30'
            sh "docker-compose -f base.yml -f staging.yml exec logs"
            sh "docker-compose -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/behat'"
            sh "docker-compose -f base.yml -f staging.yml down --remove-orphans --volumes"
         }
      }
   }
}
