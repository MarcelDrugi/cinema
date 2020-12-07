<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movie1 = new Movie([
            'title' => 'Przeminęło z wiatrem',
            'description' => <<<EOD
            Ekranizacja powieści Margaret Mitchell. Beztroska i bogata Scarlett O Hara wikła się w 
            burzliwy związek z Rhettem Butlerem. Historia w niej opowiedziana dotyczy czasów wojny 
            secesyjnej i ukazuje losy bogatej córki plantatora bawełny w czasie tego burzliwego okresu. 
            EOD,
            'published' => 1939,
            'time' => 226,
            'age_limit' => 12,
            'new_movie' => true,
        ]);
        $movie1->save();
        
        $movie2 = new Movie([
            'title' => 'Rocky',
            'description' => <<<EOD
            Rocky (Sylvester Stallone) jest zawodnikiem klubu z Filadelfii, który nie ma na koncie żadnych 
            większych sukcesów, jednak, przewrotność losu sprawia, że to właśnie jego wybiera mistrz świata 
            wagi ciężkiej Apollo Creed (Carl Weathers) na swego kolejnego przeciwnika. Dla Creeda ta walka 
            to jedynie kolejne szumne przedstawienie, a dla Rocky'ego olbrzymie wyzwanie. 
            EOD,
            'published' => 1976,
            'time' => 119,
            'age_limit' => 12,
            'new_movie' => true,
        ]);
        $movie2->save();
        
        $movie3 = new Movie([
            'title' => 'Ben Hur',
            'description' => <<<EOD
            Wygnany z kraju przez swojego przyjaciela izraelski książę spotyka na pustyni Chrystusa.
            Nauki Jezusa odmieniają życie bohatera. Film jest dźwiękowym remakiem niemego filmu z 1925
            roku oraz adaptacją powieści Lewisa Wallace’a pod tym samym tytułem.
            EOD,
            'published' => 1959,
            'time' => 212,
            'age_limit' => 12,
            'new_movie' => false,
        ]);
        $movie3->save();
        
        $movie4 = new Movie([
            'title' => '2001: Odyseja Kosmiczna',
            'description' => <<<EOD
            Obraz Kubricka opowiada o relacjach człowieka z innymi inteligentnymi bytami, zarówno pozaziemskimi, 
            jak i stworzonymi przez człowieka. Scenariusz został napisany wspólnie przez Stanleya Kubricka i 
            Arthura C. Clarke’a, częściowo na podstawie wątków z opowiadań Clarke’a, szczególnie Posterunek 
            (The Sentinel), a także Napięcie (Breaking Strain), Z kolebki – na wieczne orbitowanie (Out of the Cradle, 
            Endlessly Orbiting...), Kto tam? (Who's There?), Podróż do wnętrza komety (Into the Comet) oraz U progu 
            raju (Before Eden). Na jego podstawie Kubrick nakręcił film, a Clarke napisał powieść pod tym samym 
            tytułem. Pomimo różnic m.in. w opisie kształtu i interakcji małp z monolitem, autor powieści wraca do 
            ustaleń reżysera w dalszych jej częściach.
            EOD,
            'published' => 1968,
            'time' => 141,
            'age_limit' => 12,
            'new_movie' => true,
        ]);
        $movie4->save();
        
        $movie5 = new Movie([
            'title' => 'Casablanca',
            'description' => <<<EOD
            II wojna światowa, Casablanca. Właściciel nocnego klubu, Rick Blaine, spotyka swoją dawną miłość, Ilsę, 
            która okazuje się być żoną działacza czeskiego ruchu oporu, Victora Laszlo. Dawne uczucia odżywają. Film 
            wyreżyserował Michael Curtiz, w głównych rolach wystąpili Humphrey Bogart jako Rick Blaine oraz Ingrid 
            Bergman jako Ilsa Lund.
            EOD,
            'published' => 1942,
            'time' => 102,
            'age_limit' => 12,
            'new_movie' => false,
        ]);
        $movie5->save();
        
        $movie6 = new Movie([
            'title' => 'Dyktator',
            'description' => <<<EOD
            Dyktator Adenoid Hynkel chce powiększyć swoje imperium, podczas gdy żydowski fryzjer próbuje uniknąć 
            prześladowania związanego z nazistowskim reżimem. Amerykański czarno-biały film z 1940 roku w reżyserii 
            Charlie Chaplina, ukazujący w satyrycznym podejściu Adolfa Hitlera, Benito Mussoliniego i ideologię 
            faszyzmu. Pierwszy film dźwiękowy Chaplina.
            EOD,
            'published' => 1940,
            'time' => 124,
            'age_limit' => 12,
            'new_movie' => false,
        ]);
        $movie6->save();
        
        $movie7 = new Movie([
            'title' => 'Psychoza',
            'description' => <<<EOD
            Dziewczyna uciekająca ze skradzionymi pieniędzmi zatrzymuje się w pensjonacie prowadzonym przez młodego 
            Normana Batesa. Amerykański dreszczowiec psychologiczny z 1960 w reżyserii Alfreda Hitchcocka i według 
            scenariusza Josepha Stefano, opartego na powieści o tym samym tytule autorstwa Roberta Blocha z 1959. W 
            rolach głównych wystąpili Anthony Perkins, Janet Leigh, John Gavin i Vera Miles. Film Hitchcocka budził 
            emocje jeszcze przed premierą. Kontrowersyjna tematyka spowodowała, że wytwórnia Paramount Pictures 
            odmówiła produkcji, zajmując się jedynie dystrybucją.
            EOD,
            'published' => 1960,
            'time' => 109,
            'age_limit' => 16,
            'new_movie' => true,
        ]);
        $movie7->save();
        
        $movie8 = new Movie([
            'title' => 'Obcy – ósmy pasażer Nostromo',
            'description' => <<<EOD
            Załoga statku kosmicznego Nostromo odbiera tajemniczy sygnał i ląduje na niewielkiej planetoidzie, gdzie 
            jeden z jej członków zostaje zaatakowany przez obcą formę życia. Brytyjsko-amerykański horror science 
            fiction w reżyserii Ridleya Scotta z 1979 roku, pierwsza część serii Obcy. W roku 2002 Biblioteka Kongresu 
            USA uznała film za „znaczący kulturowo”. Oznacza to jego szczególną ochronę, jako dziedzictwa kulturowego 
            i przechowywanie w amerykańskim Narodowym Rejestrze Filmowym.
            EOD,
            'published' => 1979,
            'time' => 117,
            'age_limit' => 16,
            'new_movie' => true,
        ]);
        $movie8->save();
        
        $movie9 = new Movie([
            'title' => 'Brudny Harry',
            'description' => <<<EOD
            Szaleniec o pseudonimie Skorpion strzela do ludzi z dachów i szantażuje burmistrza San Francisco. Może go 
            unieszkodliwić jedynie inspektor Callahan, znany ze stosowania brutalnych metod wobec przestępców. 
            Amerykański film z 1971 roku, w reżyserii Dona Siegla, z Clintem Eastwoodem w roli głównej. Film 
            zapoczątkował serię 5 filmów o przygodach Harry’ego Callahana.
            EOD,
            'published' => 1971,
            'time' => 102,
            'age_limit' => 16,
            'new_movie' => false,
        ]);
        $movie9->save();
    }
}
