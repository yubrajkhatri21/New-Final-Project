document.getElementById('commentForm').addEventListener('submit', function (e) {
    const restrictedWords = ['badword1', 'badword2', 'spamword'];
    const comment = document.getElementById('comment').value;

    for (const word of restrictedWords) {
        if (comment.includes(word)) {
            alert('Your comment contains inappropriate content.');
            e.preventDefault();
            return;
        }
    }
});