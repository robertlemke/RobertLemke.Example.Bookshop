# RobertLemke.Example.Bookshop

This application based on Flow Framework contains various little examples how to use and build on features
Flow provides. That includes basic use of the Model View Controller framework, Dependency Injection, sessions,
resource handling (for binary data such as pictures), templating and more.

This repository contains a Flow distribution, which means you simply clone the repository, and then run `composer install`.
As for the database, simply add database credentials into a `Settings.yaml` in `Configuration/Development` and run `./flow doctrine:migrate`.

This package has been revised for Flow 4.0.

![Bookshop screenshot](https://raw.githubusercontent.com/robertlemke/RobertLemke.Example.Bookshop/master/BookshopScreenshot.png "Bookshop screenshot")
