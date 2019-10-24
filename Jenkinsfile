pipeline {
    agent { label 'docker' }
    triggers {
        githubPush()
    }
    environment {
        // Specify your environment variables.
        APP_VERSION = '1'
    }
    stages {
        stage('Build') {
            steps {
                // Print all the environment variables.
                sh 'printenv'
                sh 'echo $GIT_BRANCH'
                sh 'echo $GIT_COMMIT'
                echo 'Install non-dev composer packages and test a symfony cache clear'
                sh 'docker-compose -f build.yml -f staging.yml -t application:$GIT_COMMIT up --build --exit-code-from application --remove-orphans application'
            }
        }
        stage('Test') {
            steps {
                echo 'Start functional tests using Behat in 15 seconds'
                sh 'sleep 15'
                sh 'docker-compose -f build.yml -f staging.yml exec -T application bash vendor/bin/behat'
            }
        }
        stage('Push') {
            when {
                branch 'master'
            }
            steps {
                echo 'Deploying docker images'
                // sh 'docker tag application:$GIT_COMMIT application:$APP_VERSION'
                // sh 'docker tag registry.example.com/symfony_project_fpm:$GIT_COMMIT registry.example.com/symfony_project_fpm:latest'
                // sh 'docker push registry.example.com/symfony_project_fpm:$APP_VERSION'
                // sh 'docker push registry.example.com/symfony_project_fpm:latest'
                // sh 'docker tag registry.example.com/symfony_project_nginx:$GIT_COMMIT registry.example.com/symfony_project_nginx:$APP_VERSION'
                // sh 'docker tag registry.example.com/symfony_project_nginx:$GIT_COMMIT registry.example.com/symfony_project_nginx:latest'
                // sh 'docker push registry.example.com/symfony_project_nginx:$APP_VERSION'
                // sh 'docker push registry.example.com/symfony_project_nginx:latest'
                // sh 'docker tag registry.example.com/symfony_project_db:$GIT_COMMIT registry.example.com/symfony_project_db:$APP_VERSION'
                // sh 'docker tag registry.example.com/symfony_project_db:$GIT_COMMIT registry.example.com/symfony_project_db:latest'
                // sh 'docker push registry.example.com/symfony_project_db:$APP_VERSION'
                // sh 'docker push registry.example.com/symfony_project_db:latest'
            }
        }
    }
    post {
        always {
            // Always cleanup after the build.
            sh 'docker-compose -f build.yml -f staging.yml down --remove-orphans'
            sh 'rm .env'
        }
    }
}