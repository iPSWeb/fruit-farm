<?PHP
if (!defined('PSWeb') || PSWeb !== true) { Header('Location: /404'); return; }
class func{

	public $UserIP = '0000000000'; # IP пользователя
	public $UserCode = "Undefined"; # Код от IP
	public $TableID = -1; # ID таблицы
	public $UserAgent = "Undefined"; // Браузер пользователя

	/*======================================================================*\
	Function:	__construct
	Output:		Нет
	Descriiption: Выполняется при создании экземпляра класса
	\*======================================================================*/
	public function __construct(){
		$this->UserIP = $this->GetUserIp();
		$this->UserAgent = $this->UserAgent();
	}
	
	/*======================================================================*\
	Function:	__destruct
	Output:		Нет
	Descriiption: Уничтожение объекта
	\*======================================================================*/
	public function __destruct(){
	
	}
	
	
	/*======================================================================*\
	Function:	IsMail
	Output:		True / False
	Input:		Email 
	Descriiption: Проверяет правильность ввода email адреса
	\*======================================================================*/
	public function IsMail($mail){
            if(is_array($mail) && empty($mail) && strlen($mail) > 255 && strpos($mail,'@') > 64) return false;
            return ( !preg_match("#^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$#ix", $mail)) ? false : strtolower($mail);	
	}
	
	/*======================================================================*\
	Function:	IsPassword
	Output:		True / False
	Input:		Строка пароля, Маска, Длина ("10, 25") && ("10") 
	Descriiption: Проверяет правильность ввода пароля
	\*======================================================================*/
	public function IsPassword($password){
            return (is_array($password)) ? false : (preg_match("#^[a-zA-Z0-9]{4,20}$#", $password)) ? $password : false;
	}
	
	/*======================================================================*\
	Function:	IsLogin
	Output:		True / False
	Input:		Строка логина, Маска, Длина ("10, 25") && ("10") 
	Descriiption: Проверяет правильность ввода логина
	\*======================================================================*/
	public function IsLogin($login){
		return (is_array($login)) ? false : (preg_match("#^[a-zA-Z0-9]{4,10}$#", $login)) ? $login : false;
	}
	
	/*======================================================================*\
	Function:	GetUserIp
	Output:		UserIp
	Descriiption: Определяет IP пользователя
	\*======================================================================*/
	public function GetUserIp(){
            if($this->UserIP == "0000000000"){
                if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                    //ip from share internet
                    $this->UserIP = $_SERVER['HTTP_CLIENT_IP'];
                }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    //ip pass from proxy
                    $this->UserIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }else{
                    $this->UserIP = $_SERVER['REMOTE_ADDR'];
                }
                return $this->UserIP;
            }else{
                return $this->UserIP;
            }
	}
	
	/*======================================================================*\
	Function:	SellItems
	Descriiption: Выводит сумму и остаток
	\*======================================================================*/
	public function SellItems($all_items, $for_one_coin){
		if($all_items <= 0 OR $for_one_coin <= 0) return 0;
		return sprintf("%.2f", ($all_items / $for_one_coin));
	}
	
	/*======================================================================*\
	Function:	IpToLong
	Descriiption: Преобразует IP в целочисленное
	\*======================================================================*/
	public function IpToInt($ip){ 
	
		$ip = ip2long($ip); 
		($ip < 0) ? $ip+=4294967296 : true; 
		return $ip; 
	}
	
	/*======================================================================*\
	Function:	IpToLong
	Descriiption: Преобразует целочисленное в IP
	\*======================================================================*/
	public function IntToIP($int){ 
  		return long2ip($int);  
	}
	
	/*======================================================================*\
	Function:	IsWM
	Output:		True / False
	Input:		Реквизит, TYPE: 0 - WMID, 1 - WMR, 2 - WMZ, 3 - WME, 4 - WMU 
	Descriiption: Проверяет правильность ввода пароля
	\*======================================================================*/
	public function IsWM($data, $type = 0){
		$FirstChar = array( 1 => "R",
                        2 => "Z",
                        3 => "E",
                        4 => "U"
                    );
		
		if(strlen($data) < 12 && strlen($data) > 12 && $type < 0 && $type > count($FirstChar)) return false;
		if($type == 0) return (is_array($data)) ? false : ( preg_match("#^[0-9]{12}$#", $data) ? $data : false );
		if( substr(strtoupper($data),0,1) != $FirstChar[$type] or !preg_match("#^[0-9]{12}$#", substr($data,1)) ) return false;
		return $data;
	}
	
	/*======================================================================*\
	Function:	GetTime
	Descriiption: Возвращаер дату
	\*======================================================================*/
	public function GetTime($tis = 0, $unix = true, $template = "d.m.Y H:i:s"){
		
		if($tis == 0){
			return ($unix) ? time() : date($template,time());
		}else return date($template,$unix);
	}
	
	/*======================================================================*\
	Function:	UserAgent
	Descriiption: Возвращает браузер пользователя
	\*======================================================================*/
	public function UserAgent(){
		return $this->TextClean($_SERVER['HTTP_USER_AGENT']);
	}
	
	/*======================================================================*\
	Function:	TextClean
	Descriiption: Очистка текста
	\*======================================================================*/
	public function TextClean($text){
		$array_find = array("`", "<", ">", "^", '"', "~", "\\");
		$array_replace = array("&#96;", "&lt;", "&gt;", "&circ;", "&quot;", "&tilde;", "");
		return str_replace($array_find, $array_replace, $text);
	}
	
	/*======================================================================*\
	Function:	ShowError
	Descriiption: Выводит список ошибок строкой
	\*======================================================================*/
	public function ShowError($errorArray = array(), $title = "Исправьте следующие ошибки"){
		if(count($errorArray) > 0){
		$string_a = "<div class='Error'><div class='ErrorTitle'>".$title."</div><ul>";
			foreach($errorArray as $number => $value){
				$string_a .= "<li>".($number+1)." - ".$value."</li>";
			}
		$string_a .= "</ul></div><BR />";
		return $string_a;
		}else return "Неизвестная ошибка :(";
	}
	
	/*======================================================================*\
	Function:	ComissionWm
	Descriiption: Возвращает комиссию WM
	\*======================================================================*/
	public function ComissionWm($sum, $com_payee, $com_payysys){
		$a = ceil(ceil($sum * $com_payee * 100) / 10000*100) / 100;
		$b = ceil(ceil($sum * str_replace("%","",$com_payysys) * 100) / 10000*100) / 100;
		return $a+$b;
	}
	
        /*======================================================================*\
	Function:	sha512Password
	Descriiption: Возвращает хеш пароля
	\*======================================================================*/
	public function sha512Password($pass,$salt){
            return hash_hmac('sha512',$pass,$salt);
	}
        
        /*======================================================================*\
	Function:	genSaltd
	Descriiption: Возвращает соль для хеширования пароля
	\*======================================================================*/
        public function genSalt(){
            $chars='QAZXSWEDCVFRTGBNHYUJMKIOLPqazxswedcvfrtgbnhyujmkiolp1234567890';
            $max=64;
            $size=StrLen($chars)-1; 
            $salt=null;
            while($max--){
                $salt.=$chars[rand(0,$size)];
            }
            return $salt;
        }
        
        /*======================================================================*\
	Function:	genPassword
	Descriiption: Возвращает сгенерированный пароль
	\*======================================================================*/
        public function genPassword(){
            $chars='QAZXSWEDCVFRTGBNHYUJMKIOLPqazxswedcvfrtgbnhyujmkiolp1234567890';
            $max=20;
            $size=StrLen($chars)-1; 
            $password=null;
            while($max--){
                $password.=$chars[rand(0,$size)];
            }
            return $password;
        }
	/*======================================================================*\
	Function:	ControlCode
	Descriiption: Возвращает контрольное число
	\*======================================================================*/
	public function ControlCode($time = 0){
		return ($time > 0) ? date("Ymd", $time) : date("Ymd");
	}
	
	/*======================================================================*\
	Function:	SumCalc
	Descriiption: Возвращает сумму овощей
	\*======================================================================*/
	public function SumCalc($per_h, $sum_tree, $last_sbor){
		if($last_sbor > 0){
			if($sum_tree > 0 AND $per_h > 0){
				$last_sbor = ($last_sbor < time()) ? (time() - $last_sbor) : 0;
				$per_sec = $per_h / 3600;
				return round( ($per_sec * $sum_tree) * $last_sbor);
			}else return 0;
		}else return 0;
	}
        /*======================================================================*\
	Function:	CheckPayeer
	Descriiption: Проверка правильности ввода кошелька Payeer
	\*======================================================================*/
	function CheckPayeer($purse){
		if( substr($purse,0,1) != "P" ) return false;
		if( !preg_match("#^[0-9]{7,}$#", substr($purse,1)) ) return false;	
		return $purse;
	}
        
        /*======================================================================*\
	Function:	getPhrase
	Descriiption: Генерация секретной фразы для PSC кошелька
	\*======================================================================*/
        public function getPhrase(){
            $count = 12;
            $words = array("like", "just", "love", "know", "never", "want", "time", "out", "there", "make", "look", "eye", "down", "only", "think", "heart", "back", "then", "into", "about", "more", "away", "still", "them", "take", "thing", "even", "through", "long", "always", "world", "too", "friend", "tell", "try", "hand", "thought", "over", "here", "other", "need", "smile", "again", "much", "cry", "been", "night", "ever", "little", "said", "end", "some", "those", "around", "mind", "people", "girl", "leave", "dream", "left", "turn", "myself", "give", "nothing", "really", "off", "before", "something", "find", "walk", "wish", "good", "once", "place", "ask", "stop", "keep", "watch", "seem", "everything", "wait", "got", "yet", "made", "remember", "start", "alone", "run", "hope", "maybe", "believe", "body", "hate", "after", "close", "talk", "stand", "own", "each", "hurt", "help", "home", "god", "soul", "new", "many", "two", "inside", "should", "true", "first", "fear", "mean", "better", "play", "another", "gone", "change", "use", "wonder", "someone", "hair", "cold", "open", "best", "any", "behind", "happen", "water", "dark", "laugh", "stay", "forever", "name", "work", "show", "sky", "break", "came", "deep", "door", "put", "black", "together", "upon", "happy", "such", "great", "white", "matter", "fill", "past", "please", "burn", "cause", "enough", "touch", "moment", "soon", "voice", "scream", "anything", "stare", "sound", "red", "everyone", "hide", "kiss", "truth", "death", "beautiful", "mine", "blood", "broken", "very", "pass", "next", "forget", "tree", "wrong", "air", "mother", "understand", "lip", "hit", "wall", "memory", "sleep", "free", "high", "realize", "school", "might", "skin", "sweet", "perfect", "blue", "kill", "breath", "dance", "against", "fly", "between", "grow", "strong", "under", "listen", "bring", "sometimes", "speak", "pull", "person", "become", "family", "begin", "ground", "real", "small", "father", "sure", "feet", "rest", "young", "finally", "land", "across", "today", "different", "guy", "line", "fire", "reason", "reach", "second", "slowly", "write", "eat", "smell", "mouth", "step", "learn", "three", "floor", "promise", "breathe", "darkness", "push", "earth", "guess", "save", "song", "above", "along", "both", "color", "house", "almost", "sorry", "anymore", "brother", "okay", "dear", "game", "fade", "already", "apart", "warm", "beauty", "heard", "notice", "question", "shine", "began", "piece", "whole", "shadow", "secret", "street", "within", "finger", "point", "morning", "whisper", "child", "moon", "green", "story", "glass", "kid", "silence", "since", "soft", "yourself", "empty", "shall", "angel", "answer", "baby", "bright", "dad", "path", "worry", "hour", "drop", "follow", "power", "war", "half", "flow", "heaven", "act", "chance", "fact", "least", "tired", "children", "near", "quite", "afraid", "rise", "sea", "taste", "window", "cover", "nice", "trust", "lot", "sad", "cool", "force", "peace", "return", "blind", "easy", "ready", "roll", "rose", "drive", "held", "music", "beneath", "hang", "mom", "paint", "emotion", "quiet", "clear", "cloud", "few", "pretty", "bird", "outside", "paper", "picture", "front", "rock", "simple", "anyone", "meant", "reality", "road", "sense", "waste", "bit", "leaf", "thank", "happiness", "meet", "men", "smoke", "truly", "decide", "self", "age", "book", "form", "alive", "carry", "escape", "damn", "instead", "able", "ice", "minute", "throw", "catch", "leg", "ring", "course", "goodbye", "lead", "poem", "sick", "corner", "desire", "known", "problem", "remind", "shoulder", "suppose", "toward", "wave", "drink", "jump", "woman", "pretend", "sister", "week", "human", "joy", "crack", "grey", "pray", "surprise", "dry", "knee", "less", "search", "bleed", "caught", "clean", "embrace", "future", "king", "son", "sorrow", "chest", "hug", "remain", "sat", "worth", "blow", "daddy", "final", "parent", "tight", "also", "create", "lonely", "safe", "cross", "dress", "evil", "silent", "bone", "fate", "perhaps", "anger", "class", "scar", "snow", "tiny", "tonight", "continue", "control", "dog", "edge", "mirror", "month", "suddenly", "comfort", "given", "loud", "quickly", "gaze", "plan", "rush", "stone", "town", "battle", "ignore", "spirit", "stood", "stupid", "yours", "brown", "build", "dust", "hey", "kept", "pay", "phone", "twist", "although", "ball", "beyond", "hidden", "nose", "taken", "fail", "float", "pure", "somehow", "wash", "wrap", "angry", "cheek", "creature", "forgotten", "heat", "rip", "single", "space", "special", "weak", "whatever", "yell", "anyway", "blame", "job", "choose", "country", "curse", "drift", "echo", "figure", "grew", "laughter", "neck", "suffer", "worse", "yeah", "disappear", "foot", "forward", "knife", "mess", "somewhere", "stomach", "storm", "beg", "idea", "lift", "offer", "breeze", "field", "five", "often", "simply", "stuck", "win", "allow", "confuse", "enjoy", "except", "flower", "seek", "strength", "calm", "grin", "gun", "heavy", "hill", "large", "ocean", "shoe", "sigh", "straight", "summer", "tongue", "accept", "crazy", "everyday", "exist", "grass", "mistake", "sent", "shut", "surround", "table", "ache", "brain", "destroy", "heal", "nature", "shout", "sign", "stain", "choice", "doubt", "glance", "glow", "mountain", "queen", "stranger", "throat", "tomorrow", "city", "either", "fish", "flame", "rather", "shape", "spin", "spread", "ash", "distance", "finish", "image", "imagine", "important", "nobody", "shatter", "warmth", "became", "feed", "flesh", "funny", "lust", "shirt", "trouble", "yellow", "attention", "bare", "bite", "money", "protect", "amaze", "appear", "born", "choke", "completely", "daughter", "fresh", "friendship", "gentle", "probably", "six", "deserve", "expect", "grab", "middle", "nightmare", "river", "thousand", "weight", "worst", "wound", "barely", "bottle", "cream", "regret", "relationship", "stick", "test", "crush", "endless", "fault", "itself", "rule", "spill", "art", "circle", "join", "kick", "mask", "master", "passion", "quick", "raise", "smooth", "unless", "wander", "actually", "broke", "chair", "deal", "favorite", "gift", "note", "number", "sweat", "box", "chill", "clothes", "lady", "mark", "park", "poor", "sadness", "tie", "animal", "belong", "brush", "consume", "dawn", "forest", "innocent", "pen", "pride", "stream", "thick", "clay", "complete", "count", "draw", "faith", "press", "silver", "struggle", "surface", "taught", "teach", "wet", "bless", "chase", "climb", "enter", "letter", "melt", "metal", "movie", "stretch", "swing", "vision", "wife", "beside", "crash", "forgot", "guide", "haunt", "joke", "knock", "plant", "pour", "prove", "reveal", "steal", "stuff", "trip", "wood", "wrist", "bother", "bottom", "crawl", "crowd", "fix", "forgive", "frown", "grace", "loose", "lucky", "party", "release", "surely", "survive", "teacher", "gently", "grip", "speed", "suicide", "travel", "treat", "vein", "written", "cage", "chain", "conversation", "date", "enemy", "however", "interest", "million", "page", "pink", "proud", "sway", "themselves", "winter", "church", "cruel", "cup", "demon", "experience", "freedom", "pair", "pop", "purpose", "respect", "shoot", "softly", "state", "strange", "bar", "birth", "curl", "dirt", "excuse", "lord", "lovely", "monster", "order", "pack", "pants", "pool", "scene", "seven", "shame", "slide", "ugly", "among", "blade", "blonde", "closet", "creek", "deny", "drug", "eternity", "gain", "grade", "handle", "key", "linger", "pale", "prepare", "swallow", "swim", "tremble", "wheel", "won", "cast", "cigarette", "claim", "college", "direction", "dirty", "gather", "ghost", "hundred", "loss", "lung", "orange", "present", "swear", "swirl", "twice", "wild", "bitter", "blanket", "doctor", "everywhere", "flash", "grown", "knowledge", "numb", "pressure", "radio", "repeat", "ruin", "spend", "unknown", "buy", "clock", "devil", "early", "false", "fantasy", "pound", "precious", "refuse", "sheet", "teeth", "welcome", "add", "ahead", "block", "bury", "caress", "content", "depth", "despite", "distant", "marry", "purple", "threw", "whenever", "bomb", "dull", "easily", "grasp", "hospital", "innocence", "normal", "receive", "reply", "rhyme", "shade", "someday", "sword", "toe", "visit", "asleep", "bought", "center", "consider", "flat", "hero", "history", "ink", "insane", "muscle", "mystery", "pocket", "reflection", "shove", "silently", "smart", "soldier", "spot", "stress", "train", "type", "view", "whether", "bus", "energy", "explain", "holy", "hunger", "inch", "magic", "mix", "noise", "nowhere", "prayer", "presence", "shock", "snap", "spider", "study", "thunder", "trail", "admit", "agree", "bag", "bang", "bound", "butterfly", "cute", "exactly", "explode", "familiar", "fold", "further", "pierce", "reflect", "scent", "selfish", "sharp", "sink", "spring", "stumble", "universe", "weep", "women", "wonderful", "action", "ancient", "attempt", "avoid", "birthday", "branch", "chocolate", "core", "depress", "drunk", "especially", "focus", "fruit", "honest", "match", "palm", "perfectly", "pillow", "pity", "poison", "roar", "shift", "slightly", "thump", "truck", "tune", "twenty", "unable", "wipe", "wrote", "coat", "constant", "dinner", "drove", "egg", "eternal", "flight", "flood", "frame", "freak", "gasp", "glad", "hollow", "motion", "peer", "plastic", "root", "screen", "season", "sting", "strike", "team", "unlike", "victim", "volume", "warn", "weird", "attack", "await", "awake", "built", "charm", "crave", "despair", "fought", "grant", "grief", "horse", "limit", "message", "ripple", "sanity", "scatter", "serve", "split", "string", "trick", "annoy", "blur", "boat", "brave", "clearly", "cling", "connect", "fist", "forth", "imagination", "iron", "jock", "judge", "lesson", "milk", "misery", "nail", "naked", "ourselves", "poet", "possible", "princess", "sail", "size", "snake", "society", "stroke", "torture", "toss", "trace", "wise", "bloom", "bullet", "cell", "check", "cost", "darling", "during", "footstep", "fragile", "hallway", "hardly", "horizon", "invisible", "journey", "midnight", "mud", "nod", "pause", "relax", "shiver", "sudden", "value", "youth", "abuse", "admire", "blink", "breast", "bruise", "constantly", "couple", "creep", "curve", "difference", "dumb", "emptiness", "gotta", "honor", "plain", "planet", "recall", "rub", "ship", "slam", "soar", "somebody", "tightly", "weather", "adore", "approach", "bond", "bread", "burst", "candle", "coffee", "cousin", "crime", "desert", "flutter", "frozen", "grand", "heel", "hello", "language", "level", "movement", "pleasure", "powerful", "random", "rhythm", "settle", "silly", "slap", "sort", "spoken", "steel", "threaten", "tumble", "upset", "aside", "awkward", "bee", "blank", "board", "button", "card", "carefully", "complain", "crap", "deeply", "discover", "drag", "dread", "effort", "entire", "fairy", "giant", "gotten", "greet", "illusion", "jeans", "leap", "liquid", "march", "mend", "nervous", "nine", "replace", "rope", "spine", "stole", "terror", "accident", "apple", "balance", "boom", "childhood", "collect", "demand", "depression", "eventually", "faint", "glare", "goal", "group", "honey", "kitchen", "laid", "limb", "machine", "mere", "mold", "murder", "nerve", "painful", "poetry", "prince", "rabbit", "shelter", "shore", "shower", "soothe", "stair", "steady", "sunlight", "tangle", "tease", "treasure", "uncle", "begun", "bliss", "canvas", "cheer", "claw", "clutch", "commit", "crimson", "crystal", "delight", "doll", "existence", "express", "fog", "football", "gay", "goose", "guard", "hatred", "illuminate", "mass", "math", "mourn", "rich", "rough", "skip", "stir", "student", "style", "support", "thorn", "tough", "yard", "yearn", "yesterday", "advice", "appreciate", "autumn", "bank", "beam", "bowl", "capture", "carve", "collapse", "confusion", "creation", "dove", "feather", "girlfriend", "glory", "government", "harsh", "hop", "inner", "loser", "moonlight", "neighbor", "neither", "peach", "pig", "praise", "screw", "shield", "shimmer", "sneak", "stab", "subject", "throughout", "thrown", "tower", "twirl", "wow", "army", "arrive", "bathroom", "bump", "cease", "cookie", "couch", "courage", "dim", "guilt", "howl", "hum", "husband", "insult", "led", "lunch", "mock", "mostly", "natural", "nearly", "needle", "nerd", "peaceful", "perfection", "pile", "price", "remove", "roam", "sanctuary", "serious", "shiny", "shook", "sob", "stolen", "tap", "vain", "void", "warrior", "wrinkle", "affection", "apologize", "blossom", "bounce", "bridge", "cheap", "crumble", "decision", "descend", "desperately", "dig", "dot", "flip", "frighten", "heartbeat", "huge", "lazy", "lick", "odd", "opinion", "process", "puzzle", "quietly", "retreat", "score", "sentence", "separate", "situation", "skill", "soak", "square", "stray", "taint", "task", "tide", "underneath", "veil", "whistle", "anywhere", "bedroom", "bid", "bloody", "burden", "careful", "compare", "concern", "curtain", "decay", "defeat", "describe", "double", "dreamer", "driver", "dwell", "evening", "flare", "flicker", "grandma", "guitar", "harm", "horrible", "hungry", "indeed", "lace", "melody", "monkey", "nation", "object", "obviously", "rainbow", "salt", "scratch", "shown", "shy", "stage", "stun", "third", "tickle", "useless", "weakness", "worship", "worthless", "afternoon", "beard", "boyfriend", "bubble", "busy", "certain", "chin", "concrete", "desk", "diamond", "doom", "drawn", "due", "felicity", "freeze", "frost", "garden", "glide", "harmony", "hopefully", "hunt", "jealous", "lightning", "mama", "mercy", "peel", "physical", "position", "pulse", "punch", "quit", "rant", "respond", "salty", "sane", "satisfy", "savior", "sheep", "slept", "social", "sport", "tuck", "utter", "valley", "wolf", "aim", "alas", "alter", "arrow", "awaken", "beaten", "belief", "brand", "ceiling", "cheese", "clue", "confidence", "connection", "daily", "disguise", "eager", "erase", "essence", "everytime", "expression", "fan", "flag", "flirt", "foul", "fur", "giggle", "glorious", "ignorance", "law", "lifeless", "measure", "mighty", "muse", "north", "opposite", "paradise", "patience", "patient", "pencil", "petal", "plate", "ponder", "possibly", "practice", "slice", "spell", "stock", "strife", "strip", "suffocate", "suit", "tender", "tool", "trade", "velvet", "verse", "waist", "witch", "aunt", "bench", "bold", "cap", "certainly", "click", "companion", "creator", "dart", "delicate", "determine", "dish", "dragon", "drama", "drum", "dude", "everybody", "feast", "forehead", "former", "fright", "fully", "gas", "hook", "hurl", "invite", "juice", "manage", "moral", "possess", "raw", "rebel", "royal", "scale", "scary", "several", "slight", "stubborn", "swell", "talent", "tea", "terrible", "thread", "torment", "trickle", "usually", "vast", "violence", "weave", "acid", "agony", "ashamed", "awe", "belly", "blend", "blush", "character", "cheat", "common", "company", "coward", "creak", "danger", "deadly", "defense", "define", "depend", "desperate", "destination", "dew", "duck", "dusty", "embarrass", "engine", "example", "explore", "foe", "freely", "frustrate", "generation", "glove", "guilty", "health", "hurry", "idiot", "impossible", "inhale", "jaw", "kingdom", "mention", "mist", "moan", "mumble", "mutter", "observe", "ode", "pathetic", "pattern", "pie", "prefer", "puff", "rape", "rare", "revenge", "rude", "scrape", "spiral", "squeeze", "strain", "sunset", "suspend", "sympathy", "thigh", "throne", "total", "unseen", "weapon", "weary");
            $string = '';
            $i = 1;
            while($i<=$count){
                $key = array_rand($words);
                $string.= ($i == $count)?$words[$key]:$words[$key].' ';
                $i++;
            }
            return $string;
        }
        
        public function validatePSC($wallet){
            if(!preg_match("#^PSC-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{5}$#",$wallet)){
                return false;
            }else{
                return $wallet;
            }
        }
}