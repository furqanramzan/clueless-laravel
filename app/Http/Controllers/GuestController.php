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
        $data['reviews'] = $this->review->published()->latest()->limit(12)->get();
        $data['reviews'] = $data['reviews']->chunk(3);
        return view('guest.index', compact('data'));
    }

    public function toplist($id)
    {
        $toplist = $this->toplist->with(['toplistreview' => function($query){
            $query->with('review')->limit(10)->latest();
        }])->findorFail($id);
        return view('guest.toplist', compact('toplist'));
    }

    public function find(Request $request)
    {
        $data = [
            'params' => [
                'keyword' => '',
                'country' => '',
                'region' => '',
                'jump' => 0
            ]
        ];
        $params = $request->only('keyword', 'country', 'region', 'rating', 'players', 'price', 'jump');
        $data['params'] = array_merge($data['params'], $params);
        $reviews = $this->review->published()->latest()->limit(12);

        // Keyword Filter
        if (isset($data['params']['keyword']) && $data['params']['keyword']) {
            $reviews = $reviews->where(function ($query) use ($data) {
                $columns = ['company_name', 'room_name', 'room_overview', 'body', 'country', 'region'];
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', "%{$data['params']['keyword']}%");
                }
            });
        }

        // Rating Filter
        if (isset($data['params']['rating']) && $data['params']['rating']) {
            $rating = explode(',', $data['params']['rating']);
            if (isset($rating[0]) && isset($rating[1])) {
                $reviews = $reviews->where('overall', '>=', (int) $rating[0])->where('overall', '<=', (int) $rating[1]);
            } else {
                $data['params']['rating'] = '0,10';
            }
        } else {
            $data['params']['rating'] = '0,10';
        }

        // Number of Players
        if (isset($data['params']['players']) && $data['params']['players']) {
            $players = explode(',', $data['params']['players']);
            if (isset($players[0]) && isset($players[1])) {
                $reviews = $reviews->where('minimum_players', '>=', (int) $players[0])->where('maximum_players', '<=', (int) $players[1]);
            } else {
                $data['params']['players'] = '0,1000';
            }
        } else {
            $data['params']['players'] = '0,1000';
        }

        // Price Filter
        if (isset($data['params']['price']) && $data['params']['price']) {
            $price = explode(',', $data['params']['price']);
            if (isset($price[0]) && isset($price[1])) {
                $reviews = $reviews->where(function($query) use ($price) {
                    $query->orWhere('average_price', '>=', (int) $price[0])->where('average_price', '<=', (int) $price[1]);
                });
            } else {
                $data['params']['price'] = '0,1000';
            }
        } else {
            $data['params']['price'] = '0,1000';
        }

        // Country Filter
        if (isset($data['params']['country']) && $data['params']['country']) {
            $reviews = $reviews->where('country', $data['params']['country']);
        }

        // Region Filter
        if (isset($data['params']['region']) && $data['params']['region']) {
            $reviews = $reviews->where('region', $data['params']['region']);
        }

        // Jump Filter
        if (isset($data['params']['jump']) && $data['params']['jump']) {
            $reviews = $reviews->where('jump_scares', $data['params']['jump']);
        }

        $reviews = $reviews->get();
        $reviews = $reviews->chunk(3);
        $data['reviews'] = $reviews;
        $data['countries'] = $this->review->published()->select('country')->orderBy('country')->distinct('country')->get();
        $data['regions'] = $this->review->published()->select('region')->orderBy('region')->distinct('region')->get();
        return view('guest.find', compact('data'));
    }

    public function review($id)
    {
        $review = $this->review->published()->with(['reviewComments' => function ($query) {
            $query->select('review_id', 'body', 'created_at')->latest();
        }])->findorFail($id);
        $review->visits++;
        $review->save();
        $reviews = $this->review->published()->orderBy('visits', 'desc')->limit(5)->get();
        return view('guest.review', compact('review', 'reviews'));
    }

    public function contact()
    {
        $contact = config('settings.contact_us');
        return view('guest.contact', compact('contact'));
    }

    public function comment(Request $request, $id)
    {
        $validated = $request->validate([
            'body' => 'required'
        ]);
        $review = $this->review->published()->select('id')->findorFail($id);
        $comment = $review->reviewComments()->create($validated);
        $comment['date'] = $comment->created_at->format('M d, Y @ g:i A');
        return $comment;
    }
}
