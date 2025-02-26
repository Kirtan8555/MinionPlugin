<?php

declare(strict_types=1);

namespace MinionPlugin;

use pocketmine\player\Player;
use pocketmine\form\Form;

class MinionGUI {

    public function openMinionMenu(Player $player): void {
        $form = new class() implements Form {
            public function handleResponse(Player $player, $data): void {
                if ($data === null) return;
                switch ($data) {
                    case 0:
                        MinionManager::spawnMinion($player);
                        $player->sendMessage("§aआपका मिनियन स्पॉन हो गया!");
                        break;
                    case 1:
                        $player->sendMessage("§cआपने मिनियन स्पॉन नहीं किया।");
                        break;
                }
            }

            public function jsonSerialize(): array {
                return [
                    "type" => "modal",
                    "title" => "Minion Menu",
                    "content" => "क्या आप मिनियन स्पॉन करना चाहते हैं?",
                    "button1" => "✔ हाँ",
                    "button2" => "✖ नहीं"
                ];
            }
        };

        $player->sendForm($form);
    }
}