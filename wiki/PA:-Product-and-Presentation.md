TasteBuds helps people build a community of diverse, healthy and tasty eating habits.

## A9: Product

In this artifact, we present our website's installation process and usage, as well as some implementation details.

### 1. Installation

The release with the final version of the source code on the group's git repository can be found [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/releases/PA).

The group's Docker Hub image can be obtained by executing the following command:

```bash
docker pull lbaw2135/lbaw2135
```

The group's Docker Hub image can be ran by executing the following command:

```bash
docker run -it -p 8000:80 -e DB_DATABASE="lbaw2135" -e DB_USERNAME="lbaw2135" -e DB_PASSWORD="MB781648" lbaw2135/lbaw2135
```

### 2. Usage

The product can be found [here](http://lbaw2135.lbaw-prod.fe.up.pt).

#### 2.1. Administration Credentials

The main administration page can be found [here](http://lbaw2135.lbaw-prod.fe.up.pt/admin/users).

Username         | Password
---------------- | ---------
2dukes           | 123456789
a3brx            | 123456789
rafaavc          | 123456789
TiagooGomess     | 123456789

#### 2.2. User Credentials

Type            | Username                                                                              | Password  | Notes
--------------- | ------------------------------------------------------------------------------------- | --------- | -----------------------------------------------------------------------
Private member  | [caramelized_charlene](http://lbaw2135.lbaw-prod.fe.up.pt/user/caramelized_charlene)  | 123456789 | 
Public member   | [gdeter](http://lbaw2135.lbaw-prod.fe.up.pt/user/gdeter)                              | 123456789 | 
Public member   | [cuban](http://lbaw2135.lbaw-prod.fe.up.pt/user/cuban)                                | 123456789 | Moderator of [Chefs Vision](http://lbaw2135.lbaw-prod.fe.up.pt/group/3)
Private member   | [gcurvy](http://lbaw2135.lbaw-prod.fe.up.pt/user/gcurvy)                             | 123456789 | Moderator of [Bonk a Donk Cookers](http://lbaw2135.lbaw-prod.fe.up.pt/group/2) (public group with a lot of members)
Private member   | [badcharlene](http://lbaw2135.lbaw-prod.fe.up.pt/user/badcharlene)                   | 123456789 | Moderator of [Back To The Basics](http://lbaw2135.lbaw-prod.fe.up.pt/group/1) (private group with member requests)
Public member   | [gmiddle](http://lbaw2135.lbaw-prod.fe.up.pt/user/gmiddle)                            | 123456789 | Member of [Chefs Vision](http://lbaw2135.lbaw-prod.fe.up.pt/group/3)
Private member  | [larboardg](http://lbaw2135.lbaw-prod.fe.up.pt/user/larboardg)                        | 123456789 | Has made three posts
Private member  | [rafaela_almeida](http://lbaw2135.lbaw-prod.fe.up.pt/user/rafaela_almeida)            | 123456789 | Is moderator of the group [Vegetarianos do Porto!](http://lbaw2135.lbaw-prod.fe.up.pt/group/76) (private group with one recipe)
Banned user     | [warlike](http://lbaw2135.lbaw-prod.fe.up.pt/user/warlike)                            | 123456789 | Needs login to see that it's banned

### 3. Application Help

Regarding the global help, TasteBuds has a Frequently Asked Questions page, where the users can view the aswers to the most frequent questions and learn how to utilize the website.

![FAQ](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/help/faq.png)

The website has also contextual help tooltips in almost any button or input that are not completely trivial to understand.

Some examples of this are:

![Show or hide step help](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/help/step.png)

![Follow member help](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/help/follow.jpg)

![Print help](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/help/print.png)

### 4. Input Validation


For the **client-side validation**, the best example we can show is when a new user tries to register on our website. There we check if the selected username and email don't collide with an already used username or email with AJAX. The following piece of code can be found [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/public/js/signUp.js#L73).

```javascript
const signUpValidation = () => {
    let usernameInput = document.querySelector('input[name="username"]');
    let emailInput = document.querySelector('input[name="email"]');

    emailInput.addEventListener('blur', (event) => {
        const email = emailInput.value;

        makeRequest(url(`api/validation/email`), 'GET', { email: email })
        .then(res => {
            if (res.response.status != 200) {
                if(!emailRepeated) {
                    emailInput.parentElement.insertAdjacentHTML('afterend', `<p class="email-repeated" style="font-size: 0.9rem; color: red;">Repeated email. Please enter another.</p>`);
                    emailRepeated = true;
                }
            } else if(emailRepeated) {
                document.querySelector('p.email-repeated').remove();
                emailRepeated = false;
            }
        });
    });

    usernameInput.addEventListener('blur', (event) => {
        const username = usernameInput.value;

        makeRequest(url(`api/validation/username`), 'GET', { username: username })
        .then(res => {
            if (res.response.status != 200) {
                if(!usernameRepeated) {
                    usernameInput.parentElement.insertAdjacentHTML('afterend', `<p class="username-repeated" style="font-size: 0.9rem; color: red;">Repeated username. Please enter another.</p>`);
                    usernameRepeated = true;
                }
            } else if(usernameRepeated) {
                document.querySelector('p.username-repeated').remove();
                usernameRepeated = false;
            }
        });


    });
};
```

Regarding **server-side validation**, the following example shows all fields that are validated when a new recipe is created. We define a [validator](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/app/Http/Controllers/RecipeController.php#L24) and then we use it upon [creating a recipe](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/app/Http/Controllers/RecipeController.php#L191).

```php
    private static $validation = [
        'name' => 'required|string|min:5|max:100',
        'category' => 'required|integer|exists:App\Models\Category,id',
        'description' => 'required|string|min:10|max:1024',
        'difficulty' => 'required|string|in:easy,medium,hard,very hard',
        'servings' => 'required|integer|min:1',
        'tags' => 'required|array',
        'tags.*' => 'integer|exists:App\Models\Tag,id|distinct',
        'ingredients' => 'required|array',
        'ingredients.*.quantity' => 'required|numeric|min:0',
        'ingredients.*.id_unit' => 'required|integer|exists:App\Models\Unit,id',
        'ingredients.*.id' => 'required|integer|exists:App\Models\Ingredient,id|distinct',
        'preparation_time' => 'required|integer|min:0',
        'cooking_time' => 'required|integer|min:0',
        'additional_time' => 'required|integer|min:0',
        'steps' => 'required|array',
        'steps.*.name' => 'nullable|string|max:30',
        'steps.*.description' => 'required|string|max:512|min:10',
        'steps.*.image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,bmp',
        'images.*' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,bmp'
    ];

    private static $errorMessages = [
        'tags.*.distinct' => 'Repeated tags are not allowed.',
        'tags.*.*' => 'Invalid Tag.',
        'ingredients.*.quantity.*' => 'Invalid quantity.',
        'ingredients.*.id_unit.*' => 'Invalid unit.',
        'ingredients.*.id.distinct' => 'Repeated ingredients are not allowed.',
        'ingredients.*.id.*' => 'Invalid ingredient.',
        'steps.*.name.*' => 'Invalid Step name.'
    ];
    
    public function createRecipe(Request $request)
    {
        $this->validate($request, 
            RecipeController::$validation,
            RecipeController::$errorMessages);
         
        (...)
    }
```

### 5. Check Accessibility and Usability

- Accessibility: 15/18
- Usability: 26/28

The PDF files with the complete results can be accessed by the following links: [accessibility](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/reports/AccessibilityChecklist.pdf) and [usability](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/reports/UsabilityChecklist.pdf).

### 6. HTML & CSS Validation

The following HTML reports were made:
- [Home page](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/reports/homepage.html.pdf)
- [Recipe page with comments](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/reports/recipe.html.pdf)

The followinc CSS reports were made:
- [Sign-In](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/reports/signInValidationCSS.pdf)
- [Sign-Up](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/reports/signUpValidationCSS.pdf)
- [Chat](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/reports/privateMessagesValidationCSS.pdf)

### 7. Revisions to the Project

- Recipes don't have visibility anymore, their visibility is calculated as follows:
    - If the recipe was posted in a group its visibility is the same as the group
    - Otherwise, the recipe has the same visibility as its author
- New database table for the reset password feature
- Updated a few routes and added new ones

### 8. Implementation Details

#### 8.1. Libraries Used

Library name                             | Description           | Usage | Example
---------------------------------------- | --------------------- | ----- | -------
[Font Awesome](https://fontawesome.com/) | Font and icon toolkit | Used for icons in buttons and texts | [Link](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/resources/views/layouts/app.blade.php#L38)
[Bootstrap](https://getbootstrap.com/) | Free and open-source CSS framework directed at responsive, mobile-first front-end web development | Used in all pages to help with the interface | [Link](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/resources/views/layouts/app.blade.php#L34)
[Laravel](https://laravel.com/) | Free and open-source PHP web framework intended for the development of web applications | Used as main server framework for our project | [Link](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/resources/views/layouts/app.blade.php)
[Pusher](https://pusher.com/) | A real-time communication layer between the server and the client. It maintains persistent connections using WebSockets | Used in our chat | [Link](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/resources/assets/js/app.js#L5)
[Vue.js](https://vuejs.org/) | An open-source progressive JavaScript framework | Used in the development of the real-time chat | [Link](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/resources/assets/js/app.js#L19)
[GD](https://www.php.net/manual/en/book.image.php) | A PHP library that enables it to create and manipulate image files in a variety of different image formats | Used for image conversion | [Link](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/app/Http/Controllers/ImageUploadController.php#L42)
[Laravel Echo](https://www.npmjs.com/package/laravel-echo) | A JavaScript library that makes it painless to subscribe to channels and listen for events broadcast by Laravel | Used for the subscription of the broadcast channel used to exchange messages in the chat | [Link](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/src/resources/assets/js/app.js#L28)

#### 8.2 User Stories

US Identifier | Name                              | Module | Priority | Team Members               | State
------------- | --------------------------------- | ------ | -------- | -------------------------- | ---------
US11          | See home                          | M04    | high     | **Rafael**                 | 100%
US16          | Read reviews                      | M02    | high     | **Rafael**                 | 100%
US17          | View a recipe                     | M02    | high     | **Alexandre**, **Rafael**  | 100%
US21          | Sign-in                           | M01    | high     | **Tiago**                  | 100%
US22          | Sign-up                           | M01    | high     | **Alexandre**              | 100%
US39          | Post a recipe                     | M02    | high     | **Alexandre**, **Tiago**   | 100%
US310         | Sign out                          | M01    | high     | **Tiago**                  | 100%
US41          | Update a recipe                   | M02    | high     | **Rui**                    | 100%
US42          | Delete a recipe                   | M02    | high     | **Alexandre**, **Rafael**  | 100%
US315         | Save recipe                       | M02    | medium   | **Rafael**                 | 100%
US15          | View public profiles              | M02    | high     | **Alexandre**              | 100%
US31          | Edit profile                      | M01    | high     | **Alexandre**              | 100%
US36          | Change visibility of profile      | M01    | high     | **Alexandre**              | 100%
US32          | Delete profile                    | M01    | high     | **Alexandre**              | 100%
US94          | Sign out                          | M05    | high     | **Tiago**                  | 100%
US12          | Search                            | M02    | high     | **Rui**                    | 100%
US37          | Create comment                    | M02    | high     | **Rafael**                 | 100%
US38          | Rate a recipe                     | M02    | high     | **Rafael**                 | 100%
US34          | Follow users                      | M02    | high     | **Rui**                    | 100%
US35          | View private profiles             | M02    | high     | **Tiago**                  | 100%
US14          | See about                         | M04    | high     | **Tiago**                  | 100%
US19          | View Frequently Asked Questions   | M04    | medium   | **Tiago**                  | 100%
US62          | See group posts                   | M02    | high     | **Alexandre**              | 100%
US311         | Create Groups                     | M02    | high     | **Tiago**                  | 100%
US72          | Edit group                        | M02    | high     | **Tiago**                  | 100%
US13          | Filter                            | M02    | high     | **Rafael**                 | 100%
US33          | Accept requests to follow         | M01    | high     | **Rui**                    | 100%
US312         | Send group membership requests    | M02    | high     | **Alexandre**              | 100%
US313         | Join public groups                | M02    | high     | **Alexandre**              | 100%
US95          | Access private groups             | M02    | medium   | **Alexandre**              | 100%
US71          | Ban people from the group         | M02    | high     | **Rafael**                 | 100%
US73          | Manage membership requests        | M02    | high     | **Rafael**                 | 100%
US93          | Ban users                         | M05    | high     | **Rui**                    | 100%
US91          | Post removal                      | M05    | high     | **Rafael**                 | 100%
US25          | Recover my account                | M01    | medium   | **Tiago**                  | 100%
US92          | Comment or review removal         | M05    | high     | **Rui**                    | 100%
US61          | Post to group                     | M02    | high     | **Tiago**                  | 100%
US52          | Remove comment                    | M02    | medium   | **Rui**                    | 100%
US74          | Remove comments or posts          | M02    | medium   | **Alexandre**              | 100%
US314         | View suggested recipes (feed)     | M02    | medium   | **Tiago**                  | 100%
US316         | Send and receive direct message   | M03    | medium   | **Rafael**, **Rui**        | 100%
US110         | Share recipe                      | M02    | medium   | **Alexandre**              | 100%
US63          | Exit group                        | M02    | high     | **Alexandre**              | 100%
US51          | Update comment                    | M02    | medium   | **Rafael**                 | 100%

---

## A10: Presentation
 
In this artefact we present the final TasteBuds product, a culmination of all that was developed throughout the semester.

### 1. Product presentation

TasteBuds is a new concept of a social network that enables people to share cooking recipes with the world, gain visibility, and possibly attracting new people to their business or any other ventures. Cooking is one of the things we do every day, and TasteBuds is the best tool to ease the task of remembering all the cooking recipes while helping people diversify and improve their eating habits. 

You can be part of groups full of recipes, chat with everyone and search for whatever recipe you wish to cook! TasteBuds' main goal is to build a community where people can help each other create even better recipes every day!

The product can be found [here](http://lbaw2135.lbaw-prod.fe.up.pt).

### 2. Video presentation

![Video Thumbnail](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/pa/thumbnail.png)

The video can be found in a Google Drive [here](https://drive.google.com/file/d/1xNgW7e_RoYZQh1DOIOd15Fho0_UzCMog/view?usp=sharing).


## Revision history

No changes made after the first submission.

---

GROUP2135, 09/06/21

Alexandre Abreu, [up201800168@fe.up.pt](mailto:up201800168@fe.up.pt)

Rafael Cristino, [up201806680@fe.up.pt](mailto:up201806680@fe.up.pt)

Rui Pinto, [up201806441@fe.up.pt](mailto:up201806441@fe.up.pt) (Editor)

Tiago Gomes, [up201806658@fe.up.pt](mailto:up201806658@fe.up.pt)