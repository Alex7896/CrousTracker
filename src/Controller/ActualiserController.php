<?php

namespace App\Controller;

class ActualiserController
{
    public function index()
    {

        $url = "https://www.google.fr/maps/place/Restaurant+Universitaire+Puvis+de+Chavannes/@45.7721833,4.8631281,15z/data=!4m8!3m7!1s0x47f4eb5a3c74959b:0xe289fd652ff4cb88!8m2!3d45.7787853!4d4.8719782!9m1!1b1!16s%2Fg%2F11b8y_sp80?entry=ttu&g_ep=EgoyMDI1MDEyMi4wIKXMDSoASAFQAw%3D%3D";
        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

        // Execute cURL session and get the HTML content
        $htmlContent = curl_exec($ch);

        // Check for errors in cURL
        if(curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
            return;
        }

        // Close cURL session
        curl_close($ch);

        // Load HTML content into DOMDocument
        $doc = new \DOMDocument();
        @$doc->loadHTML($htmlContent); // Suppress warnings due to malformed HTML

        // Extract reviews or other content (you need to inspect the HTML structure)
        $xpath = new \DOMXPath($doc);
        $reviews = $xpath->query("//div[contains(@class, 'jftiEf fontBodyMedium')]");

        // Print reviews
        foreach ($reviews as $review) {
            $username = $review->getAttribute('aria-label');
            $reviewText = $this->getReviewText($review);
            $rating = $this->getRating($review);

            echo "Username: $username\n";
            echo "Review: $reviewText\n";
            echo "Rating: $rating\n\n";
        }
    }

    // Helper function to extract review text
    private function getReviewText($review)
    {
        $reviewTextNode = $review->getElementsByTagName('span')->item(0); // Adjust as needed
        return $reviewTextNode ? $reviewTextNode->textContent : 'No review text';
    }

    // Helper function to extract rating
    private function getRating($review)
    {
        $ratingNode = $review->getElementsByTagName('span')->item(1); // Adjust as needed
        return $ratingNode ? $ratingNode->getAttribute('aria-label') : 'No rating';
    }
}
