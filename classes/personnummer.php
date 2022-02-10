<?php

class Personnummer
{
    private
        $year  = 0,
        $month = 0,
        $day   = 0,
        $bn    = 0;
    
    public function __construct(int $year, int $month, int $day, int $bn)
    {
        $this->year  = $year;
        $this->month = $month;
        $this->day   = $day;
        $this->bn    = $bn;
    }
    
    public static function validateString(string $personnummer) : bool
    {
        return self::createFromString($personnummer) !== null;
    }
    
    public static function createFromString(string $personnummer) : ?Personnummer
    {
        // Ett personnummer består av 6 siffror (yymmdd), ett skiljetecken som är antingen ett bindestreck
        // eller ett plustecken (i de fall personen är 100 eller äldre), ett tre siffror långt
        // födelsenummer och en kontrollsiffra.
        //
        // Som tidigare påpekats så kan vi inte använda regjuljära uttryck för att validera numret
        // eftersom att vi även måste kontrollera att det är ett giltigt datum samt verifiera
        // att kontrollsiffran stämmer, men vi kan använda det för att kontrollera textformatet
        // och dela upp det i användbara delar:
        
        if(preg_match("/^
            (\d{2}) # 1: År
            (\d{2}) # 2: Månad
            (\d{2}) # 3: Dag
            ([+-])  # 4: Skiljetecken
            (\d{3}) # 5: Födelsenummer
            (\d{1}) # 6: Kontrollsiffra
        $/x", $personnummer, $m))
        {
            $year  = (int)$m[1];
            $month = (int)$m[2];
            $day   = (int)$m[3];
            $sep   = $m[4];
            $bn    = (int)$m[5];
            $check = (int)$m[6];
            
            // Innan vi kan kontrollera datumet så måste vi normalisera födelseåret:
            $year = self::normalizeYear($year, $sep === "+");
            
            // Sedan kan vi kontrollera att datumet är giltigt,
            // PHP har en standardfunktion för syftet, använd den.
            //
            // Om datumet > 60 så är det ett samordningsnummer;
            // subtrahera 60 från datumet innan kontrollen.
            if(checkdate($month, $day > 60 ? $day - 60 : $day, $year))
            {
                // Sedan verifierar vi kontrollsiffran:
                if($check === self::calcCheckDigit($year, $month, $day, $bn))
                {
                    return new self($year, $month, $day, $bn);
                }
            }
        }
        
        return null;
    }
    
    private static function normalizeYear(int $birthYear, bool $hundredOrOlder = false) : int
    {
        $currentYear    = (int)date("Y");
        $currentCentury = (int)floor($currentYear / 100) * 100;
        $currentYear    = $currentYear % 100;
        
        if($hundredOrOlder)
        {
            if($birthYear > $currentYear)
            {
                return $birthYear + $currentCentury - 200;
            }
            else
            {
                return $birthYear + $currentCentury - 100;
            }
        }
        else
        {
            if($birthYear > $currentYear)
            {
                return $birthYear + $currentCentury - 100;
            }
            else
            {
                return $birthYear + $currentCentury;
            }
        }
    }
    
    private static function calcCheckDigit(int $year, int $month, int $day, int $bn) : int
    {
        // Skapa en sträng med tvåsiffriga datumkomponenter och födelsenumret:
        $digits = sprintf(
            '%02d%02d%02d%03d',
            substr((string)$year, 2, 2),
            $month,
            $day,
            $bn
        );
        
        $sum = 0;
        
        // För varje tecken...
        for($i = 0, $c1 = strlen($digits); $i < $c1; ++$i)
        {
            // Multiplicera siffran omväxlande med 1 eller 2:
            $t = (string)((int)$digits[$i] * ($i % 2 === 0 ? 2 : 1));
            
            // För varje siffra i resultatet:
            for($n = 0, $c2 = strlen($t); $n < $c2; ++$n)
            {
                // Addera till summan:
                $sum += (int)$t[$n];
            }
        }
        
        // Hämta resten och subtrahera den från 10:
        $check = 10 - $sum % 10;
        
        // Om resten är 10 så blir kontrollsiffran 0:
        return $check === 10 ? 0 : $check;
    }
    
    public function getYear() : int
    {
        return $this->year;
    }
    
    public function getMonth() : int
    {
        return $this->month;
    }
    
    public function getDay() : int
    {
        return $this->day;
    }
    
    public function getBirthNumber() : int
    {
        return $this->bn;
    }
    
    public function getGender() : int
    {
        return $this->bn % 2;
    }
    
    public function getCheckDigit() : int
    {
        return self::calcCheckDigit($this->year, $this->month, $this->day, $this->bn);
    }
    
    public function toString() : string
    {
        return sprintf(
            '%s%02d%02d%s%03d%d',
            substr((string)$this->year, 2, 2),
            $this->month,
            $this->day,
            ((int)date("Y") - $this->year < 100 ? "-" : "+"),
            $this->bn,
            $this->getCheckDigit()
        );
    }
    
    public function __toString() : string
    {
        return $this->toString();
    }
}

