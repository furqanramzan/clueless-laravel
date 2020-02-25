<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TopList;
use Illuminate\Http\Request;
use App\Models\TopListReview;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    private $review;
    private $toplist;
    private $toplistreview;

    public function __construct(Review $review, TopList $toplist, TopListReview $toplistreview)
    {
        $this->review = $review;
        $this->toplist = $toplist;
        $this->toplistreview = $toplistreview;
    }

    public function index()
    {
        $data = [];
        $data['reviews'] = $this->review->latest()->limit(12)->get();
        return view('guest.index', compact('data'));
    }

    public function toplist($id)
    {
        $toplist = $this->toplist->with('toplistreview.review')->findorFail($id);
        return view('guest.toplist', compact('toplist'));
    }

    public function find(Request $request)
    {
        $data = [
            'params' => [
                'keyword' => '',
                'country' => '',
                'region' => ''
            ]
        ];
        $params = $request->only('keyword', 'country', 'region');
        $data['params'] = array_merge($data['params'], $params);
        $reviews = $this->review->latest()->limit(12);
        if($data['params']['keyword']) {
            $reviews = $reviews->orWhere('company_name', 'like', "%{$data['params']['keyword']}%")->orWhere('room_name', 'like', "%{$data['params']['keyword']}%")->orWhere('room_overview', 'like', "%{$data['params']['keyword']}%")->orWhere('body', 'like', "%{$data['params']['keyword']}%");
        }
        if($data['params']['country']) {
            $reviews = $reviews->orWhere('country', $data['params']['country']);
        }
        if($data['params']['region']) {
            $reviews = $reviews->orWhere('region', $data['params']['region']);
        }
        $reviews = $reviews->get();
        $data['reviews'] = $reviews;
        $data['countries'] = $this->review->select('country')->orderBy('country')->distinct('country')->get();
        $data['regions'] = $this->review->select('region')->orderBy('region')->distinct('region')->get();
        return view('guest.find', compact('data'));
    }

    public function review($id)
    {
        $review = $this->review->with(['reviewComments' => function($query){
            $query->select('review_id', 'body', 'created_at')->latest();
        }])->findorFail($id);
        $review->visits++;
        $review->save();
        $reviews = $this->review->orderBy('visits', 'desc')->limit(4)->get();
        return view('guest.review', compact('review', 'reviews'));
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function comment(Request $request, $id)
    {
        $validated = $request->validate([
            'body' => 'required'
        ]);
        $review = $this->review->select('id')->findorFail($id);
        $review->reviewComments()->create($validated);
        return redirect()->route('guest.review', $review->id);
    }
}
