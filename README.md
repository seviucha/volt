# Github fetch and compare repository stats project

## Setup project
Install docker and docker-compose.

### Clone repository
* `git clone git@github.com:seviucha/volt.git`

### Prepare .env and docker-compose.yaml
* set in .env file `GITHUB_AUTH_METHOD=access_token_header` and `GITHUB_USERNAME=github personal access tokens`
  (https://docs.github.com/en/github/authenticating-to-github/keeping-your-account-and-data-secure/creating-a-personal-access-token)

### Running project
* Run `docker-compose up` from project directory.
* Log into php `docker-compose exec php sh` container and run `composer install`.

### Additional info
* Add in hosts file `127.0.0.1 volt.local` domain
* Then run in browser `http://volt.local`
