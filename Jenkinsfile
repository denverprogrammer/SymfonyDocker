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

      stage('Startup') {
         steps {
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml up -d --build --remove-orphans --force-recreate"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml logs"
         }
      }

      stage('Testing') {
         steps {
            input('Is the server started?')
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml logs"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/behat'"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml down --remove-orphans --volumes"
         }
      }
   }

   post { 
      always { 
         sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml down --remove-orphans --volumes"
         deleteDir() /* clean up our workspace */
         // cleanWs()
      }
   }
}
