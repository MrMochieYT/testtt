<?php

namespace achedon\FoodEffect;

use pocketmine\plugin\PluginBase;
use achedon\FoodEffect\events\PlayerEvents;

class Main extends PluginBase{

    /** @var Main $instance*/
    private static Main $instance;

    protected function onEnable():void
    {
        self::$instance = $this;
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new PlayerEvents(), $this);
    }

    public static function getInstance(): self{
        return self::$instance;
    }
}