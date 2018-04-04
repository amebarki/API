-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 04 Avril 2018 à 14:56
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.1.12-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pokecard`
--

-- --------------------------------------------------------

--
-- Structure de la table `cardPokemons`
--

CREATE TABLE `cardPokemons` (
  `id` int(11) NOT NULL,
  `pokemon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cardPokemons`
--

INSERT INTO `cardPokemons` (`id`, `pokemon_id`, `user_id`) VALUES
(22, 151, 1),
(23, 249, 1),
(25, 1, 2),
(28, 282, 1),
(29, 140, 2),
(40, 417, 5),
(41, 585, 5),
(42, 718, 5),
(43, 77, 5),
(44, 168, 5),
(45, 341, 5),
(46, 99, 5),
(47, 742, 5),
(48, 345, 5),
(71, 692, 5),
(72, 231, 5),
(73, 476, 5),
(74, 488, 5),
(75, 476, 5),
(76, 314, 5),
(77, 534, 5),
(78, 673, 5),
(79, 83, 5),
(80, 430, 1),
(81, 617, 1),
(82, 779, 1),
(83, 176, 1),
(84, 494, 1),
(85, 535, 1),
(86, 552, 1),
(87, 370, 1),
(88, 656, 1),
(89, 240, 1),
(90, 483, 1),
(91, 162, 1),
(92, 747, 1),
(93, 43, 1),
(94, 662, 1);

-- --------------------------------------------------------

--
-- Structure de la table `exchanges`
--

CREATE TABLE `exchanges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pokemon_offer_id` int(11) NOT NULL,
  `pokemon_wanted_id` int(11) NOT NULL,
  `offer_accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `exchanges`
--

INSERT INTO `exchanges` (`id`, `user_id`, `pokemon_offer_id`, `pokemon_wanted_id`, `offer_accepted`) VALUES
(2, 1, 140, 282, 1),
(3, 1, 282, 2, 0),
(4, 1, 282, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sprite` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `type1` int(11) DEFAULT NULL,
  `type2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pokemons`
--

INSERT INTO `pokemons` (`id`, `name`, `sprite`, `description`, `type1`, `type2`) VALUES
(1, 'bulbasaur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png', 'Bulbasaur can be seen napping in bright sunlight.\\nThere is a seed on its back. By soaking up the sun’s rays,\\nthe seed grows progressively larger.', 4, 12),
(35, 'clefairy', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/35.png', 'On nights with a full moon, they gather together\nand dance. The surrounding area is enveloped\nin an abnormal magnetic field.', 18, NULL),
(41, 'zubat', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/41.png', 'When exposed to sunlight, they suffer burns.\nThe frequency of their ultrasonic waves can\ndiffer slightly from colony to colony.', 4, 3),
(42, 'golbat', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/42.png', 'Sometimes they drink so much blood, they can’t\nfly anymore. Then they fall to the ground and\nbecome food for other Pokémon.', 4, 3),
(43, 'oddish', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/43.png', 'Oddish searches for fertile, nutrient-rich soil, then plants itself.\nDuring the daytime, while it is planted, this Pokémon’s feet\nare thought to change shape and become similar to the roots\nof trees.', 12, 4),
(61, 'poliwhirl', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/61.png', 'It marches over the land in search of bug\nPokémon to eat. Then it takes them underwater\nso it can dine on them where it’s safe.', 11, NULL),
(77, 'ponyta', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/77.png', 'Ponyta is very weak at birth. It can barely stand up.\nThis Pokémon becomes stronger by stumbling and\nfalling to keep up with its parent.', 10, NULL),
(83, 'farfetchd', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/83.png', 'Farfetch’d is always seen with a stalk from a plant of some\nsort. Apparently, there are good stalks and bad stalks. This\nPokémon has been known to fight with others over stalks.', 1, 3),
(85, 'dodrio', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/85.png', 'Apparently, the heads aren’t the only parts of the body that\nDodrio has three of. It has three sets of hearts and lungs as\nwell, so it is capable of running long distances without rest.', 1, 3),
(99, 'kingler', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/99.png', 'Kingler has an enormous, oversized claw. It waves this huge\nclaw in the air to communicate with others. However, because\nthe claw is so heavy, the Pokémon quickly tires.', 11, NULL),
(110, 'weezing', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/110.png', 'Weezing alternately shrinks and inflates its twin bodies to mix\ntogether toxic gases inside. The more the gases are mixed,\nthe more powerful the toxins become. The Pokémon also\nbecomes more putrid.', 4, NULL),
(113, 'chansey', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/113.png', 'Not only are these Pokémon fast runners,\nthey’re also few in number, so anyone who finds\none must be lucky indeed.', 1, NULL),
(121, 'starmie', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/121.png', 'Its unusual body shape, reminiscent of abstract\nart, led local people to spread rumors that this\nPokémon may be an invader from outer space.', 11, 14),
(128, 'tauros', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/128.png', 'Although it’s known to be a fierce Pokémon,\nTauros in the Alola region are said to possess\na measure of calmness.', 1, NULL),
(132, 'ditto', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/132.png', 'With its astonishing capacity for\nmetamorphosis, it can get along with anything.\nIt does not get along well with its fellow Ditto.', 1, NULL),
(140, 'kabuto', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/140.png', 'Kabuto is a Pokémon that has been regenerated from a fossil.\nHowever, in extremely rare cases, living examples have\nbeen discovered. The Pokémon has not changed at all for\n300 million years.', 6, 11),
(151, 'mew', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/151.png', 'Mew is said to possess the genetic composition of all\nPokémon. It is capable of making itself invisible at will,\nso it entirely avoids notice even if it approaches people.', 14, NULL),
(154, 'meganium', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/154.png', 'The fragrance of Meganium’s flower soothes and calms\nemotions. In battle, this Pokémon gives off more of its\nbecalming scent to blunt the foe’s fighting spirit.', 12, NULL),
(162, 'furret', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/162.png', 'Furret has a very slim build. When under attack, it can slickly\nsquirm through narrow spaces and get away. In spite of its\nshort limbs, this Pokémon is very nimble and fleet.', 1, NULL),
(166, 'ledian', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/166.png', 'In battle, it throws punches with all four arms.\nThe power of each individual blow is piddly,\nso it aims to win by quantity rather than quality.', 7, 3),
(168, 'ariados', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/168.png', 'It spins thread from both its rear and its mouth.\nThen it wraps its prey up in thread and sips\ntheir bodily fluids at its leisure.', 7, 4),
(174, 'igglybuff', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/174.png', 'It moves by bouncing along. As it moves a lot,\nit sweats, and its body gives off a sweet aroma.', 1, 18),
(176, 'togetic', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/176.png', 'Togetic is said to be a Pokémon that brings good fortune.\nWhen the Pokémon spots someone who is pure of heart,\nit is said to appear and share its happiness with that person.', 18, 3),
(179, 'mareep', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/179.png', 'Mareep’s fluffy coat of wool rubs together and builds a static\ncharge. The more static electricity is charged, the more brightly\nthe lightbulb at the tip of its tail glows.', NULL, NULL),
(212, 'scizor', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/212.png', 'Once it has identified an enemy, this Pokémon\nsmashes it mercilessly with pincers hard\nas steel.', 7, 9),
(214, 'heracross', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/214.png', 'Heracross has sharp claws on its feet. These are planted\nfirmly into the ground or the bark of a tree, giving the\nPokémon a secure and solid footing to forcefully fling away\nfoes with its proud horn.', 7, 2),
(223, 'remoraid', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/223.png', 'Remoraid sucks in water, then expels it at high velocity using\nits abdominal muscles to shoot down flying prey. When\nevolution draws near, this Pokémon travels downstream\nfrom rivers.', 11, NULL),
(224, 'octillery', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/224.png', 'Octillery grabs onto its foe using its tentacles. This Pokémon\ntries to immobilize it before delivering the finishing blow. If the\nfoe turns out to be too strong, Octillery spews ink to escape.', 11, NULL),
(227, 'skarmory', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/227.png', 'Its metal body is sturdy, but it does rust rather\neasily. So on rainy days, this Pokémon prefers\nto stay put in its nest.', 9, 3),
(229, 'houndoom', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/229.png', 'In a Houndoom pack, the one with its horns raked sharply\ntoward the back serves a leadership role. These Pokémon\nchoose their leader by fighting among themselves.', 17, 10),
(231, 'phanpy', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/231.png', 'Phanpy uses its long nose to shower itself. When others\ngather around, they thoroughly douse each other with water.\nThese Pokémon can be seen drying their soaking-wet\nbodies at the edge of water.', 5, NULL),
(239, 'elekid', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/239.png', 'This Pokémon is constantly fighting with\nTogedemaru that try to steal its electricity.\nIt’s a pretty even match.', NULL, NULL),
(240, 'larvitar', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/246.png', 'Larvitar is born deep under the ground. To come up to the\\nsurface, this Pokémon must eat its way through the soil above.\\nUntil it does so, Larvitar cannot see its parents.', 5, 6),
(249, 'lugia', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/249.png', 'Lugia’s wings pack devastating power—a light fluttering of its\\nwings can blow apart regular houses. As a result, this\\nPokémon chooses to live out of sight deep under the sea.', 14, 3),
(254, 'sceptile', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/254.png', 'Sceptile has seeds growing on its back. They are said to be\nbursting with nutrients that revitalize trees. This Pokémon\nraises the trees in a forest with loving care.', 12, NULL),
(259, 'marshtomp', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/259.png', 'Marshtomp is much faster at traveling through mud than it is at\nswimming. This Pokémon’s hindquarters exhibit obvious\ndevelopment, giving it the ability to walk on just its hind legs.', 11, 5),
(261, 'poochyena', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/261.png', 'Poochyena is an omnivore—it will eat anything. A distinguishing\nfeature is how large its fangs are compared to its body. This\nPokémon tries to intimidate its foes by making the hair on its\ntail bristle out.', 17, NULL),
(282, 'gardevoir', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/282.png', 'Gardevoir has the psychokinetic power to distort the\\ndimensions and create a small black hole. This Pokémon\\nwill try to protect its Trainer even at the risk of its own life.', 14, 18),
(284, 'masquerain', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/284.png', 'Its wings and antennae don’t cope well with\nmoisture. After a rain, it faces sunward to\ndry off.', 7, 3),
(303, 'mawile', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/303.png', 'Don’t be taken in by this Pokémon’s cute face—it’s very\ndangerous. Mawile fools the foe into letting down its guard,\nthen chomps down with its massive jaws. The steel jaws are\nreally horns that have been transformed.', 9, 18),
(308, 'medicham', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/308.png', 'Through the power of meditation, Medicham developed its\nsixth sense. It gained the ability to use psychokinetic powers.\nThis Pokémon is known to meditate for a whole month\nwithout eating.', 2, 14),
(313, 'volbeat', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/313.png', 'Volbeat’s tail glows like a lightbulb. With other Volbeat,\nit uses its tail to draw geometric shapes in the night sky.\nThis Pokémon loves the sweet aroma given off by Illumise.', 7, NULL),
(314, 'illumise', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/314.png', 'Illumise leads a flight of illuminated Volbeat to draw signs in\nthe night sky. This Pokémon is said to earn greater respect\nfrom its peers by composing more complex designs in the sky.', 7, NULL),
(317, 'swalot', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/317.png', 'Swalot has no teeth, so what it eats, it swallows whole, no\nmatter what. Its cavernous mouth yawns widely. An automobile\ntire could easily fit inside this Pokémon’s mouth.', 4, NULL),
(334, 'altaria', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/334.png', 'Altaria sings in a gorgeous soprano. Its wings are like cotton\nclouds. This Pokémon catches updrafts with its buoyant wings\nand soars way up into the wild blue yonder.', 16, 3),
(341, 'corphish', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/341.png', 'Corphish catches prey with its sharp claws. It has no\nlikes or dislikes when it comes to food—it will eat anything.\nThis Pokémon has no trouble living in filthy water.', 11, NULL),
(345, 'lileep', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/345.png', 'Lileep is an ancient Pokémon that was regenerated from a\nfossil. It remains permanently anchored to a rock. From its\nimmobile perch, this Pokémon intently scans for prey with its\ntwo eyes.', 6, 12),
(349, 'feebas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/349.png', 'Although unattractive and unpopular, this\nPokémon’s marvelous vitality has made it a\nsubject of research.', 11, NULL),
(370, 'luvdisc', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/370.png', 'Loving couples have a soft spot for this\nPokémon, so honeymoon hotels often release\nthis Pokémon into their pools.', 11, NULL),
(388, 'grotle', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/388.png', 'It knows where pure water wells up. It carries fellow\nPokémon there on its back.', 12, NULL),
(392, 'infernape', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/392.png', 'It tosses its enemies around with agility. It uses all\nits limbs to fight in its own unique style.', 10, 2),
(397, 'staravia', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/397.png', 'It lives in forests and fields. Squabbles over\nterritory occur when flocks collide.', 1, 3),
(401, 'kricketot', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/401.png', 'When its antennae hit each other, it sounds like the\nmusic of a xylophone.', 7, NULL),
(403, 'shinx', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/403.png', 'All of its fur dazzles if danger is sensed. It flees\nwhile the foe is momentarily blinded.', NULL, NULL),
(412, 'burmy-trash', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/412.png', 'If its cloak is broken in battle, it quickly remakes\nthe cloak with materials nearby.', 7, NULL),
(417, 'pachirisu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/417.png', 'A pair may be seen rubbing their cheek pouches\ntogether in an effort to share stored electricity.', NULL, NULL),
(425, 'drifloon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/425.png', 'If for some reason its body bursts, its soul spills\nout with a screaming sound.', 8, 3),
(429, 'mismagius', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/429.png', 'Mismagius have been known to cast spells to\nmake people fall in love, so some people search\nfor this Pokémon as if their life depended on it.', 8, NULL),
(430, 'honchkrow', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/430.png', 'If its Murkrow cronies fail to catch food for it,\nor if it feels they have betrayed it, it will hunt\nthem down wherever they are and punish them.', 17, 3),
(439, 'mime-jr', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/439.png', 'It habitually mimics foes. Once mimicked, the foe\ncannot take its eyes off this Pokémon.', 14, 18),
(457, 'lumineon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/457.png', 'This deep-sea Pokémon lives at the bottom of\nthe sea. Its fins haul it over the seabed in\nsearch of its favorite food—Starmie.', 11, NULL),
(470, 'leafeon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/470.png', 'The younger they are, the more they smell like\nfresh grass. With age, their fragrance takes on\nthe odor of fallen leaves.', 12, NULL),
(473, 'mamoswine', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/473.png', 'Its impressive tusks are made of ice. The population\nthinned when it turned warm after the ice age.', 15, 5),
(476, 'probopass', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/476.png', 'The main body controls three mobile units called\nMini-Noses, which it maneuvers to catch prey.', 6, 9),
(482, 'azelf', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/482.png', 'It is thought that Uxie, Mesprit, and Azelf all came\nfrom the same egg.', 14, NULL),
(483, 'dialga', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/483.png', 'It has the power to control time. It appears in\nSinnoh-region myths as an ancient deity.', 9, 16),
(488, 'cresselia', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/488.png', 'Those who sleep holding Cresselia’s feather are\nassured of joyful dreams. It is said to represent\nthe crescent moon.', 14, NULL),
(494, 'victini', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/494.png', 'When it shares the infinite energy it creates,\nthat being’s entire body will be overflowing\nwith power.', 14, 10),
(504, 'patrat', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/504.png', 'Extremely cautious, one of them will always be on\nthe lookout, but it won’t notice a foe coming\nfrom behind.', 1, NULL),
(534, 'conkeldurr', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/534.png', 'Rather than rely on force, they master moves that\nutilize the centrifugal force of spinning concrete.', 2, NULL),
(535, 'tympole', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/535.png', 'By vibrating its cheeks, it emits sound waves\nimperceptible to humans. It uses the rhythm of\nthese sounds to talk.', 11, NULL),
(541, 'swadloon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/541.png', 'It protects itself from the cold by wrapping up in\nleaves. It stays on the move, eating leaves\nin forests.', 7, 12),
(549, 'lilligant', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/549.png', 'As soon as it finds a male to be its partner,\nthe beautiful flower on its head darkens,\ndroops, and withers away.', 12, NULL),
(551, 'sandile', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/551.png', 'It conceals itself in the sand and chomps down\non the legs of any prey that unwarily walk over\nit. Its favorite food is Trapinch.', 5, 17),
(552, 'krokorok', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/552.png', 'Thanks to the special membrane covering its\neyes, it can see its surroundings clearly, even in\nthe middle of the night.', 5, 17),
(553, 'krookodile', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/553.png', 'After clamping down with its powerful jaws,\nit twists its body around to rip its prey in half.', 5, 17),
(561, 'sigilyph', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/561.png', 'The guardians of an ancient city, they always fly\nthe same route while keeping watch for invaders.', 14, 3),
(585, 'deerling-winter', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/585.png', 'The turning of the seasons changes the color and\nscent of this Pokémon’s fur. People use it to mark\nthe seasons.', 1, 12),
(593, 'jellicent', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/593.png', 'The fate of the ships and crew that wander into\nJellicent’s habitat: all sunken, all lost, all vanished.', 11, 8),
(601, 'klinklang', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/601.png', 'Its red core functions as an energy tank. It fires the\ncharged energy through its spikes into an area.', 9, NULL),
(602, 'tynamo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/602.png', 'One alone can emit only a trickle of electricity,\nso a group of them gathers to unleash a powerful\nelectric shock.', NULL, NULL),
(606, 'beheeyem', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/606.png', 'It uses psychic power to control an opponent’s\nbrain and tamper with its memories.', 14, NULL),
(608, 'lampent', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/608.png', 'It arrives near the moment of death and steals spirit\nfrom the body.', 8, 10),
(609, 'chandelure', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/609.png', 'The spirits burned up in its ominous flame lose their\nway and wander this world forever.', 8, 10),
(617, 'accelgor', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/617.png', 'When its body dries out, it weakens. So, to prevent\ndehydration, it wraps itself in many layers of\nthin membrane.', 7, NULL),
(621, 'druddigon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/621.png', 'It warms its body by absorbing sunlight with its\nwings. When its body temperature falls, it can no\nlonger move.', 16, NULL),
(626, 'bouffalant', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/626.png', 'Their fluffy fur absorbs damage, even if they strike\nfoes with a fierce headbutt.', 1, NULL),
(639, 'terrakion', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/639.png', 'Spoken of in legend, this Pokémon used its\nphenomenal power to destroy a castle in its effort\nto protect Pokémon.', 6, 2),
(643, 'reshiram', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/643.png', 'When Reshiram’s tail flares, the heat energy moves\nthe atmosphere and changes the world’s weather.', 16, 10),
(656, 'froakie', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/656.png', 'It protects its skin by covering its body in\ndelicate bubbles. Beneath its happy-go-lucky air,\nit keeps a watchful eye on its surroundings.', 11, NULL),
(662, 'fletchinder', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/662.png', 'It will not tolerate other Fletchinder entering its\nterritory, which has a radius of several miles.', 10, 3),
(673, 'gogoat', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/673.png', 'They inhabit mountainous regions.\nThe leader of the herd is decided by\na battle of clashing horns.', 12, NULL),
(679, 'honedge', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/679.png', 'If anyone dares to grab its hilt, it wraps\na blue cloth around that person’s arm and\ndrains that person’s life energy completely.', 9, 8),
(692, 'clauncher', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/692.png', 'Through controlled explosions of internal gas,\nit can expel water like a pistol shot.\nAt close distances, it can shatter rock.', 11, NULL),
(698, 'amaura', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/698.png', 'This calm Pokémon lived in a cold land where\nthere were no violent predators like Tyrantrum.', 6, 15),
(710, 'pumpkaboo-average', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/710.png', 'It is said to carry wandering spirits\nto the place where they belong\nso they can move on.', 8, 12),
(718, 'zygarde', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/718.png', 'It’s thought to be monitoring the ecosystem.\nThere are rumors that even greater power lies\nhidden within it.', 16, 5),
(723, 'dartrix', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/723.png', 'It throws sharp feathers called blade quills\nat enemies or prey. It seldom misses.', 12, 3),
(733, 'toucannon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/733.png', 'Within its beak, its internal gas ignites,\nexplosively launching seeds with enough power\nto pulverize boulders.', 1, 3),
(741, 'oricorio-baile', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/741.png', 'This Oricorio has sipped red nectar. Its\npassionate dance moves cause its enemies\nto combust in both body and mind.', 10, 3),
(742, 'cutiefly', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/742.png', 'Myriads of Cutiefly flutter above the heads of\npeople who have auras resembling those\nof flowers.', 7, 18),
(745, 'lycanroc-midday', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/745.png', 'When properly raised from a young age, it will\nbecome a trustworthy partner that will\nabsolutely never betray its Trainer.', 6, NULL),
(746, 'wishiwashi-solo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/746.png', 'It’s awfully weak and notably tasty, so everyone\nis always out to get it. As it happens, anyone\ntrying to bully it receives a painful lesson.', 11, NULL),
(747, 'mareanie', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/747.png', 'It’s found crawling on beaches and seafloors.\nThe coral that grows on Corsola’s head is as\ngood as a five-star banquet to this Pokémon.', 4, 11),
(769, 'sandygast', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/769.png', 'It takes control of anyone who puts a hand in its\nmouth. And so it adds to the accumulation of\nits sand-mound body.', 8, 5),
(779, 'bruxish', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/779.png', 'It stuns its prey with psychokinesis and then\ngrinds them to mush with its strong teeth.\nEven Shellder’s shell is no match for it.', 11, 14),
(799, 'guzzlord', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/799.png', 'A dangerous Ultra Beast, it appears to be eating\nconstantly, but for some reason its droppings\nhave never been found.', 17, 16),
(800, 'necrozma', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/800.png', 'Light is apparently the source of its energy.\nIt has an extraordinarily vicious disposition\nand is constantly firing off laser beams.', 14, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'normal'),
(2, 'fighting'),
(3, 'flying'),
(4, 'poison'),
(5, 'ground'),
(6, 'rock'),
(7, 'bug'),
(8, 'ghost'),
(9, 'steel'),
(10, 'fire'),
(11, 'water'),
(12, 'grass'),
(13, 'electrik'),
(14, 'psychic'),
(15, 'ice'),
(16, 'dragon'),
(17, 'dark'),
(18, 'fairy'),
(10001, 'unknown'),
(10002, 'shadow');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'adam', 'mebaad10@gmail.com'),
(2, 'florian', 'florian@gmail.com'),
(3, 'babar', 'babar@gmail.com'),
(5, 'Adam Mebarki', 'nasaru@hotmail.fr');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cardPokemons`
--
ALTER TABLE `cardPokemons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pokemon_id` (`pokemon_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cardPokemons`
--
ALTER TABLE `cardPokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT pour la table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=801;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cardPokemons`
--
ALTER TABLE `cardPokemons`
  ADD CONSTRAINT `cardPokemons_ibfk_1` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemons` (`id`),
  ADD CONSTRAINT `cardPokemons_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
