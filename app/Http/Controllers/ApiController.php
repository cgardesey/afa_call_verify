<?php

namespace App\Http\Controllers;

use App\subscription;
use Illuminate\Http\Request;

use App\Question;
use App\Subscriber;

class ApiController extends Controller
{
    public function saveQuestion(Request $request)
    {

        $question = Question::create($request->all());

        $image_nmme = $request['questionid'];
        if ($request['picture'] != null) {
            $decodedImg = base64_decode($request['picture']);
            $src = imagecreatefromstring($decodedImg);
            imagejpeg($src, public_path() . '/img/uploaded_question_images/' . $image_nmme . '.jpeg', 100);
        }

        return response()->json($question);
    }


    public function updateQuestion($questionid, Request $request)
    {

        $question = Question::where('questionid', $questionid)->first();

        $question->update($request->all());

        return response()->json($question);
    }


    public function getQuestions()
    {

        return response()->json(Question::all(), 200);
    }


    public function getQuestion($questionid)
    {

        //$question = Question::where('questionid', $questionid)->first();

        //$question = Question::whereQuestionid($questionid)->first();

        //$question = DB::table('questions')->where('questionid', $questionid)->get();

        //$question = Question::where('questionid', $questionid)->first();

        //return "Hello world!";

        $question = Question::where('questionid', $questionid)->first();

        return response()->json($question, 200);
    }


    public function getYearQuestions($search)
    {

        $questions = Question::where('questionid', 'LIKE', "%$search%")->get();

        return response()->json($questions, 200);
    }

    public function getPaths($userid)
    {

        $questions = Subscription::where('userid', 'LIKE', "%$userid%")->get();

        return $questions->pluck('path');
    }

    public function getSubscriptionStatus($userid, $search)
    {

        $subscription = Subscription::where('userid', '=', $userid)
            ->where('path', 'LIKE', "%$search%")
            ->get();


        if ($subscription->isEmpty()) {
            return 'false';
        } else {
            return 'true';
        }
    }


    public function saveSubscriber(Request $request)
    {

        $suscriber = Suscriber::create($request->all());

        return response()->json($suscriber);
    }


    public function updateSubscriber($subscriptionid, Request $request)
    {

        $subscriber = Suscriber::where('subscriptionid', $subscriptionid)->first();

        $subscriber->update($request->all());

        return response()->json($subscriber);
    }


    public function getSubscribers()
    {

        return response()->json(Subscriber::all(), 200);
    }

    public function getSubscriber($number)
    {

        $subscriber = Suscriber::where('number', $number)->first();

        return response()->json($subscriber, 200);
    }
}
