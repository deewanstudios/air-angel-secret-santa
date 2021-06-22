<?php

namespace App\Http\Controllers;

class SecretSantaController extends Controller
{

    protected $path = __DIR__ . "/../../../resources/data/secret-santa.txt";

    //

    public function show()
    {
        $pairs = $this->assignSecretSanta();
        return view('secret-santas', compact('pairs'));
    }

// Story One

    private function extractParticipants()
    {
        $participants = array_filter(explode("\n", file_get_contents($this->path)));
        $secret_santas = [];
        foreach ($participants as $participant) {
            preg_match_all('/(\S+)\s++(\S+)\s+\[(.*?)\]/', $participant, $matches);
            unset($matches[0]);
            $array_reset = array_values($matches);
            $reduced = array_reduce($matches, 'array_merge', []);
            $santas = ($this->replaceIndexedArrayKeys($reduced, [0 => 'firstname', 1 => 'lastname', 2 => 'email']));
            array_push($secret_santas, $santas);
        }
        return $secret_santas;
    }

    private function replaceIndexedArrayKeys($array, $keys)
    {
        foreach ($keys as $search => $replace) {
            if (isset($array[$search])) {
                $array[$replace] = $array[$search];
                unset($array[$search]);
            }
        }

        return $array;
    }

    private function assignSecretSanta()
    {

        $secret_santas = $this->extractParticipants();
        $recipients = $this->extractParticipants();

        foreach ($secret_santas as $index => $secret_santa) {
            $unassigned = true;
            while ($unassigned) {
                //Randomly pick a recipient for the current secret_santa iteration to gift to
                $picked = rand(0, sizeof($recipients) - 1);
                // ddd($picked);
                //Check that randomly picked secret_santa is NOT themselves
                if ($secret_santa['email'] !== $recipients[$picked]['email']) {
                    //Assign the secret_santa the randomly picked recipient
                    $secret_santas[$index]['gifting'] = $recipients[$picked];
                    unset($recipients[$picked]);
                    //Correct array
                    $recipients = array_values($recipients);
                    $unassigned = false;
                } elseif ($secret_santa['lastname'] !== $recipients[$picked]['lastname']) {

                    // Story 2

                    // Check that randomly picked secret_santa does not have the same lastname as recipient
                    //Assign the secret_santa the randomly picked recipient
                    $secret_santas[$index]['gifting'] = $recipients[$picked];
                    unset($recipients[$picked]);
                    $recipients = array_values($recipients);
                    $unassigned = false;
                } else {
                    //If current iteration of secret_santa is the last one left and has been matched with itself
                    if (sizeof($recipients) == 1) {
                        //Swap with someone else (in this case the first guy who got assigned.
                        //Steal first persons, person and give self to them.
                        $secret_santas[$index]['gifting'] = $secret_santas[0]['gifting'];
                        $secret_santas[0]['gifting'] = $secret_santas[$index];
                        $unassigned = false;
                    }
                }
            }
        }
        return $secret_santas;
    }

}
