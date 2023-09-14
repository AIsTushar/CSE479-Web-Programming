<?php

// Function to read and process file content to extract words
function extractWordsFromFile($filename) {
    $content = file_get_contents($filename);
    // Remove special characters and convert to lowercase
    $words = preg_replace('/[^a-zA-Z0-9]+/', ' ', $content);
    $words = strtolower($words);
    // Split content into an array of words
    $words = explode(' ', $words);
    // Remove empty values and duplicates
    $words = array_filter(array_unique($words));
    return $words;
}

// Function to calculate Jaccard similarity between two sets
function jaccardSimilarity($set1, $set2) {
    $intersection = array_intersect($set1, $set2);
    $union = array_merge($set1, $set2);
    $similarity = count($intersection) / count($union);
    return $similarity;
}

function compareFiles($file1, $file2) {
 
    $words1 = extractWordsFromFile($file1);
    $words2 = extractWordsFromFile($file2);
   
    $similarity = jaccardSimilarity($words1, $words2);

    return $similarity;
}

// File paths
$file1 = 'file1.txt';
$file2 = 'file2.txt';

// Call the function 
$similarityScore = compareFiles($file1, $file2);

// Output the similarity score
echo "Jaccard Similarity: " . $similarityScore . "\n";
?>
