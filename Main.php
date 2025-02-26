<?php

declare(strict_types=1);

namespace MinionPlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\entity\Entity;

class Main extends PluginBase implements Listener {

    private static Main $instance;

    public function onEnable(): void {
        self::$instance = $this;
        $this->getLogger()->info("Minion Plugin Enabled!");
        Entity::registerEntity(Minion::class, true);
    }

    public static function getInstance(): Main {
        return self::$instance;
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "minion") {
            if ($sender instanceof Player) {
                (new MinionGUI())->openMinionMenu($sender);
                return true;
            }
        }
        return false;
    }
}