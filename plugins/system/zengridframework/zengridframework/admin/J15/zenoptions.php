<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// no direct access
defined('_JEXEC') or die('Restricted index access');

/**
 * Renders a list element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementZenoptions extends JElement
{
	/**
	* Element type
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Zenoptions';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgf = ZenGrid::getInstance();
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;
		$template = $zgf->getTemplateName();

		if ($zgfEnabled) {

			jimport('joomla.filesystem.folder');
			jimport('joomla.filesystem.file');
			$class = ($node->attributes('class') ? 'class="'.$node->attributes('class').'"' : 'class="inputbox"');
			$display = $node->attributes('display') ? $node->attributes('display') : "";

				$values = array('gridcount' => array('0' => 'none', 'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9', 'ten' => '10', 'eleven' => '11', 'twelve' => '12'),
							'fonts' => array(
							'------------------- Standard ---------------------' => '',
							'Cambria, Georgia, Times, Times New Roman, serif' => 'Cambria, Georgia, Times, Times New Roman, serif',
							'Adobe Caslon Pro, Georgia, Garamond, Times, serif' => 'Adobe Caslon Pro, Georgia, Garamond, Times, serif',
							'Courier new, Courier, Andale Mono' => 'Courier new, Courier, Andale Mono',
							'Garamond, ‘Times New Roman’, Times, serif' => 'Garamond, ‘Times New Roman’, Times, serif',
							'Georgia, Times, ‘Times New Roman’, serif' => 'Georgia, Times, ‘Times New Roman’, serif',
							'GillSans, Calibri, Trebuchet, arial sans-serif' => 'GillSans, Calibri, Trebuchet, arial sans-serif',
							'sans-serif' => 'Helvetica Neue, Helvetica, Arial, sans-serif',
							'Lucida Grande, Geneva, Helvetica, sans-serif' => 'Lucida Grande, Geneva, Helvetica, sans-serif',
							'Palatino, ‘Times New Roman’, serif' => 'Palatino, ‘Times New Roman’, serif',
							'Tahoma, Verdana, Geneva' => 'Tahoma, Verdana, Geneva',
							'Trebuchet ms, Tahoma, Arial, sans-serif' => 'Trebuchet ms, Tahoma, Arial, sans-serif',
							'--------------------- Serif ---------------------' => '',
							'Adamina'=>'Adamina',
							'Alegreya'=>'Alegreya',
							'Alegreya SC'=>'Alegreya SC',
							'Alice'=>'Alice',
							'Alike'=>'Alike',
							'Alike+Angular'=>'Alike Angular',
							'Almendra'=>'Almendra',
							'Almendra+SC'=>'Almendra SC',
							'Amethysta'=>'Amethysta',
							'Andada'=>'Andada',
							'Antic+Didone'=>'Antic Didone',
							'Antic+Slab'=>'Antic Slab',
							'Arapey'=>'Arapey',
							'Arbutus+Slab'=>'Arbutus Slab',
							'Artifika'=>'Artifika',
							'Arvo'=>'Arvo',
							'Average'=>'Average',
							'Balthazar'=>'Balthazar',
							'Belgrano'=>'Belgrano',
							'Bentham'=>'Bentham',
							'Bitter'=>'Bitter',
							'Brawler'=>'Brawler',
							'Bree+Serif'=>'Bree Serif',
							'Buenard'=>'Buenard',
							'Cambo'=>'Cambo',
							'Cantata+One'=>'Cantata One',
							'Cardo'=>'Cardo',
							'Caudex'=>'Caudex',
							'Copse'=>'Copse',
							'Coustard'=>'Coustard',
							'Crete+Round'=>'Crete Round',
							'Crimson+Text'=>'Crimson Text',
							'Cutive'=>'Cutive',
							'Della+Respira'=>'Della Respira',
							'Droid+Serif'=>'Droid Serif',
							'EB+Garamond'=>'EB Garamond',
							'Enriqueta'=>'Enriqueta',
							'Esteban'=>'Esteban',
							'Fanwood+Text'=>'Fanwood Text',
							'Fenix'=>'Fenix',
							'Fjord+One'=>'Fjord One',
							'Gentium+Basic'=>'Gentium Basic',
							'Gentium+Book+Basic'=>'Gentium Book Basic',
							'Glegoo'=>'Glegoo',
							'Goudy+Bookletter+1911'=>'Goudy Bookletter 1911',
							'Habibi'=>'Habibi',
							'Headland+One'=>'Headland One',
							'Holtwood+One+SC'=>'Holtwood One SC',
							'IM+Fell+DW+Pica'=>'IM Fell DW Pica',
							'IM+Fell+DW+Pica+SC'=>'IM Fell DW Pica SC',
							'IM+Fell+Double+Pica'=>'IM Fell Double Pica',
							'IM+Fell+Double+Pica+SC'=>'IM Fell Double Pica SC',
							'IM+Fell+English'=>'IM Fell English',
							'IM+Fell+English+SC'=>'IM Fell English SC',
							'IM+Fell+French+Canon'=>'IM Fell French Canon',
							'IM+Fell+French+Canon+SC'=>'IM Fell French Canon SC',
							'IM+Fell+Great+Primer'=>'IM Fell Great Primer',
							'IM+Fell+Great+Primer+SC'=>'IM Fell Great Primer SC',
							'Inika'=>'Inika',
							'Italiana'=>'Italiana',
							'Jacques+Francois'=>'Jacques Francois',
							'Josefin+Slab'=>'Josefin Slab',
							'Judson'=>'Judson',
							'Junge'=>'Junge',
							'Kameron'=>'Kameron',
							'Kotta+One'=>'Kotta One',
							'Kreon'=>'Kreon',
							'Ledger'=>'Ledger',
							'Linden+Hill'=>'Linden Hill',
							'Lora'=>'Lora',
							'Lusitana'=>'Lusitana',
							'Lustria'=>'Lustria',
							'Marcellus'=>'Marcellus',
							'Marcellus+SC'=>'Marcellus SC',
							'Marko+One'=>'Marko One',
							'Mate'=>'Mate',
							'Mate+SC'=>'Mate SC',
							'Merriweather'=>'Merriweather',
							'Montaga'=>'Montaga',
							'Neuton'=>'Neuton',
							'Noticia+Text'=>'Noticia Text',
							'Old+Standard+TT'=>'Old Standard TT',
							'Oranienbaum'=>'Oranienbaum',
							'Ovo'=>'Ovo',
							'PT+Serif'=>'PT Serif',
							'PT+Serif+Caption'=>'PT Serif Caption',
							'Petrona'=>'Petrona',
							'Playfair Display'=>'Playfair Display',
							'Podkova'=>'Podkova',
							'Poly'=>'Poly',
							'Port+Lligat+Slab'=>'Port Lligat Slab',
							'Prata'=>'Prata',
							'Prociono'=>'Prociono',
							'Quando'=>'Quando',
							'Quattrocento'=>'Quattrocento',
							'Radley'=>'Radley',
							'Rokkitt'=>'Rokkitt',
							'Rosarivo'=>'Rosarivo',
							'Sorts+Mill+Goudy'=>'Sorts Mill Goudy',
							'Stoke'=>'Stoke',
							'Tienne'=>'Tienne',
							'Tinos'=>'Tinos',
							'Trocchi'=>'Trocchi',
							'Trykker'=>'Trykker',
							'Ultra'=>'Ultra',
							'Unna'=>'Unna',
							'Vidaloka'=>'Vidaloka',
							'Volkhov'=>'Volkhov',
							'Vollkorn'=>'Vollkorn',
							'------------------- Sans Serif -------------------' => '',
							'ABeeZee'=>'ABeeZee',
							 'Abel'=>'Abel',
							 'Aclonica'=>'Aclonica',
							 'Acme'=>'Acme',
							 'Actor'=>'Actor',
							 'Advent+Pro'=>'Advent Pro',
							 'Aldrich'=>'Aldrich',
							 'Allerta'=>'Allerta',
							 'Allerta+Stencil'=>'Allerta Stencil',
							 'Amaranth'=>'Amaranth',
							 'Andika'=>'Andika',
							 'Anonymous+Pro'=>'Anonymous Pro',
							 'Antic'=>'Antic',
							 'Anton'=>'Anton',
							 'Archivo+Black'=>'Archivo Black',
							 'Archivo+Narrow'=>'Archivo Narrow',
							 'Arimo'=>'Arimo',
							 'Armata'=>'Armata',
							 'Asap'=>'Asap',
							 'Asul'=>'Asul',
							 'Basic'=>'Basic',
							 'Belleza'=>'Belleza',
							 'BenchNine'=>'BenchNine',
							 'Bubbler+One'=>'Bubbler One',
							 'Cabin'=>'Cabin',
							 'Cabin+Condensed'=>'Cabin Condensed',
							 'Cagliostro'=>'Cagliostro',
							 'Candal'=>'Candal',
							 'Cantarell'=>'Cantarell',
							 'Cantora+One'=>'Cantora One',
							 'Capriola'=>'Capriola',
							 'Carme'=>'Carme',
							 'Carrois+Gothic'=>'Carrois Gothic',
							 'Carrois+Gothic+SC'=>'Carrois Gothic SC',
							 'Chau+Philomene+One'=>'Chau Philomene One',
							 'Chivo'=>'Chivo',
							 'Coda+Caption'=>'Coda Caption',
							 'Convergence'=>'Convergence',
							 'Cousine'=>'Cousine',
							 'Cuprum'=>'Cuprum',
							 'Days+One'=>'Days One',
							 'Didact+Gothic'=>'Didact Gothic',
							 'Doppio+One'=>'Doppio One',
							 'Dorsa'=>'Dorsa',
							 'Dosis'=>'Dosis',
							 'Droid+Sans'=>'Droid Sans',
							 'Droid+Sans+Mono'=>'Droid Sans Mono',
							 'Duru+Sans'=>'Duru Sans',
							 'Economica'=>'Economica',
							 'Electrolize'=>'Electrolize',
							 'Exo'=>'Exo',
							 'Federo'=>'Federo',
							 'Francois+One'=>'Francois One',
							 'Fresca'=>'Fresca',
							 'Galdeano'=>'Galdeano',
							 'Geo'=>'Geo',
							 'Gudea'=>'Gudea',
							 'Hammersmith One'=>'Hammersmith One',
							 'Homenaje'=>'Homenaje',
							 'Imprima'=>'Imprima',
							 'Inconsolata'=>'Inconsolata',
							 'Inder'=>'Inder',
							 'Istok+Web'=>'Istok Web',
							 'Jockey+One'=>'Jockey One',
							 'Josefin+Sans'=>'Josefin Sans',
							 'Jura'=>'Jura',
							 'Karla'=>'Karla',
							 'Krona+One'=>'Krona One',
							 'Lato'=>'Lato',
							 'League+Gothic'=>'League Gothic',
							 'Lekton'=>'Lekton',
							 'Magra'=>'Magra',
							 'Mako'=>'Mako',
							 'Marmelad'=>'Marmelad',
							 'Marvel'=>'Marvel',
							 'Maven+Pro'=>'Maven Pro',
							 'Metrophobic'=>'Metrophobic',
							 'Michroma'=>'Michroma',
							 'Molengo'=>'Molengo',
							 'Montserrat'=>'Montserrat',
							 'Montserrat+Alternates'=>'Montserrat Alternates',
							 'Montserrat+Subrayada'=>'Montserrat Subrayada',
							 'Muli'=>'Muli',
							 'News+Cycle'=>'News Cycle',
							 'Nobile'=>'Nobile',
							 'Numans'=>'Numans',
							 'Nunito'=>'Nunito',
							 'Open+Sans'=>'Open Sans',
							 'Open+Sans Condensed'=>'Open Sans Condensed',
							 'Orbitron'=>'Orbitron',
							 'Orienta'=>'Orienta',
							 'Oswald'=>'Oswald',
							 'Oxygen'=>'Oxygen',
							 'Oxygen Mono'=>'Oxygen Mono',
							 'PT+Mono'=>'PT Mono',
							 'PT+Sans'=>'PT Sans',
							 'PT+Sans+Caption'=>'PT Sans Caption',
							 'PT+Sans+Narrow'=>'PT Sans Narrow',
							 'Paytone+One'=>'Paytone One',
							 'Philosopher'=>'Philosopher',
							 'Play'=>'Play',
							 'Pontano+Sans'=>'Pontano Sans',
							 'Port+Lligat+Sans'=>'Port Lligat Sans',
							 'Puritan'=>'Puritan',
							 'Quantico'=>'Quantico',
							 'Quattrocento Sans'=>'Quattrocento Sans',
							 'Questrial'=>'Questrial',
							 'Quicksand'=>'Quicksand',
							 'Raleway'=>'Raleway',
							 'Rationale'=>'Rationale',
							 'Ropa+Sans'=>'Ropa Sans',
							 'Rosario'=>'Rosario',
							 'Ruda'=>'Ruda',
							 'Ruluko'=>'Ruluko',
							 'Russo+One'=>'Russo One',
							 'Scada'=>'Scada',
							 'Shanti'=>'Shanti',
							 'Signika'=>'Signika',
							 'Signika+Negative'=>'Signika Negative',
							 'Six+Caps'=>'Six Caps',
							 'Snippet'=>'Snippet',
							 'Source+Code+Pro'=>'Source Code Pro',
							 'Source+Sans+Pro'=>'Source Sans Pro',
							 'Spinnaker'=>'Spinnaker',
							 'Syncopate'=>'Syncopate',
							 'Telex'=>'Telex',
							 'Tenor+Sans'=>'Tenor Sans',
							 'Titillium Web'=>'Titillium Web',
							 'Ubuntu'=>'Ubuntu',
							 'Ubuntu+Condensed'=>'Ubuntu Condensed',
							 'Ubuntu+Mono'=>'Ubuntu Mono',
							 'Varela'=>'Varela',
							 'Varela+Round'=>'Varela Round',
							 'Viga'=>'Viga',
							 'Voltaire'=>'Voltaire',
							 'Wire+One'=>'Wire One',
							 'Yanone+Kaffeesatz'=>'Yanone Kaffeesatz',
							'------------------- Handwriting -------------------' => '',
							'Aguafina+Script'=>'Aguafina Script',
							'Aladin'=>'Aladin',
							'Alex+Brush'=>'Alex Brush',
							'Allura'=>'Allura',
							'Amatic+SC'=>'Amatic SC',
							'Annie+Use+Your+Telescope'=>'Annie Use Your Telescope',
							'Architects+Daughter'=>'Architects Daughter',
							'Arizonia'=>'Arizonia',
							'Bad+Script'=>'Bad Script',
							'Berkshire+Swash'=>'Berkshire Swash',
							'Bilbo'=>'Bilbo',
							'Bilbo+Swash+Caps'=>'Bilbo Swash Caps',
							'Bonbon'=>'Bonbon',
							'Butterfly+Kids'=>'Butterfly Kids',
							'Calligraffitti'=>'Calligraffitti',
							'Cedarville+Cursive'=>'Cedarville Cursive',
							'Coming+Soon'=>'Coming Soon',
							'Condiment'=>'Condiment',
							'Cookie'=>'Cookie',
							'Courgette'=>'Courgette',
							'Covered+By+Your+Grace'=>'Covered By Your Grace',
							'Crafty+Girls'=>'Crafty Girls',
							'Damion'=>'Damion',
							'Dancing+Script'=>'Dancing Script',
							'Dawning+of+a+New+Day'=>'Dawning of a New Day',
							'Delius'=>'Delius',
							'Delius+Swash+Caps'=>'Delius Swash Caps',
							'Delius+Unicase'=>'Delius Unicase',
							'Devonshire'=>'Devonshire',
							'Dr+Sugiyama'=>'Dr Sugiyama',
							'Eagle+Lake'=>'Eagle Lake',
							'Engagement'=>'Engagement',
							'Euphoria+Script'=>'Euphoria Script',
							'Felipa'=>'Felipa',
							'Fondamento'=>'Fondamento',
							'Give+You+Glory'=>'Give You Glory',
							'Gloria+Hallelujah'=>'Gloria Hallelujah',
							'Gochi+Hand'=>'Gochi Hand',
							'Great+Vibes'=>'Great Vibes',
							'Handlee'=>'Handlee',
							'Herr+Von+Muellerhoff'=>'Herr Von Muellerhoff',
							'Homemade+Apple'=>'Homemade Apple',
							'Indie+Flower'=>'Indie Flower',
							'Italianno'=>'Italianno',
							'Jim+Nightshade'=>'Jim Nightshade',
							'Julee'=>'Julee',
							'Just+Another+Hand'=>'Just Another Hand',
							'Just+Me+Again+Down+Here'=>'Just Me Again Down Here',
							'Kaushan Script'=>'Kaushan Script',
							'Kristi'=>'Kristi',
							'La+Belle+Aurore'=>'La Belle Aurore',
							'League+Script'=>'League Script',
							'Leckerli+One'=>'Leckerli One',
							'Loved+by+the+King'=>'Loved by the King',
							'Lovers+Quarrel'=>'Lovers Quarrel',
							'Marck+Script'=>'Marck Script',
							'Meddon'=>'Meddon',
							'Meie+Script'=>'Meie Script',
							'Merienda+One'=>'Merienda One',
							'Miss+Fajardose'=>'Miss Fajardose',
							'Molle'=>'Molle',
							'Monsieur+La+Doulaise'=>'Monsieur La Doulaise',
							'Montez'=>'Montez',
							'Mr+Bedfort'=>'Mr Bedfort',
							'Mr+Dafoe'=>'Mr Dafoe',
							'Mr+De+Haviland'=>'Mr De Haviland',
							'Mrs+Saint+Delafield'=>'Mrs Saint Delafield',
							'Mrs+Sheppards'=>'Mrs Sheppards',
							'Neucha'=>'Neucha',
							'Niconne'=>'Niconne',
							'Norican'=>'Norican',
							'Nothing+You+Could+Do'=>'Nothing You Could Do',
							'Over+the+Rainbow'=>'Over the Rainbow',
							'Pacifico'=>'Pacifico',
							'Parisienne'=>'Parisienne',
							'Patrick+Hand'=>'Patrick Hand',
							'Permanent+Marker'=>'Permanent Marker',
							'Petit+Formal+Script'=>'Petit Formal Script',
							'Pinyon+Script'=>'Pinyon Script',
							'Princess+Sofia'=>'Princess Sofia',
							'Qwigley'=>'Qwigley',
							'Rancho'=>'Rancho',
							'Redressed'=>'Redressed',
							'Reenie+Beanie'=>'Reenie Beanie',
							'Rochester'=>'Rochester',
							'Rock+Salt'=>'Rock Salt',
							'Romanesco'=>'Romanesco',
							'Rouge+Script'=>'Rouge Script',
							'Ruge+Boogie'=>'Ruge Boogie',
							'Ruthie'=>'Ruthie',
							'Satisfy'=>'Satisfy',
							'Schoolbell'=>'Schoolbell',
							'Shadows+Into+Light'=>'Shadows Into Light',
							'Shadows+Into+Light+Two'=>'Shadows Into Light Two',
							'Short+Stack'=>'Short Stack',
							'Sofia'=>'Sofia',
							'Sue+Ellen+Francisco'=>'Sue Ellen Francisco',
							'Sunshiney'=>'Sunshiney',
							'Swanky+and+Moo+Moo'=>'Swanky and Moo Moo',
							'Tangerine'=>'Tangerine',
							'The+Girl+Next+Door'=>'The Girl Next Door',
							'Vibur'=>'Vibur',
							'Waiting+for+the+Sunrise'=>'Waiting for the Sunrise',
							'Walter+Turncoat'=>'Walter Turncoat',
							'Yellowtail'=>'Yellowtail',
							'Yesteryear'=>'Yesteryear',
							'Zeyada'=>'Zeyada',


							'------------------- Display -------------------' => '',
							'Abril+Fatface'=>'Abril Fatface',
							 'Akronim'=>'Akronim',
							 'Alfa+Slab+One'=>'Alfa Slab One',
							 'Allan'=>'Allan',
							 'Amarante'=>'Amarante',
							 'Arbutus'=>'Arbutus',
							 'Asset'=>'Asset',
							 'Astloch'=>'Astloch',
							 'Atomic+Age'=>'Atomic Age',
							 'Aubrey'=>'Aubrey',
							 'Audiowide'=>'Audiowide',
							 'Autour+One'=>'Autour One',
							 'Averia+Gruesa+Libre'=>'Averia Gruesa Libre',
							 'Averia+Libre'=>'Averia Libre',
							 'Averia+Sans+Libre'=>'Averia Sans Libre',
							 'Averia+Serif+Libre'=>'Averia Serif Libre',
							 'Bangers'=>'Bangers',
							 'Baumans'=>'Baumans',
							 'Bevan'=>'Bevan',
							 'Bigshot+One'=>'Bigshot One',
							 'Black+Ops+One'=>'Black Ops One',
							 'Boogaloo'=>'Boogaloo',
							 'Bowlby+One'=>'Bowlby One',
							 'Bowlby+One+SC'=>'Bowlby One SC',
							 'Bubblegum+Sans'=>'Bubblegum Sans',
							 'Buda'=>'Buda',
							 'Butcherman'=>'Butcherman',
							 'Cabin+Sketch'=>'Cabin Sketch',
							 'Caesar+Dressing'=>'Caesar Dressing',
							 'Carter+One'=>'Carter One',
							 'Ceviche+One'=>'Ceviche One',
							 'Changa+One'=>'Changa One',
							 'Chango'=>'Chango',
							 'Chelsea+Market'=>'Chelsea Market',
							 'Cherry+Cream+Soda'=>'Cherry Cream Soda',
							 'Chewy'=>'Chewy',
							 'Chicle'=>'Chicle',
							 'Coda'=>'Coda',
							 'Codystar'=>'Codystar',
							 'Combo'=>'Combo',
							 'Comfortaa'=>'Comfortaa',
							 'Concert+One'=>'Concert One',
							 'Contrail+One'=>'Contrail One',
							 'Corben'=>'Corben',
							 'Creepster'=>'Creepster',
							 'Crushed'=>'Crushed',
							 'Diplomata'=>'Diplomata',
							 'Diplomata+SC'=>'Diplomata SC',
							 'Dynalight'=>'Dynalight',
							 'Eater'=>'Eater',
							 'Emblema+One'=>'Emblema One',
							 'Emilys+Candy'=>'Emilys Candy',
							 'Erica+One'=>'Erica One',
							 'Ewert'=>'Ewert',
							 'Expletus+Sans'=>'Expletus Sans',
							 'Fascinate'=>'Fascinate',
							 'Fascinate+Inline'=>'Fascinate Inline',
							 'Federant'=>'Federant',
							 'Finger+Paint'=>'Finger Paint',
							 'Flamenco'=>'Flamenco',
							 'Flavors'=>'Flavors',
							 'Fontdiner+Swanky'=>'Fontdiner Swanky',
							 'Forum'=>'Forum',
							 'Fredericka+the+Great'=>'Fredericka the Great',
							 'Fredoka+One'=>'Fredoka One',
							 'Frijole'=>'Frijole',
							 'Fugaz+One'=>'Fugaz One',
							 'Galindo'=>'Galindo',
							 'Geostar'=>'Geostar',
							 'Geostar+Fill'=>'Geostar Fill',
							 'Germania+One'=>'Germania One',
							 'Glass+Antiqua'=>'Glass Antiqua',
							 'Goblin+One'=>'Goblin One',
							 'Gorditas'=>'Gorditas',
							 'Graduate'=>'Graduate',
							 'Gravitas+One'=>'Gravitas One',
							 'Griffy'=>'Griffy',
							 'Gruppo'=>'Gruppo',
							 'Happy+Monkey'=>'Happy Monkey',
							 'Henny+Penny'=>'Henny Penny',
							 'Iceberg'=>'Iceberg',
							 'Iceland'=>'Iceland',
							 'Irish+Grover'=>'Irish Grover',
							 'Jacques+Francois+Shadow'=>'Jacques Francois Shadow',
							 'Jolly+Lodger'=>'Jolly Lodger',
							 'Kelly+Slab'=>'Kelly Slab',
							 'Kenia'=>'Kenia',
							 'Knewave'=>'Knewave',
							 'Kranky'=>'Kranky',
							 'Lancelot'=>'Lancelot',
							 'Lemon'=>'Lemon',
							 'Life+Savers'=>'Life Savers',
							 'Lilita+One'=>'Lilita One',
							 'Limelight'=>'Limelight',
							 'Lobster'=>'Lobster',
							 'Lobster+Two'=>'Lobster Two',
							 'Londrina+Outline'=>'Londrina Outline',
							 'Londrina+Shadow'=>'Londrina Shadow',
							 'Londrina+Sketch'=>'Londrina Sketch',
							 'Londrina+Solid'=>'Londrina Solid',
							 'Love+Ya+Like+A+Sister'=>'Love Ya Like A Sister',
							 'Luckiest+Guy'=>'Luckiest Guy',
							 'Macondo'=>'Macondo',
							 'Macondo+SwashCaps'=>'Macondo Swash Caps',
							 'Maiden+Orange'=>'Maiden Orange',
							 'McLaren'=>'McLaren',
							 'MedievalSharp'=>'MedievalSharp',
							 'Medula+One'=>'Medula One',
							 'Megrim'=>'Megrim',
							 'Metal+Mania'=>'Metal Mania',
							 'Metamorphous'=>'Metamorphous',
							 'Miltonian'=>'Miltonian',
							 'Miltonian Tattoo'=>'Miltonian Tattoo',
							 'Miniver'=>'Miniver',
							 'Modern+Antiqua'=>'Modern Antiqua',
							 'Monofett'=>'Monofett',
							 'Monoton'=>'Monoton',
							 'Mountains+of+Christmas'=>'Mountains of Christmas',
							 'Mystery+Quest'=>'Mystery Quest',
							 'Nixie+One'=>'Nixie One',
							 'Nosifer'=>'Nosifer',
							 'Nova+Cut'=>'Nova Cut',
							 'Nova+Flat'=>'Nova Flat',
							 'Nova+Mono'=>'Nova Mono',
							 'Nova+Oval'=>'Nova Oval',
							 'Nova+Round'=>'Nova Round',
							 'Nova+Script'=>'Nova Script',
							 'Nova+Slim'=>'Nova Slim',
							 'Nova+Square'=>'Nova Square',
							 'Oldenburg'=>'Oldenburg',
							 'Oleo+Script'=>'Oleo Script',
							 'Oregano'=>'Oregano',
							 'Original+Surfer'=>'Original Surfer',
							 'Overlock'=>'Overlock',
							 'Overlock+SC'=>'Overlock SC',
							 'Passero+One'=>'Passero One',
							 'Passion+One'=>'Passion One',
							 'Patua+One'=>'Patua One',
							 'Peralta'=>'Peralta',
							 'Piedra'=>'Piedra',
							 'Plaster'=>'Plaster',
							 'Playball'=>'Playball',
							 'Poiret+One'=>'Poiret One',
							 'Poller+One'=>'Poller One',
							 'Pompiere'=>'Pompiere',
							 'Press+Start+2P'=>'Press Start 2P',
							 'Prosto+One'=>'Prosto One',
							 'Racing+Sans+One'=>'Racing Sans One',
							 'Raleway+Dots'=>'Raleway Dots',
							 'Rammetto+One'=>'Rammetto One',
							 'Ranchers'=>'Ranchers',
							 'Revalia'=>'Revalia',
							 'Ribeye'=>'Ribeye',
							 'Ribeye+Marrow'=>'Ribeye Marrow',
							 'Righteous'=>'Righteous',
							 'Ruslan+Display'=>'Ruslan Display',
							 'Rye'=>'Rye',
							 'Sail'=>'Sail',
							 'Salsa'=>'Salsa',
							 'Sancreek'=>'Sancreek',
							 'Sansita+One'=>'Sansita One',
							 'Sarina'=>'Sarina',
							 'Seaweed+Script'=>'Seaweed Script',
							 'Sevillana'=>'Sevillana',
							 'Share'=>'Share',
							 'Shojumaru'=>'Shojumaru',
							 'Sigmar+One'=>'Sigmar One',
							 'Simonetta'=>'Simonetta',
							 'Sirin+Stencil'=>'Sirin Stencil',
							 'Skranji'=>'Skranji',
							 'Slackey'=>'Slackey',
							 'Smokum'=>'Smokum',
							 'Smythe'=>'Smythe',
							 'Sniglet'=>'Sniglet',
							 'Sofadi+One'=>'Sofadi One',
							 'Sonsie+One'=>'Sonsie One',
							 'Special+Elite'=>'Special Elite',
							 'Spicy+Rice'=>'Spicy Rice',
							 'Spirax'=>'Spirax',
							 'Squada+One'=>'Squada One',
							 'Stalinist+One'=>'Stalinist One',
							 'Stardos+Stencil'=>'Stardos Stencil',
							 'Stint+Ultra+Condensed'=>'Stint Ultra Condensed',
							 'Stint+Ultra+Expanded'=>'Stint Ultra Expanded',
							 'Supermercado+One'=>'Supermercado One',
							 'Titan+One'=>'Titan One',
							 'Trade+Winds'=>'Trade Winds',
							 'Trochut'=>'Trochut',
							 'Tulpen+One'=>'Tulpen One',
							 'Uncial+Antiqua'=>'Uncial Antiqua',
							 'Underdog'=>'Underdog',
							 'UnifrakturCook'=>'UnifrakturCook',
							 'UnifrakturMaguntia'=>'UnifrakturMaguntia',
							 'Unkempt'=>'Unkempt',
							 'Unlock'=>'Unlock',
							 'VT323'=>'VT323',
							 'Vast+Shadow'=>'Vast Shadow',
							 'Voces'=>'Voces',
							 'Wallpoet'=>'Wallpoet',
							 'Warnes'=>'Warnes',
							 'Wellfleet'=>'Wellfleet',
							 'Yeseva+One'=>'Yeseva One'

											),
						'fontoptions' => array('0' => 'ZENFONTOPTION1', '1' => 'ZENFONTOPTION2', '2' => 'ZENFONTOPTION3', '3' => 'ZENFONTOPTION4'),
						'attselector' => array('color' => 'Color', 'border-color' => 'Border-color', 'background-color' => 'Background Color'));

			$options = array ();

			switch ($display){
				case "fontoptions":
					foreach ($values['fontoptions'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}
					break;
				case "fonts":
					foreach ($values['fonts'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}
					break;
				case "gridcount":
					foreach ($values['gridcount'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}
					break;
				case "attselector":
					foreach ($values['attselector'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}

					break;
				case "listcss":

					// path to images directory
					$path		= JPATH_ROOT . '/templates/' . $template . '/css';
					$filter		= $node->attributes('filter');
					$exclude	= $node->attributes('exclude');
					$stripExt	= $node->attributes('stripext');

					if (is_dir($path)) $files = JFolder::files($path, $filter);
					else $files = false;

					$options[] = JHTML::_('select.option', '', '- '.JText::_('No hilite').' -');
					if (is_array($files))
					{
						foreach ($files as $file)
						{
							if ($exclude)
							{
								if (preg_match(chr(1) . $exclude . chr(1), $file))
								{
									continue;
								}
							}
							if ($stripExt)
							{
								$file = JFile::stripExt($file);
							}
							$options[] = JHTML::_('select.option', $file, $file);
						}

					}
					else
					{
						return 'This theme does not have any hilites currently. You can add some by putting custom css files inside of /templates/'.$template.'/css folder and adding hilite as a prefix to the file.';
					}
					break;
					case "folderlist":

						// path to images directory
						$path		= JPATH_ROOT . '/' . str_replace('[template]', $template, $node->attributes('directory'));
						$filter		= $node->attributes('filter');
						$exclude	= $node->attributes('exclude');
						$folders	= JFolder::folders($path, $filter);

						foreach ($folders as $folder)
						{
							if ($exclude)
							{
								if (preg_match(chr(1) . $exclude . chr(1), $folder)) {
									continue;
								}
							}
							$options[] = JHTML::_('select.option', $folder, $folder);
						}

						if (!$node->attributes('hide_none')) {
							array_unshift($options, JHTML::_('select.option', '-1', '- '.JText::_('Do not use').' -'));
						}

						if (!$node->attributes('hide_default')) {
							array_unshift($options, JHTML::_('select.option', '', '- '.JText::_('Use default').' -'));
						}
						break;
						case "filelist":

							// path to images directory
							$path		= JPATH_ROOT . '/' . str_replace('[template]', $template, $node->attributes('directory'));
							$filter		= $node->attributes('filter');
							$exclude	= $node->attributes('exclude');
							$stripExt	= $node->attributes('stripext');
							$files		= JFolder::files($path, $filter);

							if (!$node->attributes('hide_none'))
							{
								$options[] = JHTML::_('select.option', '-1', '- '.JText::_('Do not use').' -');
							}

							if (!$node->attributes('hide_default'))
							{
								$options[] = JHTML::_('select.option', '', '- '.JText::_('Use default').' -');
							}

							if (is_array($files))
							{
								foreach ($files as $file)
								{
									if ($exclude)
									{
										if (preg_match(chr(1) . $exclude . chr(1), $file))
										{
											continue;
										}
									}
									if ($stripExt)
									{
										$file = JFile::stripExt($file);
									}
									$options[] = JHTML::_('select.option', $file, $file);
								}
							}
							return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', $class, 'value', 'text', $value, $control_name.$name);
							break;
							case "logofile":

								$path		= str_replace('[template]', $template, JPATH_ROOT.$zgf->getParam('logoLocation') . '/');

								$filter		= '\.png$|\.gif$|\.jpg$|\.bmp$|\.ico$';
								$exclude	= $node->attributes('exclude');
								$stripExt	= $node->attributes('stripext');
								$files		= JFolder::files($path, $filter);

								if (is_array($files))
								{
									foreach ($files as $file)
									{
										if ($exclude)
										{
											if (preg_match(chr(1) . $exclude . chr(1), $file))
											{
												continue;
											}
										}
										if ($stripExt)
										{
											$file = JFile::stripExt($file);
										}
										$options[] = JHTML::_('select.option', $file, $file);
									}
								}
								return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', $class, 'value', 'text', $value, $control_name.$name);
								break;
								case "logolocation":

									// path to images directory
									$path		= JPATH_ROOT . '/images';
									$filter		= $node->attributes('filter');
									$exclude	= $node->attributes('exclude');
									$folders	= JFolder::listFolderTree($path, $filter);

									$options = array ();
									$options[] = JHTML::_('select.option', '/templates/'.$template.'/images/logo', '/templates/'.$template.'/images/logo');
									foreach ($folders as $folder)
									{
										if ($exclude)
										{
											if (preg_match(chr(1) . $exclude . chr(1), $folder['relname'])) {
												continue;
											}
										}
										$relname = str_replace('\\', '/', $folder['relname']);
										$options[] = JHTML::_('select.option', $relname, $relname);
									}

									return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', $class, 'value', 'text', str_replace('[template]', $template, $value), $control_name.$name);
									break;
				default:
					return;
					break;
			}


			return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', $class, 'value', 'text', $value, $control_name.$name);


		function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
		{
			$app = JFactory::getApplication();
			$template = $zgf->getTemplateName();

			$output = '<label id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'"';
			if ($description) {
				$output .= ' class="hasTip" title="'.JText::_($label).'::'.JText::_(str_replace('[template]', $template, $description)).'">';
			} else {
				$output .= '>';
			}
			$output .= JText::_($label).'</label>';

			return $output;
		}
	}

	}
}
