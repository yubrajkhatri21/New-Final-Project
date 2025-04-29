<?php
function filterContent($input) {
    // List of restricted patterns
    $patterns = [
        '/\b(?:badword1|badword2|spamword)\b/i', // Restricted words
        '/https?:\/\/[^\s]+/i',                 // URLs
        '/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/i' // Email addresses
    ];

    // Replace matches with asterisks
    foreach ($patterns as $pattern) {
        $input = preg_replace($pattern, '****', $input);
    }

    return $input;
}

$query = "SELECT * FROM comments ORDER BY created_at DESC";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo '<p>' . htmlspecialchars(filterContent($row['comment'])) . '</p>';
}