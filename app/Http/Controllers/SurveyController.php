<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function show()
    {
        // Список вопросов для каждой группы
        $questions = [
            1 => [
                "Często czuję się przygniębiony/a lub smutny/a przez większość dnia.",
                "Często odczuwam brak energii i motywacji.",
                "Często tracisz zainteresowanie rzeczami, które wcześniej sprawiały mi radość.",
                "Moje myśli są bardziej negatywne lub przygnębiające niż zwykle.",
                "Często odczuwam, że twoje emocje są poza twoją kontrolą.",
                "Moje nastroje zmieniają się szybko i bez wyraźnej przyczyny.",
                "Czasami czuję się zbyt pobudzony/a lub rozdrażniony/a.",
                "Trudno mi skupić się na codziennych obowiązkach."
            ],
            2 => [
                "Boję się że mogę stracić kontrolę в sytuacjach społecznych.",
                "Często obawiam się, że coś złego mi się przydarzy.",
                "Unikam sytuacji, które wywołują у mnie lęk.",
                "Mam natrętne myśli, które nie chcą mnie opuścić.",
                "Muszę wykonywać pewne czynności, aby poczuć się lepiej.",
                "Odczuwam nagłe napady strachu lub paniki.",
                "Często przejmuję się tym, co inni о mnie myślą.",
                "Czuję się zdenerwowany/a, gdy jestem z dala od bliskich."
            ],
            3 => [
                "Mam wrażenie, że ktoś mnie obserwuje lub śledzi.",
                "Słyszę lub widzę rzeczy, których inni nie zauważają.",
                "Czasami mam trudności z odróżnieniem rzeczywistości od moich myśli.",
                "Mam silne przekonania, które inni uważają za dziwne.",
                "Trudno mi nawiązać kontakt z innymi ludźmi.",
                "Czasami mam poczucie, że moje myśli są kontrolowane przez kogoś lub coś.",
                "Mam obawy, że inni chcą mi zaszkodzić.",
                "Czuję się wyobcowany/a lub odłączony/a od rzeczywistości."
            ]
        ];

        $shuffledQuestions = collect($questions)
            ->flatMap(function ($group, $groupId) {
                return collect($group)->map(function ($question) use ($groupId) {
                    return ['group' => $groupId, 'text' => $question];
                });
            })
            ->shuffle();

        return view('survey', ['questions' => $shuffledQuestions]);
    }


    public function submit(Request $request)
    {
        $answers = $request->input('answers');
        $scores = [1 => 8, 2 => 8, 3 => 8]; 
    
        foreach ($answers as $question) {
            $scores[$question['group']] += $question['score'];
        }
    
        $message = '';
        $treatment = '';
        $doctorRecommendation = '';
        $statusClass = 'bg-success';  
    
        $maxScore = max($scores);
    
        if ($maxScore <= 8) {
            $message = 'Twój wynik sugeruje, że jesteś zdrowy.';
            $statusClass = 'bg-success'; 
        } else {
            if ($scores[1] == $maxScore) {
                $message = 'Twój wynik sugeruje, że masz Depresję.';
                $treatment = 'Zalecane leczenie: psychoterapia poznawczo-behawioralna, farmakoterapia (antydepresanty), regularna aktywność fizyczna.';
                $statusClass = 'bg-danger'; 
            } elseif ($scores[2] == $maxScore) {
                $message = 'Twój wynik sugeruje, że masz fobię społeczną.';
                $treatment = 'Zalecane leczenie: terapia poznawczo-behawioralna, nauka technik relaksacyjnych.';
                $statusClass = 'bg-danger'; 
            } elseif ($scores[3] == $maxScore) {
                $message = 'Twój wynik sugeruje, że masz Schizofrenię.';
                $treatment = 'Zalecane leczenie: leki przeciwpsychotyczne, terapia psychospołeczna, wsparcie rodziny.';
                $statusClass = 'bg-danger'; 
            }
        }
    
    
        if ($maxScore > 8) {
            $doctorRecommendation = 'Zalecamy pilnie skonsultować się z profesjonalnym lekarzem.';
        }
    
        return view('results', [
            'scores' => $scores,
            'message' => $message,
            'treatment' => $treatment,
            'doctorRecommendation' => $doctorRecommendation,
            'statusClass' => $statusClass
        ]);
    }
    
    


}

