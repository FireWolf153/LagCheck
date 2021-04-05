<?php 

namespace LagCheck;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase{
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        switch($cmd->getName()){
            case "ping":
                if(count($args) != 1){
                    $sender->sendMessage(C::RED . "Usage: /ping <player>");
                }else if($sender->hasPermission("lagcheck.command.ping")){
                    $player = $this->getServer()->getPlayer($args[0]);
                    if($player instanceof Player){
                        $ping = $player->getPing();
                        $sender->sendMessage(C::GREEN . $player->getName() . "'s Ping: " . C::AQUA . $ping);
                        if($ping <= 40){
                            $sender->sendMessage(C::GREEN . "Strong Connection!");
                        }else if($ping <= 100){
                            $sender->sendMessage(C::DARK_GREEN . "OK Connection!");
                        }else if($ping <= 400){
                            $sender->sendMessage(C::YELLOW . "Poor Connection!");
                        }else{
                            $sender->sendMessage(C::RED . "Terrible Connection!");
                        }
                    }else{
                        $sender->sendMessage(C::RED . "That player either has not joined the server or is not currently online.");
                    }
                }else{
                    $sender->sendMessage(C::RED . "You do not have permission to run that command.");
                }
                break;
        }
        return true;
    }
}