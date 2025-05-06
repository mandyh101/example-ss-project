# Example SS project
My example SS 5 website for learning and practice development with the SS framework.

## tech 
- Silverstripe 5
- php 8.2
- mysql 8
- Docker


## project set up - development
I am running this project through a docker environement.
Make sure you have composer installed:
- https://getcomposer.org/download/
- https://docs.silverstripe.org/en/5/getting_started/composer/

After cloning the project you can build the docker environment:
- `docker compose up`
- view project at *http://localhost:8080*
- you may need to run a dev build to run db and migrations: *http://localhost:8080/dev/build*

## shutting down development
- `docker compose down`



## SS Links

 * [Changelogs](https://docs.silverstripe.org/en/changelogs/)
 * [Bugtracker: Framework](https://github.com/silverstripe/silverstripe-framework/issues)
 * [Bugtracker: CMS](https://github.com/silverstripe/silverstripe-cms/issues)
 * [Bugtracker: Installer](https://github.com/silverstripe/silverstripe-installer/issues)
 * [Forums](http://silverstripe.org/forums)
 * [Developer Mailinglist](https://groups.google.com/forum/#!forum/silverstripe-dev)
 * [License](./LICENSE)
