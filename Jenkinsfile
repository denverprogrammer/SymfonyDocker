pipeline {
    agent { label 'docker' }
    triggers {
        bitbucketPush()
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
                sh 'docker-compose -f build.yml up --exit-code-from fpm_build --remove-orphans fpm_build'
                echo 'Building the docker images with the current git commit'
                sh 'docker build -f Dockerfile-php-production -t registry.example.com/symfony_project_fpm:$GIT_COMMIT .'
                sh 'docker build -f Dockerfile-nginx -t registry.example.com/symfony_project_nginx:$GIT_COMMIT .'
                sh 'docker build -f Dockerfile-db -t registry.example.com/symfony_project_db:$GIT_COMMIT .'
            }
        }
        stage('Test') {
            steps {
                echo 'PHP Unit tests'
                sh 'docker-compose -f test.yml up -d --build --remove-orphans'
                sh 'sleep 5'
                sh 'docker-compose -f test.yml exec -T fpm_test bash build/php_unit.sh'
            }
        }
        stage('Push') {
            when {
                branch 'master'
            }
            steps {
                echo 'Deploying docker images'
                sh 'docker tag registry.example.com/symfony_project_fpm:$GIT_COMMIT registry.example.com/symfony_project_fpm:$APP_VERSION'
                sh 'docker tag registry.example.com/symfony_project_fpm:$GIT_COMMIT registry.example.com/symfony_project_fpm:latest'
                sh 'docker push registry.example.com/symfony_project_fpm:$APP_VERSION'
                sh 'docker push registry.example.com/symfony_project_fpm:latest'
                sh 'docker tag registry.example.com/symfony_project_nginx:$GIT_COMMIT registry.example.com/symfony_project_nginx:$APP_VERSION'
                sh 'docker tag registry.example.com/symfony_project_nginx:$GIT_COMMIT registry.example.com/symfony_project_nginx:latest'
                sh 'docker push registry.example.com/symfony_project_nginx:$APP_VERSION'
                sh 'docker push registry.example.com/symfony_project_nginx:latest'
                sh 'docker tag registry.example.com/symfony_project_db:$GIT_COMMIT registry.example.com/symfony_project_db:$APP_VERSION'
                sh 'docker tag registry.example.com/symfony_project_db:$GIT_COMMIT registry.example.com/symfony_project_db:latest'
                sh 'docker push registry.example.com/symfony_project_db:$APP_VERSION'
                sh 'docker push registry.example.com/symfony_project_db:latest'
            }
        }
    }
    post {
        always {
            // Always cleanup after the build.
            sh 'docker-compose -f build.yml down'
            sh 'docker-compose -f test.yml down'
            sh 'rm .env'
        }
    }
}