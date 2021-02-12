<div align="center">
   <h1>Camagru</h1>
   <h4>The goal of this project is to build a web application a little more complex than the previous ones with a little less means.</h4>
</div>

## Table of Contents

- [Introduction](#introduction)
- [Install](#install)
- [Previews](#Previews)
- [Contributors](#contributors)

## `Introduction`

This web project will challenge you to create a small web application allowing 
you to edit basic photos and videos using your webcam and some predefined images.
<br />

Users can also:
 * Add stickers to their photos
 * View, like, and comment on each other's images
 * As well as receive email notifications.

The subject can be found here <a href="./doc/camagru.en.pdf">here</a>.
<br />

The technologies we were restricted to include:
 * PHP/APACHE
 * MYSQL
 * HTML
 * CSS (no libraries allowed)

## `Install`

Open your terminal and run:

```bash
git clone https://github.com/mchocho/Camagru.git

```
You will need to copy the template php.env file to the root directory, run:

```bash
cd Camagru
cp test/env.template.php env.php

```

Now just change your MYSQL authentication:

```bash
nano env.php

#DB_USERNAME=root Change root to your MYSQL username
#PASSWORD=        Include your MYSQL password

```

Finally, start apache and MYSQL, then run the config script to create the Database:

```bash
cd config

php setup.php

#Outputs Camagru DB created.

```

Now you can run Camagru on <a href="http://localhost/camagru/">localhost</a>.

## `Previews`

<div align="center">
  <img width="80%" src="https://i.imgur.com/QlYEvhW.png" alt="index page"/>
  <img width="80%" src="https://i.imgur.com/kdO559b.png" alt="a page containing a post"/>
  <img width="80%" src="https://i.imgur.com/pWpWL37.png" alt="camera section"/>
</div>

## `Contributors`
 * <a href="https://github.com/mohambe">mohambe</a>