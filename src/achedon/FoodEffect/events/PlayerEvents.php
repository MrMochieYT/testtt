<?php

namespace achedon\FoodEffect\events;

use achedon\FoodEffect\Main;
use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemConsumeEvent;

class PlayerEvents implements Listener{

    public function onConsume(PlayerItemConsumeEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        $ids = array_keys(Main::getInstance()->getConfig()->getAll());
        if (in_array($item->getId(), $ids)){
            $food = Main::getInstance()->getConfig()->getAll()[$item->getId()];
            $effect = $food["effect"];
            foreach($effect as $id => $values){
                $player->getEffects()->add(new EffectInstance($this->getEffect($id), $values["duration"], $values["level"], $values["visible"]));
            }
        }
    }

    private function getEffect(int $id): Effect{
        $allEffects = [];
        foreach (VanillaEffects::getAll() as $effect){
            $allEffects[] = $effect;
        }
        return $allEffects[$id];
    }
}