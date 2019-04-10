<!-- 
File: lib.php
Purpose: Set of variables and functions used by multiple scripts (library)
-->

<?php
/* Important variables */
$FirstNames = array ("Wallace",  "Richard", "Rosendo", "Kristopher", "Rodger",
                     "Elden",    "Rodrigo", "Dominic", "Ron",        "Deandre",
                     "Cletus",   "Teddy",   "Malcom",  "Anthony",    "Zachariah",
                     "Oscar",    "Michael", "Harland", "Marvin",     "Bo",
                     "Deloise",  "Grace",   "Maurita", "Suzi",       "Brandie",
                     "Annita",   "Verdie",  "Joy",     "Nicolette",  "Darlene",
                     "Jaquelyn", "Anna",    "Ellan",   "Elicia",     "Breanne",
                     "Desire",   "Kacie",   "Tiffany", "Effie",      "Roxy"
                    );

$LastNames  = array ("Navarrette", "Rivers", "Calaway", "Mortenson", "Badalamenti",
                     "Ivy",        "Nakano", "Cortes",  "Gambino",   "Mersh",
                     "Blackmon",   "Do",     "Tong",    "Paula",     "Lindow",
                     "Schaeffer",  "Munn",   "Ramirez", "Espinoza",  "Amar"
                    );

$Positions  = array ("Manager", "Warehouse Worker", "Custodian", "Supervisor",
                     "Assistant Manager", "Human Resources", "Facility Maintenance"
                    );

$ItemCategories = array ("Sports", "Books", "Games", "Electronics", "Clothing",
                         "Jewelry", "Automotive", "Health"
                     );

//Single quotes are doubled up in order to escape the single quote
$ItemNames = array ("Basketball", "Football", "Soccer Ball", "Baseball", "Tennis Ball",
                    "First 100 Words", "Diary of a Wimpy Kid: Old School",
                    "The Immortal Nicholas", "Giraffes Can''t Dance", "Fallout 4",
                    "Call of Duty: Black Ops III", "Star Wars: Battlefront",
                    "Super Mario Maker", "Yoshi''s Wooly World", "Nexus 6P", "Nexus 5X",
                    "LG G4", "Xperia Z5", "Galaxy S6", "Galaxy Note 5", "iPhone 6s", "GoPro",
                    "Levi''s 511", "Levi''s 514", "Hanes Underwear", "Nike Socks", "Watch",
                    "Necklace", "Earrings", "Diamond Ring", "Car Tires", "NGK Spark Plugs",
                    "Castrol Motor Oil", "Prestone Brake Fluid", "Honda Power Steering Fluid",
                    "Advil", "Claritin", "Zyrtec", "Tylenol", "Pepto Bismol"
                );
$SupplierNames = array ("Acme", "Globex", "Initech", "Umbrella", "Hooli",
                        "Zumcon", "Zerelectrics", "Inphase", "Dontechno"
                       );

$Addresses = array ("8391 Spruce Avenue, Martinsville, VA 24112", "9383 Route 7, Leominster, MA 01453",
                    "3837 Lawrence Street, Oswego, NY 13126", "2222 King Street, Orland Park, IL 60462",
                    "163 River Road, Corona, NY 11368", "8247 Maple Lane, Grovetown, GA 30813",
                    "152 Cherry  Street, Pelham, AL 35124", "521 Lexington Court, Biloxi, MS 39532",
                    "171 Overlook Circle, Torrance, CA 90505", "324 Cemetery Road, Palos Verdes Peninsula, CA 90274",
                    "156 Windsor Court, Acworth GA 30101", "736 Sprint Street, Galloway, OH 43119",
                    "866 Briarwood Drive, Parkville, MD 21234", "702 Circle Drive, Carpentersville, IL 60110",
                    "218 Amherst Street, Palm Bay, FL 32907", "822 7th Avenue, Gettysburg, PA 17325"
                );

$EmailAddresses = array ("Montwely54@dayrep.com", "Sumeence1942@einrot.com", "Proo1957@armyspy.com",
                         "Brothe@teleworm.us", "Wooke1930@einrot.com", "Truithe41@rhyta.com", 
                         "Fread1993@cuvox.de", "Consy1937@rhyta.com", "Morel970@gmail.com",
                         "Thansin1950@yahoo.com", "Suas1943@teleworm.us", "Thur1952@fleckens.hu",
                         "Begrommento@aol.com", "Tinticulge1953@hotmail.com", "Bele1958@csub.edu",
                         "gfmhsbea@sharklasers.com", "" 
                     );

$BusinessNames = array ("Blue Delve Industries", "Excalibur Services", "Soar Inc", "Fiddle Inc",
                        "Silver Airstream", "Bedlam Technologies", "Tickertape Inc",
                        "Loadstone Works", "Longboard Systems", "Beeline Services",
                        "Green Goblet Global", "Black Radical Reptiles Works", "Iron Horse",
                        "DEF Enterprises", "Yellow Bird Corp", "Umbrella Corporation"
                     );
$BusinessAddresses = array ("70 Vine Street, Eau Claire, WI 54701", "87 Main Street North, Canal Winchester, OH 43110",
                          "668 Highland Drive, Staten Island, NY 10301", "932 Fulton Street, Mentor, OH 44060",
                          "645 3rd Avenue, Fairburn, GA 30213", "54 Redwood Drive, Joliet, IL 60435",
                          "201 Orchard Lane, Niagara Falls, NY 14304", "962 Route 7, North Bergen, NJ 07047",
                          "7436 Cherry Street, Canton, GA 30114", "7460 Monroe Street, Yuba City, CA 95993",
                          "5520 5th Street, Macomb MI 48042", "3572 Fulton Street, Clermont, FL 34711",
                          "5843 Route 70, Branford, CT 06405", "4937 Pennsylvania Avenue, Upper Darby, PA 19082",
                          "677 Prospect Avenue, Miami, FL 33125", "460 North Avenue, Piscataway, NJ 08854",
                          "259 5th Avenue, East Meadow, NY 11554", "54 Williams Street, Norristown, PA 19401",
                          "974 Route 17, Zionsville, IN 46077", "355 Harrison Avenue, Ozone Park, NY 11417"
                      );

$ShippingMethods = array ("Ground Shipping", "2 Day Air", "Next Day Air", "Priority Shipping", "Economy Shipping");

/* 
    sets cookie to HTTP-Only and inaccessible to other 
    scripting lang. prevent XSS attacks
*/
//ini_set("session.cookie_secure",1);
//ini_set("session.cookie_httponly", 1);
//ini_set("session.use_only_cookies",1);

/* 
    This function will redirect to the login page if the user is 
    already logged in. You should not need to modify this function
    except for location to 'home' page
*/
function redirect_if_offline() {
    session_start();

    // Destroy session and redirect to home page if not logged in
    if (!isset($_SESSION['active'])) {
      setcookie(session_name(),"",-1,"/");
      $_SESSION = array();
      session_destroy();
      header("location: myIndex.php");  // <-might have to change location
    }
}

function isActive() {
    if ($_SESSION['active']) {
        return true;
    } else {
        return false;
    }
}

function redirectHome() {
    if (!$_SESSION['active']) {
        header("location: myIndex.php");
    }
}

function redirectLogin() {
    header("location: login.php");
}

function getDateTime() {
    $date = getdate();
    if ($date[hours] >= 13) {
        $date[hours] -= 12;
        $pm = true;
    }

    if ($pm) {
        return "$date[hours]:$date[minutes]:$date[seconds] PM $date[weekday],
            $date[month] $date[mday], $date[year]";
    }

    else {
        return "$date[hours]:$date[minutes]:$date[seconds] AM $date[weekday],
            $date[month] $date[mday], $date[year]";
    }
}
?>
