<?php

declare(strict_types=1);

namespace MinionPlugin;

use pocketmine\entity\Human;
use pocketmine\item\Item;
use pocketmine\world\particle\DestroyBlockParticle;
use pocketmine\block\Block;
use pocketmine\world\Position;

class Minion extends Human {

    public function onUpdate(int $currentTick): bool {
        if ($this->isClosed() || !$this->isAlive()) {
            return false;
        }

        $blockPos = $this->getPosition()->add(0, -1, 0);
        $block = $this->getWorld()->getBlock($blockPos);

        if ($block->getId() !== 0) {
            $this->breakBlock($blockPos);
        }

        return parent::onUpdate($currentTick);
    }

    private function breakBlock(Position $pos): void {
        $block = $this->getWorld()->getBlock($pos);
        if ($block->getId() !== 0) {
            $this->getWorld()->setBlock($pos, Block::get(0));
            $this->getWorld()->addParticle($pos, new DestroyBlockParticle($block));
            $this->getInventory()->addItem(Item::get($block->getId(), 0, 1));
        }
    }
}