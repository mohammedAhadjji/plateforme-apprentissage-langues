<?php
namespace App\enum;

enum CEFRLevel: string
{
    case A1 = 'A1';
    case A2 = 'A2';
    case B1 = 'B1';
    case B2 = 'B2';
    case C1 = 'C1';
    case C2 = 'C2';

    
    public function getLabel(): string
    {
        return match($this) {
            self::A1 => 'A1 - Élémentaire (Introductif)',
            self::A2 => 'A2 - Élémentaire (Intermédiaire)',
            self::B1 => 'B1 - Indépendant (Niveau seuil)',
            self::B2 => 'B2 - Indépendant (Avancé)',
            self::C1 => 'C1 - Expérimenté (Autonome)',
            self::C2 => 'C2 - Expérimenté (Maîtrise)',
        };
    }
}