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
		$playerCards1 = [];
		$tempArray = [];

		$shuffledDeck = $this->shuffleDeck();

		for( $i = 0; $i < 4; $i++)
		{
			for( $j = 0; $j < 4; $j++)
			{
				array_push($tempArray, $shuffledDeck[0]);
				array_shift($shuffledDeck);
			}
			
			$playerCards1[$i] = $tempArray;
			$tempArray = [];
		}
		
		// Bid Call Fixing

		$result = [ $playerCards1, $shuffledDeck ];
		return $result;
	}

	public function distributeCardTwo()
	{		
		$result = $this->distributeCardOne();

		$playerCards1 = $result[0];
		$shuffledDeck = $result[1];

		$playerCards2 = [];
		$tempArray = [];

		for( $i = 0; $i < 4; $i++)
		{
			for( $j = 0; $j < 4; $j++)
			{
				array_push($tempArray, $shuffledDeck[0]);
				array_shift($shuffledDeck);
			}

			$playerCards2[$i] = $tempArray;
			$tempArray = [];

		}


		$p1 = array_merge($playerCards1[0],$playerCards2[0]);
		$p2 = array_merge($playerCards1[1],$playerCards2[1]);
		$p3 = array_merge($playerCards1[2],$playerCards2[2]);
		$p4 = array_merge($playerCards1[3],$playerCards2[3]);

		$playerCards = [$p1, $p2, $p3, $p4];
		return $playerCards;

	}




}
