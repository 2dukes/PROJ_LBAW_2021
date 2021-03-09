<?php

$extraStyles = ["recipe.css", "../components/search_results_cards.css", "../components/cover.css", "../components/textareaWithButton.css"];

$extraScripts = ["../scripts/recipeYields.js"];

include "../components/docHeader.php";
include "../components/search_results_cards.php";

$author = false;

$recipe = [
    "name" => "Classic Tiramisu",
    "ingredients" => [
        "egg yolks" => "<span class=\"number\">6</span>",
        "white sugar" => "<span class=\"number\">1.25</span> cups",
        "mascarpone cheese" => "<span class=\"number\">1.25</span> cups",
        "heavy whipping cream" => "<span class=\"number\">1.75</span> cups",
        "coffee flavored liqueur" => "<span class=\"number\">0.33</span> cup",
        "ladyfingers" => "<span class=\"number\">12</span> ounce",
        "unsweetened cocoa powder" => "<span class=\"number\">1</span> teaspoon",
        "square semisweet chocolate" => "<span class=\"number\">1</span> ounce",
    ],
    "method" => [
        "Step 1" => "Combine egg yolks and sugar in the top of a double boiler, over boiling water. Reduce heat to low, and cook for about 10 minutes, stirring constantly. Remove from heat and whip yolks until thick and lemon colored.",
        "Step 2" => "Add mascarpone to whipped yolks. Beat until combined. In a separate bowl, whip cream to stiff peaks. Gently fold into yolk mixture and set aside.",
        "Step 3" => "Split the lady fingers in half, and line the bottom and sides of a large glass bowl. Brush with coffee liqueur. Spoon half of the cream filling over the lady fingers. Repeat ladyfingers, coffee liqueur and filling layers. Garnish with cocoa and chocolate curls. Refrigerate several hours or overnight.",
        "Step 4" => "To make the chocolate curls, use a vegetable peeler and run it down the edge of the chocolate bar."
    ],
    "comments" => [
        [
            "user" => "The Master Critic of Foods",
            "comment" => "Needs more salt!",
            "rate" => 3,
            "post" => "2 days ago",
            "edit" => "3 mins ago",
            "replies" => [
                [
                    "user" => "High Cholesterol Man",
                    "comment" => "I think it has more salt than needed.",
                    "post" => "2 hours ago",
                    "replies" => [
                        [
                            "user" => "The Master Critic of Foods",
                            "comment" => "How dare you question the Master Critic! I know better!",
                            "post" => "now",
                        ]
                    ]
                ]
            ]
        ],
        [
            "user" => "The Food Lover",
            "comment" => "I loved it!",
            "post" => "5 days ago",
        ]
    ]
];

function printInstruction($number, $name, $text, $image = null)
{ ?>
    <section class="instruction d-inline-block col-12">
        <h3 class="btn" data-bs-toggle="collapse" href="#instruction<?= $number ?>" role="button" aria-expanded="false" aria-controls="instruction<?= $number ?>">
            <i class="fas fa-check-circle d-inline-block align-middle"></i>
            <span class="d-inline-block align-middle"><?= $number ?>. <?= $name ?></span>
        </h3>
        <div class="collapse show" id="instruction<?= $number ?>">
            <div class="d-md-flex">
                <div class="col-md-<?= $image === null ? "12" : "8" ?> card card-body d-inline-block">
                    <?= $text ?>
                </div>
                <?php if ($image !== null) { ?>
                    <img class="col-12 col-md-3 d-inline-block" src="<?= $image ?>">
                <?php } ?>
            </div>
        </div>
    </section>
<?php }

function printMethod($method)
{
    $i = 1;
    foreach ($method as $name => $text) {
        printInstruction(
            $i++,
            $name,
            $text,
            $i % 3 != 0 ? "https://www.thespruceeats.com/thmb/OCytFbckS2guE73MmUTAGLw6D9k=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/cubes-of-tofu-168621031-588670e23df78c2ccdef8c7d.jpg" : null
        );
    }
}

function printComment($comment, $depth = 0)
{ ?>
    <div class="card comment <?= $depth !== 0 ? "subcomment" : "" ?>">
        <div class=" row g-0 p-3 d-flex">
            <img class="d-none d-md-inline-block rounded-circle" src="../images/people/<?= $comment["user"] ?>.jpg" alt="...">
            <div class="col-md-<?= 9 - round($depth / 2) ?> card-body">
                <h5 class="card-title"><a href="#"><?= $comment["user"] ?></a> <?= key_exists("rate", $comment) ? "reviewed" : "commented" ?>:</h5>
                <?php if (key_exists("rate", $comment)) { ?>
                    <div class="rating">
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star checked"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                <?php } ?>
                <p class="card-text"><?= $comment["comment"] ?></p>
                <p class="card-text">
                    <small class="text-muted">
                        <?= key_exists("edit", $comment) ? "Edited " . $comment["edit"] : $comment["post"] ?>
                    </small>
                </p>
            </div>
        </div>
        <?php if (key_exists("replies", $comment)) printComment($comment["replies"][0], $depth + 1) ?>
    </div>
<?php }

function printBoxContent($array)
{ ?>
    <table class="table table-borderless">
        <?php foreach ($array as $item => $value) { ?>
            <tr>
                <td><?= $item ?></td>
                <td><?= $value ?></td>
            </tr>
        <?php } ?>
    </table>
<?php }

function printBoxes($mobile = false)
{ ?>
    <div class="<?= $mobile ? "d-block d-md-none" : "d-none d-md-block" ?>">
        <div class="media my-4 my-md-0">
            <img class="img-fluid main" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
            <div class="small-img d-flex">
                <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
                <img class="col-3" src="https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/587/original/la-ricetta-classica-del-tiramisu-con-uova-savoiardi-e-mascarpone-1920x1080.jpg?1567093636">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <section class="icon-box">
                    <i class="fas fa-clock"></i>
                    <? printBoxContent([
                        "Duration" => "45 mins",
                        "Preparation" => "15 mins",
                        "Cooking" => "30 mins",
                        "Additional" => "-"
                    ]) ?>
                </section>
                <section class="icon-box p-2 mt-4 mt-md-0">
                    <i class="fas fa-chart-bar"></i>
                    <form>
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td>
                                    <label for="yieldsInput" class="form-label">Yields</label>
                                </td>
                                <td>
                                    <span class="number">3</span> servings
                                </td>
                            </tr>
                        </table>
                        <input type="range" class="form-range" min="1" max="10" id="yieldsInput" value="3">
                        <input class="p-1" type="reset" onclick="calculateQuantities()" value="Reset servings">
                    </form>
                </section>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <section class="icon-box pb-2">
                    <i class="fas fa-list"></i>
                    <? printBoxContent([
                        "Energy" => "579 cal",
                        "Sugars" => "52.7 g",
                        "Fat" => "39.6 g"
                    ]) ?>
                    <input class="p-1" type="reset" onclick="showNutritionModal()" value="See all">
                </section>
            </div>
        </div>
    </div>
<?php } ?>

<?php
include "../components/nav.php";
include "../components/breadcrumb.php";
?>

<main class="row content-general-margin">
    <ul id="tags">
        <li class="badge rounded-pill bg-secondary">Vegan</li>
        <li class="badge rounded-pill bg-secondary">French Cuisine</li>
        <li class="badge rounded-pill bg-secondary">Low Calorie</li>
    </ul>
    <article id="recipe" class="col-md-8">
        <header class="row text-left pt-3 m-md-3">
            <h1 class="col-11">Classic Tiramisu</h1>
            <div class="col-9">
                <div class="rating">
                    <span class="small">34 ratings</span>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star checked"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="row g-0 py-2 text-center text-md-start">
                    <table>
                        <tbody>
                            <tr>
                                <td class="col-2 col-md-1 image-container">
                                    <img class="rounded-circle" src="https://thispersondoesnotexist.com/image" alt="...">
                                </td>
                                <td class="align-middle">
                                    <div class="col-md-5 card-body p-0 m-0 ms-2 text-start">
                                        by <a href="#">Alex Johnson</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p>These vegan meringues use the liquid from a tin of chickpeas as the substitute for egg whites - genius! Use these vegan meringues wherever you would use egg white meringue such as summer fruit pavlova and Eton mess.</p>
            </div>
            <ul class="col-3 text-end">
                <li class="list-group-item">
                    <a href="#">
                        <span class="legend">Print</span><i class="fas fa-print"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <span class="legend">Share</span><i class="fas fa-share-alt"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <?php if ($author) { ?>
                        <a href="#">
                            <span class="legend">Edit</span><i class="fas fa-edit"></i>
                        </a>
                    <?php } else { ?>
                        <a href="#">
                            <span class="legend">Favourite</span><i class="fas fa-heart"></i>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </header>
        <?php printBoxes(true) ?>
        <section id="ingredients">
            <h2>Ingredients</h2>
            <table class="table table-striped p-3">
                <?php
                foreach ($recipe["ingredients"] as $ingredient => $quantity) { ?>
                    <tr>
                        <td class="quantity"><?= $quantity ?></td>
                        <td><?= $ingredient ?></td>
                    </tr>
                <?php } ?>
            </table>
        </section>
        <section id="method">
            <h2>Method</h2>
            <?php printMethod($recipe["method"]);
            ?>
        </section>
        <section class="icon-box mt-4 mt-md-0" id="comments">
            <i class="fas fa-comments"></i>
            <?php
            foreach ($recipe["comments"] as $i => $comment)
                printComment($comment);
            include "../components/textareaWithButton.php";
            ?>
        </section>
    </article>
    <aside class="col-md-4">
        <?php printBoxes() ?>
        <div class="suggested">
            <h2 class="text-center">Suggested</h2>
            <?php
            for ($i = 0; $i < 4; $i++)
                getRecipeCard()
            ?>
        </div>
    </aside>
</main>

<?php
include "../components/footer.php";
include "../components/docFooter.php";
?>