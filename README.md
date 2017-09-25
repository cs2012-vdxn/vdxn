# Set up

Run vagrant up in same directory as this README file.

Phpmyadmin is available at 192.168.33.66/phpmyadmin

Site is available at 192.168.33.66

Seed the database manually.

# Instructions

## Database Seeding

When you pull any changes off the repo, be sure to update your database with
what is defined in seed.sql

seed.sql should contain the following:

1. Dropping existing tables
2. Adding tables
3. Seeding tables with values

As we are currently creating new components and assembling them together, the
schema is incomplete. A *TODO* will be to add the foreign key requirements and
updates to the schema so that it concisely represents our requirements.

## UI CSS Styling
You can use some of these in-built HTML elements / CSS classes to style your
components. Documentation located in the HTML files at  `/public/flat-ui-bootstrap-template/docs`.

> Credits to [Flat-UI](https://designmodo.github.io/Flat-UI) - made by Designmodo.

## Workflow

Work off your own branch, and merge to master as you see fit.
