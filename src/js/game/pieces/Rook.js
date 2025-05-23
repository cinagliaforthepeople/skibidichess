import { Piece } from "./Piece.js";
import { Helper } from "../Helpers.js"

export class Rook extends Piece
{
    constructor(isWhite, position)
    {
       super(isWhite ? 'R' : 'r', isWhite, position) ;
    }

    calculateLegalMoves(VirtualBoard)
    {
        this.legalMoves = []
        const Coords = Helper.to2D(this.position)

        let Directions = [[1, 0], [-1, 0], [0, 1], [0, -1]];

        for(let [DirectionRow, directionColoumn] of Directions)
        {
            let nextRow = Coords[0] + DirectionRow;
            let nextColoumn = Coords[1] + directionColoumn;
        
            while(nextRow >= 0 && nextRow < 8 && nextColoumn >= 0 && nextColoumn < 8)
            {
                let index = Helper.toLinear([nextRow, nextColoumn]);
        
                if(VirtualBoard[index] === null)
                {
                    this.legalMoves.push(index)
                }
                else
                {
                    if(VirtualBoard[index].isWhite !== this.isWhite)
                        this.legalMoves.push(index)
                    
                    break;
                }
        
                nextColoumn += directionColoumn;
                nextRow += DirectionRow;
            }
        } 

        
    }
}