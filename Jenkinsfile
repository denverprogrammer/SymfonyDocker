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

      stage('Test') {
         steps {
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml up -d --build --remove-orphans --force-recreate"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml logs"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/behat'"
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml down --remove-orphans --volumes"
         }
      }

      stage('cleanup') {
         steps {
            sh "docker-compose -p $COMPOSE_ID -f base.yml -f staging.yml down --remove-orphans --volumes"
         }
      }
   }

   post { 
      always { 
         echo 'I will always say Hello again!'
         deleteDir() /* clean up our workspace */
         // cleanWs()
      }
      success {
         echo 'I succeeeded!'
         mail to: 'denverprogrammer@gmail.com',
            subject: "Tested Pipeline: ${currentBuild.fullDisplayName}",
            body: "Testing a success ${env.BUILD_URL}"
      }
      unstable {
         echo 'I am unstable :/'
         mail to: 'denverprogrammer@gmail.com',
            subject: "Unstable Pipeline: ${currentBuild.fullDisplayName}",
            body: "Looks like it passed but something is wrong with ${env.BUILD_URL}"
      }
      failure {
         echo 'I failed :('
         mail to: 'denverprogrammer@gmail.com',
            subject: "Failed Pipeline: ${currentBuild.fullDisplayName}",
            body: "Something is wrong with ${env.BUILD_URL}"
      }
      changed {
         echo 'Things were different before...'
         mail to: 'denverprogrammer@gmail.com',
            subject: "Changed Pipeline: ${currentBuild.fullDisplayName}",
            body: "Pipeline ${env.BUILD_URL} has been changed"
      }
   }
}
