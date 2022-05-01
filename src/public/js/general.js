import { makeRequest } from "./ajax/methods.js";
import { instantiateToolTip } from "./utils/tooltip.js";
import { url } from "./utils/url.js";

document.body.style.minHeight = window.innerHeight + "px";

window.addEventListener('resize', () => {
    document.body.style.minHeight = window.innerHeight + "px"
    document.body.style.paddingTop = window.getComputedStyle(header).height
});

const tooltips = Array.from(document.querySelectorAll('.has-tooltip'));
tooltips.forEach(elem => instantiateToolTip(elem));


const header = document.querySelector('body > nav.navbar');
let calculationCounter = 0;
let last = null;

const interval = setInterval(() => {
    calculationCounter++;
    const newHeight = window.getComputedStyle(header).height;
    if (last !== null && newHeight >= last) {
        if (calculationCounter > 10) clearInterval(interval);
        return;
    }
    last = Number.parseFloat(newHeight);
    document.body.style.paddingTop = newHeight;
    if (calculationCounter > 2) clearInterval(interval);
}, 200);  // sometimes there were problems in the calculation


/**
 * Deals with favourite buttons
 */
const favouriteButtons = document.querySelectorAll(".add-to-favourites-recipe-button");
for (const button of favouriteButtons) {
    button.addEventListener('click', function(event) {
        const recipeId = event.target.parentElement.dataset.recipeId || event.target.dataset.recipeId;

        let favouriteState = event.target.parentElement.dataset.favouriteState || event.target.dataset.favouriteState;
        favouriteState = favouriteState == "true";

        const rootUrl = document.body.dataset.rootUrl;

        makeRequest(`${rootUrl}/api/recipe/${recipeId}/favourite`, favouriteState ? 'DELETE' : 'POST')
            .then((result) => {
                if (result.response.status != 200) {
                    console.error("ERROR in favourites", result);
                    return;
                }
                const change = (el) => {
                    if (el.dataset.favouriteState != null) el.dataset.favouriteState = !favouriteState;
                }
                change(event.target.parentElement);
                change(event.target);

                if (button.dataset.completeText) {
                    const span = button.querySelector('span');
                    if (span) span.innerText = !favouriteState ? "Remove from Favourites" : "Add to Favourites";
                }
            });
    });

}


const dropdownMenus = document.querySelectorAll('.dropdown-menu');

dropdownMenus.forEach(menu => menu.addEventListener('click', event => event.stopPropagation()));  // clicks inside the dropdown menu don't cause it to close


const buttonLinks = document.querySelectorAll('button.has-link');

for (const link of buttonLinks) {
    link.addEventListener('click', () => window.open(link.dataset.href, '_self'));
}

const deleteRecipeButtons = document.querySelectorAll('.deleteRecipePreviewButton');
for (const button of deleteRecipeButtons) {
    button.addEventListener('click', () => {
        makeRequest(url(`api/recipe/${button.dataset.data}`), 'DELETE')
            .then((res) => {
                if (res.response.status != 200) return;
                const card = button.parentElement.parentElement.parentElement.parentElement.parentElement;
                card.remove();
            })
    })
}


const deleteReviewButtons = document.querySelectorAll('.deleteReviewPreviewButton');
for (const button of deleteReviewButtons) {
    button.addEventListener('click', () => {
        makeRequest(url(`api/comment/${button.dataset.data}`), 'DELETE')
            .then((res) => {
                if (res.response.status != 200) return;
                const card = button.parentElement.parentElement.parentElement.parentElement.parentElement;
                card.remove();
            })
    })
}
