
node('docker') {
 
    stage 'Checkout'
        checkout scm

    stage 'Build'
        sh "printenv"
        sh "docker-compose -f base.yml -f staging.yml build"

    stage 'Test'
        sh "docker-compose -f base.yml -f staging.yml up --force-recreate --abort-on-container-exit"
        sh 'sleep 15'
        sh "docker-compose -f base.yml -f staging.yml exec application sh -c 'vendor/bin/behat'"
        sh "docker-compose -f base.yml -f staging.yml down -v"
}
