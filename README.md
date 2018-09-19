# nfq
NFQ akademijos pirma užduotis...

Info:
  - SQL connection duomenys -> App\Core\Database\PDOGateway objekte
  - routai aprašomi App\Routes\Web.php


 - iki dviejų lygių routeris.
 - pridedant nauja routą nurodomas jo tipas. 
            Jeigu post -> į routinamą metodą routeris pridės Request objektą, į kurį sumapinti POST parametrai.
            Jeigu get -> į routinamą controllerio metodą paduos GET parametrų masyvą.
 - modeliai su duombaze bendrauja per savo mapperių objektus.
 - mapperių konstruktoriai tikisi gaut DB gateway objektą (implementinantį IDatabase).
 - duombazės gateway objektas implementina IDatabase interfeisą.
 
 TO DO:
      logiką perkelti iš controllerių į service layerį
