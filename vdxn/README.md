# Instructions

## File Structure for important files
```
.
├── /application/Controller    # Contains main app logic that retrieves data from the Model
├── /application/Model         # Contains .SQL files that implement our Model methods. You may find all of our SQL queries here
├── /application/view          # UI template files and implementation
├── /public                    # Contains public image assets, and necessary CSS and JS files
└── seed.sql                   # Database seeds
```

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
