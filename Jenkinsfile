pipeline {
   // This project is intended to be built by Jenkins Build Server. 
   // https://github.com/denverprogrammer/JenkinsBuildServer   

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
      stage('Checkout') {
         steps {
            checkout scm
         }
      }

      stage('Build') {
         steps {
            sh "printenv"
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml build"
         }
      }

      stage('Startup') {
         steps {
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml --no-ansi up -d --remove-orphans --force-recreate"
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'composer install --no-interaction --prefer-dist --no-suggest --no-progress --ansi'"
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'timeout 300s /usr/local/bin/DatabaseWait.sh'"
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'bin/console doctrine:migrations:migrate --no-interaction --query-time --all-or-nothing'"
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/simple-phpunit -c tests/phpunit.xml --version'"
         }
      }

      stage('Code Sniffing') {
         steps {
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/phpcs -p --standard=tests/phpcs.xml .'"
         }
      }

      stage('Unit Testing') {
         steps {
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'rm -irf tests/unit/results && vendor/bin/simple-phpunit -c tests/phpunit.xml'"
         }
      }

      stage('Functional Testing') {
         steps {
            sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml exec -T application sh -c 'vendor/bin/behat --colors --config tests/behat.yaml'"
         }
      }

      stage('Collecting Test Results') {
         steps {
            junit '**/tests/*/results/junit/default.xml'
            sh "pwd"
            sh "ls -lac app/tests/unit/results"
            sh "ls -lac app/tests/unit/results/html"

            fileOperations([fileCopyOperation(
               excludes: '',
               flattenFiles: false,
               includes: '${env.WORKSPACE}/app/tests/unit/results/clover/default.xml',
               targetLocation: "${env.WORKSPACE}/app/tests/unit/results/html/default.xml"
            )]).

            sh "ls -lac app/tests/unit/results/html"

            step([
               $class: 'CloverPublisher',
               cloverReportDir: 'app/tests/unit/results/html',
               cloverReportFileName: 'app/tests/unit/results/html/default.xml',
               healthyTarget: [methodCoverage: 70, conditionalCoverage: 80, statementCoverage: 80], // optional, default is: method=70, conditional=80, statement=80
               unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50], // optional, default is none
               failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]     // optional, default is none
            ])
         }
      }
   }

   post { 
      always { 
         sh "docker-compose -p $PROJECT_ID -f base.yml -f staging.yml --no-ansi down --remove-orphans --volumes"
         deleteDir() /* clean up our workspace */
      }
   }
}
