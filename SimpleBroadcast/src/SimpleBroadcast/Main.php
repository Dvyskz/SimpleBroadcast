<?php

namespace SimpleBroadcast;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info(TextFormat::GREEN . "SimpleBroadcast plugin activado!");
    }

    public function onDisable(): void {
        $this->getLogger()->info(TextFormat::RED . "SimpleBroadcast plugin desactivado!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "ann") {
            if (!$sender->hasPermission("SimpleBroadcast.use")) {
                $sender->sendMessage(TextFormat::RED . "No tienes permiso para usar este comando.");
                return false;
            }

            if (empty($args)) {
                $sender->sendMessage(TextFormat::YELLOW . "Uso: /ann <mensaje>");
                return false;
            }

            $mensaje = implode(" ", $args);
            $alerta = TextFormat::BOLD . TextFormat::RED . "[ALERTA] " . TextFormat::WHITE . $mensaje;

            foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                $player->sendMessage($alerta);
            }

            return true;
        }

        return false;
    }
}