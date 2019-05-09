<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeckOfCardsController extends Controller
{
    public function createDeck()
    {
    	$deck = [];

    	$ranks = ['J', '9', 'A', '10', 'K', 'Q', '8', '7'];

    	$values = ['J' => 3, '9' => 2, 'A' => 1, '10' => 1, 'K' => 0, 'Q' => 0, '8' => 0, '7' => 0];

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

    public function shuffleDeck()
    {
    	$deck = $this->createDeck();
    	shuffle($deck);

    	// cut from any index

    	return $deck;
    }

	public function distributeCardOne()
	{		
		$playerCards = [];
		$tempArray = [];

		$shuffledDeck = $this->shuffleDeck();

		for( $i = 0; $i < 4; $i++)
		{
			for( $j = 0; $j < 4; $j++)
			{
				array_push($tempArray, $shuffledDeck[0]);
				array_shift($shuffledDeck);
			}
			
			$playerCards[$i] = $tempArray;
			$tempArray = [];
		}
		
		// Bid Call Fixing

		$result = [ $playerCards, $shuffledDeck ];
		return $result;
	}

	public function distributeCardTwo()
	{		
		$result = $this->distributeCardOne();

		$shuffledDeck = $result[1];

		$playerCards = [];
		$tempArray = [];

		for( $i = 0; $i < 4; $i++)
		{
			for( $j = 0; $j < 4; $j++)
			{
				array_push($tempArray, $shuffledDeck[0]);
				array_shift($shuffledDeck);
			}

			$playerCards[$i] = $tempArray;
			$tempArray = [];

		}	
            return response()->json([
	            'playerCards' => $playerCards,
	            'shuffledDeck' => $shuffledDeck
        ], 200);

	}


}
