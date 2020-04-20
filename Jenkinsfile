pipeline {
   // This project is intended to be built by Jenkins Build Server. 
   // https://github.com/denverprogrammer/JenkinsBuildServer   

   agent {
   
      label 'my-defined-label'
      
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
         PROJECT_ID          = "${env.BRANCH_NAME}".replace("-", "_")
         NETWORK_NAME        = "${env.BRANCH_NAME}".replace("-", "_")
         JWT_PASSPHRASE      = '14bac7d2cf4c46f978ae7a13bf6d4ed7'
      }
      
      options {
         buildDiscarder logRotator(daysToKeepStr: '7')
         timeout(time: 10, unit: 'MINUTES')
         ansiColor('css')
      }

      stages {

         stage('Build & Start Containers') {
            steps {
               checkout scm
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml build"
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml up -d --remove-orphans --force-recreate"
            }
         }

         stage('Install Dependencies') {
            steps {
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'composer install --no-interaction --prefer-dist --no-suggest --no-progress --ansi'"
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/simple-phpunit -c tests/phpunit.xml --version'"
            }
         }

         stage('Database Migrations') {
            steps {
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'timeout 300s /usr/local/bin/DatabaseWait.sh'"
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing --ansi'"
            }
         }

         stage('Sniffing & Testing Code') {
            steps {
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/phpcs --colors -p --standard=tests/phpcs.xml .'"
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'rm -irf tests/unit/results && vendor/bin/simple-phpunit -c tests/phpunit.xml'"
               sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/behat --colors --config tests/behat.yaml'"
            }
         }

         stage('Collecting Test Results') {
            steps {
               junit '**/tests/*/results/junit/default.xml'

               publishHTML (target: [
                  allowMissing: true,
                  alwaysLinkToLastBuild: true,
                  keepAll: false,
                  reportDir: 'app/tests/unit/results/html',
                  reportFiles: 'index.html',
                  reportName: "Unit Tests Report",
                  reportTitles: "Testing Unit"
               ])

               publishHTML (target: [
                  allowMissing: true,
                  alwaysLinkToLastBuild: true,
                  keepAll: false,
                  reportDir: 'app/tests/functional/results/html',
                  reportFiles: 'index.html',
                  reportName: "Functional Tests Report",
                  reportTitles: "Testing Functional"
               ])
            }
         }
      }

      post { 
         always { 
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml down --remove-orphans --volumes"
            deleteDir() /* clean up our workspace */
         }
      }
   }
}