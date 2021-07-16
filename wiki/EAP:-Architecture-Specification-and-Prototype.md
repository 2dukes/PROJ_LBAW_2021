TasteBuds helps people build a community of diverse, healthy and tasty eating habits.

## A7: High-level architecture. Privileges. Web resources specification

This artefact's goal is to document the entire website API. All routes and respective permission access, endpoints (CRUD) and HTTP request parameters will be defined here. The format of HTTP responses will also be available in this artefact.

### 1. Overview

<table>
    <tr>
        <th>M01: Authentication and Individual Profile</th>
        <td>Web resources associated with user authentication and individual profile management, includes the following system features: login/logout, registration, credential recovery, view and edit personal profile information.</td>
    </tr>
    <tr>
        <th>M02: Recipes, categories, groups and members</th>
        <td>Web resources associated with feed, upsert recipe, search results, recipes, categories, groups and members.</td>
    </tr>
    <tr>
        <th>M03: Chat</th>
        <td>Web resources associated with the private messages between members.</td>
    </tr>
    <tr>
        <th>M04: Information Pages</th>
        <td>Web resources associated with the information pages, namely the FAQ and the About pages.</td>
    </tr>
    <tr>
        <th>M05: Administration</th>
        <td>Web resources associated with the administrator pages, namely the users and reports management.</td>
    </tr>
</table>

### 2. Permissions

<table>
    <tr>
        <th>PUB</th>
        <td>Public</td>
        <td>Group of users without privileges.</td>
    </tr>
    <tr>
        <th>MBR</th>
        <td>Member</td>
        <td>Authenticated member.</td>
    </tr>
    <tr>
        <th>OWN</th>
        <td>Owner</td>
        <td>Users that are owners of the information (e.g. own profile, own recipe, own comment).</td>
    </tr>
    <tr>
        <th>MOD</th>
        <td>Moderator</td>
        <td>Users that are moderators of a group.</td>
    </tr>
    <tr>
        <th>ADM</th>
        <td>Administrator</td>
        <td>Administrators.</td>
    </tr>
</table>

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

The yaml code can be found [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/eap/openapi.yaml).

The Swagger generated documentation can be found [here](https://app.swaggerhub.com/apis-docs/TasteBuds/taste-buds_api/1.0).

## A8: Vertical prototype

In this iteration, we developed a Vertical Prototype that aims the implementation of several user stories to validate the presented architecture. In this early stage of the project, the main goal is to gain some familiarity with Laravel. This prototype includes page visualization, insertion, edition, removal, permission control and success/error message display.

### 1. Implemented Features

#### 1.1. Implemented User Stories
The user stories that were implemented in the prototype are described in the following table.

Reference  | Name                            | Priority | Description
---------- | ------------------------------- | -------- | -----------
US11       | See home                        | high     | As a *User*, I want to access the homepage, so that I can see the website's presentation.
US16       | Read reviews                    | high     | As a *User*, I want to read all reviews of a post, so that I know what other people think about it.
US17       | View a recipe                   | high     | As a *User*, I want to view all information of a specific public recipe, so that I can get all the information about it.
US21       | Sign-in                         | high     | As a *Visitor*, I want to authenticate into the system, so that I can access privileged information.
US22       | Sign-up                         | high     | As a *Visitor*, I want to register myself into the system, so that I can then authenticate myself.
US39       | Post a recipe                   | high     | As a *Member*, I want to post recipes, so that I can share them with other users.
US310      | Sign out                        | high     | As a *Member*, I want to sign out of the system, so that I can close the session.
US315      | Save recipe                     | medium   | As a *Member*, I want to add a recipe to my favourites list, so that I can view it in the future more easily.
US41       | Update a recipe                 | high     | As a *Post Author*, I want to update a recipe, so that I can change its information.
US42       | Delete a recipe                 | high     | As a *Post Author*, I want to delete a recipe so that it's no longer in the website's database and no one can see it.

#### 1.2. Implemented Web Resources

The web resources that were implemented in the prototype are described in the next section. 

**Module M01: Authentication and Individual Profile**  

Web Resource Reference | URL
---------------------- | ---
R1002: Login form      | [/login](http://lbaw2135.lbaw-prod.fe.up.pt/login)
R1003: Login Action    | POST /login
R1004: Register form   | [/register](http://lbaw2135.lbaw-prod.fe.up.pt/register)
R1005: Register Action | POST /register
R1006: Logout Action   | POST /logout

**Module M02: Recipes, categories, groups and members**  

Web Resource Reference | URL
---------------------- | ---
R1014: View recipe            | [/recipe/{recipeId}](http://lbaw2135.lbaw-prod.fe.up.pt/recipe/1)
R1015: Edit recipe page       | [/recipe/{recipeId}/edit](http://lbaw2135.lbaw-prod.fe.up.pt/recipe/1/edit)
R1016: Edit recipe action     | POST /recipe/{recipeId}/edit
R1017: Delete recipe action   | POST /recipe/{recipeId}/delete
R1018: Create recipe page     | [/recipe](http://lbaw2135.lbaw-prod.fe.up.pt/recipe)
R1019: Create recipe action   | POST /recipe
R2101: Create recipe          | POST /api/recipe
R2102: Get recipe             | [/api/recipe/{recipeId}](http://lbaw2135.lbaw-prod.fe.up.pt/api/recipe/1)
R2103: Edit recipe)           | PUT /api/recipe/{recipeId}
R2104: Delete recipe          | DELETE /api/recipe/{recipeId}
R2105: Add a favourite recipe | POST /api/recipe/{recipeId}/favourite
R2106: Remove a favourite recipe | DELETE /api/recipe/{recipeId}/favourite

### 2. Prototype

The prototype is available [here](http://lbaw2135.lbaw-prod.fe.up.pt/).

Credentials:
- Email: gdeter
- Password: 123456789
- Obs: This user has created the recipes with ids 1 and 65.

The code is available [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/tree/master/src).

---

## Revision history

- [11/05/2021@18:15] Updated prototype credentials to match authentication changes during the product development phase - going from using email to using username to login.

---

GROUP2135, 03/05/21

Alexandre Abreu, [up201800168@fe.up.pt](mailto:up201800168@fe.up.pt)

Rafael Cristino, [up201806680@fe.up.pt](mailto:up201806680@fe.up.pt)

Rui Pinto, [up201806441@fe.up.pt](mailto:up201806441@fe.up.pt)

Tiago Gomes, [up201806658@fe.up.pt](mailto:up201806658@fe.up.pt) (Editor)