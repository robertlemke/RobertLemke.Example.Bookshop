# "Roe Books" Example

This FLOW3 package is the example created during the "Getting Into FLOW3" workshop. It's a simple bookshop which demonstrates a few of the core features of FLOW3, including controllers, templating, forms, sessions and persistence.

# Setup Instructions

In order to try this example, you'll need to clone a FLOW3 distribution:

	git clone --recursive git://git.typo3.org/FLOW3/Distributions/Base.git

Then setup file permissions:

	./flow3 flow3:core:setfilepermissions john _www _ww

And setup the database credentials in your Settings.yaml. Once the database is configured, run migrations and an update:

	./flow3 doctrine:migrate
	./flow3 doctrine:update

You also need to install Twitter Bootstrap:

	./flow3 package:import Twitter.Bootstrap

Now you should be able to use the application as demoed during the workshop.