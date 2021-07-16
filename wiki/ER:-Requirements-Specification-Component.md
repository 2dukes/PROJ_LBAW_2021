TasteBuds helps people build a community of diverse, healthy and tasty eating habits.

## A1: TasteBuds

The purpose of this project is to develop a web application for a social network that enables people to share cooking recipes with the world. The main stakeholders of this platform are the producer and the consumer, and a user may be both. The producers look for a way to share their recipes with the world, hopefully gaining some visibility from it and possibly attracting people to their business or any other ventures they have. The consumers look for a way to find new recipes that they haven’t tried before.

Technology is always evolving to improve and facilitate people’s lives. Cooking is one of the things we do every day, and it would be useful to have a tool to ease the task of remembering all the cooking recipes while helping people diversify and improve their diet. This application enables the formation of a community where people help each other create even better recipes.

The website has a responsive and intuitive design, where all users can share recipes that can be private, visible to followers or public. These recipes can include text, links, photos or videos. The user can create an account in the website and then authenticate himself with a username and password. Recipes are tagged and can be searched, filtered, sorted and saved to the user's favourites list. This also allows users to give a list of the ingredients they have at home and filter for recipes that need them. A recommendation algorithm is used to order recipes by default in the user feed. Users can view, comment and rate posts when the necessary permissions are met.

Users can follow accounts and set their profile as private so people need their confirmation to follow. They can also create public and private groups where users can easily share recipes with specific friends. The users can also send direct private messages to each other.

TasteBuds has different types of users. The visitor is able to navigate through the website, look up other people’s profiles and public recipes but not comment or create posts and send messages. The member has the ability to comment and create posts, send messages, perform reviews on recipes, access his profile menu and change his personal information. The group moderators have the ability to manage their groups, such as approving membership requests, removing members and editing the group information. Lastly, the administrators are responsible for the management of the entire website. They don’t have the ability to create, comment or make a review about a post but they do have the possibility of removing offensive content and banning users.

## A2: Actors and User stories

This artefact contains the specification of the actors and possible relations between them, user stories, and some project requirements, serving as agile documentation. 

### 1. Actors

[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/actor_diagram.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/actor_diagram.jpg)


**Figure 1:** Actors.

Identifier          | Description | Examples
------------------- | ----------- | -----------
User                | Has access to public information and can perform actions such as search and view recipes. | n/a
Visitor             | Unauthenticated user that can sign-up or sign-in on the website. | n/a
Member  | User that has authenticated. Can post, comment on other posts, follow people and participate in groups. | johndoe
Post Author              | Creator of a post. Can edit the post and remove it. | gordonramsay
Comment Author      | Creator of a comment. Can edit the comment and remove it. | foodcritic123
Group User          | Member of a group. Can create and interact with posts shared with the group. | averagejoe
Group Moderator     | Member of a group who can remove members and remove inappropriate content, as well as add other moderators. | averagejoe
Banned User         | User that has been banished from the website. Upon authentication, no action is allowed (except that of a regular user). | trump
Administrator       | Can delete inappropriate content, banish users and manage accounts and posts. | admin
Google API          | External APIs that can be used to sign up or authenticate into the system. | Google Sign In for Websites

**Table 1:** Actors' description.

### 2. User Stories

For the TasteBuds system, consider the user stories that are presented in the following sections. 

#### 2.1 User

Identifier | Name                            | Priority | Description
---------- | ------------------------------- | -------- | ------------
US11       | See home                        | high     | As a *User*, I want to access the homepage, so that I can see the website's presentation.
US12       | Search                          | high     | As a *User*, I want to search for specific posts, users, groups and categories, so that I can view the information I want.
US13       | Filter                          | high     | As a *User*, I want to filter and sort the results of a search, so that I can find information more easily.
US14       | See about                       | high     | As a *User*, I want to access the about page so that I can learn more about the website's origin.
US15       | View public profiles            | high     | As a *User*, I want to view all public profiles, so that I can get their information and recipes.
US16       | Read reviews                    | high     | As a *User*, I want to read all reviews of a post, so that I know what other people think about it.
US17       | View a recipe                   | high     | As a *User*, I want to view all information of a specific public recipe, so that I can get all the information about it.
US18       | View similar recipes            | low      | As a *User*, I want to view similar recipes on a recipe's page, so that I can discover new recipes I may like.
US19       | View Frequently Asked Questions | low      | As a *User*, I want to access a page that gives help to commonly asked questions, so that I can clear up doubts.
US110      | Share recipe                    | low      | As a *User*, I want to share a public recipe on other social media, so that I can send it to anyone I want.
 
**Table 2:** User's user stories

#### 2.2 Visitor

Identifier | Name                       | Priority | Description
---------- | -------------------------- | -------- | ------------
US21       | Sign-in                    | high     | As a *Visitor*, I want to authenticate into the system, so that I can access privileged information.
US22       | Sign-up                    | high     | As a *Visitor*, I want to register myself into the system, so that I can then authenticate myself.
US23       | Sign-up using external API | low      | As a *Visitor*, I want to register a new account linked to my external account, so that I can access privileged information.
US24       | Sign-in using external API | low      | As a *Visitor*, I want to sign-in through my external account, so that I can authenticate myself into the system.
US25       | Recover my account         | low      | As a *Visitor*, I want to recover my account in case I forget one of my credentials so that I can use it again.

**Table 3:** Visitor's user stories

#### 2.3 Member

Identifier | Name                             | Priority | Description
---------- | -------------------------------- | -------- | ------------
US31       | Edit profile                     | high     | As a *Member*, I want to edit my profile, so that I can update my information.
US32       | Delete profile                   | high     | As a *Member*, I want to delete my account, so that I can erase all my information from the website.
US33       | Accept requests to follow        | high     | As a *Member*, I want to accept or decline a request to follow my profile, so that I can choose who can see my recipes.
US34       | Follow users                     | high     | As a *Member*, I want to follow other users so I can see what they post on my feed.
US35       | View private profiles            | high     | As a *Member*, I want to view the private profiles that I follow, so that I can see their information and posted recipes.
US36       | Change visibility of profile     | high     | As a *Member*, I want to choose to have my profile public or private, so that I can feel like my privacy is being respected.
US37       | Create comment                   | high     | As a *Member*, I want to comment on a recipe post or another comment, so that I can give my opinion.
US38       | Rate a recipe                    | high     | As a *Member*, I want to give a rating to a recipe from 1 to 5, so that I can give my feedback and share my opinion.
US39       | Post a recipe                    | high     | As a *Member*, I want to post recipes, so that I can share them with other users.
US310      | Sign out                         | high     | As a *Member*, I want to sign out of the system, so that I can close the session.
US311      | Create Groups                     | high     | As a *Member*, I want to create groups, so that we can share recipes in one place.
US312      | Send group membership requests   | high     | As a *Member*, I want to send membership requests to private groups, so that I have the chance to be a part of them.
US313      | Join public groups               | high     | As a *Member*, I want to join public groups, so that I can post in them.
US314      | View suggested recipes           | medium   | As a *Member*, I want to view suggested recipes on my feed so that I can discover new recipes I may like.
US315      | Save recipe                      | medium   | As a *Member*, I want to add a recipe to my favourites list, so that I can view it in the future more easily.
US316      | Send and receive direct messages | medium   | As a *Member*, I want to send and receive direct messages from a person I follow, so that we can have a private chat.
US317      | Block a user                     | low      | As a *Member*, I want to block a user, so that we cannot see each other's profiles.
US318      | Add ingredient                   | low      | As a *Member*, I want to add ingredients to the website's database, so that I can use them in my recipes.
US319      | Verify my account                | low      | As a *Member*, I want to verify my identity, so that people can be sure that I am the real celebrity, chef or influencer they want to follow.

**Table 4:** Member's user stories

#### 2.4 Post Author

Identifier | Name                        | Priority | Description
---------- | --------------------------- | -------- | ------------
US41       | Update a recipe             | high     | As a *Post Author*, I want to update a recipe, so that I can change its information.
US42       | Delete a recipe             | high     | As a *Post Author*, I want to delete a recipe so that it's no longer in the website's database and no one can see it.
US43       | Change visibility of recipe | high     | As a *Post Author*, I want to change the visibility of a recipe, so that I can choose the users who can see it.
 
**Table 5:** Author's user stories

#### 2.5 Comment Author

Identifier | Name           | Priority | Description
---------- | -------------- | -------- | ------------
US51       | Update comment | medium   | As a *Comment Author*, I want to update my comments, so that I can change their information.
US52       | Remove comment | medium   | As a *Comment Author*, I want to remove comments I made so that I can act when I regret posting one.

**Table 6:** Comment author's user stories

#### 2.6 Group User

Identifier | Name                       | Priority | Description
---------- | -------------------------- | -------- | ------------
US61       | Post to group              | high     | As a *Group user*, I want to post to the group so that I can share recipes with the other members.
US62       | See group posts            | high     | As a *Group user*, I want to view all the posts in the group, so that I can see what other people shared.
US63       | Exit group                 | high     | As a *Group user*, I want to exit a group, so that I no longer see its posts.
US64       | Search group               | low      | As a *Group user*, I want to search for specific posts or users in the group, so that I can view the ones I am interested in.
US65       | Filter posts in the group  | low      | As a *Group user*, I want to filter the posts in the group, so that I can find information more easily.
 
**Table 7:** Group user's user stories

#### 2.7 Group Moderator

Identifier | Name                           | Priority | Description
---------- | ------------------------------ | -------- | ------------
US71       | Ban people from the group      | high     | As a *Group moderator*, I want to ban group members, so that the group can be made of people valuable to the group.
US72       | Edit group                     | high     | As a *Group moderator*, I want to change the group's information and visibility, so that it is up to date.
US73       | Manage membership requests     | high     | As a *Group moderator*, I want to accept or reject membership requests, so that I can choose who enters the group.
US74       | Remove comments or posts       | medium   | As a *Group moderator*, I want to delete posts or comments made by other users that do not follow the group's rules.
US75       | Add a moderator                | low      | As a *Group moderator*, I want to add more moderators, so that they can help in the task of keeping the group in order.
 
**Table 8:** Group moderator's user stories

#### 2.8 Banned User

Identifier | Name          | Priority | Description
---------- | ------------- | -------- | ------------
US81       | Request unban | low      | As a *Banned User*, I want to request unban so that I can solve wrong bans and recover my account.
 
**Table 9:** Banned user's user stories

#### 2.9 Administrator

Identifier | Name                              | Priority | Description
---------- | --------------------------------- | -------- | ------------
US91       | Post removal                      | high     | As an *Administrator*, I want to remove a post, so that I can remove posts that do not follow the website's rules.
US92       | Comment or review removal         | high     | As an *Administrator*, I want to remove a comment or review, so that inadequate and spamming content gets wiped.
US93       | Ban users                         | high     | As an *Administrator*, I want to banish users, so that toxic users leave the website.
US94       | Sign out                          | high     | As an *Administrator*, I want to sign out of the system, so that I can close the session.
US95       | Access private groups             | medium   | As an *Administrator*, I want to check private groups so that I can keep the order and respect on the website. 
US96       | Approve or reject new ingredient  | low      | As an *Administrator*, I want to have the ability to accept or reject an ingredient, so that users can find the ingredients they need.
US97       | Manage Frequently Asked Questions | low      | As an *Administrator*, I want to add, edit and remove a question so that it's kept always updated.
US98       | Remove user ban                   | low      | As an *Administrator*, I want to unban a user, so that he can post and view recipes again.
US99       | Manage banishments                | low      | As an *Administrator*, I want to see the appeals made by banned users, so that I review their requests and rethink the administration's decision.

**Table 10**: Administrator's user stories

### 3 Supplementary requirements

#### 3.1 Business rules
Identifier | Name                   | Description
---------- | ---------------------- | ------------
BR01       | Single Rating          | An authenticated user can only rate a recipe once.
BR02       | Recipe Score           | The score of a recipe is the average of its reviews.
BR03       | User Score             | The score of users is the average of their recipes' scores.
BR04       | User Ban               | The administrator is able to ban users from the website if they do not follow the rules.
BR05       | User account deletion  | A user can opt to delete his account and consequently all the personal info related to it gets wiped.
BR06       | Unbiased Review        | An authenticated user can only review recipes posted by others.
BR07       | Ban Lift               | Every banned user has the right to submit an appeal to be reviewed by an administrator.
BR08       | Post removal           | When a post is deleted either by its creator or by an administrator then all the subsequent comments or reviews are removed as well.
BR09       | Comment removal        | When a comment is deleted either by its creator or by an administrator then all the subsequent comments are removed as well.
BR10       | Review date            | The date of a review must be after the post's creation date.
BR11       | Unique username            | Each user must have an unique username.
BR12       | Unique e-mail address           | Each user must have an unique e-mail address.

**Table 11:** Business Rules

#### 3.2 Technical requirements

Identifier | Name                | Description
---------- | ------------------- | ------------
TR01       | Availability        | The system must be available 99 percent of the time in each 24-hour period.
TR02       | Accessibility       | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the web browser they use.
TR03       | Usability           | The system should be simple and easy to use.
TR04       | Performance         | The system should have response times shorter than 2s to ensure the user's attention.
TR05       | Web application     | The system should be implemented as a Web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP).
TR06       | Portability         | The server-side system should work across multiple platforms (Linux, Mac OS, etc.).
TR07       | Database            | The PostgreSQL 13 database management system must be used.
TR08       | Security            | The system shall protect information from unauthorised access through the use of an authentication and verification system.
TR09       | Robustness          | The system must be prepared to handle and continue operating when runtime errors occur.
TR10       | Scalability         | The system must be prepared to deal with the growth in the number of users and their actions.
TR11       | Ethics              | The system must respect the ethical principles in software development (for example, the password must be stored encrypted to ensure that only the owner knows it).

**Table 12:** Technical requirements

The three most important technical requirements are:
- __Usability__: The website must be very simple and easy to use so customers can browse the website without losing an excessive amount of time trying to understand how it works.
- __Accessibility__: The website must allow every user to access its contents regardless of any handicap.
- __Ethics__: The ethical responsibility of the website is taken very seriously, so users know TasteBuds cares about them.

#### 3.3 Restrictions

Identifier | Name          | Description
---------- | ------------- | ------------
C01        | Deadline      | The system should be ready to be used by the end of the semester.

**Table 13:** Restrictions

## A3: User Interface Prototype

This artefact contains the prototype of all user interfaces. Its goal is to validate the correctness of previously defined user requirements, preview, test, and enable multiple iterations on the design of the user interface.

### 1. Interface and common features

TasteBuds is a web application based on HTML5, JavaScript, and CSS. The user interface was implemented using the [Bootstrap](https://getbootstrap.com/) framework.

Desktop           |  Mobile
-------------------------|-------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interface_features_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interface_features_desktop.png)  |  [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interface_features_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interface_features_mobile.png)

**Figure 2:** Interface's guidelines


1. Navbar
2. Logo
3. Search box
4. Sign In/Sign Up Area
5. Page Content
6. Footer

In this figure some characteristics common to all pages are highlighted:

* The user interface was developed taking all kinds of users into account. The result is an intuitive experience, no matter your background.
* The implemented web design is responsive allowing various screen sizes and resolutions, from a 15" or more desktop to a 4" smartphone.
* Through the website, all common links and buttons to the several pages, especially the ones placed in the navigation bar and footer, maintain their position to deliver a consistent user experience. Furthermore, the page margins also follow a common standard.
* All different sections are distinctly styled to denote different hierarchies of the presented information. 

**Note:** Regarding the mobile view, when clicking "Search" or "Menu", a dropdown is presented with the referenced information.

### 2. Sitemap

A sitemap visually represents the relationships between different pages of the website by showing how all the information fits together. Moreover, it gives a general idea of how the website is internally structured into different areas.

[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/sitemap.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/sitemap.png)

**Figure 3:** Sitemap

### 3. Wireflow

A Wireflow represents some of the main system interactions using a sequence of interfaces and describing how navigation is done between them.

[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/wireflow.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/wireflow.png)
**Figure 4:** Website wireflow.

The entire wireflow can be found [here](https://projects.invisionapp.com/freehand/document/El6h07FpT).

### 4. Interfaces

**List of Pages:**
* Homepage
* Sign In
* Sign Up - Account Info
* Sign Up - Personal Info
* Sign Up - Finish
* About Us
* FAQ
* Private Messages
* Profile Page - Recipes
* Profile Page - Reviews
* Profile Page - Favourites
* Edit Profile
* Reports Management
* Users Management
* Search Results
* Group
* Category
* Feed
* Insert/Update Recipe - Information
* Insert/Update Recipe - Ingredients
* Insert/Update Recipe - Method
* Recipe
* Create Group
* Edit Group

**UI01: Homepage**

 Desktop                             | Mobile
 ---------------------------------  | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/homepage_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/homepage_desktop.jpg)  |  [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/homepage_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/homepage_mobile.png)

**Figure 5:** [Homepage](http://lbaw2135-piu.lbaw-prod.fe.up.pt/) of the website is where we can see its features.

**UI02: Sign In**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signin_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signin_desktop.jpg)  |  [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signin_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signin_mobile.png)

**Figure 6:** [Sign In page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/signIn.php) is where an user can login in his account.

**UI03: Sign Up - Account Info**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
 [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_account_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_account_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_account_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_account_mobile.png)
 
**Figure 7:** [Sign Up page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/signUp.php) is where an user can register a new account (account info).

**UI04: Sign Up - Personal Info**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_personal_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_personal_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_personal_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_personal_mobile.png)

**Figure 8:** [Sign Up page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/signUp.php) is where an user can register a new account (personal info).

**UI05: Sign Up - Finish**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_finish_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_finish_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_finish_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/signup_finish_mobile.png)

**Figure 9:** [Sign Up page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/signUp.php) is where an user can register a new account (finish).

**UI06: About Us**

 Desktop                             | Mobile
 ---------------------------------| ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/about_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/about_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/about_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/about_mobile.png)

**Figure 10:** [About Us page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/about.php) is where a small description of the website can be viewed as well as the development team.

**UI07: FAQ**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/faq_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/faq_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/faq_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/faq_mobile.png)

**Figure 11:** [FAQ page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/faq.php) is where the most frequently asked questions and respective answers are.

**UI08: Private Messages**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/messages_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/messages_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/messages_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/messages_mobile.png)

**Figure 12:** [Private Messages page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/privateMessages.php) is where people can chat with each other and view their conversations.

**UI09: Profile Page - Recipes**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_recipes_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_recipes_desktop.jpg) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_recipes_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_recipes_mobile.png)

**Figure 13:** [Profile page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/profile.php) is where the user can view his info, check  posts, reviews, and saved recipes (recipes).

**UI10: Profile Page - Reviews**

 Desktop                             | Mobile
 --------------------------------- | --------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_reviews_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_reviews_desktop.jpg) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_reviews_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_reviews_mobile.png)

**Figure 14:** [Profile page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/profile_reviews.php) is where the user can view his info, check  posts, reviews, and saved recipes (reviews).

**UI11: Profile Page - Favourites**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_favourites_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_favourites_desktop.jpg) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_favourites_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/profile_favourites_mobile.png)

**Figure 15:** [Profile page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/profile_favourites.php) is where the user can view his info, check  posts, reviews, and saved recipes (favourites).

**UI12: Edit Profile**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_profile_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_profile_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_profile_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_profile_mobile.png)

**Figure 16:** [Edit Profile page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/edit_profile.php) is where the user can change his basic info.

**UI13: Reports Management**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/reports_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/reports_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/reports_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/reports_mobile.png)

**Figure 17:** [Reports Management page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/reportsManagement.php) is where reports regarding post recipes, users, and comments are managed.

**UI14: Users Management**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/users_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/users_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/users_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/users_mobile.png)

**Figure 18:** [Users Management page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/usersManagement.php) is where all the website users can be managed.

**UI15: Search Results**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/search_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/search_desktop.jpg) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/search_mobile.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/search_mobile.jpg)

**Figure 19:** [Search Results page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/search.php) is where results for searches are presented. It includes recipes, users, groups, and categories.

**UI16: Group**

 Desktop                             | Mobile
 --------------------------------- |---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/group_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/group_desktop.jpg) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/group_mobile.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/group_mobile.jpg)

**Figure 20:** [Group page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/group.php) is where groups between users are formed and all the posts related to them are presented.

**UI17: Category**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/category_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/category_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/category_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/category_mobile.png)

**Figure 21:** [Category page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/category.php) is where recipes from a specific category are presented.

**UI18: Feed**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/feed_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/feed_desktop.jpg) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/feed_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/feed_mobile.png)

**Figure 22:** [Feed page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/feed.php) is where user's recipes are presented.

**UI19: Insert/Update Recipe - Information**

 Desktop                             | Mobile
 --------------------------------- |--------------------------------
 [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_information_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_information_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_information_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_information_mobile.png)

**Figure 23:** ["Upsert" recipe page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/createRecipe.php) is where user's recipes are created/updated (information).

**UI20: Insert/Update Recipe - Ingredients**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_ingredients_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_ingredients_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_ingredients_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_ingredients_mobile.png)

**Figure 24:** ["Upsert" recipe page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/createRecipe.php) is where user's recipes are created/updated (ingredients).

**UI21: Insert/Update Recipe - Method**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_method_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_method_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_method_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/upsert_recipe_method_mobile.png)

**Figure 25:** ["Upsert" recipe page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/createRecipe.php) is where user's recipes are created/updated (method).

**UI22: Recipe**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/recipe_desktop.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/recipe_desktop.jpg) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/recipe_mobile.jpg)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/recipe_mobile.jpg)

**Figure 26:** [Recipe page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/recipe.php) is where specific information regarding a recipe is presented.

**UI23: Create Group**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/create_group_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/create_group_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/create_group_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/create_group_mobile.png)

**Figure 27:** [Create group page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/create_group.php) is where groups made by people with common tastes are created.

**UI24: Edit Group**

 Desktop                             | Mobile
 --------------------------------- | ---------------------------------
[![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_group_desktop.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_group_desktop.png) | [![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_group_mobile.png)](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/er/interfaces/edit_group_mobile.png)

**Figure 28:** [Edit group page](http://lbaw2135-piu.lbaw-prod.fe.up.pt/pages/edit_group.php) is where a given group's information can be changed.

---


## Revision history

No changes made so far.
<!-- Changes made to the first submission:
1. Item 1
1. ... -->

***
GROUP2135, 15/03/2021

Alexandre Abreu, up201800168@fe.up.pt

Rafael Cristino, up201806680@fe.up.pt (Editor)

Rui Pinto, up201806441@fe.up.pt

Tiago Gomes, up201806658@fe.up.pt