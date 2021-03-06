<?php

$owner = true;
$pageTitle = "Jamie Oliver's Profile | TasteBuds";
$extraStyles = [
    "../components/navPopups.css",
    "../components/profile_cover.css",
    "../components/post.css",
    "../components/membersFollowingBoxes.css",
    "../components/breadcrumb.css",
    "group.css"
];
$extraScripts = [
    "../components/membersFollowingBoxes.js",
    "../components/navPopups.js",
    "../scripts/addToFavourites.js"
];
$role = "member";
include_once "../components/docHeader.php";
include_once "../components/nav.php";
include_once "../components/post.php";
include_once "../components/breadcrumb.php";
include_once "../components/membersFollowingBoxes.php";

?>

<main class="content-general-padding margin-to-footer">
    <?php drawBreadcrumb(["Profiles", "Jamie Oliver's Profile"], true); ?>
    <div>
        <div class="cover">

            <?php $section = 2;
            include_once "../components/profile_cover.php"; ?>
        </div>
        <div class="row group-body">
            <div class="col-md-4 p-0 pe-md-4 mt-5">
                <div class="card m-0 mb-4 shadow-sm text-center p-3 personal-info">
                    <h4>Personal Info</h4>
                    <div class="text-start m-auto d-inline">
                        <span><i class="fas fa-map-marker-alt"></i>Ruílhe, Portugal</span>
                        <br>
                        <span><i class="fas fa-birthday-cake"></i>Joined in Jul 2020</span>
                    </div>
                    <a class="btn btn-primary mt-2" href="<?= getRootUrl() . "/pages/createRecipe.php" ?>">Create Recipe</a>
                    <a class="btn btn-primary mt-2" href="<?= getRootUrl() . "/pages/create_group.php" ?>">Create Group</a>
                </div>
                <?php displayPeopleBox("Following"); ?>
                <div class="card shadow-sm people-box mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Groups</h5>
                        <div class="g-5 mb-5">
                            <div class="mt-4">
                                <button class="btn small-profile-photo small-group-photo d-inline"></button>
                                <span class="name">Vegetarianos do Porto</span>
                            </div>
                            <div class="mt-4">
                                <button class="btn small-profile-photo small-group-photo d-inline"></button>
                                <span class="name">Receitas da avó</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary">
                            <small><i class="fas fa-plus me-2"></i> See all groups</small>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-8 posts-area ps-md-4 mt-5">
                <h3>Recipe Reviews</h3>
                <div class="row first-recipe-mt">
                    <?php
                    displayReview(false, "Absolutely delicius! Explosion of flavour...", "Jamie Oliver", "https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg", "1 January, 2021", "Traditional Irish Stew", "https://www.thespruceeats.com/thmb/AhWrgq_6_WUp6Vezr69PdbLC_tM=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/traditional-irish-stew-recipe-435757-hero-01-7ec7d4b8688a424d93b080f000ab53ff.jpg");
                    displayReview(false, "The best blueberry pie I've seen! It doesn't disappoint!", "Jamie Oliver", "https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg", "1 January, 2021", "Classic Double Crust Blueberry Pie", "https://www.thespruceeats.com/thmb/l_HEh1Z__Tb43dgZqC3ySmNnOdY=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/classic-double-crust-blueberry-pie-3051709-hero-01-e3db9e34e7dc416ba9b5d48a22f947f1.jpg");
                    ?>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-dark load-more w-25 mt-5 mx-auto">Load More</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once "../components/footer.php";
include_once "../components/docFooter.php";
?>