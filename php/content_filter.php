function filterContent($input) {
    // List of restricted words
    $restrictedWords = ['badword1', 'badword2', 'spamword'];

    // Replace restricted words with asterisks
    foreach ($restrictedWords as $word) {
        $input = preg_replace('/\b' . preg_quote($word, '/') . '\b/i', '****', $input);
    }

    return $input;
}