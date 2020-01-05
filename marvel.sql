-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2020 at 09:03 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marvel`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(200) NOT NULL,
  `category_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`) VALUES
(1, 'Characters'),
(2, 'Comics'),
(3, 'Movies'),
(4, 'Tv Shows'),
(5, 'Games');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_user_id` int(200) DEFAULT NULL,
  `comment_username` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `comment_role` varchar(255) NOT NULL DEFAULT 'visitor',
  `comment_image` text NOT NULL DEFAULT 'icon.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_user_id`, `comment_username`, `comment_email`, `comment_content`, `comment_date`, `comment_status`, `comment_role`, `comment_image`) VALUES
(1, 21, 2, 'HulkSmash', 'Hulk@example.com', 'In a stand up fight, The Hulk would win almost every time!!!', '2020-01-04', 'approved', 'user', 'hulkicon.jpg'),
(2, 11, 2, 'HulkSmash', 'Hulk@example.com', 'The most amusing movie having to do with Marvel and certainly one of the best in the MCU.', '2020-01-04', 'approved', 'user', 'hulkicon.jpg'),
(3, 11, 4, 'Marvel-Angel', 'Marvel-Angel@example.com', 'I am Groot ^_^', '2020-01-04', 'approved', 'user', 'groot.jpg'),
(4, 17, 4, 'Marvel-Angel', 'Marvel-Angel@example.com', 'Love the comics and the show!!', '2020-01-04', 'approved', 'user', 'groot.jpg'),
(5, 13, 4, 'Marvel-Angel', 'Marvel-Angel@example.com', 'Can\'t stop playing this gameee', '2020-01-04', 'approved', 'user', 'groot.jpg'),
(6, 5, 5, 'Mind-Stone', 'Mind-Stone@example.com', 'Its one of the best series I ever saw.First of all, Jon Bernthal is killing it. He made the character so realistic, and natural perfect job at expressing every emotion that needs to be expressed by this complex character. Whoever haven\'t watched it, I strongly recommend to to watch it..A Must Watch!!', '2020-01-04', 'approved', 'user', 'thanosicon.png'),
(7, 1, 5, 'Mind-Stone', 'Mind-Stone@example.com', 'Love reading x-men characters backstory.', '2020-01-04', 'approved', 'user', 'thanosicon.png'),
(8, 11, NULL, 'music-comics', 'tabatha@example.com', 'Can we just talk about how awesome the soundtrack is!!', '2020-01-04', 'approved', 'visitor', 'icon.png'),
(9, 23, NULL, 'JessTheHero', 'Jess@example.com', 'defiantly one of the most powerful beings in the MU.', '2020-01-05', 'approved', 'visitor', 'icon.png'),
(10, 24, 6, 'WinterSoldier', 'WinterSoldier@example.com', 'One of the original Marvel characters, can\'t believe the Hulk has always been on the verge of cancellation!!', '2020-01-05', 'approved', 'user', 'WinterSoldiericon.jpg'),
(11, 22, 6, 'WinterSoldier', 'WinterSoldier@example.com', 'Everything about this movie is just PERFECT!!  every second of the movie was heart pounding and exciting.', '2020-01-05', 'approved', 'user', 'WinterSoldiericon.jpg'),
(12, 23, 1, 'x-men93', 'x-men93@example.com', 'He is so strong that his armor instead of protecting him from external threats, it protects the universe from his own body.', '2020-01-05', 'approved', 'admin', 'xmen.jpg'),
(13, 24, 2, 'HulkSmash', 'Hulk@example.com', 'Love his quotes “Don\'t make me angry. You wouldn\'t like me when I\'m angry.” is my top favorite XD', '2020-01-05', 'approved', 'user', 'hulkicon.jpg'),
(14, 24, NULL, 'CaptainBlob', 'blob@example.com', 'In every the Hulk conversation, someone has to ask \"Who would win: The Hulk vs ....\" Hahaha', '2020-01-05', 'approved', 'visitor', 'icon.png'),
(15, 22, 1, 'x-men93', 'x-men93@example.com', 'Saw it at the theaters 8 times!!', '2020-01-05', 'approved', 'admin', 'xmen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(200) NOT NULL,
  `post_category_id` int(200) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_subtitle` varchar(255) NOT NULL,
  `user_name_id` int(200) NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_subtitle`, `user_name_id`, `post_image`, `post_content`, `post_tags`) VALUES
(1, 1, 'Cyclops', 'Scott Summers', 1, 'cyclops.jpeg', '<p>Scott Summers was the first of two sons born to Major Christopher Summers, a test pilot for the U.S. Air Force, and his wife Katherine. Christopher was flying his family home from vacation when their plane was attacked by a spacecraft from the interstellar Shi\'ar Empire. To save their lives, Katherine pushed Scott and his brother&nbsp;Alex&nbsp;out of the plane with the only available parachute. Scott suffered a head injury upon landing, thus forever preventing him from controlling his mutant power by himself.</p><p>With their parents presumed dead, the authorities separated the two boys. Alex was adopted, but Scott remained comatose in a hospital for a year. On recovering, he was placed in an orphanage in Omaha, Nebraska that was secretly controlled by his future enemy, the evil geneticist&nbsp;Mister Sinister.</p><p>As a teenager, Scott came into the foster care of Jack Winters, a mutant criminal known as the Jack O\'Diamonds. After Scott began to suffer from severe headaches he was sent to a specialist who discovered that lenses made of ruby quartz corrected the problem. Soon after, Scott\'s mutant power first erupted from his eyes as an uncontrollable blast of optic force. The blast demolished a crane, causing it to drop its payload toward a terrified crowd. Scott saved lives by obliterating the object with another blast, but the bystanders believed that he had tried to kill them and rallied into an angry mob. Scott fled, escaping on a freight train.</p><p>Winters sought to use Scott\'s newfound talent in his crimes, and physically abused the young boy when he initially refused. However, Scott\'s display of power had attracted the attention of the mutant telepath&nbsp;Professor Charles Xavier, who teamed up with F.B.I. agent Fred Duncan in their mutual attempt to find Scott. Scott was rescued from Winter\'s clutches and was enlisted by Xavier as the first member of the&nbsp;X-Men, a team of young mutants who trained to use their powers in the fight for human\'s mutant equality.</p>', 'Scott Summers Cyclops'),
(2, 1, 'She-Hulk', 'Jennifer Walters', 1, 'shehulk.jpg', '<p>Following an injury, Walters received an emergency blood transfusion from her cousin, Bruce Banner, and acquired a milder version of his Hulk condition. As such, Walters becomes a large, powerful green-hued version of herself while still largely retaining her personality. In particular, she retains her intelligence and emotional control, although like Hulk, she still becomes stronger if enraged. In later issues of the comics, her transformation is permanent.</p><p>She-Hulk has been a member of the Avengers, the Fantastic Four, Heroes for Hire, the Defenders, Fantastic Force and S.H.I.E.L.D. As a highly skilled lawyer, she has served as legal counsel to various superheroes on numerous occasions.</p>', 'Jennifer Walters She-Hulk'),
(3, 3, 'Iron Man', 'Tony Stark', 1, 'ironman.png', '<p>Iron Man tells the story of Tony Stark, a billionaire industrialist and genius inventor who is kidnapped and forced to build a devastating weapon. Instead, using his intelligence and ingenuity, Tony builds a high-tech suit of armor and escapes captivity. When he uncovers a nefarious plot with global implications, he dons his powerful armor and vows to protect the world as Iron Man.</p><p>&nbsp;</p><p><strong>Directed By:</strong> Jon Favreau</p><p><strong>Run Time: </strong>126 min</p><p><strong>Release Date: </strong>May 2, 2008</p>', 'Tony Stark iron man avengers'),
(4, 2, 'Avengers Origins', 'Vision (2013) #1', 2, 'vision.jpg', '<p>Is he man or machine? Created by the evil Ultron, The Vision was meant to be a terrifying weapon of destruction. But when tasked with destroying The Avengers, he must decide whether to follow his programming...or defy his creator. Witness the origin of The Avenger\'s most mysterious member in this exciting one-shot!</p><p>Written by Kyle Higgins &amp; Alec Siegel with art by Stephane Perger.&nbsp;</p>', 'Vision Avengers'),
(5, 4, 'The Punisher|Season 1', 'Frank Castle', 3, 'thepunisher.jpg', '<p>After the murder of his family, marine veteran Frank Castle became a vigilante known as \'The Punisher\' with only one goal in mind - to avenge them. &nbsp;</p><p><strong>Starting:</strong> Jon Bernthal</p><p><strong>Release: </strong>2017</p><p><strong>No. of episodes:</strong> 13</p><p>&nbsp;</p>', 'the punisher'),
(6, 1, 'The Thing', 'Benjamin \"Ben\" Grimm', 4, 'thething.jpg', '<p>Orphan Benjamin J. Grimm grew up on the sordid sidewalks of New York’s Yancy Street and grew up to be a gruff but kindhearted young man whose only escape lay in a college football scholarship. While attending Empire State he earned the eternal friendship of genius Reed Richards and promised to pilot the starship Richards intended to design and build.&nbsp;</p><p>Reconnecting with Reed Richards, Grimm agreed to take his friend and siblings Sue and Johnny Storm on an illicit test flight of Richards’ new spacecraft, but warned him of his misgivings over its shielding. While in space, the four found themselves bombarded by cosmic rays and Grimm managed to bring the ship in for a crash-landing back on Earth. Upon emerging from the wreckage, the crew was subject to incredible changes from the radiation, and the pilot himself transformed into a hulking, boulder-skinned monstrosity quickly dubbed the Thing. From then on, Grimm and his fellow travelers would operate as team—and a family—known as the Fantastic Four.</p><p>The Thing stands as one of the most powerful individuals on the planet, perhaps second only to the Hulk. His unique physique enables him to lift nearly one-hundred tons, withstand extreme temperatures, and survive intense bombardments of energy and explosive detonations.</p><p>Ben Grimm’s outward form has mutated over his years as the Thing, changing from a lumpy hide to what appears to be individual rocks linked together, and at one time he possessed the ability to regain his human form at will. This ability is no longer available to him, but after much time living with his deformity, he’s gained a level of complacency with it.</p><p>&nbsp;</p>', 'Benjamin Ben Grimm Thing'),
(7, 5, 'Marvel vs Capcom', 'Infinite', 4, 'marvelcapcon.jpg', '<p>Marvel vs. Capcom: Infinite features a variety of exciting and accessible single player modes and rich multi-player content for new players and longtime fans alike. In addition to single player Arcade, Training, and Mission modes, a visually stunning and immersive cinematic Story Mode puts players at the center of both universes as they battle for supremacy against powerful forces and a new villain.</p><p>&nbsp;</p><p><strong>Release Year:</strong> 2017</p><p><strong>Genre:</strong> Fighting</p><p><strong>Publisher:</strong> Capcom</p><p><strong>Rating: </strong>Teen</p><p><strong>Available On:</strong> Xbox One, Playstation 4, Windows PC</p>', 'Marvel vs. Capcom Infinite'),
(8, 2, 'Spider-Man Unlimited', '(1993) #1', 2, 'spiderman.jpg', '<p>MAXIMUM CARNAGE PART 1 Carnage has returned and he\'s ready to bring his brand of murder and mayhem to New York. But when Carnage adopts like-minded allies, it becomes Maximum Carnage. Can Spider-Man, Venom and others stop him?</p><p>&nbsp;</p><p><strong>Published: </strong>May 01, 1993</p>', 'Spider-Man Unlimited'),
(9, 2, 'The Life of Captain Marvel', '(2018) #1', 3, 'captainmarvel.jpg', '<p>THE DEFINITIVE ORIGIN OF CAPTAIN MARVEL! Carol Danvers was just a girl from the Boston suburbs who loved science and the Red Sox until a chance encounter with a Kree hero gave her incredible super-powers. Now, she’s a leader in the Avengers and the commander of Alpha Flight. But what if there were more to the story? When crippling anxiety attacks put her on the sidelines in the middle of a fight, Carol finds herself reliving memories of a life she thought was far behind her. You can’t outrun where you’re from — and sometimes, you HAVE to go home again. But there are skeletons in Captain Marvel’s closet — and what she discovers will change her entire world. Written by best-selling author Margaret Stohl and drawn by fan-favorite comics veteran Carlos Pacheco, this is the true origin of Captain Marvel.&nbsp;</p><p>&nbsp;</p><p><strong>Published: </strong>July 18, 2018</p>', 'The Life of Captain Marvel'),
(10, 3, 'Captain America', 'The First Avenger', 4, 'captainamerica.jpg', '<p>Marvel\'s \"Captain America: The First Avenger\" focuses on the early days of the Marvel Universe when Steve Rogers volunteers to participate in an experimental program that turns him into the Super Soldier known as Captain America.</p><p>&nbsp;</p><p><strong>Directed By:</strong> Joe Johnston</p><p><strong>Rating:</strong> PG-13</p><p><strong>Run Time:</strong> 124 min</p><p><strong>Release Date:</strong> July 22, 2011</p>', 'Captain America avengers'),
(11, 3, 'Guardians of the Galaxy', 'Vol 1', 2, 'GuardiansoftheGalaxy.jpg', '<p>An action-packed, epic space adventure, Marvel\'s \"Guardians of the Galaxy,\" expands the Marvel Cinematic Universe into the cosmos, where brash adventurer Peter Quill finds himself the object of an unrelenting bounty hunt after stealing a mysterious orb coveted by Ronan, a powerful villain with ambitions that threaten the entire universe. To evade the ever-persistent Ronan, Quill is forced into an uneasy truce with a quartet of disparate misfits--Rocket, a gun-toting raccoon; Groot, a tree-like humanoid; the deadly and enigmatic Gamora; and the revenge-driven Drax the Destroyer. But when Quill discovers the true power of the orb and the menace it poses to the cosmos, he must do his best to rally his ragtag rivals for a last, desperate stand--with the galaxy\'s fate in the balance.</p><p><strong>Directed By: </strong>James Gunn</p><p><strong>Rating:</strong> PG-13</p><p><strong>Run Time:</strong> 121 min</p><p><strong>Release Date:</strong> August 1, 2014</p>', 'Guardians of the Galaxy'),
(12, 4, 'Jessica Jones', 'Season 1', 2, 'jessicajones.jpg', '<p>Following the tragic end of her brief superhero career, Jessica Jones tries to rebuild her life as a private investigator, dealing with cases involving people with remarkable abilities in New York City.</p><p><strong>Starting:</strong> Krysten Ritter</p><p><strong>Release: </strong>2015</p><p><strong>No. of episodes:</strong> 13</p>', 'jessica jones'),
(13, 5, 'marvel contest of champions', 'Video game', 5, 'marvelcontestofchampions.jpg', '<p>Iron Man vs. Captain America! Hulk vs. Wolverine! Drax vs. Deadpool! The greatest battles in Marvel history are in your hands! The greedy Elder of the Universe known as The Collector has summoned you to a brawl of epic proportions against a line-up of vile villains including Thanos, Kang the Conqueror, and many more! Experience the ultimate free-to-play fighting game on your mobile device… Contest of Champions! Who\'s on your team?</p><p>&nbsp;</p><p><strong>Genre: </strong>Action</p><p><strong>Publisher:</strong> Kabam</p><p><strong>Available On:</strong> iOS and Android</p>', 'marvel fight champions'),
(14, 4, 'Luke Cage', 'Season 1', 5, 'lukecage.jpg', '<p>After a sabotaged experiment leaves him with super strength and unbreakable skin, Luke Cage becomes a fugitive trying to rebuild his life in modern day Harlem, New York City. But he is soon pulled out of the shadows and must fight a battle for the heart of his city - forcing him to confront a past he had tried to bury.</p><p><strong>Starting:</strong> Mike Colter</p><p><strong>Release: </strong>2016</p><p><strong>No. of episodes:</strong> 13</p>', 'luke cage defenders'),
(15, 1, 'Magneto', 'Max Eisenhardt', 5, 'magneto.jpg', '<p>Among Earth’s most powerful mutants, Magneto’s abilities are essentially limitless. He can manipulate all forms of magnetism, summon force fields and shoot electromagnetic pulses that can disable electronic devices. He can assemble complex machinery in seconds and manipulate the iron in blood to take control of people’s actions. He has even shown power over forms of energy on the electromagnetic spectrum like visible light and gamma rays, though he rarely uses these abilities. On top of these gifts Magneto possesses genius level intelligence in multiple technical fields and genetic engineering. He is a brilliant tactician, a natural born leader and, though he rarely demonstrates it, a trained hand-to-hand combatant.</p>', 'Magneto Max Eisenhardt'),
(16, 1, 'Venom', 'Eddie Brock', 5, 'venom.jpg', '<p>A hulking and twisted distortion of Spider-Man, Venom is the result of an alien symbiote merged with a human holding a bitter grudge against Peter Parker. This combination has proven nearly lethal to the wall-crawler numerous times.</p><p>Despite his hatred of Spider-Man, Venom has a twisted sense of morality, avoiding harming anyone he deems to be innocent and even performing heroic deeds. However, it is never clear how long Venom\'s darker impulses can be held in check. No matter how hard anyone tries to keep the symbiote down, Venom always manages to come back, like a plague.</p>', 'Eddie Brock venom spiderman'),
(17, 1, 'Daredevil', 'Matthew \"Matt\" Murdock', 5, 'daredevilmatt.jpg', '<p>Daredevil\'s origins stem from a childhood accident that gave him special abilities. While growing up in the historically gritty or crime-ridden working class Irish-American neighborhood of Hell\'s Kitchen in New York City, <strong>Matt Murdock</strong> is blinded by a radioactive substance that falls from an out-of-control truck after he pushes a man out of the path of the oncoming vehicle. While he no longer can see, his exposure to the radioactive material heightens his remaining senses beyond normal human ability, and gives him a \"radar sense.\" His father, a boxer named Jack Murdock, is a single man raising his now blind son. Jack is later killed by gangsters after refusing to throw a fight, leaving Matt an orphan. Some years later, after donning a yellow and red costume (which he soon changes to all red), Matt seeks out revenge against his father\'s killers as the superhero Daredevil, fighting against many villains, including his enemies Bullseye and the Kingpin. He also becomes a lawyer after having graduated from Columbia Law School with his best friend and roommate, Franklin \"Foggy\" Nelson.&nbsp;</p>', 'Matthew Matt Murdock Daredevil'),
(18, 3, 'Doctor Strange', 'Stephen Strange', 1, 'doctorstrange.jpeg', '<p>From Marvel Studios comes “Doctor Strange,” the story of world-famous neurosurgeon Dr. Stephen Strange whose life changes forever after a horrific car accident robs him of the use of his hands. When traditional medicine fails him, he is forced to look for healing, and hope, in an unlikely place—a mysterious enclave known as Kamar-Taj. He quickly learns that this is not just a center for healing but also the front line of a battle against unseen dark forces bent on destroying our reality. Before long Strange—armed with newly acquired magical powers—is forced to choose whether to return to his life of fortune and status or leave it all behind to defend the world as the most powerful sorcerer in existence.</p><p>&nbsp;</p><p><strong>Directed By:</strong> Scott Derrickson</p><p><strong>Rating:</strong> PG-13</p><p><strong>Run Time: </strong>115 min</p><p><strong>Release Date:</strong> November 4, 2016</p>', 'Doctor Strange Doctor Stephen'),
(19, 5, 'Spider-Man', '2018 video game', 3, 'spidermanbegreater.jpg', '<p>Sony Interactive Entertainment, Insomniac Games, and Marvel have teamed up to create a brand-new and authentic Spider-Man adventure. This isn’t the Spider-Man you’ve met or ever seen before. This is an experienced Peter Parker who’s more masterful at fighting big crime in New York City. At the same time, he’s struggling to balance his chaotic personal life and career while the fate of millions of New Yorkers rest upon his shoulders.</p><p>&nbsp;</p><p><strong>Release Year:</strong> 2018</p><p><strong>Genre:</strong> Action-adventure</p><p><strong>Publisher:</strong> Sony Interactive Entertainment</p><p><strong>Rating: </strong>Teen</p><p><strong>Available On:</strong> Playstation 4</p>', 'spider-man spider man'),
(20, 4, 'Agent Carter', 'Peggy Carter', 3, 'agentcarter.jpg', '<p>Dedicated to the fight against new Atomic Age threats in the wake of World War II, Peggy must now journey from New York City to Los Angeles for her most dangerous assignment yet. But even as she discovers new friends, a new home – perhaps even a new love – she\'s about to find out that the bright lights of the post-war Hollywood mask a more sinister threat to everyone she is sworn to protect.</p><p><strong>Starting:</strong> Hayley Atwell&nbsp;</p><p><strong>Release: </strong>2015&nbsp;</p><p><strong>No. of episodes:</strong> 8</p>', 'Agent Carter Peggy'),
(21, 1, 'Iron Man', 'Tony Stark', 3, 'ironmancharacter.jpg', '<p>Tony Stark is the wealthy son of industrialist and weapons manufacturer Howard Stark and his wife, Maria. Tony grew up a genius with a brilliant mind for technology and inventions and, naturally, followed in his father’s footsteps, inheriting Stark Industries upon his parents’ untimely death. Tony designed many weapons of war for Stark Industries, far beyond what any other company was creating, while living the lifestyle of an irresponsible playboy.</p><p>Fate would take a dark turn for Tony Stark once he decided to consult on a weapons contract overseas in enemy terrain. An improvised explosive device exploded underneath Tony’s transport, and he was brought to the brink of death.</p><p>Awakening as a prisoner of the warlord Wong-Chu, Tony made a gruesome discovery: the explosion had sent a piece of shrapnel mere inches from his heart. It was only the timely intervention of fellow captive and engineer Yinsen that kept the shrapnel at bay.While held captive, and forced to work on weapons, Tony turned his near-death experience into inspiration. What if he could power an iron suit that would not only keep the shrapnel from killing Tony, but also help him to escape Combining their genius, Tony and Yinsen built a mighty suit of iron armor that would be dubbed Iron Man. This first suit left a lot of room for improvement, but it still did what Tony couldn’t do alone. Yinsen sacrificed his life so the final preparations could be made, and Tony, wearing the Iron Man suit for the first time, escaped and returned to the United States a changed man.With full access to his equipment, Tony built a new, more streamlined suit of armor—the first of many updated versions he would create—and dedicated his life to fighting threats to the world.</p>', 'Tony Stark Iron Man'),
(22, 3, 'Avengers', 'Infinity War', 6, 'avengers.jpg', '<p>An unprecedented cinematic journey ten years in the making and spanning the entire Marvel Cinematic Universe, Marvel Studios\' \"Avengers: Infinity War\" brings to the screen the ultimate, deadliest showdown of all time. As the Avengers and their allies have continued to protect the world from threats too large for any one hero to handle, a new danger has emerged from the cosmic shadows: Thanos. A despot of intergalactic infamy, his goal is to collect all six Infinity Stones, artifacts of unimaginable power, and use them to inflict his twisted will on all of reality. Everything the Avengers have fought for has led up to this moment - the fate of Earth and existence itself has never been more uncertain.&nbsp;</p><p><strong>Directed By:</strong> Anthony Russo, Joe Russo</p><p><strong>Rating:</strong> PG-13</p><p><strong>Run Time:</strong> 149 min</p><p><strong>Release Date:</strong> April 27, 2018</p>', 'Infinity War Avengers'),
(23, 1, 'Galactus', 'Galan', 6, 'Galactus.jpeg', '<p>Sole survivor of the universe existing before the Big Bang, Galactus is perhaps the most feared being in the cosmos. Untold billions of years ago, he was born the humanoid Galan on the planet Taa, a wondrous paradise of scientific and social achievement; however, his universe was in its final stages, with all matter plunging towards a central point via the \"Big Crunch\", collapsing into a new \"Cosmic Egg\", a sphere of disorganized, compact primordial matter. Galan, a space explorer, discovered a radiation-plague threatening all of Taa. Though he was initially scoffed at, the truth became clear as the people of surrounding planets perished. Despite the efforts of Taa\'s greatest scientists, no cure could be found, and the population began to die off. Galan convinced the handful of remaining survivors to die gloriously by flying a starship into the blazing cosmic cauldron. The others were killed by the intense radiation, but Galan was filled with new energy and saved by the Phoenix Force of the dying universe. The sentient energy spoke to Galan as it brought him into the Egg.</p>', 'Galactus Galan'),
(24, 1, 'Hulk', 'Bruce Banner', 6, 'hulk.png', '<p>Bruce Banner was a top scientist for the military that was working on a gamma bomb, a weapon of massive destructive power. During a test of the gamma bomb, Bruce noticed a young teenager by the name of Rick Jones had entered the test site. Bruce rushed to aide the young man, and in pushing Rick into a trench, exposed himself to the rays of the gamma bomb. The result of this exposure would be to transform gentle Bruce Banner into the destructive monster known as The Incredible Hulk.</p><p>The Hulk has gone through many different personality transformations during his lifetime. At first, the Hulk had very little of Bruce Banner in him and was easily angered, making him a threat to mankind. Banner was able to control the beast for a time and went on to help form the Avengers in the process. However, his control would wane, and the Hulk continued to threaten the world.</p><p>When Bruce Banner changes into the Hulk, he becomes an unstoppable beast of near unlimited strength, power, and destruction. The Hulk’s strength is probably the greatest in the Marvel universe, with many foes falling to his thunderous attacks. The Hulk is also able to leap great distances traveling for miles before bounding upwards again.</p><p>For his size, the Hulk is incredibly fast and can run great distances at extreme speeds. He generally travels by jumping as described above though. The hulk is also highly resistant to damage, being near impervious to most forms of damage. Very little has been known to faze the Hulk, except those of the same power level as the Hulk such as The Thing, Thor, Abomination, and others.</p>', 'Hulk Bruce Banner');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL DEFAULT 'icon.png',
  `user_role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_fname`, `user_lname`, `user_email`, `user_image`, `user_role`) VALUES
(1, 'x-men93', '$2y$12$7rZev2G3598p5CcS4eW2POaD4CiK61M39vCfqviM/mV/XTnnvEnHG', 'Maryam', 'J', 'x-men93@example.com', 'xmen.jpg', 'admin'),
(2, 'HulkSmash', '$2y$12$xHL/NS1OoLbr5D.JiYKB5.UAIMXb7GtIhny44t9rHzcGZEupFh2f2', 'Angie', 'Reeves', 'Hulk@example.com', 'hulkicon.jpg', 'user'),
(3, 'Web-Head', '$2y$12$nY2RU4rJ/qGIQQtt1Nh7i.Upl1MLtugRYbi1aTsf7BuJHht7nVEp6', 'Byron', 'Ward', 'spiderman@example.com', 'spidermanicon.png', 'user'),
(4, 'Marvel-Angel', '$2y$12$DQDmB.WW8k9C6OVVQDYlOeaxTqRtT7siuow8TLKDPazpwKomzI.BC', 'Mindy', 'Sutton', 'Marvel-Angel@example.com', 'groot.jpg', 'user'),
(5, 'Mind-Stone', '$2y$12$Mjov4JEtdKCVU6i/xvb5r.dyq8fSnPHlWIySFR3kv48ICwMqflQdS', 'Franklin', 'Warner', 'Mind-Stone@example.com', 'thanosicon.png', 'user'),
(6, 'WinterSoldier', '$2y$12$SaPbWKKlPpdwtMixSEVfYuS4H1fsIKkNzjeQc.MeduawIWAVOA5k6', 'Jasmine', 'Mussio', 'WinterSoldier@example.com', 'WinterSoldiericon.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_post_id` (`comment_post_id`),
  ADD KEY `comment_user_id` (`comment_user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_name_id` (`user_name_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_name_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
