<?php 

namespace App\Service;
use \DOMDocument;
use \DOMElement;

class Scraper{
    private $colors = array( 
    0 => "None",
    1 => "White", 
    49 => "Very Light Gray", 
    99 => "Very Light Bluish Gray", 
    86 => "Light Bluish Gray", 
    9 => "Light Gray", 
    10 => "Dark Gray", 
    85 => "Dark Bluish Gray", 
    11 => "Black", 
    59 => "Dark Red", 
    5 => "Red", 
    220 => "Coral", 
    231 => "Dark Salmon", 
    25 => "Salmon", 
    26 => "Light Salmon", 
    58 => "Sand Red", 
    120 => "Dark Brown", 
    8 => "Brown", 
    91 => "Light Brown", 
    240 => "Medium Brown", 
    88 => "Reddish Brown", 
    106 => "Fabuland Brown", 
    69 => "Dark Tan", 
    241 => "Medium Tan", 
    2 => "Tan", 
    90 => "Light Nougat", 
    28 => "Nougat", 
    150 => "Medium Nougat", 
    225 => "Dark Nougat", 
    160 => "Fabuland Orange", 
    29 => "Earth Orange", 
    68 => "Dark Orange", 
    27 => "Rust", 
    165 => "Neon Orange", 
    4 => "Orange", 
    31 => "Medium Orange", 
    110 => "Bright Light Orange", 
    32 => "Light Orange", 
    96 => "Very Light Orange", 
    161 => "Dark Yellow", 
    3 => "Yellow", 
    33 => "Light Yellow", 
    103 => "Bright Light Yellow", 
    236 => "Neon Yellow", 
    166 => "Neon Green", 
    35 => "Light Lime", 
    158 => "Yellowish Green", 
    76 => "Medium Lime", 
    248 => "Fabuland Lime", 
    34 => "Lime", 
    242 => "Dark Olive Green", 
    155 => "Olive Green", 
    80 => "Dark Green", 
    6 => "Green", 
    36 => "Bright Green", 
    37 => "Medium Green", 
    38 => "Light Green", 
    48 => "Sand Green", 
    39 => "Dark Turquoise", 
    40 => "Light Turquoise", 
    41 => "Aqua", 
    152 => "Light Aqua", 
    63 => "Dark Blue", 
    7 => "Blue", 
    153 => "Dark Azure", 
    247 => "Little Robots Blue", 
    72 => "Maersk Blue", 
    156 => "Medium Azure", 
    87 => "Sky Blue", 
    42 => "Medium Blue", 
    105 => "Bright Light Blue", 
    62 => "Light Blue", 
    55 => "Sand Blue", 
    109 => "Dark Blue-Violet", 
    43 => "Violet", 
    97 => "Blue-Violet", 
    245 => "Lilac", 
    73 => "Medium Violet", 
    246 => "Light Lilac", 
    44 => "Light Violet", 
    89 => "Dark Purple", 
    24 => "Purple", 
    93 => "Light Purple", 
    157 => "Medium Lavender", 
    154 => "Lavender", 
    227 => "Clikits Lavender", 
    54 => "Sand Purple", 
    71 => "Magenta", 
    47 => "Dark Pink", 
    94 => "Medium Dark Pink", 
    104 => "Bright Pink", 
    23 => "Pink", 
    56 => "Light Pink",
    12 => "Trans-Clear", 
    13 => "Trans-Black", 
    17 => "Trans-Red", 
    18 => "Trans-Neon Orange", 
    98 => "Trans-Orange", 
    164 => "Trans-Light Orange", 
    121 => "Trans-Neon Yellow", 
    19 => "Trans-Yellow", 
    16 => "Trans-Neon Green", 
    108 => "Trans-Bright Green", 
    221 => "Trans-Light Green", 
    226 => "Trans-Light Bright Green", 
    20 => "Trans-Green", 
    14 => "Trans-Dark Blue", 
    74 => "Trans-Medium Blue", 
    15 => "Trans-Light Blue", 
    113 => "Trans-Aqua", 
    114 => "Trans-Light Purple", 
    234 => "Trans-Medium Purple", 
    51 => "Trans-Purple", 
    50 => "Trans-Dark Pink", 
    107 => "Trans-Pink", 
    21 => "Chrome Gold", 
    22 => "Chrome Silver", 
    57 => "Chrome Antique Brass", 
    122 => "Chrome Black", 
    52 => "Chrome Blue", 
    64 => "Chrome Green", 
    82 => "Chrome Pink",
    83 => "Pearl White", 
    119 => "Pearl Very Light Gray", 
    66 => "Pearl Light Gray", 
    95 => "Flat Silver", 
    239 => "Bionicle Silver", 
    77 => "Pearl Dark Gray", 
    244 => "Pearl Black", 
    61 => "Pearl Light Gold", 
    115 => "Pearl Gold", 
    235 => "Reddish Gold", 
    238 => "Bionicle Gold", 
    81 => "Flat Dark Gold", 
    249 => "Reddish Copper", 
    84 => "Copper", 
    237 => "Bionicle Copper", 
    78 => "Pearl Sand Blue", 
    243 => "Pearl Sand Purple",
    228 => "Satin Trans-Clear", 
    229 => "Satin Trans-Black", 
    233 => "Satin Trans-Bright Green", 
    223 => "Satin Trans-Light Blue", 
    232 => "Satin Trans-Dark Blue", 
    230 => "Satin Trans-Purple", 
    224 => "Satin Trans-Dark Pink",
    67 => "Metallic Silver", 
    70 => "Metallic Green", 
    65 => "Metallic Gold", 
    250 => "Metallic Copper",
    60 => "Milky White", 
    159 => "Glow In Dark White", 
    46 => "Glow In Dark Opaque", 
    118 => "Glow In Dark Trans",
    101 => "Glitter Trans-Clear", 
    222 => "Glitter Trans-Orange", 
    163 => "Glitter Trans-Neon Green", 
    162 => "Glitter Trans-Light Blue", 
    102 => "Glitter Trans-Purple", 
    100 => "Glitter Trans-Dark Pink",
    111 => "Speckle Black-Silver", 
    151 => "Speckle Black-Gold", 
    116 => "Speckle Black-Copper", 
    117 => "Speckle DBGray-Silver",  
    123 => "Mx White", 
    124 => "Mx Light Bluish Gray", 
    125 => "Mx Light Gray", 
    126 => "Mx Charcoal Gray", 
    127 => "Mx Tile Gray", 
    128 => "Mx Black", 
    131 => "Mx Tile Brown", 
    134 => "Mx Terracotta", 
    132 => "Mx Brown", 
    133 => "Mx Buff", 
    129 => "Mx Red", 
    130 => "Mx Pink Red", 
    135 => "Mx Orange", 
    136 => "Mx Light Orange", 
    137 => "Mx Light Yellow", 
    138 => "Mx Ochre Yellow", 
    139 => "Mx Lemon", 
    141 => "Mx Pastel Green", 
    140 => "Mx Olive Green", 
    142 => "Mx Aqua Green", 
    146 => "Mx Teal Blue", 
    143 => "Mx Tile Blue", 
    144 => "Mx Medium Blue", 
    145 => "Mx Pastel Blue", 
    147 => "Mx Violet", 
    148 => "Mx Pink", 
    149 => "Mx Clear", 
    210 => "Mx Foil Dark Gray", 
    211 => "Mx Foil Light Gray", 
    212 => "Mx Foil Dark Green", 
    213 => "Mx Foil Light Green", 
    214 => "Mx Foil Dark Blue", 
    215 => "Mx Foil Light Blue", 
    216 => "Mx Foil Violet", 
    217 => "Mx Foil Red", 
    218 => "Mx Foil Yellow", 
    219 => "Mx Foil Orange");
    private $elid_arr = [];
    private $name_arr = [];
    private $quantity_arr = [];
    private $link_arr = [];
    private $imglink_arr = [];
    private $type_arr = [];
    private $color_arr = [];
    private $minifig_arr = [];

    private $m_elid_arr = [];
    private $m_name_arr = [];
    private $m_quantity_arr = [];
    private $m_link_arr = [];
    private $m_imglink_arr = [];

    private function get_elid($el){
        $string = '';
        for($i=0;1;$i++){
            if(substr($el, strpos($el, 'Part No:')+9+$i,1)==' ' or empty(strpos($el, 'Part No:'))){
                break;
            }else{
                $string = $string.substr($el, strpos($el, 'Part No:')+9+$i,1);
            }
        }
        return $string;
    }

    private function get_name($el){
        $string = '';
        for($i=0;1;$i++){
            if(substr($el, strpos($el, 'title=')+7+$i,1)=='"'){
                break;
            }else{
                if(substr($el, strpos($el, 'Name:')+6+$i,1)=='"'){
                    break;
                }else{
                    $string = $string.substr($el, strpos($el, 'Name:')+6+$i,1);
                }
            }
        }
        return $string;
    }

    private function get_color($el){
        $string = '';
        for($i=0;1;$i++){
            if(substr($el, strpos($el, 'idColor=')+8+$i,1)=='"'){
                break;
            }else{
                 $string = $string.substr($el, strpos($el, 'idColor=')+8+$i,1);
            }
        }
        return $string;
    }

    private function get_quantity($el){
        $string = '';
        for($i=0;1;$i++){
            if(substr($el, strpos($el, 'RIGHT')+9+$i,1)=='<'){
                break;
            }else{
                 $string = $string.substr($el, strpos($el, 'RIGHT')+9+$i,1);
            }
        }
        return (int) $string;
    }

    private function get_link($el){
        $string = 'https://www.bricklink.com/v2/catalog/catalogitem.page?P='.
        $this->get_elid($el).
        '&idColor='.
        $this->get_color($el).
        '#T=S&C='.
        $this->get_color($el).
        '&O={"color":'.
        $this->get_color($el).
        ',"rpp":"500","iconly":0}';
        return $string;
    }

    private function get_imglink($el){
        $string = 'https://img.bricklink.com/P/'.
        $this->get_color($el).
        '/'.
        $this->get_elid($el).
        '.jpg';
        return $string;
    }

    private function get_type($el){
        $string = '';
        for($i=0;1;$i++){
            if(substr($el, strpos($el, 'catString')+9+$i,1)=='<'){
                break;
            }else{
                 $string = $string.substr($el, strpos($el, 'catString')+9+$i,1);
            }
        }
        return substr(strstr($string, '>'), 1);
    }

    public function get_parts(){
        $arr = [];
        foreach($this->elid_arr as $key => $elid){
            array_push($arr, ['el_id'=>$this->elid_arr[$key],
            'name'=>$this->name_arr[$key],
            'quantity'=>$this->quantity_arr[$key],
            'link'=>$this->link_arr[$key],
            'img_link'=>$this->imglink_arr[$key],
            'part_type'=>$this->type_arr[$key],
            'color'=>$this->color_arr[$key]]);
        }
        return $arr;
    }

    private function get_minifig_id($el){
        $string = '';
        for($i=0;1;$i++){
            if(substr($el, strpos($el, 'asp?M=')+$i,1)=='"' or empty(strpos($el, 'asp?M='))){
                break;
            }else{
                $string = $string.substr($el, strpos($el, 'asp?M=')+6+$i,1);
            }
        }
        return explode('"',$string)[0];
    }

    public function get_minifigures(){
        $arr = [];
        foreach($this->m_elid_arr as $key => $elid){
            array_push($arr, ['el_id'=>$this->m_elid_arr[$key],
            'name'=>$this->m_name_arr[$key],
            'quantity'=>$this->m_quantity_arr[$key],
            'link'=>$this->m_link_arr[$key],
            'img_link'=>$this->m_imglink_arr[$key]]);
        }
        return $arr;
    }

    private function get_minifigure_link($el){
        $string = 'https://www.bricklink.com/v2/catalog/catalogitem.page?M='.
        $this->get_minifig_id($el).
        '&#T=I';
        return $string;
    }

    private function get_minifigure_imglink($el){
        $string = 'https://img.bricklink.com/ItemImage/MN/0/'.
        $this->get_minifig_id($el).
        '.png';
        return $string;
    }
    private function DOMinnerHTML(DOMElement $element) 
    { 
        $innerHTML = ""; 
        $children  = $element->childNodes;

        foreach ($children as $child) 
        { 
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML; 
    }

    public function scrap($set_id, $t){
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        if($t==='m'){
            $url = 'https://www.bricklink.com/catalogItemInv.asp?M='.$set_id;
        }else{
            $url = 'https://www.bricklink.com/catalogItemInv.asp?S='.$set_id.'-1';
        }
        $doc->loadHTMLFile($url);

        $trs = $doc->getElementsByTagName('tr');
        $arr = [];
        $i=0;
        foreach($trs as $tr){  
            if(strpos($this->DOMinnerHTML($tr), 'IV_ITEM') or $i){
                array_push($arr, $this->DOMinnerHTML($tr));
                $i++;
            }
        }

        for($n=0;$n<10;$n++){
            array_shift($arr);
        }

        $va = 0;
        foreach($arr as $key=>$a){
            if(strpos($a, 'Minifigures:')){
                $va = $key;
            }elseif($va>0){
                array_push($this->minifig_arr, $a);
            }elseif(strpos($a, 'Parts:') and $va>0){
                echo "minifigures between {$va} and {$key}";
                break;
            }
        }

        foreach($this->minifig_arr as $key=>$a){
            if(!empty(strpos($a, 'td colspan='))){
                array_splice($this->minifig_arr, $key);
            }
        }

        foreach($arr as $key=>$a){
            if(!empty(strpos($a, 'td colspan='))){
                array_splice($arr, $key);
            }
        }
        

        foreach($arr as $key => $a){
                $this->elid_arr[$key] = $this->get_elid($a);
                $this->elid_arr = array_filter($this->elid_arr);
                if(isset($this->elid_arr[$key])){
                    $this->elid_arr[$key] = $this->get_elid($a);
                    $this->name_arr[$key] = $this->get_name($a);
                    $this->color_arr[$key] = $this->colors[$this->get_color($a)];
                    $this->quantity_arr[$key] = $this->get_quantity($a);
                    $this->link_arr[$key] = $this->get_link($a);
                    $this->imglink_arr[$key] = $this->get_imglink($a);
                    $this->type_arr[$key] = $this->get_type($a);
                }
        }
        foreach($this->minifig_arr as $key => $a){
            $x = $this->get_minifig_id($a);
            if(empty( $x )){
                unset($this->minifig_arr[$key]);
            }
        }

        foreach($this->minifig_arr as $key => $a){
            $this->m_elid_arr[$key] = $this->get_minifig_id($a);
            $this->m_name_arr[$key] = $this->get_name($a);
            $this->m_quantity_arr[$key] = $this->get_quantity($a);
            $this->m_link_arr[$key] = $this->get_minifigure_link($a);
            $this->m_imglink_arr[$key] = $this->get_minifigure_imglink($a);
        }
    }
}
