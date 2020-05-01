<?php
declare(strict_types=1);
/*
  _____ _             _    _____  ______
 / ____| |           | |  |  __ \|  ____|
| (___ | |_ ___   ___| | _| |__) | |__
 \___ \| __/ _ \ / __| |/ /  ___/|  __|
 ____) | || (_) | (__|   <| |    | |____
|_____/ \__\___/ \___|_|\_\_|    |______|
                                         */
namespace StockPE\MCBE;

//pmmp libs!
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\command\{Command, CommandSender, defaults\VanillaCommand};
use pocketmine\lang\TranslationContainer;
use pocketmine\utils\Config;
use ZipArchive;

class GenCommand extends PluginBase {

    public function onEnable()
      {
        $this->saveResource("Template.zip", true);
        $this->getServer()->getLogger()->info("[StockPE] skyblock generator activated, VAAN VOON VEEN...");
      }
      
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool
      {
      	  switch($command->getName())
      	   {
      	      case "sb gen":
      	      if($sender instanceof Player)
      	       {
      	       	 $IslandName = $sender->getName();
      	       	 $temp = $this->getDataFolder() . "Template.zip";
      	       	 $worldsdir = $this->getServer()->getDataPath() . "worlds/" . $IslandName . ".zip";
      	       	 $duplicate = copy($temp, $worldsdir);
      	       	 $zip = new ZipArchive;
      	       	 $res = $zip->open($worldsdir);
      	       	 if($res === TRUE)
      	       	  {
      	       	    $zip->extractTo($this->getServer()->getDataPath() . "worlds/" . $IslandName . "/");
      	       	    $zip->close();
      	       	  }
      	       }
      	      break;
      	   }
      	  return true;
      }
}
?>