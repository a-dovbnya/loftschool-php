<?php

/**
 * Интерфейс с тарифом
 */
interface TariffProto {
    public function calculate($distance, $time);
}

/**
 * Абстрактный класс с тарифом
 */
abstract class Tariff implements TariffProto {

    const MIN_AGE = 18;
    const MAX_AGE = 65;
    const YOUNG_AGE = 21;

    public $driverAge;
    public $ageKoeff;

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

    abstract public function calculate($distance, $time);
}

/**
 * Использование gps
 */
trait Gps {
    public function useGps($time) {
        if ($time < 60) {
            throw new Exception("Вы не можете заказать gps менее чем на 1 час");
        }

        return $time*15/60;
    }
}

/**
 * Дополнительный водитель
 */
trait AddedDriver {
    public function useAddDriver() {
        return 100;
    }
}

/**
 * Тариф базовый
 */
class BaseTariff extends Tariff {
    use Gps;

    const KM_PRICE = 10;
    const MINUTES_PRICE = 3;

    public function __construct(int $age)
    {
        parent::__construct($age);
    }

    public function calculate($distance, $time, $gps = false)
    {
        $price = ($distance*self::KM_PRICE + $time*self::MINUTES_PRICE) * $this->ageKoeff;

        if ($gps) {
            try {
                $price += $this->useGps($time);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        return $price;
    }
}

/**
 * Тариф почасовой
 */
class HourlyTariff extends Tariff {
    use Gps;
    use AddedDriver;

    const HOUR_PRICE = 200;

    public function __construct(int $age)
    {
        parent::__construct($age);
    }

    public function calculate($time, $gps = false, $addedDriver = false)
    {
        $hours = ceil($time / 60);
        $price = self::HOUR_PRICE * $hours * $this->ageKoeff;

        if ($gps) {
            try {
                $price += $this->useGps($time);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        if ($addedDriver) {
            $price += $this->useAddDriver();
        }

        return $price;
    }
}

/**
 * Тариф суточный
 */
class DialyTariff extends Tariff {
    use Gps;
    use AddedDriver;

    const KM_PRICE = 1;
    const DAY_PRICE = 1000;

    public function __construct(int $age)
    {
        parent::__construct($age);
    }

    public function calculate($distance, $time, $gps = false, $addedDriver = false)
    {
        $days = $this->getDays($time);

        $price = (self::KM_PRICE * $distance + self::DAY_PRICE *  $days) * $this->ageKoeff;

        if ($gps) {
            try {
                $price += $this->useGps($time);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

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
class StudentTariff extends Tariff {
    use Gps;

    const KM_PRICE = 4;
    const DAY_PRICE = 1;

    public function __construct(int $age)
    {
        if($age > 25) {
            throw new Exception('Водитель слишком стар для этого тарифа!');
        }

        parent::__construct($age);
    }

    public function calculate($distance, $time, $gps = false)
    {
        $price = (self::KM_PRICE * $distance + self::DAY_PRICE * $time) * $this->ageKoeff;

        if ($gps) {
            try {
                $price += $this->useGps($time);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

        return $price;
    }
}