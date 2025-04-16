<?php

    $conn= new mysqli("localhost","root","","talktome");
    if ($conn->connect_error){
    die("Connection failed:  ".$database->connect_error);
    }

    function tokenize($text) {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);
        return array_filter(explode(' ', $text));
    }

    function getFrequencyVector($words){
        $vector == [];
        foreach($words as $word){
            $vector[$word] = isset($vector[$word]) ? $vector[$word] + 1 : 1;
        }
        return $vector;
    }

    function cosine_similarity($vector1, $vector2){
        $dotProduct = 0;
        $magnitudeA = 0;
        $magnitudeB = 0;

        $allword = array_unique(array_merge(array_keys($vector1), array_keys($vector2)));

        foreach($allword as $word){
            $a = $vector1[$word] ?? 0;
            $b = $vector2[$word] ?? 0;
            $dotProduct += $a * $b;
            $magnitudeA += $a * $a;
            $magnitudeB += $b * $b;
        }

        if($magnitudeA == 0 || $magnitudeB == 0) return 0;

        return $dotProduct / sqrt($magnitudeA) * sqrt($magnitudeB);
    }

    function getRecommendation($userInputText) {
        global $conn;
        $result = $conn->query("SELECT * from doctor LEFT JOIN specialties on doctor.specialties = specialties.id");
        $user_words= tokenize($userInputText);
        $user_vector = getFrequencyVector($user_words);

        $recommendation = [];
        while($row = $result->fetch_assoc()){
            $doc_words = tokenize($row['keywords']);
            $doc_vector = getFrequencyVector($doc_words);
            $similarity = cosine_similarity($user_vector, $doc_vector);
            $doctor = $row;
            $doctor['similarity'] = $similarity;
            if($similarity > 0){
                $recommendation[] = $doctor;
            }
        }

        usort($recommendation, function($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        return $recommendation;
    }
?>