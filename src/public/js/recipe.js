import { makeRequest } from './ajax/methods.js'
import { url } from './utils/url.js';
import { scrollToTargetCustom } from './utils/scrollToTargetCustom.js';
import { Feedback } from './feedback/Feedback.js';

let createCommentForm;
let ratingInput;
let stars;
let ratingInputCancel;

const notAdminOrExternalUser = document.body.contains(document.querySelector('form[name=createCommentForm]'));

if(notAdminOrExternalUser) {
    createCommentForm = document.querySelector('form[name=createCommentForm]');
    ratingInput = createCommentForm.querySelector('input[name=rating]');
    stars = document.querySelectorAll('.rating-input-star');
    ratingInputCancel = document.querySelector('#ratingInputCancel');

    ratingInputCancel.style.display = 'none';
}

const showRatingInputs = () => {
    const ratingInputs = document.querySelectorAll('.rating-input');
    for (const input of ratingInputs) {
        input.style.display = 'block';
    }
}

// TODO IF COMMENT WITH RATING IS DELETED, PUT DISPLAY = 'BLOCK' NO .rating-input

const starmark = (event) => {
    const count = event.target.id[0];
    if (event.type == 'click') {
        ratingInput.value = count;
        ratingInputCancel.style.display = 'inline';
    }

    const subid = event.target.id.substring(1);
    for (let i = 0; i < 5; i++) {
        const star = document.getElementById((i + 1) + subid);
        if (event.type == 'mouseout') {
            star.classList.remove("hover");
            continue;
        }
        if (i < count) {
            if (event.type == 'click') star.classList.add("active");
            else star.classList.add("hover");
        }
        else {
            if (event.type == 'click') star.classList.remove("active");
            else star.classList.remove("hover");
        }
    }
}

const removeRating = () => {
    ratingInput.value = 0;
    const subid = ratingInputCancel.nextElementSibling.id.substring(1);
    for (let i = 0; i < 5; i++) {
        const star = document.getElementById((i + 1) + subid);
        star.classList.remove("active");
    }
    ratingInputCancel.style.display = 'none';
}

if(notAdminOrExternalUser) {
    for (const star of stars) {
        star.addEventListener('click', starmark);
        star.addEventListener('mouseover', starmark);
        star.addEventListener('mouseout', starmark);
    }
    ratingInputCancel.addEventListener('click', removeRating);
}

const setErrorMessage = (message) => {
    const errorElements = document.querySelectorAll('.createCommentFormErrors');
    if (errorElements.length == 0) {
        createCommentForm.insertAdjacentHTML('beforebegin', `<div class="alert alert-danger createCommentFormErrors">
            ${message}
        </div>`);
    } else {
        for (const elem of errorElements) elem.innerText = message;
    }
}

const setReplyErrorMessage = (form, message) => {
    const errorElements = document.querySelectorAll('.createReplyFormErrors');
    if (errorElements.length == 0) {
        form.insertAdjacentHTML('beforebegin', `<div class="alert alert-danger createReplyFormErrors">
            ${message}
        </div>`);
    } else {
        for (const elem of errorElements) elem.innerText = message;
    }
}

const removeReplyErrorMessage = () => {
    const errorElements = document.querySelectorAll('.createReplyFormErrors');
    for (const elem of errorElements) elem.remove();
}

const removeCommentErrorMessage = () => {
    const errorElements = document.querySelectorAll('.createCommentFormErrors');
    for (const elem of errorElements) elem.remove();
}

const handleCommentFormSubmit = (event) => {
    event.preventDefault();
    const rating = createCommentForm.querySelector('input[name=rating]').value;
    const textarea = createCommentForm.querySelector('textarea[name=content]');
    const body = {
        'recipeId': createCommentForm.querySelector('input[name=recipeId]').value,
        'content': textarea.value
    };

    let hasRating = false;
    if (rating != '0' && rating != null) {
        body.rating = rating;
        hasRating = true;
    }
    makeRequest(url('/api/comment'), 'POST', body)
        .then((result) => {
            if (result.response.status == 200) {
                createCommentForm.previousElementSibling.insertAdjacentHTML('beforebegin', result.content.comment);
                textarea.value = '';
                if (hasRating) document.querySelector('.rating-input').style.display = 'none';
                removeCommentErrorMessage();
                removeRating();
                refreshCommentReplyButtons();
                refreshCommentEditButtons();
                refreshCommentDeleteButtons();
            } else {
                setErrorMessage(result.content.message);
            }
        });
}

const handleReplyFormSubmit = (event, form, comment) => {
    event.preventDefault();

    const parentCommentId = form.querySelector('input[name=parentCommentId]').value;
    const textarea = form.querySelector('textarea[name=content]');
    const depth = form.querySelector('input[name=depth]').value;
    const body = {
        recipeId: form.querySelector('input[name=recipeId]').value,
        content: textarea.value,
        parentCommentId,
        depth
    };

    makeRequest(url('/api/comment'), 'POST', body)
        .then((result) => {
            if (result.response.status == 200) {
                comment.insertAdjacentHTML('beforeend', result.content.comment);
                removeCreateReplyForm();
                removeReplyErrorMessage();
                refreshCommentReplyButtons();
                refreshCommentEditButtons();
                refreshCommentDeleteButtons();
            } else {
                setReplyErrorMessage(form, result.content.message);
            }
        });
}

if(notAdminOrExternalUser) {
    createCommentForm.addEventListener('submit', handleCommentFormSubmit);
}

const removeCreateReplyForm = () => {
    const forms = document.querySelectorAll('.createReplyFormWrapper');
    for (const form of forms) form.remove();
}

const getCreateReplyFormHTML = (parentComment) => {
    const recipeId = createCommentForm.querySelector('input[name=recipeId]').value;
    const parentCommentId = parentComment.dataset.commentId;
    const parentCommentDepth = parentComment.dataset.depth;
    return `
        <div class="createReplyFormWrapper">
            <h5 class="mt-2">Reply to comment</h5>
            <form name="createReplyForm" class="form-floating m-3 position-relative">
                <input type="hidden" name="recipeId" value="${recipeId}" />
                <input type="hidden" name="parentCommentId" value="${parentCommentId}" />
                <input type="hidden" name="depth" value="${parentCommentDepth+1}" />
                <textarea name="content" required max="512" id="replyContent" class="form-control" placeholder="Leave a comment here" style="height: 6rem"></textarea>
                <label for="replyContent">Your comment</label>
                <button type="submit" class="btn btn-primary position-absolute py-1 send">
                    <small>
                        <i class="fas fa-paper-plane me-2"></i>
                        Comment
                    </small>
                </button>
            </form>
        </div>
    `;
}

const getCommentElementFromActionButton = (action) => {
    let comment;
    if (action.tagName == 'I') comment = action.parentElement;  // makes element equal to the button
    else comment = action;

    return comment.parentElement.parentElement.parentElement.parentElement;
}

const showRecipeReplyForm = (event) => {
    removeCreateReplyForm();
    removeEditCommentForm();

    const comment = getCommentElementFromActionButton(event.target);


    comment.insertAdjacentHTML('beforeend', getCreateReplyFormHTML(comment));
    const form = comment.lastElementChild.lastElementChild;
    scrollToTargetCustom(form, window.innerHeight/3);
    const submitButton = form.querySelector('button[type=submit]');
    submitButton.addEventListener('click', (event) => handleReplyFormSubmit(event, form, comment));
    form.querySelector('textarea').focus();
}

let recipeCommentReplyButtons = [];

const refreshCommentReplyButtons = () => {
    const newButtons = document.querySelectorAll('.recipe-comment-reply-button');
    for (const button of newButtons) {
        if (!recipeCommentReplyButtons.includes(button)) {
            button.addEventListener('click', showRecipeReplyForm);
        }
    }
    recipeCommentReplyButtons = [...newButtons];
}

refreshCommentReplyButtons();

const removeEditCommentForm = () => {
    const forms = document.querySelectorAll(".edit-comment-form");
    for (const form of forms) {
        form.previousElementSibling.style.display = 'block';
        form.remove();
    }
}

const getEditContentInput = (preexistingContent) => {
    return `<form class="edit-comment-form">
        <textarea name="content" required max="512" id="commentContent" class="form-control" placeholder="Leave a comment here" style="height: 6rem">${preexistingContent}</textarea>
        <button class="btn btn-sm btn-primary mt-2" type="submit">Edit</button>
        <button class="btn btn-sm btn-outline-secondary cancel-edit mt-2 ms-2">Cancel</button>
    </form>`;
}

const showCommentEditForm = (event) => {
    removeCreateReplyForm();
    removeEditCommentForm();

    const comment = getCommentElementFromActionButton(event.target);
    if (comment.firstElementChild.classList.contains('alert')) comment.firstElementChild.remove();


    let commentContent = comment.firstElementChild.firstElementChild.nextElementSibling.firstElementChild.nextElementSibling;
    if (commentContent.tagName == 'DIV') commentContent = commentContent.nextElementSibling;

    commentContent.style.display = 'none';

    commentContent.insertAdjacentHTML('afterend', getEditContentInput(commentContent.innerText));

    const form = commentContent.nextElementSibling;

    const commentFeedback = new Feedback(comment.firstElementChild, "mx-3 mt-4");

    form.querySelector('.cancel-edit').addEventListener('click', () => {
        form.remove();
        commentContent.style.display = 'block';
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const content = form.firstElementChild.value;
        makeRequest(url(`api/comment/${comment.dataset.commentId}`), 'PUT', { content })
            .then((res) => {
                if (res.response.status != 200) {
                    commentFeedback.showMessage(res.content.message, 'danger');
                } else {
                    form.remove();
                    commentContent.style.display = 'block';
                    commentContent.innerText = content;
                    commentFeedback.showMessage("Comment edited successfully!");
                }
            });

    });
}

let recipeCommentEditButtons = [];

const refreshCommentEditButtons = () => {
    const newButtons = document.querySelectorAll('.recipe-comment-edit-button');
    for (const button of newButtons) {
        if (!recipeCommentEditButtons.includes(button)) {
            button.addEventListener('click', showCommentEditForm);
        }
    }
    recipeCommentEditButtons = [...newButtons];
}

refreshCommentEditButtons();


// ------------- DELETE COMMENT/REVIEW ------------- //

let recipeCommentDeleteButtons = [];

const refreshCommentDeleteButtons = () => {
    const newButtons = document.querySelectorAll('.recipe-comment-delete-button');
    for (const button of newButtons) {
        if (!recipeCommentDeleteButtons.includes(button)) {
            button.addEventListener('click', (event) => {
                const comment = getCommentElementFromActionButton(event.target);
                let commentFeedback;
                if(comment.parentElement.tagName == 'SECTION')
                    commentFeedback = new Feedback(comment, "mx-3 mt-4");
                else
                    commentFeedback = new Feedback(comment.parentElement.lastElementChild, "mx-3 mt-4");
                makeRequest(url(`api/comment/${comment.dataset.commentId}`), 'DELETE')
                .then((res) => {
                    if (res.response.status != 200) {
                        commentFeedback.showMessage(res.content.message, 'danger');
                    } else {
                        commentFeedback.showMessage("Comment(s) deleted successfully!");
                        if (comment.dataset.hasReview == "true") {
                            showRatingInputs();
                        }
                        comment.remove();
                    }
                });

            });
        }
    }
    recipeCommentDeleteButtons = [...newButtons];
}

refreshCommentDeleteButtons();

