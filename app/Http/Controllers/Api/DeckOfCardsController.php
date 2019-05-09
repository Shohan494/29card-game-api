<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeckOfCardsController extends Controller
{
    public function create()
    {
    	$deck = [];

    	$ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
        $suits = ['♥', '♦', '♠', '♣'];

        for( $i = 0; $i < count($ranks); $i++)
        {
        	for( $j = 0; $j < count($suits); $j++)
        	{
        		array_push($deck, $suits[$j].$ranks[$i]);
        	}	
        }

        return $deck;

    }
}
