<div align="center">
   <h1>Camagru</h1>
   <h4>The goal of this project is to build a web application a little more complex than the previous ones with a little less means.</h4>
</div>

## Table of Contents

- [Introduction](#introduction)
- [Install](#install)
- [Getting started](#started)
- [Guide](#guide)
- [Documentation](#documentation)
- [Contributors](#contributors)

## `Introduction`

Camagru is a social media web application that allows users to upload and take pictures with
webcam.
<br />

Users can also:
 * Add stickers to their photos
 * Comment, view and like each other's images
 * As well as receive email notifications.
<br />
This web project will challenge you to create a small web application allowing you to
edit basic photos and videos using your webcam and some predefined images. The subject
can be found here <a href="./doc/camagru.en.pdf">here</a>.
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

Now finally just change your MYSQL authentication:

```bash
nano env.php

#Change DB_USERNAME=root to your MYSQL username
#Change PASSWORD= to your MYSQL password

```

Then start apache and run the site on your browser.

## `Previews`

<div align="center">
  <img width="80%" src="https://i.imgur.com/QlYEvhW.png" alt="index page"/>
  <img width="80%" src="https://i.imgur.com/kdO559b.png" alt="a page containing a post"/>
  <img width="80%" src="https://i.imgur.com/pWpWL37.png" alt="camera section"/>
</div>

