<?php

/**
 * Интерфейс с тарифом
 */
interface TariffProto
{
    public function calculate($distance, $time);
}

/**
 * Использование gps
 */
trait Gps
{
    public function useGps($time)
    {
        if ($time < 60) {
            throw new Exception("Вы не можете заказать gps менее чем на 1 час");
        }

        return $time*15/60;
    }
}

/**
 * Дополнительный водитель
 */
trait AddedDriver
{
    public function useAddDriver()
    {
        return 100;
    }
}

/**
 * Абстрактный класс с тарифом
 */
abstract class Tariff implements TariffProto
{
    use Gps;

    const MIN_AGE = 18;
    const MAX_AGE = 65;
    const YOUNG_AGE = 21;

    public $driverAge;
    public $ageKoeff;
    public $distancePrice;
    public $timePrice;

    public function getDistancePrice()
    {
        return $this->distancePrice ?? 0;
    }
    public function getTimePrice()
    {
        return $this->timePrice ?? 0;
    }

    public function __construct(int $age)
    {
        if(!$this->checkAge($age)) {
            throw new Exception('Возраст не соответствует допустимому!');
        }

        $this->driverAge = $age;
        $this->setAgeKoeff();
    }

    public function checkAge(int $age):bool
    {
        return $age >= self::MIN_AGE && $age <= self::MAX_AGE;
    }

    public function isYoungDriver(int $age):bool
    {
        return $age >= self::MIN_AGE && $age <= self::YOUNG_AGE;
    }

    public function setAgeKoeff()
    {
        if ($this->isYoungDriver($this->driverAge)) {
            $this->ageKoeff = 1.1;
        } else {
            $this->ageKoeff = 1;
        }
    }

    public function innerCalc($distance, $time, $gps = false)
    {
        $price = ($distance*$this->getDistancePrice() + $time*$this->getTimePrice()) * $this->ageKoeff;

        if ($gps) {
            try {
                $price += $this->useGps($time);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        return $price;
    }

    abstract function calculate($distance, $time, $gps = false);
}

/**
 * Тариф базовый
 */
class BaseTariff extends Tariff
{

    public function __construct(int $age)
    {
        parent::__construct($age);
        $this->distancePrice = 10;
        $this->timePrice = 3;
    }

    public function calculate($distance, $time, $gps = false)
    {
        return $this->innerCalc($distance, $time, $gps);
    }
}

/**
 * Тариф почасовой
 */
class HourlyTariff extends Tariff
{
    use AddedDriver;

    public function __construct(int $age)
    {
        parent::__construct($age);
        $this->timePrice = 200;
    }

    public function calculate($time, $gps = false, $addedDriver = false)
    {
        $hours = ceil($time / 60);
        $price = $this->innerCalc(0, $hours, $gps);

        if ($addedDriver) {
            $price += $this->useAddDriver();
        }

        return $price;
    }
}

/**
 * Тариф суточный
 */
class DialyTariff extends Tariff
{
    use AddedDriver;

    public function __construct(int $age)
    {
        parent::__construct($age);
        $this->distancePrice = 1;
        $this->timePrice = 1000;
    }

    public function calculate($distance, $time, $gps = false, $addedDriver = false)
    {
        $days = $this->getDays($time);
        $price = $this->innerCalc($distance, $days, $gps);

        if ($addedDriver) {
            $price += $this->useAddDriver();
        }

        return $price;
    }

    public function getDays($time)
    {
        $mod = fmod($time, 24);

        if ($mod <= 0.5) {
            $days = intdiv($time, 24);
        } else {
            $days = ceil($time / 24);
        }

        return $days;
    }
}

/**
 * Тариф студенческий
 */
class StudentTariff extends Tariff
{
    public function __construct(int $age)
    {
        if($age > 25) {
            throw new Exception('Водитель слишком стар для этого тарифа!');
        }

        parent::__construct($age);
        $this->distancePrice = 4;
        $this->timePrice = 1;
    }

    public function calculate($distance, $time, $gps = false)
    {
        return $this->innerCalc($distance, $time, $gps);
    }
}