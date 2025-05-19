<?php

// rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1

function ValidateMove($CurrentFEN, $start, $end, $turn)
{
    $parti = explode(' ', $CurrentFEN);

    $posizioneScacchiera = $parti[0];



    $scacchiera = array_fill(0, 64, '');
    $righe = explode('/', $posizioneScacchiera);
    $indice = 0;

    foreach($righe as $riga)
    {
        foreach(str_split($riga) as $carattere)
        {
            if(is_numeric($carattere))
            {
                $indice += intval($carattere);
            }
            else
            {
                $scacchiera[$indice] = $carattere;
                $indice++;
            }
        }
    }

    echo json_encode($scacchiera);

    if(empty($scacchiera[$start]))
        return false;



    $pezzo = $scacchiera[$start];
    $color = ctype_upper($pezzo) ? 'w' : 'b';

    if($color != $turn)
        return false;


    if(!empty($scacchiera[$start]))
    {
        $pezzoDest = $scacchiera[$end];
        $colorDest = ctype_upper($pezzoDest) ? 'w' : 'b';

        if($colorDest == $turn)
            return false;
    }

    $rigaDa = intval($start / 8);
    $colonnaDa = $start % 8;

    $rigaA = intval($end / 8);
    $colonnaA = $end % 8;



    $tipoPezzo = strtolower($pezzo);


    switch ($tipoPezzo) {
        case 'p': // Pedone
            return validaMossaPedone($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA, $color);
        case 'r': // Torre
            return validaMossaTorre($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA);
        case 'n': // Cavallo
            return validaMossaCavallo($rigaDa, $colonnaDa, $rigaA, $colonnaA);
        case 'b': // Alfiere
            return validaMossaAlfiere($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA);
        case 'q': // Regina
            return validaMossaRegina($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA);
        case 'k': // Re
            return validaMossaRe($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA);
        default:
            return false;
    }



}


function dentroScacchiera($riga, $colonna) {
    return $riga >= 0 && $riga < 8 && $colonna >= 0 && $colonna < 8;
}


function posizione($riga, $colonna) {
    return $riga * 8 + $colonna;
}


function validaMossaPedone($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA, $colore) {
    // Direzione di movimento
    $direzione = ($colore === 'w') ? -1 : 1;
    
    // Mossa in avanti di una casella
    if ($colonnaA === $colonnaDa && $rigaA === $rigaDa + $direzione) {
        return empty($scacchiera[posizione($rigaA, $colonnaA)]);
    }
    
    // Mossa iniziale di due caselle
    if ($colonnaA === $colonnaDa && 
        (($colore === 'w' && $rigaDa === 6 && $rigaA === 4) || 
         ($colore === 'b' && $rigaDa === 1 && $rigaA === 3))) {
        $posizioneIntermedia = posizione($rigaDa + $direzione, $colonnaDa);
        return empty($scacchiera[$posizioneIntermedia]) && 
               empty($scacchiera[posizione($rigaA, $colonnaA)]);
    }
    
    // Cattura diagonale
    if (abs($colonnaA - $colonnaDa) === 1 && $rigaA === $rigaDa + $direzione) {
        // Cattura normale
        $posizioneArrivo = posizione($rigaA, $colonnaA);
        if (!empty($scacchiera[$posizioneArrivo])) {
            $pezzoDestinazione = $scacchiera[$posizioneArrivo];
            $coloreDestinazione = ctype_upper($pezzoDestinazione) ? 'w' : 'b';
            return $colore !== $coloreDestinazione;
        }
    }
    
    return false;
}

/**
 * Valida movimento torre
 */
function validaMossaTorre($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA) {
    // La torre si muove solo in orizzontale o verticale
    if ($rigaDa !== $rigaA && $colonnaDa !== $colonnaA) {
        return false;
    }
    
    // Determina la direzione
    $rigaDir = ($rigaA > $rigaDa) ? 1 : (($rigaA < $rigaDa) ? -1 : 0);
    $colonnaDir = ($colonnaA > $colonnaDa) ? 1 : (($colonnaA < $colonnaDa) ? -1 : 0);
    
    // Controlla che il percorso sia libero
    $r = $rigaDa + $rigaDir;
    $c = $colonnaDa + $colonnaDir;
    
    while ($r !== $rigaA || $c !== $colonnaA) {
        if (!empty($scacchiera[posizione($r, $c)])) {
            return false;
        }
        $r += $rigaDir;
        $c += $colonnaDir;
    }
    
    return true;
}

/**
 * Valida movimento cavallo
 */
function validaMossaCavallo($rigaDa, $colonnaDa, $rigaA, $colonnaA) {
    $diffRiga = abs($rigaA - $rigaDa);
    $diffColonna = abs($colonnaA - $colonnaDa);
    
    // Il cavallo si muove a L: 2 caselle in una direzione e 1 nell'altra
    return ($diffRiga === 2 && $diffColonna === 1) || 
           ($diffRiga === 1 && $diffColonna === 2);
}

/**
 * Valida movimento alfiere
 */
function validaMossaAlfiere($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA) {
    // L'alfiere si muove solo in diagonale
    $diffRiga = abs($rigaA - $rigaDa);
    $diffColonna = abs($colonnaA - $colonnaDa);
    
    if ($diffRiga !== $diffColonna) {
        return false;
    }
    
    // Determina la direzione
    $rigaDir = ($rigaA > $rigaDa) ? 1 : -1;
    $colonnaDir = ($colonnaA > $colonnaDa) ? 1 : -1;
    
    // Controlla che il percorso sia libero
    $r = $rigaDa + $rigaDir;
    $c = $colonnaDa + $colonnaDir;
    
    while ($r !== $rigaA && $c !== $colonnaA) {
        if (!empty($scacchiera[posizione($r, $c)])) {
            return false;
        }
        $r += $rigaDir;
        $c += $colonnaDir;
    }
    
    return true;
}

/**
 * Valida movimento regina
 */
function validaMossaRegina($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA) {
    // La regina si muove come torre o alfiere
    return validaMossaTorre($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA) || 
           validaMossaAlfiere($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA);
}

/**
 * Valida movimento re
 */
function validaMossaRe($scacchiera, $rigaDa, $colonnaDa, $rigaA, $colonnaA) {
    $diffRiga = abs($rigaA - $rigaDa);
    $diffColonna = abs($colonnaA - $colonnaDa);
    
    // Movimento normale del re (una casella in qualsiasi direzione)
    if ($diffRiga <= 1 && $diffColonna <= 1) {
        return true;
    }
    
    
    return false;
}
