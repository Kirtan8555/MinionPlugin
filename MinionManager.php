<?php

declare(strict_types=1);

namespace MinionPlugin;

use pocketmine\player\Player;
use pocketmine\entity\Entity;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\Position;

class MinionManager {

    public static function spawnMinion(Player $player): void {
        $pos = $player->getPosition();
        $nbt = Entity::createBaseNBT($pos);
        $minion = new Minion($player->getWorld(), $nbt);
        $minion->spawnToAll();
    }
}