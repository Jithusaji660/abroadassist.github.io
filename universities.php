<?php
// universities.php

$universities = [
    "United States" => [
        "Famous Universities" => ["Harvard University", "Stanford University", "MIT"],
        "Famous Colleges" => ["Williams College", "Amherst College", "Swarthmore College"],
        "Programs Offered" => ["Engineering", "Business", "Arts", "Medicine"],
        "Admission Requirements" => ["SAT/ACT scores", "High School Transcripts", "Letters of Recommendation"]
    ],
    "United Kingdom" => [
        "Famous Universities" => ["University of Oxford", "University of Cambridge", "Imperial College London"],
        "Famous Colleges" => ["London School of Economics", "University College London"],
        "Programs Offered" => ["Humanities", "Science", "Engineering"],
        "Admission Requirements" => ["A-Level results", "Personal Statement", "References"]
    ],
    // Add more countries and details as needed
];

function displayUniversityInfo($country) {
    global $universities;
    if (isset($universities[$country])) {
        $info = $universities[$country];
        echo "<h3>Details for $country</h3>";
        foreach ($info as $key => $value) {
            echo "<h4>$key:</h4>";
            echo "<ul>";
            foreach ($value as $item) {
                echo "<li>$item</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<p>No information available for $country.</p>";
    }
}
?>
