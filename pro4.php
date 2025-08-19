<?php
/* Write a program for Text Analyzer. Accepts a paragraph, Show word count, character count, 
reverse string and check if the string is a palindrome or not. */

function wordCount($text) {
    return str_word_count($text);
}

function charCount($text) {
    return strlen($text);
}

function reverseString($text) {
    return strrev($text);
}

function isPalindrome($text) {
    $clean = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $text));
    return $clean === strrev($clean);
}

function countVowelsAndConsonants($text) {
    $vowels = preg_match_all('/[aeiouAEIOU]/', $text);
    $consonants = preg_match_all('/[bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ]/', $text);
    return [$vowels, $consonants];
}

$results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST["text"];

    $results['wordCount'] = wordCount($input);
    $results['charCount'] = charCount($input);
    $results['reverse'] = reverseString($input);
    $results['palindrome'] = isPalindrome($input) ? "Yes" : "No";
    list($vowels, $consonants) = countVowelsAndConsonants($input);
    $results['vowels'] = $vowels;
    $results['consonants'] = $consonants;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>String Analyzer</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 40px; }
        .container { background: white; padding: 25px; width: 600px; margin: auto; box-shadow: 0 0 10px #ccc; border-radius: 10px; }
        textarea, input[type="submit"] { width: 100%; padding: 10px; margin-top: 10px; }
        .result { margin-top: 20px; background: #e8f5e9; padding: 15px; border-left: 4px solid #2e7d32; }
    </style>
</head>
<body>
<div class="container">
    <h2>String Analyzer Tool</h2>
    <form method="post">
        <textarea name="text" rows="5" placeholder="Enter your text here..." required><?= $_POST['text'] ?? '' ?></textarea>
        <input type="submit" value="Analyze">
    </form>

    <?php if (!empty($results)): ?>
    <div class="result">
        <p><strong>Word Count:</strong> <?= $results['wordCount'] ?></p>
        <p><strong>Character Count:</strong> <?= $results['charCount'] ?></p>
        <p><strong>Reversed Text:</strong> <?= htmlspecialchars($results['reverse']) ?></p>
        <p><strong>Palindrome:</strong> <?= $results['palindrome'] ?></p>
        <p><strong>Vowels:</strong> <?= $results['vowels'] ?> | <strong>Consonants:</strong> <?= $results['consonants'] ?></p>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
